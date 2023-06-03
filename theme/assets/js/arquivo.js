class MenuFixo{
	constructor(){
		this.abreMenuFixo();
		this.fechaMenuFixo();
	}
	abreMenuFixo(){
		let botaoAbreMenuFixo  = document.getElementById("botaoAbreMenuFixo");
		if(botaoAbreMenuFixo){
			botaoAbreMenuFixo.addEventListener("click", function(){
				document.getElementById("menuFixo").style.display = "block";
				document.getElementById("botaoAbreMenuFixo").style.display = "none";

			});
		}
	}
	fechaMenuFixo(){
		let botaoFecharMenuFixo  = document.getElementById("botaoFecharMenuFixo");
		if(botaoFecharMenuFixo){
			botaoFecharMenuFixo.addEventListener("click", function(){
				document.getElementById("menuFixo").style.display = "none";
				document.getElementById("botaoAbreMenuFixo").style.display = "block";

			});
		}
	}
}
class AvisoDeCookies{
	constructor(){
		this.checkCookie();
		this.fecharAvisoDeCookies();
	}
	getCookie(cname){
	  let name = cname + "=";
	  let decodedCookie = decodeURIComponent(document.cookie);
	  let ca = decodedCookie.split(';');
	  for(let i = 0; i < ca.length; i++) {
	    let c = ca[i];
	    while (c.charAt(0) == ' ') {
	      c = c.substring(1);
	    }
	    if (c.indexOf(name) == 0) {
	      return c.substring(name.length, c.length);
	    }
	  }
	  return "";
	}
	checkCookie(){
	  let estadodoavisodecookie = this.getCookie("estadodoavisodecookie");
	  if (estadodoavisodecookie != ""){
	    document.getElementById("linhaAvisoDeCookies").style.display = "none";
	  }
	}
	fecharAvisoDeCookies(){
		var botaoFecharCookies = document.getElementById("botaoFecharCookies");
		if(botaoFecharCookies){
			botaoFecharCookies.addEventListener("click", function(){
				document.getElementById("linhaAvisoDeCookies").style.display = "none";
				let estadodoavisodecookie = "fechado";
				document.cookie = "estadodoavisodecookie" + "=" + "fechado" + ";";
			});
		}
	}
}
class DataHoraAtual{
	constructor(){
		this.atribuindoDataHoraAtual();
	}
	atribuindoDataHoraAtual(){
		var data = new Date();
		var dia = String(data.getDate()).padStart(2, '0');
		var mes = String(data.getMonth() + 1).padStart(2, '0');
		var ano = data.getFullYear();
		var dataAtual = dia + '-' + mes + '-' + ano;
		var hora = data.getHours();
		var min = data.getMinutes();
		var seg = data.getSeconds();
		var horaAtual = hora + ':' + min + ':' + seg;
		var dataAtualFormatoUSA = ano + '-' + mes + '-' + dia;
		if(document.querySelector('time')){
			document.querySelector('time').innerHTML = "Data Atual: "+dataAtual+" | Horário Atual: "+horaAtual;
			document.querySelector('time').setAttribute("datetime", dataAtualFormatoUSA);
		}
	}
}
var mostrandoDdataHoraAtual = new DataHoraAtual();
var avisoDeCookies = new AvisoDeCookies();
var menuFixo = new MenuFixo();
