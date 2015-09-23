<?php
include_once('menu_array.php');

class menu
{
	public  $menuObjeto;

	//função que transforma array em objeto
	function menu($menuArray)
	{
		$this->menuObjeto=$menuArray;
	}
	
	//função recursiva que gera os itens e o menu.
	//TODO- Colocar parametro como opcional.
	function geraMenu($menuObjeto)
	{	
		echo '<ul style="list-style-type:none">';
		foreach ($menuObjeto as $item)
		{
			if (isset($item['title'])) 
				echo  '<li>' , '<a href='.$item['href'].'>'.$item['title'].'</a>' , '</li>' ; 
			
			if (isset($item['child'])) 
				$this->geraMenu($item['child']);
		}
		echo '</ul>';	
	}
}

 $teste = new menu($menu);
 $teste->geraMenu($menu);
 //var_dump($teste);

?>
