<?php
namespace Views;
/**
 * Esta view serve para gerar menus 
 * É na verdade a resolução do primeiro teste exigido aqui: https://github.com/mmdadigital/test_php
*/
require_once(__DIR__.'/Base.php');

class Menu extends Base{
	
	var $data = array();
	
	private function gera($itens){
		echo '<ul>';
		foreach($itens as $item){
			echo '<li><a href="'.$item['href'].'">'.$item['title'].'</a>';
			if(!empty($item['child'])){
				$this->gera($item['child']);
			}
			echo '</li>';
		}
		echo '</ul>';
	}
	
	function render(){
		$this->gera($this->data);
	}
	
}