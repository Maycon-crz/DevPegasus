class VisualizadorDeBorderRadius{
	constructor(){
		this.captandoValorValorGeralBorderRadius()
		this.captandoValorCantoInferiorDireito();
		this.captandoValorCantoInferiorEsquerdo();
		this.captandoValorCantoSuperiorDireito();
		this.captandoValorCantoSuperiorEsquerdo();		
		this.vlCantoSuperiorEsquerdo = 0;
		this.vlCantoSuperiorDireito = 0;
		this.vlCantoInferiorEsquerdo = 0;
		this.vlCantoInferiorDireito = 0;		
		this.toggleVisualizadorDeBorderRadius();
		this.resetarBorderRadius();
	}
	codigoCSScompativel(SuperiorEsquerdo, SuperiorDireito, InferiorEsquerdo, InferiorDireito){
		var padrao = "Código padrão &#10;"+
		"border-top-left-radius: "+SuperiorEsquerdo+"px; &#10;"+
		"border-top-right-radius: "+SuperiorDireito+"px; &#10;"+
		"border-bottom-left-radius: "+InferiorEsquerdo+"px; &#10;"+
		"border-bottom-right-radius: "+InferiorDireito+"px; &#10;";
		var safari = "Navegador: Safari &#10;"+
		"-webkit-border-top-left-radius: "+SuperiorEsquerdo+"px; &#10;"+
		"-webkit-border-top-right-radius: "+SuperiorDireito+"px; &#10;"+
		"-webkit-border-bottom-left-radius: "+InferiorEsquerdo+"px; &#10;"+
		"-webkit-border-bottom-right-radius: "+InferiorDireito+"px; &#10;";
		var mozilla = "Navegador: Mozilla &#10;"+
		"-moz-border-radius-topleft: "+SuperiorEsquerdo+"px; &#10;"+
		"-moz-border-radius-topright: "+SuperiorDireito+"px; &#10;"+
		"-moz-border-radius-bottomleft: "+InferiorEsquerdo+"px; &#10;"+
		"-moz-border-radius-bottomright: "+InferiorDireito+"px; &#10;";		
		document.getElementById("caixaBorderRadius").innerHTML = "<textarea class='mt-5' rows=8>"+padrao+safari+mozilla+"</textarea>";
	}	
	atribuindoBorderRadius(nomeDoCanto, valor){		
		var caixaBorderRadius = document.getElementById("caixaBorderRadius");
		valor = valor.replace(/[^0-9]/g,'');
    	valor = parseInt(valor);//Apenas os números
		switch(nomeDoCanto){
			case "CantoSuperiorEsquerdo":
				caixaBorderRadius.style.borderTopLeftRadius  = valor+"px";
				caixaBorderRadius.style.MozBorderTopLeftRadius  = valor+"px";
				caixaBorderRadius.style.WebkitBorderTopLeftRadius  = valor+"px";
				this.vlCantoSuperiorEsquerdo = valor;
				this.codigoCSScompativel(this.vlCantoSuperiorEsquerdo, this.vlCantoSuperiorDireito, this.vlCantoInferiorEsquerdo, this.vlCantoInferiorDireito);
						
			break;
			case "CantoSuperiorDireito":
				caixaBorderRadius.style.borderTopRightRadius  = valor+"px";
				caixaBorderRadius.style.MozBorderTopRightRadius  = valor+"px";
				caixaBorderRadius.style.WebkitBorderTopRightRadius  = valor+"px";
				this.vlCantoSuperiorDireito = valor;
				this.codigoCSScompativel(this.vlCantoSuperiorEsquerdo, this.vlCantoSuperiorDireito, this.vlCantoInferiorEsquerdo, this.vlCantoInferiorDireito);				
			break;
			case "CantoInferiorEsquerdo":
				caixaBorderRadius.style.borderBottomLeftRadius  = valor+"px";
				caixaBorderRadius.style.MozBorderBottomLeftRadius  = valor+"px";
				caixaBorderRadius.style.WebkitBorderBottomLeftRadius  = valor+"px";	
				this.vlCantoInferiorEsquerdo = valor;
				this.codigoCSScompativel(this.vlCantoSuperiorEsquerdo, this.vlCantoSuperiorDireito, this.vlCantoInferiorEsquerdo, this.vlCantoInferiorDireito);				
			break;
			case "CantoInferiorDireito":
				caixaBorderRadius.style.borderBottomRightRadius  = valor+"px";
				caixaBorderRadius.style.MozBorderBottomRightRadius  = valor+"px";
				caixaBorderRadius.style.WebkitBorderBottomRightRadius  = valor+"px";
				this.vlCantoInferiorDireito = valor;
				this.codigoCSScompativel(this.vlCantoSuperiorEsquerdo, this.vlCantoSuperiorDireito, this.vlCantoInferiorEsquerdo, this.vlCantoInferiorDireito);				
			break;
			case "ValorGeralBorderRadius":
				caixaBorderRadius.style.borderRadius  = valor+"%";
				let retornandoCodigoGeralBorderRaius = 
				"Código padrão &#10;"+
				"border-radius: "+valor+"%; &#10;"+
				"Navegador: Safari &#10;"+
				"-webkit-border-radius: "+valor+"%; &#10;"+
				"Navegador: Mozilla &#10;"+								
				"-moz-border-radius: "+valor+"%; &#10;";
				document.getElementById("caixaBorderRadius").innerHTML = "<textarea class='mt-5' rows=8>"+retornandoCodigoGeralBorderRaius+"</textarea>";
			break;
		}		
	}
	resetarBorderRadius(){
		var botaoResetarBorderRadius = document.getElementById("BotaoResetarBorderRadius");
		var caixaBorderRadius = document.getElementById("caixaBorderRadius");
		if(botaoResetarBorderRadius){
			botaoResetarBorderRadius.addEventListener('click', function(){			
				caixaBorderRadius.style.borderTopLeftRadius = "0px";
				caixaBorderRadius.style.MozBorderTopLeftRadius = "0px";
				caixaBorderRadius.style.WebkitBorderTopLeftRadius = "0px";
				caixaBorderRadius.style.borderTopRightRadius = "0px";
				caixaBorderRadius.style.MozBorderTopRightRadius = "0px";
				caixaBorderRadius.style.WebkitBorderTopRightRadius = "0px";
				caixaBorderRadius.style.borderBottomLeftRadius = "0px";
				caixaBorderRadius.style.MozBorderBottomLeftRadius = "0px";
				caixaBorderRadius.style.WebkitBorderBottomLeftRadius = "0px";
				caixaBorderRadius.style.borderBottomRightRadius = "0px";
				caixaBorderRadius.style.MozBorderBottomRightRadius = "0px";
				caixaBorderRadius.style.WebkitBorderBottomRightRadius = "0px";
				document.getElementById("ValorGeralBorderRadius").value="";
				document.getElementById("CantoInferiorDireito").value="";
				document.getElementById("CantoInferiorEsquerdo").value="";
				document.getElementById("CantoSuperiorDireito").value="";
				document.getElementById("CantoSuperiorEsquerdo").value="";
				document.getElementById("caixaBorderRadius").innerHTML = "";
			});	
		}			
	}
	captandoValorValorGeralBorderRadius(){
		var valorGeralBorderRadius = document.getElementById("ValorGeralBorderRadius");
		if(valorGeralBorderRadius){
			valorGeralBorderRadius.addEventListener('keyup', (e) => {
				let key = e.which || e.keyCode;
				if (key == 13) { // codigo da tecla enter
					if(valorGeralBorderRadius.value){
						let vlGeralBorderRadius = valorGeralBorderRadius.value;
						this.atribuindoBorderRadius("ValorGeralBorderRadius", vlGeralBorderRadius);
					}				
				}					
			});
		}				
	}
	captandoValorCantoInferiorDireito(){
		var cantoInferiorDireito = document.getElementById("CantoInferiorDireito");
		if(cantoInferiorDireito){
			cantoInferiorDireito.addEventListener('keyup', (e) => {
				let key = e.which || e.keyCode;
				if (key == 13) { // codigo da tecla enter
					let valorCantoInferiorDireito = cantoInferiorDireito.value;
					this.atribuindoBorderRadius("CantoInferiorDireito", valorCantoInferiorDireito);
				}					
			});
		}					
	}
	captandoValorCantoInferiorEsquerdo(){
		var cantoInferiorEsquerdo = document.getElementById("CantoInferiorEsquerdo");
		if(cantoInferiorEsquerdo){
			cantoInferiorEsquerdo.addEventListener('keyup', (e) => {
				let key = e.which || e.keyCode;
				if (key == 13) {
					let valorCantoInferiorEsquerdo = cantoInferiorEsquerdo.value;
					this.atribuindoBorderRadius("CantoInferiorEsquerdo", valorCantoInferiorEsquerdo);
				}					
			});
		}				
	}
	captandoValorCantoSuperiorDireito(){
		var cantoSuperiorDireito = document.getElementById("CantoSuperiorDireito");
		if(cantoSuperiorDireito){
			cantoSuperiorDireito.addEventListener('keyup', (e) => {
				let key = e.which || e.keyCode;
				if (key == 13) {
					let valorCantoSuperiorDireito = cantoSuperiorDireito.value;
					this.atribuindoBorderRadius("CantoSuperiorDireito", valorCantoSuperiorDireito);
				}					
			});	
		}				
	}
	captandoValorCantoSuperiorEsquerdo(){
		var cantoSuperiorEsquerdo = document.getElementById("CantoSuperiorEsquerdo");
		if(cantoSuperiorEsquerdo){
			cantoSuperiorEsquerdo.addEventListener('keyup', (e) => {
				let key = e.which || e.keyCode;
				if (key == 13) {
					let valorCantoSuperiorEsquerdo = cantoSuperiorEsquerdo.value;
					this.atribuindoBorderRadius("CantoSuperiorEsquerdo", valorCantoSuperiorEsquerdo);
				}					
			});
		}				
	}	
	toggleVisualizadorDeBorderRadius(){	
		let botaoVisualizador = document.getElementById("botaoVisualizadorDeBorderRadius");
		var toggle = 0;
		if(botaoVisualizador){
			botaoVisualizador.addEventListener("click", function(){			
				if(toggle == 0){			
					document.getElementById("linhaVisualizadorDeBorderRadius").style.display="block";
					toggle = 1;
				}else{
					document.getElementById("linhaVisualizadorDeBorderRadius").style.display="none";
					toggle = 0;
				}
			});
		}				
	}
}
var visualizadorDeBorderRadius = new VisualizadorDeBorderRadius();