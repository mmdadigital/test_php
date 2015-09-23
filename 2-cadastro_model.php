<?php
class Model {
	 public $tipoImovel;
	 public $estado;
	 public $link;
	 
     public function __construct() {
        $this->link = new mysqli('localhost', 'root', NULL, 'imobiliaria');
		if (!$this->link) {
			die('Não foi possível conectar: ' . mysql_error());
		}
		
		$this->tipoImovel = mysqli_fetch_all(mysqli_query($this->link,"SELECT tipoImaovel FROM tipoImovel"));
		$this->estado = mysqli_fetch_all(mysqli_query($this->link,"SELECT estado FROM estado"));
	 }       
	 
	 public function close()
	 {
	  mysqli_close($this->link );
	 }
}
 
?>
