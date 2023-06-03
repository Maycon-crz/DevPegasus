class EnviandoParaAlgoritmoPHP{
	enviandoParaPHP(cripto, chave, parametro){		
		$.ajax({
			url: "source/Models/Encriptador.php",
			type: "post",
			data: {
				"cripto": cripto,
				"chaveCripto": chave,
				"parametroCripto": parametro 
			},
			dataType: "json",
			success: function(retorno){	
				let texto = document.getElementById("TextoParaCriptografar").value;		
				document.getElementById("TextoCriptografado").value = texto;
				document.getElementById("TextoParaCriptografar").value = retorno;
			}
		});
	}
}
class Encriptador{
	constructor(texto, enviandoParaPHP){
		this.criptografar(texto, enviandoParaPHP);
		this.descriptografar(enviandoParaPHP);		
	}	
	criptografar(texto, enviandoParaPHP){		
		let botaoCriptografar = document.getElementById("BotaoCriptografar");		
		botaoCriptografar.addEventListener("click", function(){			
			let chave = document.getElementById("ChaveParaCriptografar").value;
			enviandoParaPHP.enviandoParaPHP(texto.value, chave, "criptografar");
		});
	}
	descriptografar(enviandoParaPHP){
		let botaoDescriptografar = document.getElementById("BotaoDescriptografar");
		botaoDescriptografar.addEventListener("click", function(){
			let chave = document.getElementById("ChaveParaCriptografar").value;		
			enviandoParaPHP.enviandoParaPHP(texto.value, chave, "descriptografar");
		});
	}	
}
let texto = document.getElementById("TextoParaCriptografar");
if(texto){
	var enviandoParaAlgoritmoPHP = new EnviandoParaAlgoritmoPHP();		
	var encriptador = new Encriptador(texto, enviandoParaAlgoritmoPHP);
}