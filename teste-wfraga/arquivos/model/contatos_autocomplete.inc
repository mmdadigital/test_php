<?php
include_once '../config.php';
//require 'class.db.php';

$newImovel = new imovelOp;
$arr_retorno = $newImovel->getAllContatos();
$arr_autocomplete = array();

foreach ($arr_retorno as $value) {
    $arr_autocomplete[] = array( 
        'id'    => $value['idcontatos'],
        'label' => $value['nome'],
        'value' => $value['nome']
    );
}

$arr_autocomplete = json_encode($arr_autocomplete);

