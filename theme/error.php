<?php $v->layout("_theme"); ?>
<div class='error'>
	<h2>Ooooops erro <?= $error; ?>!</h2>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
</div>

<?php $v->start("slidebar"); ?>
<a href="<?= url(); ?>" title="Voltar ao inicio!">Voltar</a>
<?php $v->end(); ?>