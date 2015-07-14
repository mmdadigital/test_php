<?php 

class realty extends Main_Controller{
	
	public function index(){

		//set the title
		$data['title'] = "Home - Teste PHP Imobiliária";

		//load the model
		$model = $this->load_model('realty_model');

		//get all realties in the database
		$data['realties'] = $model->getRealties();

		//load the view (view_name, $data_array, menu_name) 
		$this->load_view('realty/home', $data, null);
	}


	public function detail($id){
		//set the title
		$data['title'] = "Home - Teste PHP Imobiliária";

		//load the model
		$model = $this->load_model('realty_model');

		//get the realty
		$data['realty'] = $model->getRealty($id);

		//get all realties in the same city
		$data['similar_realty'] = $model->getSimilar($data['realty'][0]['city'],$id);

		//load the view (view_name, $data_array, menu_name) 
		$this->load_view('realty/detail', $data, null);
	}

}

?>