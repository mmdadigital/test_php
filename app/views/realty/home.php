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
          <p>Clique em um imóvel abaixo para ver as mais informações</p>
        </div>
      </div>
    </div> 
</div>
<!-- /header container-->

<!-- CONTENT
=================================-->
<div class="container">
    <div class="row">
      <!-- all realties-->
    	<?php foreach ($realties as $realty) : ?>
        <div class="col-md-4">
        	<div class="well">
        		<p><a href="<?php echo $this->base_url; ?>imobiliaria/imovel/<?php echo $realty['id']; ?>"><?php echo $realty['title'].' - '.$realty['city'] ; ?></a></p>
        		<p><img src="<?php echo $this->base_url; ?>upload/gallery/<?php echo $realty['img_file']; ?>" style="width:90%;height:200px"></p>
        	</div>
        </div>
    	<?php endforeach;?>
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