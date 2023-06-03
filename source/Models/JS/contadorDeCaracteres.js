class ContadorDeCaracteres{
	constructor(){
		this.recolhendoCaracteres();
	}
	recolhendoCaracteres(){
		let textContadorDeCaracteres = document.getElementById("textContadorDeCaracteres");
		if(textContadorDeCaracteres){
			textContadorDeCaracteres.addEventListener("keyup", () => {
				let digitado = textContadorDeCaracteres.value;
				let qtdCaracteres = digitado.length;
				let palavras = digitado.split(" ");
				let qtdPalavras = palavras.length;
				document.getElementById("qtdCaracteres").innerHTML = qtdCaracteres;
				document.getElementById("qtdPalavras").innerHTML = qtdPalavras;
			});
		}
	}
}
var contadorDeCaracteres = new ContadorDeCaracteres();
