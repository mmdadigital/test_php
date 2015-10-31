<?php
namespace Views;
/**
 * Esta view serve para gerenciar os numeros de telefones que um determinado contato pode ter
*/
require_once(__DIR__.'/Base.php');

class AdminContatoFones extends Base{
	
	// Id do contato selecionado
	var $row_id = 0;
	
	function render(){
		
		$id_contato = (int)$this->row_id;
		
		if(!$id_contato){
			echo 'Id do contato não informado!';
			return;
		}
		
		// Consulta os fones deste contato
		require_once(__DIR__.'/../models/ContatosFones.php');
		$fones = new \Models\ContatosFones();
		$rows = $fones->getRows("cf.id, cf.fone","cf.id_contato=".$id_contato);
		
		?>
		
		<form method="POST">
			Novo Fone: <input name="save_data[fone]"  />
			<input type="submit" value="Salvar" />
		</form>
		
		<table width=100%>
			<thead>
				<th>ID</th>
				<th align=left>Fone</th>
				<th align=left>Ações</th>
			</thead>
			<?php foreach($rows as $row) : ?>
				<tr class=item>
					<td align=center><?php echo $row['id']; ?></td>
					<td><?php echo $row['fone']; ?></td>
					<td><?php echo $this->createLinkButton('Excluir','admin_contato_fones',
							array('delete_id'=>$row['id'],'row_id'=>$id_contato),
							"Tem certeza que deseja excluir este fone?"
						); ?>
					</td>
				</tr>
			<?php endforeach; ?>			
		</table>
		
		<?php
	}
	
}