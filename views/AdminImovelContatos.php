<?php
namespace Views;
/**
 * Esta view serve para exibir os contatos associados a um imovel
 * Inclui facilidade para vincular contatos ao imóvel
*/
require_once(__DIR__.'/Base.php');

class AdminImovelContatos extends Base{
	
	// Id do imóvel selecionado
	var $row_id = 0;
	
	// cache var
	protected $contatos_vinculados = array();
	
	// helper function
	function getContatosVinculados(){
		if(empty($this->contatos_vinculados)){
			$id_imovel = (int)$this->row_id;		
			if(!$id_imovel){
				return;
			}
			// Consulta os contatos vinculados a este imóvel
			require_once(__DIR__.'/../models/ImoveisContatos.php');
			$contatos = new \Models\ImoveisContatos();
			$this->contatos_vinculados = $contatos->getRows("ixc.id, ixc.id_contato, ct.nome","ixc.id_imovel=".$id_imovel);
		}
		return $this->contatos_vinculados;
	}

	// helper function	
	function getContatosNaoVinculados(){
		$vinculados = $this->getContatosVinculados();
		$ids = array();
		foreach($vinculados as $row){
			$ids[] = $row['id_contato'];
		}
		require_once(__DIR__.'/../models/Contatos.php');
		$contatos = new \Models\Contatos();
		$where = '1';
		if(!empty($ids)){
			$where = 'ct.id NOT IN('.implode(',',$ids).')';
		}
		return $contatos->getRows("ct.id, ct.nome",$where);
		
	}
	
	// render 
	function render(){
		
		$id_imovel = (int)$this->row_id;
		
		if(!$id_imovel){
			echo 'Id do imóvel não informado!';
			return;
		}
		
		$vinculados = $this->getContatosVinculados();
		$nao_vinculados = $this->getContatosNaoVinculados();
			
		?>
		
		<form method="POST">
			Vincular Contato:  
			<select name="vincula_id" onChange="this.form.submit()">
				<option>Selecione:</option>
				<?php echo $this->array2options($nao_vinculados); ?>
			</select>
		</form>
		
		<table width=100%>
			<thead>
				<th>ID</th>
				<th align=left>Nome</th>
				<th align=left>Ações</th>
			</thead>
			<?php foreach($vinculados as $row) : ?>
				<tr class=item>
					<td align=center><?php echo $row['id_contato']; ?></td>
					<td><?php echo $row['nome']; ?></td>
					<td><?php echo $this->createLinkButton('Excluir','admin_imovel_contatos',
							array('delete_id'=>$row['id'],'row_id'=>$id_imovel),
							"Tem certeza que deseja desvincular este contato?"
						); ?>
					</td>
				</tr>
			<?php endforeach; ?>			
		</table>
		
		<?php
	}
	

	
}