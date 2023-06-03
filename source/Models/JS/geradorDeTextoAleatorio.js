class GeradorDeTextoAleatorio{
	constructor(bancoDeTextos){
		this.opcaoGerarTexto();
		this.toggleTextoAleatorio();
	}
	opcaoGerarTexto(){
		var botaoGerarTexto = document.getElementById("botaoGerarTexto");
		if(botaoGerarTexto){
			botaoGerarTexto.addEventListener("click", function(){
				var select = document.getElementById('selectGeradorDeTextoAleatorio');
				var opcao = select.options[select.selectedIndex].value;		
				var qtdTemas = bancoDeTextos.bancoDeTemas.qtd;
				var textoRetornado, qtdFrases, idFraseAleatoria;
				switch(opcao){
					case "Aleatório":
						var idTemaAleatorio = Math.random() * (qtdTemas - 0) + 0;
						idTemaAleatorio = Math.ceil(idTemaAleatorio);//Aredonda
						var tema = bancoDeTextos.bancoDeTemas[idTemaAleatorio];					
						switch(tema){
							case "Reciclagem":
								qtdFrases = bancoDeTextos.listaReciclagem.qtd;
								idFraseAleatoria = Math.random() * (qtdFrases - 0) + 0;
								idFraseAleatoria = Math.ceil(idFraseAleatoria);//Aredonda
								textoRetornado = bancoDeTextos.listaReciclagem[idFraseAleatoria];			
								document.getElementById("textoGerado").innerHTML = textoRetornado;
							break;
							case "Programação":
								qtdFrases = bancoDeTextos.listaProgramacao.qtd;
								idFraseAleatoria = Math.random() * (qtdFrases - 0) + 0;
								idFraseAleatoria = Math.ceil(idFraseAleatoria);//Aredonda
								textoRetornado = bancoDeTextos.listaProgramacao[idFraseAleatoria];
								document.getElementById("textoGerado").innerHTML = textoRetornado;
							break;
						}					
					break;
					case "Reciclagem":
						qtdFrases = bancoDeTextos.listaReciclagem.qtd;
						idFraseAleatoria = Math.random() * (qtdFrases - 0) + 0;
						idFraseAleatoria = Math.ceil(idFraseAleatoria);//Aredonda
						textoRetornado = bancoDeTextos.listaReciclagem[idFraseAleatoria];			
						document.getElementById("textoGerado").innerHTML = textoRetornado;
					break;
					case "Programação":
						qtdFrases = bancoDeTextos.listaProgramacao.qtd;
						idFraseAleatoria = Math.random() * (qtdFrases - 0) + 0;
						idFraseAleatoria = Math.ceil(idFraseAleatoria);//Aredonda
						textoRetornado = bancoDeTextos.listaProgramacao[idFraseAleatoria];
						document.getElementById("textoGerado").innerHTML = textoRetornado;
					break;
					case "Em Breve":
						document.getElementById("textoGerado").innerHTML = "<h3>Em Breve Disponibilizaremos mais temas!</h3>";
					break;
				}
				document.getElementById("textoGerado").style.display = "block";
		});
		}		
	}
	toggleTextoAleatorio(){
		var toggleTextoAleatorio=0;
		var botaoAbrirGeradorDeTexto = document.getElementById("botaoAbrirGeradorDeTexto");
		if(botaoAbrirGeradorDeTexto){
			botaoAbrirGeradorDeTexto.addEventListener("click", function(){				
				if(toggleTextoAleatorio == 0){
					document.getElementById("linhaGeradorDeTextoAleatorio").style.display = "block";
					toggleTextoAleatorio=1;
				}else{
					document.getElementById("linhaGeradorDeTextoAleatorio").style.display = "none";
					toggleTextoAleatorio=0;
				}
			});
		}		
	}
}
//Arquivo bancoDeTextosAleatorios.js
	var bancoDeTextos = new BancoDeTextosAleatorios();
//---
var geradorDeTextoAleatorio = new GeradorDeTextoAleatorio(bancoDeTextos);

