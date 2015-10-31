<?php
namespace Models;
require_once(__DIR__."/Base.php");

class Estados extends Base{
	
	function getTableName(){
		return "estados";
	}
	
	function getAlias(){
		return "e";
	}
	
}