<?php
namespace Views;
/**
 * Esta view serve para exibir uma lista para manipular as fotos de um imóvel
 * Também inclui campo de arquivo para upload de fotos
*/
require_once(__DIR__.'/Base.php');

class AdminImovelFotos extends Base{
	
	// Id do imóvel selecionado
	var $row_id = 0;
	
	function render(){
		
		$id_imovel = (int)$this->row_id;
		
		if(!$id_imovel){
			echo 'Id do imóvel não informado!';
			return;
		}
		
		// Consulta as fotos deste imóvel
		require_once(__DIR__.'/../models/ImoveisFotos.php');
		$fotos = new \Models\ImoveisFotos();
		$rows = $fotos->getRows("ift.id, ift.arquivo","ift.id_imovel=".(int)$id_imovel);
		
		?>
		
		<form method="POST" enctype="multipart/form-data">
			Adicionar foto: <input type=file name=foto onChange="this.form.submit()" />
		</form>
		
		<table width=100%>
			<thead>
				<th>ID</th>
				<th align=left>Foto</th>
				<th align=left>Ações</th>
			</thead>
			<?php foreach($rows as $row) : ?>
				<tr class=item>
					<td align=center><?php echo $row['id']; ?></td>
					<td><img src="<?php echo IMG_BASE_URL.$row['arquivo']; ?>" width=100 /></td>
					<td><?php echo $this->createLinkButton('Excluir','admin_imovel_fotos',
							array('delete_id'=>$row['id'],'row_id'=>$id_imovel),
							"Tem certeza que deseja excluir esta foto?"
						); ?>
					</td>
				</tr>
			<?php endforeach; ?>			
		</table>
		
		<?php
	}
	
}