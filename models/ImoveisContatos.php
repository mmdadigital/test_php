<?php
namespace Models;
require_once(__DIR__."/Base.php");

class ImoveisContatos extends Base{
	
	function getTableName(){
		return "imoveis_x_contatos";
	}
	
	function getAlias(){
		return "ixc";
	}
	
	function getJoins(){
		return "JOIN contatos ct ON ct.id=ixc.id_contato";
	}
	
}