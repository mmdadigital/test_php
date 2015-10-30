<?php
namespace Views;
/**
 * Esta view serve para exibir uma tabela com os últimos imóveis registrados
*/
require_once(__DIR__.'/Base.php');
require_once(__DIR__.'/../models/Imoveis.php');

class AdminImoveis extends Base{
	
	function render(){
		$imoveis = new \Models\Imoveis();
		$rows = $imoveis->getRows('i.id, i.cidade, t.nome as tipo, i.data_cadastro',$where='1','i.id DESC');
		?>
		<table width=100%>
			<thead>
				<th>ID</th>
				<th>Tipo</th>
				<th>Cidade</th>
				<th>Data de Cadastro</th>
				<th>Ações</th>
			</thead>
			<?php foreach($rows as $row) : ?>
				<tr class=item>
					<td align=center><?php echo $row['id']; ?></td>
					<td align=center><?php echo $row['tipo']; ?></td>
					<td align=center><?php echo $row['cidade']; ?></td>
					<td align=center><?php echo $this->formatDate($row['data_cadastro']); ?></td>
					<td align=center>
						<?php echo $this->createLinkButton('Editar Dados','admin_imovel',array('row_id'=>$row['id'])); ?>
						<?php echo $this->createLinkButton('Editar Fotos','admin_imovel_fotos',array('row_id'=>$row['id'])); ?>
						<?php echo $this->createLinkButton('Editar Contatos','admin_imovel_contatos',array('row_id'=>$row['id'])); ?>
						<?php echo $this->createLinkButton('Excluir Imóvel','admin_imoveis',array('delete_id'=>$row['id']), 'Tem certeza que deseja excluir?'); ?>
					</td>
				</tr>
			<?php endforeach; ?>			
		</table>
		
		<?php
	}
	
}