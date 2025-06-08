<?php $v->layout("_theme"); ?>

<section class="row">
	<div class="col-12">
        <h1>Painel</h1>
    </div>
</section>
<?php require_once("include/userOptions/postsOperationsView.php"); ?>

<?= $v->start("js"); ?>
<script src="<?= url('theme/assets/js/loggedUserOptions/registration/postRegistration.js'); ?>"></script>
<script src="<?= url('theme/assets/js/loggedUserOptions/edition/postEdition.js'); ?>"></script>
<?= $v->end(); ?>