<?php
/**
 * 28/10/2015 19h
 * Classe desenvolvida apenas para o teste da MMDA
 * Cada view concreta deve implementar o método render()
 * O método render deve printar um html que é o conteúdo renderizado
 * As variaveis da requisição são automaticamente importadas para dentro da instância
 * Mas são apenas importadas quando a classe declara variáveis como públicas
*/
namespace Views;
require_once(__DIR__.'/../config.php');

abstract class Base{
	
	// construtor
	function __construct($request_data=null){
		// importa variaveis do array $request_data ou da variável de requisição padrão
		$request_data = is_array($request_data) ? $request_data : $_REQUEST;
		foreach($request_data as $k => $v){
			if(property_exists($this,$k)){
				$this->$k = $v;		
			}
		}
		// inicializações da classe concreta
		$this->init();
	}
	
	function init(){
		// sobrescreva init ao invés de __construct		
	}
	
	// deve printar um html
	abstract function render();

	function __toString(){
		try{
			ob_start();
			$this->render();
			return ob_get_clean();
		} catch(Exception $e) {
			if(DEV_MODE){
				echo $e->getMessage();
			}
		}
	}
	
	// helper: gera uma url que aponta para alguma ação
	function createURL($action, $params=array()){
		$url = BASE_URL . '?'.ACTION_VARNAME.'='.$action;
		if(!empty($params)){
			$url.='&'.http_build_query($params);
		}
		return $url;
	}
	
	// helper: gera um botão que ao ser clicado leva para uma url gerada
	function createLinkButton($label, $action, $params=array(),$confirm_msg=''){
		$url = $this->createURL($action,$params);
		$script = "location.href='$url'";
		if($confirm_msg){
			$script = "if(confirm('$confirm_msg')){ $script; }";
		}
		return "<input type=button value=\"$label\" onClick=\"$script\" />";
	}
	
	// helper: gera opcoes de uma tag select a partir de um array bidimensional
	function array2options($array, $select_value=null){
		$options = '';
		foreach($array as $row){
			$value = current($row);
			$label = next($row);
			$select = !is_null($select_value) && $select_value===$value ? "selected" : "";
			$options.="<option value=\"$value\" $select>$label</option>";			
		}
		return $options;
	}
	
	// helper: formata uma data para melhor visualização
	function formatDate($date, $format='d/m/Y H:i'){
		return date($format,strtotime($date));
	}
	
	
}