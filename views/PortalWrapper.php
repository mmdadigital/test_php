<?php
/**
 * 29/10/2015 9h
 * Esta view serve para gerar um container que abriga todas as páginas do "portal"
 * Ela já herda a funcionalidade de um Wrapper básico, que serve para montar uma página HTML
 * Você deve instanciar esta classe e setar as propriedades title e content 
*/
namespace Views;
require_once(__DIR__.'/BaseWrapper.php');

class PortalWrapper extends BaseWrapper{
		
	function render(){
		$portal_content = $this->content;
		ob_start();
		?>
		<div style="background:black;padding:10px;font-variant:small-caps;color:white;">
			Portal Imobiliária > <?php echo $this->title; ?>
		</div>
		<div id="main" style="padding:10px">
			<?php echo $portal_content; ?>
		</div>
		<?php
		$this->content = ob_get_clean();
		parent::render();		
	}
}