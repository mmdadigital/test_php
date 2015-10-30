<?php
namespace Models;
require_once(__DIR__."/Base.php");

class ImoveisFotos extends Base{
	
	function getTableName(){
		return "imoveis_fotos";
	}
	
	function getAlias(){
		return "ift";
	}
	
}