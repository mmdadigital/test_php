<?php 
session_start();

include_once $_SERVER['DOCUMENT_ROOT'].'/controller/get-node-imovel.php';

//PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE
  if(!isset($_SESSION['username'])){
        $link_admin = '/view/main-login.php';
  }else{
        $link_admin = '/view/index-forms.php';
  }
?>

<!DOCTYPE html>
<html lang="en">
  <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/head.inc';?>
    
  <body>
    <div class="container">
        
        <div class="row">
            <a href="<?=$link_admin?>"> <strong>Adminstrar</strong> | </a>
            <a href="/view/lista-imoveis.php"> <strong>Voltar</strong></a>
        </div>
        
        <div class="row">
            <?php
                $arr_imovel = array_values($arr_imovel); // resetando array
                $value = $arr_imovel[0];
                $desc_imovel = $value['descricao'];
                $endereco    = $value['descricao'];
                $numero      = $value['descricao'];
                $cidade      = $value['cidade'];
                $estado      = $value['estado'];
                $id_imovel   = $value['id_imovel'];
                
                $folder_imgs = '/imgs_upload';
                
            ?>
            <div class="col-md-12">
                <h2> <?php print $desc_imovel;?> </h2>
                <div class="dados inline-block">
                    <span class="inline-block"> <strong>Endereço:</strong> <?php print $endereco;?> </span>
                    <span class="inline-block"> <strong>Número:</strong> <?php print $numero;?> </span>
                    <span class="inline-block"> <strong>Cidade:</strong> <?php print $cidade;?> </span>
                    <span class="inline-block"> <strong>Estado:</strong> <?php print $estado;?> </span>
                </div>
                
                <div class="imagens col-md-3">
                    
                    <?php
                    foreach ($value['imagens'] as $item_img):
                        $path_img = $folder_imgs.'/'.$item_img;
                    ?>
                    <img src="<?=$path_img?>" />
                    
                    <?php endforeach;?>
                    
                </div>
                
            </div>
        </div>
 
    </div> <!-- /container -->
  </body>
  <style>
      .inline-block{width: 100%;display: inline-block;}
      .imagens img{margin: 25px 0px}
  </style>
  
</html>