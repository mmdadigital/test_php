<?php
session_start();
include_once '../config.php';
require '../model/class.db.php';

if(isset($_POST['telefones'])){
    $telefones = $_POST['telefones'];
}else{
    $telefones = '';
}

if(isset($_POST['emails'])){
    $emails = $_POST['emails'];
}else{
    $emails = '';
}

$nome     = filter_input(INPUT_POST, 'nome');

$newImovel = new imovelOp;
$response = $newImovel->addContato($nome, $telefones, $emails);

if($response){
    $_SESSION['mensagem'] = array('tipo' => 'alert-success', 'texto' => 'Cadastro realizado com sucesso!');
    header("location:/view/index-forms.php");
}else{
    $_SESSION['mensagem'] = array('tipo' => 'alert-danger', 'texto' => 'Erro ao tentar cadastrar!');
    header("location:/view/index-forms.php");
}