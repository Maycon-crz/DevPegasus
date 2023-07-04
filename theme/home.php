<?php 
	use CoffeeCode\Cropper\Cropper;
	$v->layout("_theme");
	$cropperPosts = new Cropper("theme/assets/img/posts/cache");
?>

<main class="row shadow-lg">
	<header class="col-12 border rounded">
		<h1>Aqui Você Vai Encontrar Ferramentas para Desenvolvedores, Web Designers, Criadores de Conteúdo e Programadores, futuramente open source para podermos evoluir mais rápido e melhor.</h1>
		<span>O Tempo Voa! | <time datetime="2021-07-16 15:44"></time></span>
	</header>
</main>
<aside class="row shadow-lg border rounded mt-3">
	<div class="col-12">
		<h3>
		Pretendemos proporcionar ferramentas super úteis para você, desde as mais simples até futuramente as mais avançadas!
		</h3>
	</div>
</aside>
<section class="row">
	<div class="col-12 px-0">
	  	<button type="button" id="botaoVisualizadorDeBorderRadius" class="form-control btn btn-lg btn-outline-dark my-3">Visualizador e Gerador de Border Radius</button>
	</div>
</section>
<section id="linhaVisualizadorDeBorderRadius" class="shadow-lg text-center border ocultar">
	<div class="row">
		<header class="col-12 text-center">          
			<h2>Visualizador de <strong>Border Radius</strong></h2>          
		</header>
		<div class="col-2">&nbsp;</div>
			<div class="col-4 text-start">
				<input type="text" id="CantoSuperiorEsquerdo" size=3 placeholder="0px" />
			</div>
			<div class="col-4 text-end">            
				<input type="text" id="CantoSuperiorDireito" size=3 placeholder="0px" />
			</div>
		<div class="col-2">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-1">&nbsp;</div>
			<div class="col-10 text-center">
				<div id="caixaBorderRadius" class="pt-5 border"></div>
			</div>     
		<div class="col-1">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-2">&nbsp;</div>
			<div class="col-4 text-start">
				<input type="text" id="CantoInferiorEsquerdo" size=3 placeholder="0px" />
			</div>
			<div class="col-4 text-end">
				<input type="text" id="CantoInferiorDireito" size=3 placeholder="0px" />
			</div>
		<div class="col-2">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-2">&nbsp;</div>
			<div class="col-8">
				<label>Valor geral em Porcentagem: </label><input type="text" id="ValorGeralBorderRadius" size="5" placeholder="Ex:20" class="border rounded p-2" /><label>%</label><button type="button" id="BotaoResetarBorderRadius" class="btn btn-lg btn-outline-dark">Resetar</button>
			</div>
		<div class="col-2">&nbsp;</div>
	</div>
</section>
<section class="row">
	<div class="col-12 p-0">
		<button type="button" id="botaoAbrirGeradorDeTexto" class="form-control btn btn-lg btn-outline-dark my-3">Abrir Gerador de Texto Aleatório</button>
	</div>
</section>
<section class="text-center ocultar" id="linhaGeradorDeTextoAleatorio">
	<div class="row">
		<div class="col-12 " id="linhaGeradorDeTextoAleatorio">
			<h2>Gerador de Texto Aleatório</h2>
		</div>
	</div>	
	<div class="row shadow-lg border">
		<div class="col-6">
			<select id="selectGeradorDeTextoAleatorio" class="form-select form-select-lg my-3">
				<option value="Aleatório">Aleatório</option>
				<option value="Reciclagem">Reciclagem</option>
				<option value="Programação">Programação</option>
				<option value="Em Breve">Em Breve Mais Temas...</option>
			</select>
		</div>
		<div class="col-6">
			<button type="button" class="form-control btn btn-lg btn-outline-dark my-3" id="botaoGerarTexto">Gerar texto</button>
		</div>
	</div>
	<div class="row shadow-lg">
		<div class="col-1">&nbsp;</div>
		<div class="col-10 ocultar" id="textoGerado"></div>
		<div class="col-1">&nbsp;</div>
	</div>
</section>
<section class="row shadow-lg border rounded mt-3">
	<div class="col-12">
		<h3>Quer criar um site elegante e responsivo como o DevPegasus entre em contato:</h3>
		<li>
			<li><a title="GitHub do Desenvolvedor" target="_bank" href="https://github.com/">Maycon-crz</a></li>
			<li>devpegasus321@gmail.com</li>
			<li>nmaycon304@gmail.com</li>
		</li>
	</div>
</section>
<?php
	$qtdPosts = count($posts["data"]);	
	if($qtdPosts > 0) :
	$postsPerPage = 4;
	if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/iphone|android|blackberry|opera mini|mobile/', strtolower($_SERVER['HTTP_USER_AGENT']))) : $postsPerPage = 1; endif;
?>
<section id="postsCarousel" class="row shadow-lg border rounded carousel slide mt-3" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php for ($i = 0; $i < $qtdPosts; $i += $postsPerPage) : ?>
            <div class="carousel-item <?= ($i == 0) ? 'active' : ''; ?>">
                <div class="row">
                    <?php for ($k = $i; $k < min($i + $postsPerPage, $qtdPosts); $k++) : ?>
                        <div class="col-12 col-md-3">
                            <div class="card my-3 shadow-lg bg-transparent rounded">
                                <!-- código para adicionar a imagem do filme -->
                                <img src="<?= $cropperPosts->make('theme/assets/img/posts/' . $posts["data"][$k]["image"], "300"); ?>" alt="<?= $posts["data"][$k]["title"]; ?> Imagem descritiva" class="form-control imagesPosts mx-auto mt-3">
                                <div class="card-body">
                                    <!-- código para adicionar o título do filme -->
                                    <h2 class="card-title text-wrap h5 titleCard"><?= substr($posts["data"][$k]["title"], 0, 160); ?></h2>
                                    <!-- código para adicionar a descrição do filme -->
                                    <p class="card-text"><?= substr($posts["data"][$k]["descriptions"], 0, 200); ?></p>
                                </div>
                                <div class="card-footer">
                                    <!-- código para adicionar o botão de "Ver Mais" -->
                                    <button type="button" id="<?= $posts[$k]["id"]; ?>" class="form-control buttonShowMoreStyle buttonShowMoreModalPHP" data-bs-toggle="modal" data-bs-target="#modalPHP<?= $k ?>">Ver Mais</button>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modalPHP<?= $k ?>" tabindex="-1" role="dialog" aria-labelledby="modalPHP<?= $k ?>Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content text-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalPHP<?= $k ?>Label"><?= $posts["data"][$k]["title"]; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="card-text border"><?= $posts["data"][$k]["descriptions"]; ?></p>
                                        <div id="divDataAdditionalForModalPHP<?= $posts["data"][$k]["id"]; ?>"></div>
                                    </div>
                                    <div class="modal-footer">
                                    <?php if(isset($_SESSION["email"]) || isset($_SESSION["email"]) !== false) : ?>
                                        <button type="button" class="btn btn-info" data-bs-dismiss="modal"><a href="usuario" class="text-dark text-decoration-none">Comprar</a></button>                                        
                                    <?php else: ?>
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalLogin">Comprar</button>
                                    <?php endif; ?>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <!-- botões para navegar entre os slides do carrossel -->
    <button class="carousel-control-prev" type="button" data-bs-target="#postsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#postsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</section>
<?php endif; ?>
<section class="row shadow-lg border rounded mt-3">
	<div class="col-12">
		<h3>Sites produzidos por Maycon Nascimento de olivera - Criador do DevPegasus:</h3>
	</div>
</section>
<section class="row shadow-lg border rounded mt-3">
	<div class="col-1">&nbsp;</div>
	<div class="col-5 text-center">
		<a target="_blank" href="https://receitasedrinks.com/">
			<h4 class="my-3 text-dark h2 text-center">Receitas e Drinks</h4>
			<img alt="logo do site Receitas e Drinks" src="theme/assets/img/logo_receitas_e_drinks.png" class="form-control p-0 border shadow-lg rounded my-3">
		</a>
	</div>
	<div class="col-5 text-center">
		<a target="_blank" href="https://recicladarte.com/">
			<h4 class="my-3 text-dark h2 text-center">Site RecicladArte</h4>
			<img alt="logo do site logo RecicladArte" src="theme/assets/img/logo_recicladarte.jpg" class="form-control p-0 border shadow-lg rounded my-3">
		</a>
	</div>
	<div class="col-1">&nbsp;</div>
</section>

<?= $v->start("js"); ?>
	<script src="<?= url('theme/assets/js/bancoDeTextosAleatorios.js'); ?>"></script>
	<script src="<?= url('theme/assets/js/geradorDeTextoAleatorio.js'); ?>"></script>
	<script src="<?= url('theme/assets/js/visualizador_de_border_radius.js'); ?>"></script>	
<?= $v->end(); ?>