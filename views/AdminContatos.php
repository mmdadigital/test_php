<?php
namespace Views;
/**
 * Esta view serve para exibir uma tabela com os últimos contatos registrados
*/
require_once(__DIR__.'/Base.php');
require_once(__DIR__.'/../models/Contatos.php');

class AdminContatos extends Base{
	
	function render(){
		$contatos = new \Models\Contatos();
		$rows = $contatos->getRows('ct.id, ct.nome');
		?>
		<table width=100%>
			<thead>
				<th>ID</th>
				<th>Nome</th>
				<th>Ações</th>
			</thead>
			<?php foreach($rows as $row) : ?>
				<tr class=item>
					<td align=center><?php echo $row['id']; ?></td>
					<td align=center><?php echo $row['nome']; ?></td>
					<td align=center>
						<?php echo $this->createLinkButton('Editar Dados','admin_contato',array('row_id'=>$row['id'])); ?>
						<?php echo $this->createLinkButton('Editar Emails','admin_contato_emails',array('row_id'=>$row['id'])); ?>
						<?php echo $this->createLinkButton('Editar Fones','admin_contato_fones',array('row_id'=>$row['id'])); ?>
						<?php echo $this->createLinkButton('Excluir Contato','admin_contatos',array('delete_id'=>$row['id']), 'Tem certeza que deseja excluir?'); ?>
					</td>
				</tr>
			<?php endforeach; ?>			
		</table>
		
		<?php
	}
	
}