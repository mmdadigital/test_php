<?php 
session_start();

include_once $_SERVER['DOCUMENT_ROOT'].'/controller/get-lista-imoveis.php';

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
        
        <div class="row"><a href="<?=$link_admin?>"> <strong>Adminstrar</strong></a></div>
        
        <div class="row">
            <?php
            
            if(!empty($arr_lista_imoveis)){
                
                foreach ($arr_lista_imoveis as $value):

                    $desc_imovel = $value['descricao'];
                    $endereco    = $value['descricao'];
                    $numero      = $value['descricao'];
                    $cidade      = $value['cidade'];
                    $estado      = $value['estado'];
                    $id_imovel   = $value['id_imovel'];

                    $folder_imgs = '/imgs_upload';

                ?>
                <div class="col-md-12">
                    <h2> <a href="/view/node-imovel.php?idimovel=<?=$id_imovel?>"> <?php print $desc_imovel;?> </a> </h2>
                    <div class="dados inline-block">
                        <span class="inline-block"> <strong>Endereço:</strong> <?php print $endereco;?> </span>
                        <span class="inline-block"> <strong>Número:</strong> <?php print $numero;?> </span>
                        <span class="inline-block"> <strong>Cidade:</strong> <?php print $cidade;?> </span>
                        <span class="inline-block"> <strong>Estado:</strong> <?php print $estado;?> </span>
                    </div>
                    
                    <div class="row">
                        <div class="imagens">

                        <?php
                        foreach ($value['imagens'] as $item_img):
                            $path_img = $folder_imgs.'/'.$item_img;
                        ?>
                            <a href="/view/node-imovel.php?idimovel=<?=$id_imovel?>">
                                <img class="col-md-3" src="<?=$path_img?>" />
                            </a>
                            

                        <?php endforeach;?>

                    </div>
                    </div>

                </div>
                <?php endforeach;?>
            <?php
            }else{
                print '<h2> Não exsitem imoveis cadastrados ainda! </h2>';
            }
            ?>
        </div>
 
    </div> <!-- /container -->
  </body>
  <style>
      .inline-block{width: 100%;display: inline-block;}
      .imagens img{margin: 25px 0px; max-width: 150px;}
  </style>
  
</html>