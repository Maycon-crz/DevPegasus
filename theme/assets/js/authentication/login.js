class Login{
    constructor(session){
        if (session.checkCookieSession("createsessioncookie") === false){session.createSession();}
        this.startLogin(session);
    }
    startLogin(session){
		$("#userLoginForm").submit(function(event){
			event.preventDefault();
			var appKey = session.checkCookieSession("createsessioncookie");
			if(appKey != false){
                let formData = $("#userLoginForm").serialize()+"&app_key="+appKey+"&front_end=web";
                var urlSite = $("#urlSite").val();
                var loadingGif = document.querySelector(".loadingGif");
                loadingGif.innerHTML = "<div class='spinner-border text-success' role='status'><span class='sr-only'></span></div>";
                $.ajax({
                    url: urlSite+"/api/login",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response){
                        loadingGif.innerHTML = "";
                        console.log(response);
                        if(response.status == "success"){
                            window.location.href = urlSite+"/user"; 
                            $("#smgLogin").html("Aguarde...");
                        }else{                            
                            const triangle = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svgIcons"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/></svg>';
							$("#smgLogin").html(triangle+response.data);
                        }
                    }
                });
            }else{ alert("Erro recarregue a página!"); }
		});
	}
}
let startSession = new Session();
let startLogin = new Login(startSession);