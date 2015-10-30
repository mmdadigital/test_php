<?php
namespace Controllers;
/**
 * 28/10/2015 20h
 * Este controller concentra ações para todas as páginas da parte administrativa do portal
*/
require_once(__DIR__.'/Base.php');
require_once(__DIR__.'/../views/AdminWrapper.php');
require_once(__DIR__.'/../models/Imoveis.php');
require_once(__DIR__.'/../models/Contatos.php');
			
class Admin extends Base{
		
	// Declara parâmetros de requisição esperados por este controller
	var $delete_id = 0; 
	var $row_id = 0;
	var $save_data = array();
	var $vincula_id = 0; 
	
	// Página inicial que lista imóveis cadastrados e permite deletar registros 
	function index(){

		// Inicia a view que monta o painel de administração
		$wrapper = new \Views\AdminWrapper();
		$wrapper->title = 'Lista de Imóveis Cadastrados';
		
		// Foi solicitado para remover um registro de imóvel?
		if($this->delete_id){
			// Instancia o model de imoveis e remove o registro selecionado
			$imovel = new \Models\Imoveis($this->delete_id);
			$imovel->delete();					
			$wrapper->message = 'Imóvel deletado com sucesso!';				
		}

		// Inclui a view AdminImoveis que serve para listar imoveis
		require_once(__DIR__.'/../views/AdminImoveis.php');
		
		// Esta view deve ir como conteudo principal do painel
		$wrapper->content = new \Views\AdminImoveis();
		
		// Retorna o painel configurado
		return $wrapper;
		
	}
	
	// Página que exibe um formulário para cadastro/edição de imóvel
	function imovel(){
		
		// Inicia a view que monta o painel de administração
		$wrapper = new \Views\AdminWrapper();
		$wrapper->title = 'Cadastro de Imóvel';
		
		// Inclui e inicia a view que monta o formulário de cadastro/edição
		require_once(__DIR__.'/../views/AdminImovel.php');
		$form = new \Views\AdminImovel();
		
		// Foi solicitado para salvar os dados de um imóvel?
		if(!empty($this->save_data)){			
			// Tenta salvar os dados enviados
			$imovel = new \Models\Imoveis($this->row_id);
			$imovel->save($this->save_data);
			$form->row_id = $imovel->row_id;
			if(empty($imovel->errors)){
				$wrapper->message = 'Dados Salvos com Sucesso!';
			} else {
				$wrapper->error = 'Ops, parece que alguma coisa deu errado.';
				$form->errors = $imovel->errors;
			}
		}
		
		// Seta o formulário como conteúdo principal do painel
		$wrapper->content = $form;
		
		// Retorna o painel pronto para ser renderizado
		return $wrapper;
		
	}
	
	function contatos(){
		
		// Inicia a view que monta o painel de administração
		$wrapper = new \Views\AdminWrapper();
		$wrapper->title = 'Lista de Contatos Cadastrados';
		
		// Foi solicitado para remover um registro de contato?
		if($this->delete_id){
			// Instancia contato e remove o registro selecionado
			$contato = new \Models\Contatos($this->delete_id);
			$contato->delete();					
			$wrapper->message = 'Contato deletado com sucesso!';				
		}

		// Inclui a view que serve para listar contatos
		require_once(__DIR__.'/../views/AdminContatos.php');
		
		// Esta view deve ir como conteudo principal do painel
		$wrapper->content = new \Views\AdminContatos();
		
		// Retorna o painel
		return $wrapper;
		
	}
	
	// Processa e exibe um formulário para cadastro/edição de contato
	function contato(){
		
		// Inicia a view que monta o painel de administração
		$wrapper = new \Views\AdminWrapper();
		$wrapper->title = 'Cadastro de Contato';
		
		// Inclui e inicia a view que monta o formulário de cadastro/edição
		require_once(__DIR__.'/../views/AdminContato.php');
		$form = new \Views\AdminContato();
		
		// Foi solicitado para salvar os dados de um contato?
		if(!empty($this->save_data)){		
		
			// Tenta salvar os dados enviados
			$contato = new \Models\Contatos($this->row_id);
			$contato->save($this->save_data);
			$form->row_id = $contato->row_id;
			if(empty($contato->errors)){
				$wrapper->message = 'Dados Salvos com Sucesso!';
			} else {
				$wrapper->error = 'Ops, parece que alguma coisa deu errado.';
				$form->errors = $contato->errors;
			}
		}
		
		// Seta o formulário como conteúdo principal do painel
		$wrapper->content = $form;
		
		// Retorna o painel pronto para ser renderizado
		return $wrapper;
	}
	
	// Lista os tipos de imóveis existentes e processa comando para adicionar novo tipo
	function tipos(){
		
		require_once(__DIR__.'/../models/ImoveisTipos.php');
		
		// Inicia a view que monta o painel de administração
		$wrapper = new \Views\AdminWrapper();
		$wrapper->title = 'Lista de Tipos de Imóveis';
		
		// Foi solicitado para remover um registro?
		if($this->delete_id){
			// Instancia e remove o registro selecionado
			$tipo = new \Models\ImoveisTipos($this->delete_id);
			$tipo->delete();					
			$wrapper->message = 'Tipo deletado com sucesso!';				
		}

		// Foi solicitado para adicionar novo tipo?
		if(!empty($this->save_data['nome'])){
			$tipo = new \Models\ImoveisTipos();
			$tipo->add($this->save_data);
			$wrapper->message = 'Novo tipo adicionado com sucesso!';
		}
		
		// Inclui a view que serve para gerenciar os tipos
		require_once(__DIR__.'/../views/AdminTipos.php');
		
		// Esta view deve ir como conteudo principal do painel
		$wrapper->content = new \Views\AdminTipos();
		
		// Retorna o painel
		return $wrapper;
		
	}
	
	// Lista as fotos de um imovel, 
	// Processa requisicao para adicionar/excluir uma foto
	function imovel_fotos(){

		// Obriga usuario a selecionar um imovel
		if(!$this->row_id){
			
			return $this->index();
		}
		
		// Inicia painel de admin
		$wrapper = new \Views\AdminWrapper();
		$wrapper->title = 'Fotos do Imóvel #'.$this->row_id;
		
		// Verifica se foi enviado uma nova foto
		if(!empty($_FILES['foto']['tmp_name'])){
			// Tenta transferir o upload
			$ext = pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION);
			$filename = uniqid().'.'.$ext;
			if(!move_uploaded_file($_FILES['foto']['tmp_name'],IMG_DIR.$filename)){
				$wrapper->error = 'Não foi possível fazer upload de foto!';
			} else {
				// Salva nome do arquivo no banco de dados
				require_once(__DIR__.'/../models/ImoveisFotos.php');
				$foto = new \Models\ImoveisFotos();
				$foto->add(array('id_imovel'=>$this->row_id,'arquivo'=>$filename));
				$wrapper->message = 'Foto adicionada com sucesso!';
			}
		}
		
		// Verifica se foi solicitado para excluir uma foto
		if($this->delete_id){
			// Consulta o nome do arquivo
			require_once(__DIR__.'/../models/ImoveisFotos.php');
			$foto = new \Models\ImoveisFotos($this->delete_id);
			if($row = $foto->getRow("ift.arquivo")){
				// Deleta o registro e o arquivo
				if($foto->delete() && unlink(IMG_DIR.$row['arquivo'])){
					$wrapper->message = 'Foto excluída com sucesso';
				} else {
					$wrapper->error = 'Não foi possível excluir foto!';
				}
			}
		}
		
		// Insere a view para listar as fotos do imovel
		require_once(__DIR__.'/../views/AdminImovelFotos.php');
		$wrapper->content = new \Views\AdminImovelFotos();
		return $wrapper;
	}
	
	// Lista contatos associados a um imóvel, 
	// Processa requisição para adicionar/excluir vinculo
	function imovel_contatos(){
		
		// Obriga usuario a selecionar um imovel
		if(!$this->row_id){
			return $this->index();
		}
		
		// Inicia painel de admin
		$wrapper = new \Views\AdminWrapper();
		$wrapper->title = 'Contatos do Imóvel #'.$this->row_id;
		
		// Verifica se há requisição para vincular um contato
		if($this->vincula_id){
			require_once(__DIR__.'/../models/ImoveisContatos.php');
			$imoveisContatos = new \Models\ImoveisContatos();
			$imoveisContatos->add(array('id_imovel'=>$this->row_id,'id_contato'=>$this->vincula_id));
			$wrapper->message = 'Contato vinculado com sucesso!';
		}
		
		// Verifica se há requisição para remover um vínculo
		if($this->delete_id){
			require_once(__DIR__.'/../models/ImoveisContatos.php');
			$imoveisContatos = new \Models\ImoveisContatos($this->delete_id);
			$imoveisContatos->delete();
			$wrapper->message = 'Contato desvinculado com sucesso!';
		}
		
		// Inclui a view para ir no miolo do painel
		require_once(__DIR__.'/../views/AdminImovelContatos.php');
		$wrapper->content = new \Views\AdminImovelContatos();
		return $wrapper;
		
	}
	
	// Permite gerenciar emails de um contato
	function contato_emails(){
		
		// Obriga usuario a selecionar um contato
		if(!$this->row_id){
			return $this->contatos();
		}

		// Inicia painel de admin
		$wrapper = new \Views\AdminWrapper();
		$wrapper->title = 'Emails do Contato #'.$this->row_id;
		
		// Adiciona um novo email
		if(!empty($this->save_data['email'])){
			require_once(__DIR__.'/../models/ContatosEmails.php');
			$emails = new \Models\ContatosEmails();
			$emails->add(array('email'=>$this->save_data['email'],'id_contato'=>$this->row_id));
			$wrapper->message = 'Email cadastrado com sucesso!';
		}
		
		// Remove um email
		if($this->delete_id){
			require_once(__DIR__.'/../models/ContatosEmails.php');
			$fones = new \Models\ContatosEmails($this->delete_id);
			$fones->delete();
			$wrapper->message = 'Email deletado com sucesso!';
		}
		
		// Inclui view principal
		require_once(__DIR__."/../views/AdminContatoEmails.php");
		$wrapper->content = new \Views\AdminContatoEmails();
		return $wrapper;
		
	}
	
	// Permite gerenciar telefones de um contato
	function contato_fones(){
		
		// Obriga usuario a selecionar um contato
		if(!$this->row_id){
			return $this->contatos();
		}

		// Inicia painel de admin
		$wrapper = new \Views\AdminWrapper();
		$wrapper->title = 'Telefones do Contato #'.$this->row_id;
		
		// Adiciona um novo telefone
		if(!empty($this->save_data['fone'])){
			require_once(__DIR__.'/../models/ContatosFones.php');
			$fones = new \Models\ContatosFones();
			$fones->add(array('fone'=>$this->save_data['fone'],'id_contato'=>$this->row_id));
			$wrapper->message = 'Telefone cadastrado com sucesso!';
		}
		
		// Remove um telefone
		if($this->delete_id){
			require_once(__DIR__.'/../models/ContatosFones.php');
			$fones = new \Models\ContatosFones($this->delete_id);
			$fones->delete();
			$wrapper->message = 'Telefone deletado com sucesso!';
		}
		
		// Inclui view principal
		require_once(__DIR__."/../views/AdminContatoFones.php");
		$wrapper->content = new \Views\AdminContatoFones();
		return $wrapper;
		
	}
	

	
	
	
}