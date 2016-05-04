<?php
 if(isset($_SESSION['username'])){
    header("location:../view/main-login.php");
  }
?>
  
  <!DOCTYPE html>
<html lang="en">
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/head.inc';?>

    <body>
    <div class="container">

      <form class="form-inserts" name="form-insert-tipo-imovel" method="post" enctype="multipart/form-data" action="/controller/insert-datas-tipo-imovel.php">
        <h2 class="form-signin-heading">Cadastro de Contato</h2>
        
        <label for="tags">Tipo: </label>
        <input name="nome" id="nome" type="text" class="form-control" placeholder="nome do contato">
        
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->

    <?php include '../includes/chamadas-footer.inc';?>
    
    
  </body>
</html>