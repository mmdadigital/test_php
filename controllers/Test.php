<?php
namespace Controllers;
require_once(__DIR__.'/Base.php');
require_once(__DIR__.'/../views/BaseWrapper.php');

class Test extends Base{
	
	// Exibe página de introdução com links para os tests
	function index(){
		require_once(__DIR__.'/../views/Intro.php');
		$wrapper = new \Views\BaseWrapper;
		$wrapper->title = 'Test Intro';
		$wrapper->content = new \Views\Intro();
		return $wrapper;
	}
	
	// Implementação do primeiro teste de gerar o menu
	function gera_menu(){
		require_once(__DIR__.'/../views/Menu.php');
		$menu = new \Views\Menu();
		$menu->data = $this->menu_data;
		
		$wrapper = new \Views\BaseWrapper;
		$wrapper->title = 'Test Gera Menu';
		$wrapper->content = $menu;
		
		return $wrapper;
	}

	var $menu_data = array(
	  0 => array(
		'title' => 'Home',
		'href' => '/',
	  ),
	  1 => array(
		'title' => 'Community',
		'href' => '/community',
		'child' => array(
		  0 => array(
			'title' => 'Community Home',
			'href' => '/community',
			'child' => array(
			  0 => array(
				'title' => 'Irc',
				'href' => '/irc',
			  ),
			  1 => array(
				'title' => 'Events',
				'href' => '/events',
			  ),
			),
		  ),
		  1 => array(
			'title' => 'Getting Involved',
			'href' => '/getting-involved',
			'child' => array(
			  0 => array(
				'title' => 'Translation',
				'href' => '/translation',
			  ),
			  1 => array(
				'title' => 'Design',
				'href' => '/contribute/themes',
			  ),
			  2 => array(
				'title' => 'Coding',
				'href' => '/contribute/development',
			  ),
			),
		  ),
		),
	  ),
	  2 => array(
		'title' => 'Support',
		'href' => '/support',
		'child' => array(
		  0 => array(
			'title' => 'Search',
			'href' => '/search/apachesolr_search',
		  ),
		  1 => array(
			'title' => 'Forums',
			'href' => '/Forum',
		  ),
		  2 => array(
			'title' => 'Community Documentation',
			'href' => '/documentation',
		  ),
		),
	  ),
	);
	
}
