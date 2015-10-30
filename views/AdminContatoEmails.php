<?php
namespace Views;
/**
 * Esta view serve para gerenciar os emails de um determinado contato
*/
require_once(__DIR__.'/Base.php');

class AdminContatoEmails extends Base{
	
	// Id do contato selecionado
	var $row_id = 0;
	
	function render(){
		
		$id_contato = (int)$this->row_id;
		
		if(!$id_contato){
			echo 'Id do contato não informado!';
			return;
		}
		
		// Consulta os emails deste contato
		require_once(__DIR__.'/../models/ContatosEmails.php');
		$emails = new \Models\ContatosEmails();
		$rows = $emails->getRows("ce.id, ce.email","ce.id_contato=".$id_contato);
		
		?>
		
		<form method="POST">
			Novo Email: <input name="save_data[email]"  />
			<input type="submit" value="Salvar" />
		</form>
		
		<table width=100%>
			<thead>
				<th>ID</th>
				<th align=left>Email</th>
				<th align=left>Ações</th>
			</thead>
			<?php foreach($rows as $row) : ?>
				<tr class=item>
					<td align=center><?php echo $row['id']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $this->createLinkButton('Excluir','admin_contato_emails',
							array('delete_id'=>$row['id'],'row_id'=>$id_contato),
							"Tem certeza que deseja excluir este email?"
						); ?>
					</td>
				</tr>
			<?php endforeach; ?>			
		</table>
		
		<?php
	}
	
}