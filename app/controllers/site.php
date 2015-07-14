<?php 

class site extends Main_Controller{
	
	public function index(){
		//set the title
		$data['title'] = "TESTE PHP";
		//load the view (view_name, $data_array, menu_name) 
		$this->load_view('home', $data, null);
	}


	public function menuExample(){
		//set the title
		$data['title'] = "TESTE PHP - Menu dinâmico";
		//load the view (view_name, $data_array, menu_name) 
		$this->load_view('menu/menu', $data, 'test_menu');
	}
}

?>