<?php $v->layout("_theme"); $hoje = date('d/m/Y'); ?>

<h1 class="text-center">Luana IA</h1>

<?php require_once("include/luana_components/content_generator.php"); ?>

<?php $v->start("js"); ?>
	<script src="<?= url("theme/assets/js/luana_js/content_generator/title_generator.js"); ?>"></script>
	<script src="<?= url("theme/assets/js/luana_js/content_generator/text_generator.js"); ?>"></script>
<?php $v->end(); ?>