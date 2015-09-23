<?php

 
class View{
     private $model;
     private $controller;
 
     public function __construct(Controller $controller, Model $model) {
         $this->controller = $controller;
         $this->model = $model;
     }

	 
	 public function cadastro()
	 { 
		?>
		<form id="cadastro" name="cadastro" method="post" action="site.php?action=form" onsubmit="return validaCampo(); return false;">
			<table width="625" border="0">
				<tr>
					<td>Tipo de Imovel:
					<select name="tipoImovel">
					<?php
					foreach ($this->model->tipoImovel as $key => $tipo)
					{
						echo "<option value=$key>$tipo[0]</option>";
					}
					?>
					</td>
				</tr>
				<tr>
					<td>Fotos:
					<input  type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
					</td>
				</tr>
				
				<tr>
					<td>Rua:
					<input name="rua" type="text" id="rua" maxlength="20" />
				</tr>
				
				<tr>
				
				<td>Numero:
					<input name="numero" type="text" id="numero" maxlength="20" />
				</tr>
				
				<tr>
				<td>Cidade:
					<input name="cidade" type="text" id="cidade" maxlength="20" />
				</tr>
				
				<tr>
				<td>Estado:
					<select name="estado">
					<?php
					foreach ($this->model->estado as $key => $tipo)
					{
						echo "<option value=$key>$tipo[0]</option>";
					}
					?>
				</tr>
				<tr>
				<td>
				<input name="cadastrar" type="submit" id="cadastrar" value="Concluir meu Cadastro!" />
				</td>
				</tr>
			</table>
		</form>
		<?php
	 }
}


?>
