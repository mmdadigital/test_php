<?php
namespace Views;
require_once(__DIR__.'/Base.php');
/**
 * Esta view serve para mostrar os dados de um determinado imóvel, 
 * seus contatos, e outros 3 imóveis aleatórios na mesma cidade. 
 */
 
class PortalImovel extends Base{
	
	// Id do imóvel desejado
	var $imovel_id = 0;
	
	// Dados do imóvel a ser exibido
	var $imovel_data = array();
	
	// Helper function
	function getImovelID(){
		return (int)$this->imovel_id;
	}
	
	// Renderiza tudo
	function render(){
		if(!$this->getImovelID()){
			echo 'Id do imóvel não foi informado!';			
			return;
		}
		?>

		<?php $this->renderImovel(); ?>
		
		<hr/>
		
		<h2>Imoveis Relacionados</h2>
		<?php $this->renderImoveisAleatorios(); ?>

		<?php
	}
	
	// Renderiza os dados do imóvel
	function renderImovel(){
		$data = $this->getImovelData();
		?>
		
		<?php echo $data['descricao']; ?>
		<br/><br/>
		<b>Tipo:</b> <?php echo $data['tipo']; ?> <br/>
		<b>Rua:</b> <?php echo $data['numero']; ?> <br/>
		<b>Cidade:</b> <?php echo $data['cidade']; ?> <br/>
		<b>Número:</b> <?php echo $data['numero']; ?>
		
		<h2>Fotos</h2>
		<?php foreach($data['fotos'] as $foto) : ?>
			<img src="<?php echo IMG_BASE_URL.$foto; ?>" width=100 />
		<?php endforeach; ?>
		
		<h2>Contatos</h2>
		<?php foreach($data['contatos'] as $contato) : ?>
		<div>
			<h3><?php echo $contato['nome']; ?></h3>
			<?php if(!empty($contato['emails'])) : ?>
			<b>Emails:</b>
			<ul>
				<?php foreach($contato['emails'] as $email) : ?>
					<li><?php echo $email; ?></li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
			<?php if(!empty($contato['fones'])) : ?>
			<b>Telefones:</b>
			<ul>
				<?php foreach($contato['fones'] as $fone) : ?>
					<li><?php echo $fone; ?></li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>	
		<?php endforeach; ?>
		
		<?php
	}
	
	// Renderiza os imóveis aleatórios
	function renderImoveisAleatorios(){
		$data = $this->getImoveisAleatorios();
		?>
		
		<?php foreach($data as $imovel) : ?>
			<a href="<?php echo $this->createURL('imovel',array('imovel_id'=>$imovel['id'])); ?>" style="display:inline-block;vertical-align:text-top;padding:5px;border:1px solid black;background:#efefef;">
				<b><?php echo $imovel['contato']; ?></b>
				<br />
				<img src="<?php echo IMG_BASE_URL.$imovel['foto']; ?>" width=100 />
				<br/>
				Fone: <?php echo $imovel['fone']; ?>
			</a>
		<?php endforeach; ?>
		
		<?php
	}
		
	// Helper function
	// Retorna os dados do imóvel selecionado
	// (dados principais, fotos e contatos)
	function getImovelData(){
		
		if(!empty($this->imovel_data)){
			return $this->imovel_data;
		}
		
		require_once(__DIR__.'/../models/Imoveis.php');
		$id = $this->getImovelID();
		$imovel = new \Models\Imoveis($id);
		
		// Obtem os dados principais do imóvel
		$this->imovel_data = $imovel->getRow("i.*,t.nome as tipo");
		
		// Obtem o nome dos arquivos das fotos
		require_once(__DIR__.'/../models/ImoveisFotos.php');
		$fotos = new \Models\ImoveisFotos();
		$this->imovel_data['fotos'] = $fotos->getValues("ift.arquivo","ift.id_imovel=".$id,"ift.id ASC");
		
		// Obtem os contatos vinculados a este imovel
		$this->imovel_data['contatos'] = array();
		
		require_once(__DIR__.'/../models/ImoveisContatos.php');
		require_once(__DIR__.'/../models/ContatosEmails.php');
		require_once(__DIR__.'/../models/ContatosFones.php');
		
		$contatos = new \Models\ImoveisContatos();
		$contatosEmails = new \Models\ContatosEmails();
		$contatosFones = new \Models\ContatosFones();
		
		foreach($contatos->getRows("ct.id, ct.nome","ixc.id_imovel=$id","ct.id ASC") as $contato){
			$emails = $contatosEmails->getValues("ce.email","ce.id_contato=$contato[id]","ce.id ASC");
			$fones = $contatosFones->getValues("cf.fone","cf.id_contato=$contato[id]","cf.id ASC");
			$this->imovel_data['contatos'][] = array(
				'id' => $contato['id'],
				'nome' => $contato['nome'],
				'emails' => $emails,
				'fones' => $fones
			);
		}
		
		return $this->imovel_data;
		
	}
	
	// Helper function
	// Retorna dados de 3 imoveis aleatorios
	// Cada imovel encontrado tera: foto, contato, email e fone
	function getImoveisAleatorios(){
		
		// Pega os dados do imóvel
		$data = $this->getImovelData();
		
		// Instancia o model
		require_once(__DIR__.'/../models/Imoveis.php');
		$model = new \Models\Imoveis();
		
		// Faz escape do nome da cidade
		$cidade = $model->escape($data['cidade']);
		
		// Procura ids de imoveis que estejam na mesma cidade
		$ids_found = $model->getValues("i.id","i.cidade LIKE '$cidade'","RAND()",3);
		if(empty($ids_found)){
			return array();
		}
		
		// Agora devemos percorrer cada imovel encontrado
		// E obter dados extras, como: foto principal, contato, email, etc...
		
		// Inclui e instancia models adicionais
		require_once(__DIR__.'/../models/ImoveisFotos.php');
		require_once(__DIR__.'/../models/ImoveisContatos.php');
		require_once(__DIR__.'/../models/ContatosEmails.php');
		require_once(__DIR__.'/../models/ContatosFones.php');
		
		$fotos = new \Models\ImoveisFotos();
		$contatos = new \Models\ImoveisContatos();
		$emails = new \Models\ContatosEmails();
		$fones = new \Models\ContatosFones();
		
		$result = array();
		
		// Para cada id de imóvel, obtem dados adicionais
		foreach($ids_found as $id_imovel){
			
			$arquivo = $fotos->getValue("ift.arquivo","ift.id_imovel=$id_imovel","ift.id ASC");
			$find = $contatos->getRows("ct.id, ct.nome","ixc.id_imovel=$id_imovel", "ixc.id ASC", 1);
			if(count($find)>0){
				$contato = $find[0];
				$email = $emails->getValue("ce.email","ce.id_contato=$contato[id]","ce.id ASC");
				$fone = $fones->getValue("cf.fone","cf.id_contato=$contato[id]","cf.id ASC");
				$result[] = array(
					'id' => $id_imovel,
					'foto' => $arquivo,
					'contato' => $contato['nome'],
					'email' => $email,
					'fone' => $fone
				);
			}
			
		}
		
		return $result;
		
	}
	
	
	
	
}