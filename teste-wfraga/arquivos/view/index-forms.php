<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/head.inc';?>
    
  <body>
    <div class="container">
        
        <?php 
        if(isset($_SESSION['mensagem']) and !empty($_SESSION['mensagem'])):
            $arr_msg = $_SESSION['mensagem'];
        ?>
        <div class="alert <?=$arr_msg['tipo']?>" role="alert"> <?=$arr_msg['texto']?> </div>
        <?php endif;?>
        
        <ul class="nav nav-pills nav-stacked">
        <?php
        if(!isset($_SESSION['username'])){
           header("location:../login/main-login.php");
         }else{
             print '<li role="presentation"> <a href="/view/insert-imovel.php"> Cadastrar Imóvel </a> </li>';
             print '<li role="presentation"> <a href="/view/insert-contato.php"> Cadastrar Contato</a> </li>';
             print '<li role="presentation"> <a href="/view/insert-tipo-imovel.php"> Cadastrar Tipo Imóvel</a> </li>';
             print '<li role="presentation"> <a href="/view/lista-imoveis.php"> Lista Imóveis</a> </li>';
             print '<li role="presentation"> <a href="/controller/logout.php"> Logout</a> </li>';
         }
        ?>
        </ul>
    </div> <!-- /container -->
  </body>
</html>