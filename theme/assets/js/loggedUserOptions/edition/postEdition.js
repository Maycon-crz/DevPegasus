class PostEdition {
    constructor(session) {
        this.getPostsForEdition(this, session);        
    }    
    getPostsForEdition(obj, session){        
        $("#formPostEdition").submit(function(event){
            event.preventDefault();
            const formData = new FormData(document.querySelector('#formPostEdition'));                        
            var loadingGif = document.querySelector(".loadingGif");
            loadingGif.innerHTML = "<div class='spinner-border text-success' role='status'><span class='sr-only'></span></div>";
            const appKey = session.checkCookieSession("createsessioncookie");
            if (appKey) {
                formData.append("front_end", "web");
                formData.append("app_key", appKey);
                formData.append("limit", "6");
                const action = $(this).attr("action");
                fetch(action+"/api/post/get_posts", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(function (response){
                    loadingGif.innerHTML = "";
                    console.log(response);
                    obj.show(obj, response, session, action);
                });
            }else{ alert("Erro de autenticação, recarregue a página!"); }
        });
    }
    show(obj, data, session, urlSite){
        const posts = data.data;
        const divShowPostsForEdition = document.getElementById("divShowPostsForEdition");
        const fragment = document.createDocumentFragment();
        /*Button Close*/
        const buttonCloseEditionPosts = document.createElement("button");
        buttonCloseEditionPosts.setAttribute("class", "btn btn-outline-secondary btnClosePostEdition form-control my-3");
        buttonCloseEditionPosts.innerHTML = "X Fechar Edição";
        fragment.appendChild(buttonCloseEditionPosts);
        for (let i = 0; i < posts.length; i++) {
            const post = posts[i];
            const postCol = document.createElement("article");
            postCol.setAttribute("class", "col-12 col-md-4");
            const postCard = document.createElement("div");
            postCard.setAttribute("class", "card my-3 shadow-lg bg-transparent rounded");
            /*header*/
            const postHeader = document.createElement("div");
            postHeader.setAttribute("class", "card-header");
            postHeader.innerHTML = post.title;
            postCard.appendChild(postHeader);
            /*Viewing image*/
            const postImage = document.createElement("img");
            postImage.setAttribute("src", urlSite+"/theme/assets/img/posts/"+post.image);
            /* Apliacar Lazy load: postImage.setAttribute("data-src", "http://localhost/HOMOLOGACAO_WEB/sistema_de_venda_de_ingressos/theme/assets/img/posts/"+post.image);*/
            postImage.setAttribute("alt", post.title);
            postImage.setAttribute("class", "form-controll imagesPosts");
            postCard.appendChild(postImage);            
            /*Form Edition Post*/
            const postForm = document.createElement("form");
            postForm.setAttribute("action", urlSite);
            postForm.setAttribute("id", "formEditionPost_"+post.id);
            /*Card For Input File Image*/
            const cardFildImage = document.createElement("div");
            cardFildImage.setAttribute("class", "border my-3 py-3");
            /*Input Hidden With Name Image For Delete When Add New Image*/
            const inputHiddenWithNameImageForDeleteOldImageWhenAddNewImage = document.createElement("input");
            inputHiddenWithNameImageForDeleteOldImageWhenAddNewImage.setAttribute("type", "hidden");
            inputHiddenWithNameImageForDeleteOldImageWhenAddNewImage.setAttribute("name", "image_name_db");
            inputHiddenWithNameImageForDeleteOldImageWhenAddNewImage.setAttribute("value", post.image);
            /*Concatenating Elements*/
            cardFildImage.appendChild(inputHiddenWithNameImageForDeleteOldImageWhenAddNewImage);
            /*Label Input File Image*/
            const cardFildImageLabel = document.createElement("label");
            cardFildImageLabel.setAttribute("for", "image_"+post.id);
            cardFildImageLabel.setAttribute("class", "custom-file-label form-control text-center bg-transparent");
            cardFildImageLabel.innerHTML = "Alterar imagem";
            /*Concatenating Elements*/
            cardFildImage.appendChild(cardFildImageLabel);
            /*Input File For New Image*/
            const cardFildImageInputFile = document.createElement("input");
            cardFildImageInputFile.setAttribute("type", "file");
            cardFildImageInputFile.setAttribute("name", "image");
            cardFildImageInputFile.setAttribute("id", "image_"+post.id);
            cardFildImageInputFile.setAttribute("accept", "image/jpeg, image/JPEG, image/jpg, image/JPG, image/png, image/PNG");
            cardFildImageInputFile.setAttribute("class", "custom-file-input form-control bg-transparent");
            /*Concatenating Elements*/
            cardFildImage.appendChild(cardFildImageInputFile); 
            postForm.appendChild(cardFildImage);
            /*Body*/
            /*Label Title*/
            const cardBody = document.createElement("div");
            cardBody.setAttribute("class", "card-body");
            const postLabelTitle = document.createElement("label");            
            postLabelTitle.innerHTML = "Título:";
            /*Concatenating Elements*/
            cardBody.appendChild(postLabelTitle);
            /*Title*/
            const postTitle = document.createElement("input");
            postTitle.setAttribute("type", "text");
            postTitle.setAttribute("name", "title");
            postTitle.setAttribute("value", post.title);
            postTitle.setAttribute("class", "form-control");            
            /*Concatenating Elements*/
            cardBody.appendChild(postTitle);
            postForm.appendChild(cardBody);
            /*Label Descriptions*/
            const postLabelDescriptions = document.createElement("label");
            postLabelDescriptions.setAttribute("class", "");
            postLabelDescriptions.innerHTML = "Descrição:";
            /*Concatenating Elements*/
            cardBody.appendChild(postLabelDescriptions);
            /*Descriptions*/
            const postDesctiption = document.createElement("textarea");
            postDesctiption.setAttribute("name", "descriptions");
            postDesctiption.setAttribute("class", "form-control");
            postDesctiption.setAttribute("rows", "6");
            postDesctiption.innerHTML = post.descriptions;
            /*Concatenating Elements*/
            cardBody.appendChild(postDesctiption);
            /*Label Author*/
            const postLabelAuthor = document.createElement("label");
            postLabelAuthor.setAttribute("class", "");
            postLabelAuthor.innerHTML = "E-mail do Autor do cadastro:";
            /*Concatenating Elements*/
            cardBody.appendChild(postLabelAuthor);
            /*Author*/
            const postAuthor = document.createElement("input");
            postAuthor.setAttribute("type", "text");            
            postAuthor.setAttribute("class", "form-control");            
            postAuthor.setAttribute("value", post.author);
            postAuthor.setAttribute("disabled", "disabled");
            /*Concatenating Elements*/
            cardBody.appendChild(postAuthor);
            postForm.appendChild(cardBody);
            /*Label Registration Date*/
            const postLabelRegistrationDate = document.createElement("label");
            postLabelRegistrationDate.setAttribute("class", "");
            postLabelRegistrationDate.innerHTML = "Data do cadastro:";
            cardBody.appendChild(postLabelRegistrationDate);
            /*Registration Date*/
            const postRegistrationDate = document.createElement("input");
            postRegistrationDate.setAttribute("type", "text");            
            postRegistrationDate.setAttribute("class", "form-control");            
            postRegistrationDate.setAttribute("value", post.registration_date);
            postRegistrationDate.setAttribute("disabled", "disabled");
            /*Concatenating Elements*/
            cardBody.appendChild(postRegistrationDate);            
            /*Notice of change of registration date*/
            const movieNoticeOfChangeRegistrationDate = document.createElement("label");
            movieNoticeOfChangeRegistrationDate.setAttribute("class", "");
            movieNoticeOfChangeRegistrationDate.innerHTML = "Aviso: A cada edição de postagem a data de cadastro é atualizada para o dia e hora da edição, o author do cadastro também é alterado para o E-mail de quem está editando!";
            cardBody.appendChild(movieNoticeOfChangeRegistrationDate);
            /*Concatenating Elements*/
            postForm.appendChild(cardBody);
            /*Footer*/
            const cardFooter = document.createElement("div");
            cardFooter.setAttribute("class", "card-footer");
            /*Button Edition*/
            const cardButtonEdition = document.createElement("button");
            cardButtonEdition.setAttribute("type", "button");
            cardButtonEdition.setAttribute("id", post.id);
            cardButtonEdition.setAttribute("class", "btn btn-outline-success form-control btnEditionPost my-3");
            cardButtonEdition.innerHTML = "Editar";
            /*Concatenating Elements*/
            cardFooter.appendChild(cardButtonEdition);
            /*Button Delete*/
            const cardButtonDelete = document.createElement("button");
            cardButtonDelete.setAttribute("type", "button");
            cardButtonDelete.setAttribute("id", post.id);
            cardButtonDelete.setAttribute("class", "btn btn-outline-danger form-control btnDeletePost my-3");
            cardButtonDelete.innerHTML = "Excluir";
            /*Concatenating Elements*/
            cardFooter.appendChild(cardButtonDelete);
            postForm.appendChild(cardFooter);
            postCard.appendChild(postForm);
            postCol.appendChild(postCard);
            fragment.appendChild(postCol);
        }        
        /*Concatenating Elements and reseting div*/        
        divShowPostsForEdition.innerHTML = "";
        divShowPostsForEdition.appendChild(fragment);
        obj.edition(obj, session);
        obj.delete(obj, session, urlSite);
        obj.closeEdition();
    }
    edition(obj, session){
        $(".btnEditionPost").click(function(event){
            const id = $(this).attr("id");
            const formData = new FormData(document.querySelector("#formEditionPost_"+id));            
            var loadingGif = document.querySelector(".loadingGif");
            loadingGif.innerHTML = "<div class='spinner-border text-success' role='status'><span class='sr-only'></span></div>";
            const appKey = session.checkCookieSession("createsessioncookie");
            if (appKey) {
                formData.append("id", id);
                formData.append("front_end", "web");
                formData.append("app_key", appKey);
                const action = $("#formEditionPost_"+id).attr("action");
                fetch(action+"/api/post/post_edition", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(function (response){                    
                    loadingGif.innerHTML = "";
                    console.log(response);
                    // alert(response.data);
                    if(response.data == "Postagem editada com sucesso!"){
                        obj.updatesDataAfterEditing(obj, session, action, appKey);
                    }
                })
                .catch(error => alert("Erro ao editar, recarregue a página!"));
            }else{ alert("Erro de autenticação, recarregue a página!"); }
        });
    }
    delete(obj, session, action){        
        $(".btnDeletePost").click(function(event){
            var checkDelete = confirm("Tem certeza que deseja excluir a postagem?");
            if (checkDelete == true) {
                const id = $(this).attr("id");
                const formData = new FormData();
                const form = document.querySelector("#formEditionPost_"+id);
                const image_name_db = form.querySelector("input[name='image_name_db']");
                var loadingGif = document.querySelector(".loadingGif");
                loadingGif.innerHTML = "<div class='spinner-border text-success' role='status'><span class='sr-only'></span></div>";
                const appKey = session.checkCookieSession("createsessioncookie");
                if (appKey) {
                    formData.append("front_end", "web");
                    formData.append("app_key", appKey);
                    formData.append("id", id);
                    formData.append("image_name_db", image_name_db.value);
                    fetch(action+"/api/post/post_delete", {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(function (response){
                        loadingGif.innerHTML = "";
                        console.log(response);
                        if(response.data == "Excluido com sucesso"){
                            obj.updatesDataAfterEditing(obj, session, action, appKey);
                        }
                    }).catch();
                }else{ alert("Erro de autenticação, recarregue a página!"); }
            }
        });
    }
    updatesDataAfterEditing(obj, session, action, appKey){
        const formData = new FormData();
        formData.append("front_end", "web");
        formData.append("app_key", appKey);
        formData.append("limit", "6");
        fetch(action+"/api/post/get_posts", {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(function (data){
            obj.show(obj, data, session, action);            
        })
        // .catch(error => console.error(error));
    }
    closeEdition(){
        $(".btnClosePostEdition").click(function(event){
            const divShowPostsForEdition = document.getElementById("divShowPostsForEdition");
            divShowPostsForEdition.innerHTML = "";
        });
    }
}
const startPostEdition = new PostEdition(new Session(false));