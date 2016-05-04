<?php
 if(isset($_SESSION['username'])){
    header("location:../index.php");
  }
?>
  
  <!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.inc';?>

    <body>
    <div class="container">
        
        <div class="row"><a href="/view/index-forms.php"> <strong>Voltar</strong></a></div>

      <form class="form-inserts" name="form-insert-imovel" method="post" enctype="multipart/form-data" action="/controller/insert-datas-contato.php">
        <h2 class="form-signin-heading">Cadastro de Contato</h2>
        
        <label for="tags">Nome: </label>
        <input name="nome" id="nome" type="text" class="form-control" placeholder="nome do contato">
        
        <div class="form-group multiple-form-group" data-max=100>
            <label>Telefones:</label>

            <div class="form-group input-group">
                <input type="text" name="telefones[]" class="form-control" name="telefones">
                    <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+</button></span>
            </div>
        </div>
        
        <div class="form-group multiple-form-group" data-max=100>
            <label>Emails: </label>

            <div class="form-group input-group">
                <input type="email" name="emails[]" class="form-control">
                    <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+</button></span>
            </div>
        </div>
        
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->

    <?php include '../includes/chamadas-footer.inc';?>
    
    <script>
    (function ($) {
    $(function () {

        var addFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
            var $formGroupClone = $formGroup.clone();

            $(this)
                .toggleClass('btn-default btn-add btn-danger btn-remove')
                .html('–');

            $formGroupClone.find('input').val('');
            $formGroupClone.insertAfter($formGroup);

            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', true);
            }
        };

        var removeFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', false);
            }

            $formGroup.remove();
        };

        var countFormGroup = function ($form) {
            return $form.find('.form-group').length;
        };

        $(document).on('click', '.btn-add', addFormGroup);
        $(document).on('click', '.btn-remove', removeFormGroup);

    });
})(jQuery);
    </script>
    
  </body>
</html>