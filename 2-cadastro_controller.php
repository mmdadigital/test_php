<?php
 
class Controller {
     private $model;
 
     public function __construct(Model $model) {
         $this->model = $model;
     }
	 
	public function form($POST)
	{

		if(isset ($POST['files']))
		{
			$filenumber=mysqli_fetch_row(mysqli_query($this->model->link,"SELECT max(numero) FROM fotos"))[0]+1;
			
			foreach ($POST['files'] as $value)
			{
				mysqli_query($this->model->link,"Insert into cadastro fotos values ".$filenumber.",".$value);
			}
		}
		else $filenumber = "NULL";
		
		mysqli_query($this->model->link,"Insert into cadastro values NULL, ".$POST['tipoImovel'].",".$filenumber.$POST['rua'].",".$POST['numero'].",".$POST['cidade'].",".$POST["estado"]);
	}
	 
	 
}

?>
