<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?= $head; ?>
  <!-- Google Search Console -->
  <meta name="google-site-verification" content="l92humeQRIVEtnv5actJx6u5mAiX9iMGiAvdmUaQq0w" />
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-5Q9YSWHFGN"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-5Q9YSWHFGN');
  </script>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= url("theme/assets/css/style.css"); ?>" />
	<link rel="shortcut icon" href="<?= url("theme/assets/img/favicon.ico"); ?>"/>
</head>
<body>
	<nav class="navbar navbar-expand-lg main_nav">		
		<?php if($v->section("slidebar")): 
			echo $v->section("slidebar");
		else:
			?>
			<div class="container-fluid">
				<img src="<?= url() ?>/theme/assets/img/logo.png" class="border rounded-circle mx-3" />
				<a class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span>| | |</span>
        </a>	
		    <div class="collapse navbar-collapse" id="navbarNav">		         	
					<a title="" class="nav-item form-control btn btn-dark my-3" href="<?= url() ?>">Home</a>
          <a title="" class="nav-item form-control btn btn-dark my-3" href="<?= url("sobre"); ?>">Sobre</a>
					<a title="" class="nav-item form-control btn btn-dark my-3" href="<?= url("contato"); ?>">Contato</a>
          <a title="" class="nav-item form-control btn btn-dark my-3" href="<?= url("gerador_de_conteudo"); ?>">Entrar</a>
				</div>
			</div>
		<?php
		endif; ?>
	</nav>
	<div class='container-fluid border shadow-lg'>
    <div class='col-12'>
      <div id="menuTopo" class="carousel slide pt-1 pb-1" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class='row'>
              <div class='col-1'>&nbsp;</div>
              <div class='col-5'>
              	<a title="" class="nav-item form-control btn btn-outline-dark my-3" href="<?= url("texto"); ?>">Ferramentas de Texto</a>
              </div>
              <div class='col-5'>
              	<a title="" class="nav-item form-control btn btn-outline-dark my-3" href="<?= url("dicas_conhecimento"); ?>">Dicas e Conhecimento</a>
              </div>
              <div class='col-1'>&nbsp;</div>
            </div>
          </div>
          <div class="carousel-item">
            <div class='row'>
              <div class='col-4'>&nbsp;</div>
                <div class='col-4'>
                 		<a title="" class="nav-item form-control btn btn-outline-dark my-3" href="<?= url("palheta_de_cores"); ?>">Palheta de Cores</a>               	
                </div>
              <div class='col-4'>&nbsp;</div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#menuTopo" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bg-info rounded-pill" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#menuTopo" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bg-info rounded-pill" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
      </div>
    </div>
  </div>
	<main class="container my-3">
		<?= $v->section("content"); ?>
	</main>  
  <section id='linhaAvisoDeCookies'>
    <p>Navegando em Nosso Site você Automaticamente Concorda com a Utilização de cookies para oferecer uma melhor experiência de navegação, <a href='politica_privacidade.php'>Saiba mais.</a> <button tipe='button' id='botaoFecharCookies'>X</button></p>
  </section>
	<footer class="container-flex text-center border mt-5">		
		Todos os Direitos Reservados - <?= SITE; ?> - 2021
	</footer>
<script src="theme/assets/js/arquivo.js"></script>
<!-- Javascrip bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<?= $v->section("js"); ?>
</body>
</html>