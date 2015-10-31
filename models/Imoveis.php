<?php
namespace Models;
/**
 * 29/10/2015 9h
 * Model Imoveis 
 */
require_once(__DIR__.'/Base.php');

class Imoveis extends Base{
	
	function getTableName(){
		return "imoveis";
	}
	
	function getAlias(){
		return "i";
	}
	
	function getJoins(){
		return "LEFT JOIN imoveis_tipos t ON t.id=i.id_tipo";
	}
	
	function validate(array $data){
		return true;
	}
	
	// Sobrescreve método add
	function add(array $data){
		// Garante que tenha uma data de cadastro
		if(empty($data['data_cadastro'])){
			$data['data_cadastro'] = date('Y-m-d H:i:s');
		}
		return parent::add($data);
	}
	
}