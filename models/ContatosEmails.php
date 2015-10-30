<?php
namespace Models;
require_once(__DIR__."/Base.php");

class ContatosEmails extends Base{
	
	function getTableName(){
		return "contatos_emails";
	}
	
	function getAlias(){
		return "ce";
	}
	
}