<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/model/class.db.php';

$newImovel = new imovelOp;
$response = $newImovel->getImoveis();
$arr_lista_imoveis = array();

if(!is_null($response)){
    $arr_lista_imoveis = $response;
}
?>