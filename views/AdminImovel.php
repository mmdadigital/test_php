<?php
/**
 * Esta view mostra um formulário para cadastrar/editar um registro de imóvel
*/
namespace Views;
require_once(__DIR__.'/Base.php');

class AdminImovel extends Base{
	
	var $row_id = 0;
	var $save_data = array();
	var $errors = array();
	
	function render(){
		$data = $this->getFormData();
		$tipos = $this->getImoveisTipos();
		$estados = $this->getEstados();
		?>
		<form method="POST" action="<?php echo $this->createURL('admin_imovel',array('row_id'=>$this->row_id)); ?>">
			<table>
				<tr>
					<td align=right>Tipo de Imóvel:</td>
					<td>
						<select name="save_data[id_tipo]">
							<option value="0">Selecione:</option>
							<?php echo $this->array2options($tipos, $data['id_tipo']); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align=right>Rua:</td>
					<td><input name="save_data[rua]" value="<?php echo $data['rua']; ?>"  /></td>
				</tr>

				<tr>
					<td align=right>Número:</td>
					<td><input name="save_data[numero]" value="<?php echo $data['numero']; ?>"  /></td>
				</tr>
				<tr>
					<td align=right>Cidade:</td>
					<td><input name="save_data[cidade]" value="<?php echo $data['cidade']; ?>"  /></td>
				</tr>
				<tr>
					<td align=right>Estado:</td>
					<td>
						<select name="save_data[estado]">
							<option value="">Selecione:</option>
							<?php echo $this->array2options($estados, $data['estado']); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align=right>Descrição:</td>
					<td><textarea name="save_data[descricao]" cols=50 rows=5><?php echo $data['descricao']; ?></textarea></td>
				</tr>
			</table>
			<input type=submit value="Salvar" />
		</form>
		<?php
	}
	
	function getFormData(){
		if(!empty($this->save_data)){
			return $this->save_data;
		}
		if($this->row_id){
			require_once(__DIR__.'/../models/Imoveis.php');
			$imovel = new \Models\Imoveis($this->row_id);
			$data = $imovel->getRow("i.id_tipo, i.numero, i.rua, i.cidade, i.descricao");
		} else {
			$data = array(
				'id_tipo' => null,
				'numero' => null,
				'rua' => null,
				'cidade' => null,
				'descricao' => null
			);
		}	
		return $data;		
	}
	
	function getImoveisTipos(){
		require_once(__DIR__.'/../models/ImoveisTipos.php');
		$tipos = new \Models\ImoveisTipos();
		return $tipos->getRows("t.id, t.nome");
	}
	
	function getEstados(){
		require_once(__DIR__.'/../models/Estados.php');
		$estados = new \Models\Estados();
		return $estados->getRows("e.id, e.sigla");
	}
		
	
	
}