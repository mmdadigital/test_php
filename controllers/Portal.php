<?php
namespace Controllers;
require_once(__DIR__.'/Base.php');

class Portal extends Base{
	
	var $imovel_id = 0;
	
	function imovel(){
		if(!(int)$this->imovel_id){
			return $this->index();
		}
		require_once(__DIR__.'/../views/PortalWrapper.php');
		require_once(__DIR__.'/../views/PortalImovel.php');
		$wrapper = new \Views\PortalWrapper();
		$wrapper->title = 'Detalhes do Imóvel';
		$wrapper->content = new \Views\PortalImovel();
		return $wrapper;
	}
	
}
