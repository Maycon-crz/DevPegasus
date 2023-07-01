<?php $v->layout("_theme"); ?>

<section class="row">
	<div class="col-12">
	  	<h1 class="text-center">Iniciar sessão</h1>
        <form action="" method="" id="userLoginForm" class="col-12">
            <label class="" for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control mb-3" required>
            <label class="" for="password">Senha</label>
            <input type="password" name="password" id="password" class="form-control mb-3" required>
            <span class="form-control" id="smgLogin"></span>
            <button type="submit" class="form-control btn btn-outline-primary mb-3">Entrar</button>
        </form>
	</div>
</section>