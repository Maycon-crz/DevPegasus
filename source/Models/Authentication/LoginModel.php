<?php

namespace Source\Models\Authentication;
use Source\Models\Lib\Connection;
use Source\Models\Lib\GenericTools;
use Source\Models\Authentication\Services\AuthBO;
use Source\Models\Authentication\DataTransferObjects\LoginDTO;

use \PDO;
use PDOException;
//outras Exceptions
use Exception;
use InvalidArgumentException;

class LoginModel extends Connection{
    private static $con;
    private $genericTools;
    private $authBO;
    private $msg;
    private $response = array();
    private $data = array();
    private $result = array();
    public function __construct(){
        self::$con = $this->getConn();
        $this->genericTools = new GenericTools();
        $this->authBO = new AuthBO();
    }
    public function loginValidation(LoginDTO $loginDTO): array{
		/* Login Validation */		
		$this->msg = ($loginDTO->getEmail() == "") ? "Informe seu E-mail!": "";
		$this->msg = ($this->msg == "") ? $this->msg = ($loginDTO->getPassword() == "") ? "Informe sua senha!" : "": $this->msg;
		$this->response["status"] = "error";
		if($this->msg === ""){
			$loginDTO->setEmail(filter_var($loginDTO->getEmail(), FILTER_SANITIZE_EMAIL));
			if(filter_var($loginDTO->getEmail(), FILTER_VALIDATE_EMAIL)){                
				$countPass = strlen($loginDTO->getPassword());
				if($countPass >=8){
					$this->data = $this->checkIfTheEmailExists($loginDTO->getEmail(), true);//Reescrever essa função novo model                    
					if($this->data["status"] === "success"){
                        $this->data["status"] = "error";
						if($this->data["data"][0]["status_user"] !== "inactive"){
                            if(password_verify($loginDTO->getPassword(), $this->data["data"][0]["pass"])){
                                $this->response = $this->loginRepository($loginDTO);
                            }else{
                                $this->response["status"] = "error";
                                $this->response["data"] = "Senha ou E-mail inválidos! 1";
                            }
						}else{ $this->response["data"] = "Senha ou E-mail inválidos ou usuário desativado!"; }
					}else{ $this->response["data"] = "Senha ou E-mail inválidos! 2"; }
				}else{ $this->response["data"] ="Senha ou E-mail inválidos 3"; }
			}else{ $this->response["data"] = "Senha ou E-mail inválidos! 4"; }
		}else{ $this->response["data"] = $this->msg; }
		return $this->response;
	}
    public function checkIfTheEmailExists(string $email, bool $turnBack){
        /*TODO:Essa função será usada em mais lugares, por isso não implementei as sessions aqui*/
        try{
            $email = $this->genericTools->filter($email);
            if($turnBack === false){
                $sql = "SELECT email FROM users WHERE email=:email LIMIT 1";
                $stmt = self::$con->prepare($sql);
                $stmt->bindParam(':email', $email);
                if($stmt->execute()){
                    $this->response["status"] = "success";
                    $this->response["data"] = $stmt->rowCount();
                    return $this->response;
                }
                $this->response["status"] = "error";
                $this->response["data"] = "Error in query";
                return $this->response;
            }
            $stmt = "SELECT id, full_name, email, hierarchy, pass, phone, status_user FROM users WHERE email=:email LIMIT 1";
            $stmt = self::$con->prepare($stmt);
            $stmt->bindParam(':email', $email);
            if($stmt->execute()){
                if($stmt->rowCount() === 1){
                    $this->result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $this->response["status"] = "success";
                    $this->response["data"] = $this->result;
                    
                    return $this->response;
                }
                $this->response["status"] = "error";
                $this->response["data"] = "Not registered";
                return $this->response;
            }
            $this->response["status"] = "error"; 
            $this->response["data"] = "Error in query"; 				
            return $this->response;
        }catch (Exception $e) {
            $this->response["status"] = "error";
            $this->response["data"] = "Error in email verification";
            return $this->response;
        }
    }
    private function loginRepository(LoginDTO $loginDTO) :array{
        $this->data["data"][0]["token"] = $this->authBO->getGenerateToken($loginDTO->getEmail());
        $this->data["data"][0]["app_key"] = $this->authBO->getExternalAppKey();
        /*Persiste e retorna os dados*/
        try{
            if($loginDTO->getFrontEnd() === "web"){
                if(session_status() === PHP_SESSION_NONE){ session_start(); }                            
                /*Completando o DTO*/
                $loginDTO->setID($this->data["data"][0]["id"]);
                $loginDTO->setFullName($this->data["data"][0]["full_name"]);
                $loginDTO->setEmail($this->data["data"][0]["email"]);
                $loginDTO->setToken($this->data["data"][0]["token"]);
                $loginDTO->setAppKey($this->data["data"][0]["app_key"]);
                $loginDTO->setHierarchy($this->data["data"][0]["hierarchy"]);
                $loginDTO->setPhone($this->data["data"][0]["phone"]);
                $loginDTO->setStatusUser($this->data["data"][0]["status_user"]);
                /*Atribuindo os dados as sessões*/
                $_SESSION['full_name'] = $loginDTO->getFullName();
                $_SESSION['email'] = $loginDTO->getEmail();
                $_SESSION['token'] = $loginDTO->getToken();
                $_SESSION['app_key_login'] = $loginDTO->getAppKey();
                $_SESSION['hierarchy'] = $loginDTO->getHierarchy();
                $_SESSION["front_end"] = $loginDTO->getFrontEnd();
                $_SESSION["phone"] = $loginDTO->getPhone();
                $_SESSION["status_user"] = $loginDTO->getStatusUser();
                /*---*/
                $this->response["status"] = "success";
                /*$this->response["data"] = $loginDTO->toArray();*/
                $this->response["data"] = "Sessão iniciada!";
                return $this->response;
            }if($loginDTO->getFrontEnd() === "external"){
                $this->response["status"] = "success";
                $this->response["data"]["token"] = $loginDTO->getToken();
                $this->response["data"]["app_key"] = $loginDTO->getAppKey();
                $this->response["data"]["email"] = $loginDTO->getEmail();
                $this->response["data"]["hierarchy"] = $loginDTO->getHierarchy();
                return $this->response;
            }
            $this->addingAmountOfAccess($loginDTO->getID());
        }catch (Exception $e) {
            $this->response["status"] = "error";
            $this->response["data"] = "Erro no servidor!";
            return $this->response;
        }
    }
    private function addingAmountOfAccess($idDB){
        try{
            $sql = "UPDATE users SET qtd_accesses=qtd_accesses+1 WHERE id=:idDB";
            $sql = self::$con->prepare($sql);
            $sql->bindParam(':idDB', $idDB);
            $sql->execute();
        }catch (Exception $e) {}
    }
    public function logOut(){
        try{
            if(session_status() === PHP_SESSION_NONE){ session_start(); }
            unset($_SESSION['full_name']);
            unset($_SESSION['email']);
            unset($_SESSION['token']);
            unset($_SESSION['app_key_login']);
            unset($_SESSION['hierarchy']);
            unset($_SESSION['front_end']);

            session_destroy();        
            $this->response["status"] = "success";
            $this->response["data"] = 1;
            return $this->response;
        }catch (Exception $e) {
            return [];
        }
    }
}