<?php
namespace Views;
/**
 * Esta view mostra alguns links para o pessoal que deve avaliar o meu trabalho 
*/
require_once(__DIR__.'/Base.php');

class Intro extends Base{
	
	function render(){
		?>
		<h2>MMDA Tests</h2>
		Você pode rodar o resultado dos testes através dos links abaixo:
		<ul>
			<li><a href="<?php echo $this->createURL('gera_menu'); ?>" target=_blank>Teste 1 - Geração de Menu</a></li>
			<li><a href="<?php echo $this->createURL('imovel',array('imovel_id'=>2)); ?>" target=_blank>Teste 2 - Detalhe de Imóvel</a></li>
			<li><a href="<?php echo $this->createURL('admin_imoveis'); ?>" target=_blank>Extra - Painel para Gerenciar o Conteúdo do Portal : )</a></li>
		</ul>
		
		<?php
	}
	
}