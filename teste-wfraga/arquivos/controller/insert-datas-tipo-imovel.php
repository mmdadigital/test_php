<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/model/class.db.php';

$nome     = filter_input(INPUT_POST, 'nome');

$newImovel = new imovelOp;
$response = $newImovel->addTipoImovel($nome);

if($response){
    $_SESSION['mensagem'] = array('tipo' => 'alert-success', 'texto' => 'Cadastro realizado com sucesso!');
    header("location:/view/index-forms.php");
}else{
    $_SESSION['mensagem'] = array('tipo' => 'alert-danger', 'texto' => 'Erro ao tentar cadastrar!');
    header("location:index-forms.php");
}