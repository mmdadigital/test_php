<?php
namespace Models;
require_once(__DIR__."/Base.php");

class Contatos extends Base{
	
	function getTableName(){
		return "contatos";
	}
	
	function getAlias(){
		return "ct";
	}
	
}