<?php
/**
 * 28/10/2015 18h
 * Classe desenvolvida apenas para o teste da MMDA
 * Cada classe concreta deve representar uma tabela do sistema (imoveis, contatos etc...)
 * Encapsula a construção de queries do tipo INSERT, UPDATE e DELETE
 * Oferece métodos para queries de consultas rápidas
*/
namespace Models;
require_once(__DIR__."/../config.php");

abstract class Base{
	
	// id de um registro selecionado
	public $row_id = null;
	
	// erros de validacao (campo => mensagem de erro)
	public $errors = array();
	
	// variaveis de conexao
	protected $host = '';
	protected $pass = '';
	protected $user = '';
	protected $dbname = '';
	
	// cache global de conexoes abertas
	private static $connections = array();
		
	// construtor
	function __construct($row_id=null){
		
		$this->row_id = $row_id;
		
		// seta as variaveis de conexao com valores default (ver ../config.php)
		$this->host   = DB_HOST_DEFAULT;
		$this->pass   = DB_PASS_DEFAULT;
		$this->user   = DB_USER_DEFAULT;
		$this->dbname = DB_NAME_DEFAULT;
		
		$this->init();
	}
	
	function init(){
		// aqui voce pode sobrescrever variaveis de conexao
		// caso o seu model (tabela) esteja em um banco especifico
	}
	
	// uma classe concreta deve implementar os metodos abaixo
	abstract function getTableName();
	abstract function getAlias();
	
	// uma classe abstrata pode especificar joins a serem feitos automaticamente em todas as queries SELECT
	function getJoins(){
		return '';
	}

	// garante que uma conexao com os mesmos parametros só é feita uma única vez
	protected function getConnection(){
		
		$hash = $this->host.$this->pass.$this->user.$this->dbname;
		
		if(!isset(self::$connections[$hash])){
			self::$connections[$hash] = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
			if(!self::$connections[$hash]){
				throw new Exception("Não foi possivel conectar-se ao banco de dados. Error: ".mysqli_connect_error());
			}
			mysqli_set_charset(self::$connections[$hash],'utf8');
		}
		
		return self::$connections[$hash];
	}
	
	// pode ser implementada por uma classe concreta
	// para indicar erro retorne false e grave os erros em $this->errors
	function validate(array $data){
		return true;
	}

	// faz escape de uma string para montar queries com segurança
	function escape($value){
		$connection = $this->getConnection();
		return mysqli_real_escape_string($connection, $value);
	}
	
	// executa um comando sql e verifica se aconteceu algum erro
	function query($sql){
		$connection = $this->getConnection();
		$result = mysqli_query($connection, $sql);	
		if(!$result){
			throw new \Exception("Não foi possível executar query: $sql. Error: ".mysqli_error($connection));
		}
		return $result;
	}
		
	// monta uma query de INSERT e adiciona um registro na tabela deste model
	// retorna sempre o id do registro inserido
	function add(array $data){
		// valida
		if(empty($data)||!$this->validate($data)){
			return false;
		}
		// monta query
		$table = $this->getTableName();
		$cols = "`".implode("`,`",array_keys($data))."`";
		$vals = array();
		foreach($data as $value){
			$vals[] = $this->escape($value);
		}
		$vals = "'".implode("','",$vals)."'";
		$sql = "INSERT INTO `$table` ($cols) VALUES($vals)";
		// executa query
		$this->query($sql);
		$this->row_id = mysqli_insert_id($this->getConnection());
		return $this->row_id;
	}
	
	// monta uma query de UPDATE e atualiza um registro indicado por $row_id
	// caso $row_id não for especificado, tenta obtê-lo a partir da instância ($this->row_id)
	function update(array $data, $row_id=null){
		// valida
		$table = $this->getTableName();
		$row_id = (int) ($row_id ?: $this->row_id);
		if(!$row_id){
			throw new \Exception("Não foi possivel atualizar registro da tabela $table: row_id não informado!");
		}
		if(empty($data)||!$this->validate($data)){
			return false;
		}
		// monta query
		$sql = "UPDATE `$table` SET ";
		foreach($data as $k=>$v){
			$v = $this->escape($v);
			$sql.="`$k`='$v', ";
		}
		$sql = rtrim($sql,", ")." WHERE id=$row_id";
		// executa
		return $this->query($sql);
	}

	// adiciona um registro quando $this->row_id é vazio
	// atualiza um registro quando $this->row_id é um id válido
	function save($data=array()){
		$row_id = (int)$this->row_id;
		if($row_id){
			return $this->update($data);
		} else {
			return $this->add($data);
		}
	}
	
	// deleta um registro indicado por $row_id ou $this->row_id
	function delete($row_id=null){
		// valida
		$table = $this->getTableName();
		$row_id = (int)($row_id ?: $this->row_id);
		if(!$row_id){
			throw new \Exception("Não foi possivel deletar registro da tabela $table: row_id não informado!");
		}
		// monta e executa query
		return $this->query("DELETE FROM `$table` WHERE id=$row_id");		
	}

	// retorna um registro por vez a partir de um resultset
	function fetchRow($rs){
		return mysqli_fetch_assoc($rs);
	}

	// monta query de select e retorna um array de registros encontados
	// a ordenação default é id DESC (estatisticamente é a ordenação mais usada)
	function getRows($select='', $where=null, $order_by=null, $limit=null){
		// monta query
		$table = $this->getTableName();
		$alias = $this->getAlias();
		$joins = $this->getJoins();
		$select = $select ?: $alias.'.*';
		$where = $where ?: '1';
		$order_by = $order_by ?: $alias.'.id DESC';
		$query = "SELECT $select FROM `$table` $alias $joins WHERE $where ORDER BY $order_by ";
		if($limit){
			$query.= " LIMIT $limit";
		}
		// executa
		$rs = $this->query($query);
		// coleta
		$rows = array();
		while($row = $this->fetchRow($rs)){
			$rows[] = $row;		
		}
		// retorna
		return $rows;
	}

	// retorna os dados de um registro indicado por $row_id ou $this->row_id
	function getRow($select='', $row_id=null){
		// valida
		$table = $this->getTableName();
		$row_id = (int)($row_id ?: $this->row_id);
		if(!$row_id){
			throw new \Exception("Não foi possivel selecionar registro da tabela $table: row_id não informado!");
		}
		$alias = $this->getAlias();
		// consulta
		$rows = $this->getRows($select, "$alias.id=$row_id", 1);		
		// verifica e retorna
		if(isset($rows[0])){
			return $rows[0];
		}
		return null;
	}	
	
	// Retorna um array com os valores da primeira coluna selecionada
	function getValues($select='', $where=null, $order_by=null, $limit=null){
		$rows = $this->getRows($select,$where,$order_by,$limit);
		$values = array();
		foreach($rows as $row){
			$values[] = current($row);
		}
		return $values;
	}
	
	// Retorna o valor da primeira coluna do primeiro registro encontrado
	function getValue($select='', $where=null, $order_by=null){
		$values = $this->getValues($select,$where,$order_by,1);
		if(!empty($values)){
			return current($values);
		}
	}
}