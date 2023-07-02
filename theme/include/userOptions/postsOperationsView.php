<section class="row postsOperationsView hideElement" id="rowregistrationPostsOperations">
    <div class="col-12 shadow-lg py-3 rounded">
        <button type="buttton" class="form-control btn btn-outline-info buttonUserOptionsMenu my-3" value="postsOperationsView">X Fechar</button>
        <form action="<?= url("") ?>" id="formPostRegistration" enctype="multipart/form-data">
            <h3 for="" class="col-12 my-3 text-center">Cadastro de Postagens</h3>
            <label for="titlePost">Título</label>
            <input type="text" name="title" id="titlePost" class="form-control rounded-pill bg-transparent my-3">
            <label for="descriptionsPost">Descrição</label>
            <textarea name="descriptions" id="descriptionsPost" cols="30" rows="3" class="form-control bg-transparent"></textarea>
            <div class="my-3 py-3">
                <label for="imagePost" class="custom-file-label form-control text-center bg-transparent">Escolha uma imagem</label>
                <input type="file" name="image" id="imagePost" accept="image/jpeg, image/JPEG, image/jpg, image/JPG, image/png, image/PNG" class="custom-file-input form-control bg-transparent">                
            </div>
            <button type="submit" class="form-control my-5 btn btn-outline-info">Cadastrar</button>
            <span class="form-control" id="smgErrorRegistrationPost"></span>
        </form>
    </div>
</section>
<section class="row postsOperationsView hideElement">
    <div class="col-12 p-3">&nbsp;</div>
</section>
<section class="row postsOperationsView hideElement">
    <div class="col-12 shadow-lg py-3 rounded">
        <form action="<?= url("") ?>" id="formPostEdition">
            <h3 for="" class="col-12 my-3 text-center">Edição de Postagens</h3>
            <div class="row">
                <div class="col-9">
                    <input type="text" name="title" class="form-control autocomplete-input" id="postTitle" placeholder="Título da Postagem">
                </div>
                <div class="col-3 ps-0">
                    <button type="submit" class="form-control btn btn-outline-info">Buscar</button>
                </div>
            </div>
        </form>
    </div>
</section>
<section id="divShowPostsForEdition" class="row"></section>