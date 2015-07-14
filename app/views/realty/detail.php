<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title><?php echo $title; ?></title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="<?php echo $this->base_url; ?>public/css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?php echo $this->base_url; ?>public/css/styles.css" rel="stylesheet">
	</head>
	<body>

<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">

      
    </div><!-- /.container -->
</div><!-- /.navbar -->
  
<!-- HEADER 
=================================-->

<div class="jumbotron text-center">
    <div class="container">
      <div class="row">
        <div class="col col-lg-12 col-sm-12">
          <h1>Teste PHP  - Imobiliária</h1>
          <p>Detalhes do Imóvel</p>
        </div>
      </div>
    </div> 
</div>
<!-- /header container-->

<!-- CONTENT
=================================-->

<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="well">
        	<!-- the realty title-->
        	<p><?php echo $realty[0]['title']." - ".$realty[0]['city'] ; ?></p>
		   		<div class="row">
        			<!-- the realty images-->
		        	<?php foreach ($realty[0]['gallery'] as $img) : ?>
			        <div class="col-md-3">
			        		<p><img src=" <?php echo $this->base_url; ?>upload/gallery/<?php echo $img['img_file']; ?>" style="width:90%;height:150px"></p>
			        </div>
			   		 <?php endforeach; ?>
			   	</div>
			   	<div class="row">
			        <div class="col-md-4">
        				<!-- the realty details-->
			        	<p><?php echo $realty[0]['street'];?>, <?php echo $realty[0]['number'];?> - <?php echo $realty[0]['city'];?> / <?php echo $realty[0]['state'];?></p>
			        </div>
			   	</div>
			   	<div class="row">
			        <div class="col-md-12">
        				<!-- the realty description-->
			        	<p><?php echo $realty[0]['description'];?></p>
			        </div>
			   	</div>
        	</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
     			<!-- the realty contacts-->
	        	<p>Contatos</p>
	        	<?php foreach ($realty[0]['contacts'] as $contact): ?>
	    	    <div class="col-md-4">
	        		<p><?php echo $contact['name']; ?></p>
	        		<?php foreach($contact['emails'] as  $email) :?>
		        		<p><?php echo $email['email']; ?></p>
	       			<?php endforeach; ?>
	       			<?php foreach($contact['phones'] as  $phone) :?>
		        		<p><?php echo $phone['phone']; ?></p>
	       			<?php endforeach; ?>
	        	</div>
	       		<?php endforeach; ?>
	    </div>
    </div>
    <div class="row">
     	<!-- the realty similar realties-->
    	<?php foreach ($similar_realty as $similar) : ?>
	        <div class="col-md-4">
	        	<div class="well">
	        		<a href="<?php echo $this->base_url; ?>imobiliaria/imovel/<?php echo $similar['id']; ?>">
	        			<p><?php echo $similar['title']." - ".$similar['city']  ; ?></p>
	        			<p><img src="<?php echo $this->base_url; ?>upload/gallery/<?php echo $similar['img_file']; ?>" style="width:90%;height:200px"></p>
	        			<p><?php echo $similar['name']."  ".$similar['phone']  ; ?></p>
	        		</a>
	        	</div>
	        </div>
	    <?php endforeach; ?>
    </div>
  	<hr>
</div>
<hr>
<!-- /CONTENT ============-->

	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="<?php echo $this->base_url; ?>public/js/bootstrap.min.js"></script>
	</body>
</html>