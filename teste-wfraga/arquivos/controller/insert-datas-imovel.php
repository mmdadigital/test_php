<?php
include_once '../config.php';
require '../model/class.db.php';

if(!empty($_FILES)){
    
    $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/imgs_upload/';
    $arr_imgs = array();
    
    foreach ($_FILES['imagens']['tmp_name'] as $key => $item) {
        
        $name = $_FILES['imagens']['name'][$key];
        $uploadfile = $uploaddir . basename($name);
        
        try {
            move_uploaded_file($item, $uploadfile);
            array_push($arr_imgs, $name);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
    }
    
}

$tipo       = filter_input(INPUT_POST, 'tipo');
$rua        = filter_input(INPUT_POST, 'rua');
$numero     = filter_input(INPUT_POST, 'numero');
$cidade     = filter_input(INPUT_POST, 'cidade');
$estado     = filter_input(INPUT_POST, 'estado');
$desc       = filter_input(INPUT_POST, 'descricao');
$id_contato = filter_input(INPUT_POST, 'contato-id');

$newImovel = new imovelOp;
$response = $newImovel->addImovel($tipo, $rua, $numero, $cidade, $estado, $desc, $arr_imgs, $id_contato);

if($response){
    $_SESSION['mensagem'] = array('tipo' => 'alert-success', 'texto' => 'Cadastro realizado com sucesso!');
    header("location:/view/index-forms.php");
}else{
    $_SESSION['mensagem'] = array('tipo' => 'alert-danger', 'texto' => 'Erro ao tentar cadastrar!');
    header("location:/view/index-forms.php");
}
