class Session{
    constructor(create = true){
		if(create){
			this.createSession();
		}
	}
	checkCookieSession(cookieName) {
		var name = cookieName + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
			c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {				
				return c.substring(name.length, c.length);
			}
		}		
		return false;
	}
	createSession($data){
		var urlSite = $("#urlSite").val();
		$.ajax({
			type: "POST",
			url: urlSite+"/api/createsession",
			dataType: "JSON",
			success: function (response) {
				let createsessioncookie = response;
				document.cookie = "createsessioncookie" + "=" + response + ";";
			}
		});
	}
}