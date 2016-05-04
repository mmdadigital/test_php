<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/model/class.db.php';

$arr_imovel = array();

if(isset($_GET['idimovel']) and !empty($_GET['idimovel'])){
    
    $newImovel = new imovelOp;
    $response = $newImovel->getNodeImovel($_GET['idimovel']);

    if(!is_null($response)){
        $arr_imovel = $response;
    }
    
}


?>