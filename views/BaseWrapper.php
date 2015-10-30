<?php
namespace Views;
require_once(__DIR__.'/Base.php');
/**
 * 29/10/2015 8h
 * Classe criada apenas para resolver o teste aplicado pela MMDA
 * Esta view deve ser reutilizada toda vez que desejamos montar um documento HTML
 * As dependências comuns a todas as páginas devem ser inclusas neste template
 * Voce deve estender essa classe sempre que desejar criar um tipo de wrapper/painel específico
 * Ao instanciar esta classe (ou subclasses desta) voce deve setar as propriedads title e content
*/
class BaseWrapper extends Base{
	
	var $title = '';
	var $content = '';
	
	function render(){
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title><?php echo $this->title; ?></title>
			<meta charset=utf8 />
			<!-- INCLUA AS DEPENDECIAS GLOBAIS AQUI -->
		</head>
		<body>
			<?php echo $this->content; ?>
		</body>
		</html>
		<?php		
	}
	
}