<?php

	class Main_Controller {

		//declare core variables
		public static $menu_array;
		public static $base_url;
		public static $database;

		protected function load_view($view, $data = null, $menu = null){
			//if data is passed to the view, extract it 
			if($data){
				extract($data);
			}
			//if a menu name is passed, generate the menu html
			if($menu){
				$menu = $this->getMenu('test_menu');
			}
			//load the view file
			require_once APP_PATH."views/".$view.".php";
		}



		protected function load_model($model){
			//load the model file
			require_once APP_PATH."models/".$model.".php";

			//instantiate the object 
			$objModel = new $model();
			$objModel->db = $this->database; //set the database settings

			return $objModel; //returns the objetc so we can use it in the controller 
		}


	//generates the html for the menu
	public function getMenu ($menu){
		$html="<ul>"; 
		foreach ($this->menu_array[$menu] as $menu){
			$html.="<li>".$menu['title']."</li>";
			if(isset($menu['child'])){
				$html.= $this->addLevel($menu['child']); //if the item has a child, add a level
			}
		}
		$html.="</ul>";

		return $html;
	}

	public function addLevel($itens){
		$html="<ul>";
		foreach ($itens as $menu){
			$html.="<li>".$menu['title']."</li>";
			if(isset($menu['child'])){
				$html.= $this->addLevel($menu['child']); //add levels as long it has child
			}
		}
		$html.="</ul>";

		return $html;
	}

	}

?>