<?php
 if(isset($_SESSION['username'])){
    header("location:/view/main-login.php");
  }
  
  include $_SERVER['DOCUMENT_ROOT'].'/controller/get-lista-tipos-imoveis.php';;
?>
  
  <!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.inc';?>

  <body>
    <div class="container">
        
        <div class="row"><a href="/view/index-forms.php"> <strong>Voltar</strong></a></div>

      <form class="form-inserts" name="form-insert-imovel" method="post" enctype="multipart/form-data" action="/controller/insert-datas-imovel.php">
        <h2 class="form-signin-heading">Cadastro de Imóvel</h2>
        
        <div class="ui-widget">
            <label for="tags">Contato: </label>
            <input id="tags" name="contato-nome">
            <input id="tags-id" name="contato-id" style="display: none;">
            <p class="help-block"><a href="/view/insert-contato.php">Clique aqui</a> para adicionar contatos.</p>
        </div>
        
        <label class="control-label">Tipo:</label>
        <select class="form-control" name="tipo">
            
            <option value="default">Selecionar</option>
            <?php 
            foreach ($arr_tipos_imoveis as $value):
            ?>
            <option value="<?=$value['idtipo_imovel']?>"><?=$value['tipo']?></option>
            <?php endforeach;?>
            
        </select>
        <p class="help-block"><a href="/view/insert-tipo-imovel.php">Clique aqui</a> para adicionar tipos.</p>
        
        <label class="control-label">Rua:</label>
        <input name="rua" id="rua" type="text" class="form-control" placeholder="nome da rua">
        
        <label class="control-label">Número:</label>
        <input name="numero" id="numero" type="text" class="form-control" placeholder="número">
        
        <label class="control-label">Cidade:</label>
        <input name="cidade" id="numero" type="text" class="form-control" placeholder="cidade">
        
        <label class="control-label">Estado:</label>
        <select name="estado" class="form-control"> 
		<option value="estado">Selecione o Estado</option> 
		<option value="ac">Acre</option> 
		<option value="al">Alagoas</option> 
		<option value="am">Amazonas</option> 
		<option value="ap">Amapá</option> 
		<option value="ba">Bahia</option> 
		<option value="ce">Ceará</option> 
		<option value="df">Distrito Federal</option> 
		<option value="es">Espírito Santo</option> 
		<option value="go">Goiás</option> 
		<option value="ma">Maranhão</option> 
		<option value="mt">Mato Grosso</option> 
		<option value="ms">Mato Grosso do Sul</option> 
		<option value="mg">Minas Gerais</option> 
		<option value="pa">Pará</option> 
		<option value="pb">Paraíba</option> 
		<option value="pr">Paraná</option> 
		<option value="pe">Pernambuco</option> 
		<option value="pi">Piauí</option> 
		<option value="rj">Rio de Janeiro</option> 
		<option value="rn">Rio Grande do Norte</option> 
		<option value="ro">Rondônia</option> 
		<option value="rs">Rio Grande do Sul</option> 
		<option value="rr">Roraima</option> 
		<option value="sc">Santa Catarina</option> 
		<option value="se">Sergipe</option> 
		<option value="sp">São Paulo</option> 
		<option value="to">Tocantins</option> 
	</select>
        
        <label class="control-label">Descrição:</label>
        <textarea class="form-control" rows="3" name="descricao"></textarea>
        
        <label class="control-label">Selecionar imagens</label>
        <input id="imagens" name="imagens[]" type="file" multiple class="file-loading">
        <p class="help-block">Escolha até 10 imagens para fazer o upload.</p>

        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->

    <?php include '../includes/chamadas-footer.inc';?>
    <?php include '../model/contatos_autocomplete.inc';?>
    
    <script>
    $(document).on('ready', function() {
        $("#imagens").fileinput({
            showUpload: false,
            maxFileCount: 10,
            mainClass: "input-group-lg"
        });
    });
    </script>
    
    <script>
    $(document).ready(function($){
        $('#tags').autocomplete({
            source:<?=$arr_autocomplete?>,
            minLength:2,
            select: function (event, ui) {
                $( "#tags" ).val( ui.item.label );
                $( "#tags-id" ).val( ui.item.id );
                return false;
            }
        });
    });
    </script>
    
  </body>
</html>