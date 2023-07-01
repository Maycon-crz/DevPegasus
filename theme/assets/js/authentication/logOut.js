class LogOut{
	constructor(session){
		this.exit(session);
	}
	exit(session){		
		document.getElementById("buttonLogOut").addEventListener("click", function(ev){
			ev.preventDefault();
			var appKey = session.checkCookieSession("createsessioncookie");
			if(appKey != false){				
				var urlSite = $("#urlSite").val();				
				var loadingGif = document.querySelector(".loadingGif");
				loadingGif.innerHTML = "<div class='spinner-border text-success' role='status'><span class='sr-only'></span></div>";
				$.ajax({
					url: urlSite+"/api/logout",
					type: "POST",
					data: {"app_key": appKey, "system": "web"},
					dataType: "json",
					success: function(response){
						loadingGif.innerHTML = "";
						console.log(response);
						if(response.status == "success" || response.data == "Erro de autenticação!"){
							document.location.reload(true);
						}
					}
				});
			}
		});		
	}
}
let startSession = new Session();
let startLogOut = new LogOut(startSession);