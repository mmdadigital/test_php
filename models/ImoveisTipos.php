<?php
namespace Models;
require_once(__DIR__."/Base.php");

class ImoveisTipos extends Base{
	
	function getTableName(){
		return "imoveis_tipos";
	}
	
	function getAlias(){
		return "t";
	}
	
}