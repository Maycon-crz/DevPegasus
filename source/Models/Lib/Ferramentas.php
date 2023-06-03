<?php
    namespace Source\Models\Lib;
    
    use Source\Models\Lib\Conn;
    
    use \PDO;
    use PDOException;
    
    //outras Exceptions
    use Exception;
    use InvalidArgumentException;
    
	class Ferramentas{
	    private static $con;
	    public function __construct(){
	        self::$con = (new Conn())->getConn();
	    }
	    public function filtrando($dados){
			$dados = trim($dados);
			$dados = htmlspecialchars($dados);			
			$dados = addslashes($dados);
			return $dados;
		}
    	public function verificaSeEmailExiste($email){
    		$sqlverificaEmail = "SELECT * FROM usuarios WHERE email=:email LIMIT 1";
    		$verificaEmail = self::$con->prepare($sqlverificaEmail);
    		$verificaEmail->bindParam(':email', $email);			
    		if($verificaEmail->execute()){
    			$result = $verificaEmail->fetchAll(PDO::FETCH_ASSOC);
    			$retornado["id"] 		= "";
    			$retornado["msg"] 		= ""; 
    			$retornado["email"] 	= ""; 
    			$retornado["senha"] 	= "";
    			$retornado["nome"] 		= "";
    			$retornado["sobrenome"] = "";
    			$retornado["qtd_acessos"] = "";
    			$retornado["nivel"]		= 0;
    			foreach($result as $retorno){
    				$retornado["id"]		= $retorno["id"];
    				$retornado["email"] 	= $retorno["email"];
    				$retornado["senha"] 	= $retorno["senha"];
    				$retornado["nome"] 		= $retorno["nome"];
    				$retornado["sobrenome"] = $retorno["sobrenome"];
    				$retornado["qtd_acessos"] = $retorno["qtd_acessos"];
    				$retornado["nivel"]		= $retorno["nivel"];
    			}
    			if($retornado["email"] == ""){ $retornado["msg"] = "Erro"; }
    		}else{ $retornado["msg"] = "Erro"; }
    		return $retornado;			
    	}
    	public function verificaSeExisteTituloDoPostDB($titulopost){
			$sqlVerificaTituloPost = "SELECT titulo FROM posts WHERE titulo=:titulo";
			$verificaTituloPost = self::$con->prepare($sqlVerificaTituloPost);
			$verificaTituloPost->bindParam(":titulo", $titulopost);
			if($verificaTituloPost->execute()){
				$verificaTitulo = $verificaTituloPost->fetchAll(PDO::FETCH_ASSOC);
				$tituloRetornado = "";
				foreach($verificaTitulo as $verificaTP){
					$tituloRetornado = $verificaTP['titulo'];
				}
				if($tituloRetornado === ""){
					return "Pode";
				}else{ return "Este título já está cadastrado"; }
			}else{ return "Erro"; }
		}
		public function verificaTamanhoTipoImagem($imagem){
			$imagem = $imagem['name'] ?? "";
			$formatosPermitidos = array("png", "PNG", "jpeg", "JPEG", "jpg", "JPG");
			$extensaoprod = pathinfo($imagem, PATHINFO_EXTENSION);					
			if(in_array($extensaoprod, $formatosPermitidos)){
				if(1024*1024*100 < $imagem){
					return "Imagem muito grande!";					
				}else{ return "Imagem aceita"; }
			}else{ return "Arquivo não é uma imagem"; }	
		}
		public function validateEmail($email) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $email;
            }else { return ""; }
        }
	}
?>