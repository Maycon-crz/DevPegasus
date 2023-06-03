<!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable text-dark">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Iniciar sessão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section class="row border border-primary rounded mb-3">
                    <form action="<?= url("source/Controllers/AuthenticationController.php") ?>" method="" id="userLoginForm" class="col-12">
                        <label class="" for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control mb-3">
                        <label class="" for="password">Senha</label>
                        <input type="password" name="password" id="password" class="form-control mb-3">
                        <button type="submit" class="form-control btn btn-outline-primary mb-3">Entrar</button>
                    </form>
                </section>
                <section class="row border border-primary rounded">
                    <div class="col-12">
                        <h4>Cadastre-se<h4>
                    </div>
                    <form action="" method="" class="col-12">
                        <label class="" for="full_name">Nome Completo</label>
                        <input type="text" name="full_name" id="full_name" class="form-control mb-3">
                        <label class="" for="email_cad">E-mail</label>
                        <input type="email" name="email" id="email_cad" class="form-control mb-3">
                        <label class="" for="email_conf_cad">Confirma seu E-mail</label>
                        <input type="email" name="email_conf" id="email_conf_cad" class="form-control mb-3">
                        <label class="" for="date_of_birth">Data de Nascimento</label>
                        <input type="text" name="date_of_birth" id="date_of_birth" class="form-control mb-3">
                        <label class="" for="address">Endereço</label>
                        <input type="text" name="address" id="address" class="form-control mb-3">
                        <label for="phone">Enter a phone number:</label>
                        <input type="tel" class="form-control" id="tel" name="tel" maxlength="15" pattern="\(\d{2}\)\s*\d{5}-\d{4}" required>
                        <label class="" for="password_cad">Senha</label>
                        <input type="password" name="password" id="password_cad" class="form-control mb-3">
                        <label class="" for="password_conf_cad">Confirme sua Senha</label>
                        <input type="password" name="password_conf" id="password_conf_cad" class="form-control mb-3">
                        <button type="submit" class="form-control btn btn-outline-primary mb-3">Cadastrar</button>
                    </form>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>