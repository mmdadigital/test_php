<?php
namespace Views;
/**
 * Esta view serve para listar, excluir e adicionar novos tipos de imóveis
*/
require_once(__DIR__.'/Base.php');
require_once(__DIR__.'/../models/ImoveisTipos.php');

class AdminTipos extends Base{
	
	function render(){
		$tipos = new \Models\ImoveisTipos();
		$rows = $tipos->getRows('t.id, t.nome','1','t.nome ASC');
		?>
		
		<form action="<?php echo $this->createURL("admin_tipos"); ?>" method=POST>
			Novo Tipo: <input name="save_data[nome]" /> <input type=submit value="Salvar" />
		</form>
		
		<table width=100%>
			<thead>
				<th>ID</th>
				<th align=left>Nome</th>
				<th>&nbsp;</th>
			</thead>
			<?php foreach($rows as $row) : ?>
				<tr class=item>
					<td align=center><?php echo $row['id']; ?></td>
					<td align=left><?php echo $row['nome']; ?></td>
					<td align=left>
						<?php echo $this->createLinkButton('Excluir','admin_tipos',array('delete_id'=>$row['id']), 'Tem certeza que deseja excluir?'); ?>
					</td>
				</tr>
			<?php endforeach; ?>			
		</table>
		
		<?php
	}
	
}