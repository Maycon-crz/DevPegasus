<?php $v->layout("_theme"); ?>

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