<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/model/class.db.php';

$newImovel = new imovelOp;
$response = $newImovel->getAllTiposImoveis();
$arr_tipos_imoveis = array();

if($response){
    $arr_tipos_imoveis = $response;
}

?>