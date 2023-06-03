<?php $v->layout("_theme"); ?>
<main class='row'>
	<article class='col-12'>
		<h1 class='text-center border border-danger mt-3'>Palheta de Cores RGB ()</h1>
		<p>Encontre Aqui Aquela Cor Perfeita, A Cor Que Combina, A Cor Que Você Está Procurando!</p>				
	</article>
</main>
<section class='row'>
	<div class='col-12 PiscaPisca'></div>
</section>
<section class='row pt-3'>
	<div class='col-12'>
		<div id="escolhas"></div>
		<div id="visualizar" class='mt-3'></div>
		<h3 id='codigoDaCor' class='text-center'></h3>
	</div>
</section>
<section class='row pt-3'>
	<div class='col-12'>
		<p>No Momentos Apenas Cores RGB (), Em Breve Disponibilizaremos Mais Cores e Códigos CSS, Hexadecimal, HEX, RGB (), HSL (), HSV (), HWB (), CMYK (), Vamos Aprimorar Tudo Logo Logo!</p>
	</div>
</section>

<?= $v->start("js"); ?>
	<script src="<?= url('theme/assets/js/paletadecorescodigos.js');?>"></script>
<?= $v->end(); ?>