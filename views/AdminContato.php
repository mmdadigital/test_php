<?php
/**
 * Esta view mostra um formulário para cadastrar/editar um registro de contato
*/
namespace Views;
require_once(__DIR__.'/Base.php');

class AdminContato extends Base{
	
	var $row_id = 0;
	var $save_data = array();
	var $errors = array();
	
	function render(){
		$data = $this->getFormData();
		?>
		<form method="POST" action="<?php echo $this->createURL('admin_contato',array('row_id'=>$this->row_id)); ?>">
			<table>
				<tr>
					<td align=right>Nome:</td>
					<td><input name="save_data[nome]" value="<?php echo $data['nome']; ?>"  /></td>
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
			require_once(__DIR__.'/../models/Contatos.php');
			$contato = new \Models\Contatos($this->row_id);
			$data = $contato->getRow("ct.id, ct.nome");
		} else {
			$data = array(
				'nome' => null
			);
		}	
		return $data;		
	}
	
	
}