<?php
/**
 * 29/10/2015 9h
 * Esta view serve para gerar um painel que abriga todas as páginas da area de administração
 * Ela já herda a funcionalidade de um Wrapper básico, que serve para montar uma página HTML
 * Você deve instanciar esta classe e setar as propriedades title e content 
*/
namespace Views;
require_once(__DIR__.'/BaseWrapper.php');

class AdminWrapper extends BaseWrapper{
	
	var $message = '';
	var $error = '';
	
	function render(){
		$admin_content = $this->content;
		ob_start();
		?>
		<table width="100%">
			<thead>
				<th align=left>Menu</th>
				<th align=left><?php echo $this->title; ?></th>
			</thead>
			<tr>
				<td valign="top" width="20%">
					<?php $this->renderMenu(); ?>
				</td>
				<td valign="top" width="80%">
					<?php if($this->message) : ?>
					<div style="background:honeydew;padding:2px;border:1px solid green;">
						<?php echo $this->message; ?>
					</div>
					<?php endif; ?>
					<?php if($this->error) : ?>
					<div style="background:oldlace;padding:2px;border:1px solid red;">
						<?php echo $this->error; ?>
					</div>
					<?php endif; ?>

					<?php echo $admin_content; ?>
				</td>
			</tr>
		</table>
		<style>
			table tr td{
				background:snow;
			}
			table tr.item td{
				background: #efefef;
				border-bottom:1px dashed gainsboro;
			}
			table thead th{
				background: black;
				color:white;
				padding:3px;
				font-variant:small-caps;
			}
		</style>
		<?php
		$this->content = ob_get_clean();
		parent::render();		
	}
	
	function renderMenu(){
		?>
		<ul id="admin_menu">
			<li><a href="<?php echo $this->createURL('admin_imoveis'); ?>">Listar Imóveis</a></li>
			<li><a href="<?php echo $this->createURL('admin_imovel'); ?>">Adicionar Imóvel</a></li>
			<li><a href="<?php echo $this->createURL('admin_contatos'); ?>">Listar Contatos</a></li>
			<li><a href="<?php echo $this->createURL('admin_contato'); ?>">Adicionar Contato</a></li>
			<li><a href="<?php echo $this->createURL('admin_tipos'); ?>">Tipos de Imóveis</a></li>
		</ul>
		<style>
			#admin_menu{ 
				list-style:none;
				padding:5px;
				margin:0px;
			}
			#admin_menu li a{
				padding:5px;
				background:#efefef;
				color:black;
				border: 1px solid white;
				display:block;
			}
			#admin_menu li a:hover{
				background:black;
				color:white;
			}
		</style>
		<?php
	}
	
}