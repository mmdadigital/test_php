<?php
namespace Models;
require_once(__DIR__."/Base.php");

class ContatosFones extends Base{
	
	function getTableName(){
		return "contatos_fones";
	}
	
	function getAlias(){
		return "cf";
	}
	
}