<?php
class Encriptador{
	public function __construct(){		
		if(isset($_POST['parametroCripto'])){
			$this->validacaoCriptografia();				
		}	
	}
	private function descriptografar($cripto, $chaveCripto){
		$mensagem = $cripto;
		$algoritimo = "AES-256-CBC";
		$chave = $chaveCripto;
		$iv = "wNYtCnelXfOa6uiJ";

		$mensagem = openssl_decrypt(base64_decode($mensagem), $algoritimo, $chave, OPENSSL_RAW_DATA, $iv);
		echo json_encode($mensagem); //já que codificamos a mensagem em base64 foi preciso decodificá-la.
		//saída da função é "meu texto a ser encriptado"
	}
	private function criptografar($cripto, $chaveCripto){
		$string = $cripto;
		$algoritmo = "AES-256-CBC";
		$chave = $chaveCripto;
		$iv = "wNYtCnelXfOa6uiJ";

		$mensagem = openssl_encrypt($string, $algoritmo, $chave, OPENSSL_RAW_DATA, $iv);
		echo json_encode(base64_encode($mensagem));  //codificada em base64 para conseguirmos enviá-la em transtornos.		
	}
	private function validacaoCriptografia(){
		$cripto = $_POST['cripto'] ?? "";
		$chaveCripto = $_POST['chaveCripto'] ?? "";
		$parametroCripto = $_POST['parametroCripto'] ?? "";
		$msg = ($cripto == "") ? $msg = "Digite algo um texto ou palavra!": "";
		$msg = ($msg == "") ? ($chaveCripto == "") ? $msg = "Digite Uma Chave De Criptografia!" : "" : $msg;
		$msg = ($msg == "") ? ($parametroCripto == "") ? $msg = "Erro" : "Todo Ok!" : $msg;
		if($msg == "Todo Ok!"){
			if($parametroCripto === "criptografar"){
				$this->criptografar($cripto, $chaveCripto);
			}elseif($parametroCripto === "descriptografar"){
				$this->descriptografar($cripto, $chaveCripto);
			}else{
				echo json_encode("Erro");
			}
		}else{ echo json_encode($msg); }
	}
}
$encriptador = new Encriptador();