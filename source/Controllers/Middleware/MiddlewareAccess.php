<?php

namespace Source\Controllers\Middleware;

use Exception;

abstract class MiddlewareAccess{	
	private $appKey;
	private $appKeySession;
	private $system;
	private $externalAppKey;
	private $token;
	private $hierarchy;
	protected function middleware($pageAccessLevel, $genericTools, $view, $auth, $rota = true) :bool{		
		try{
			$this->system = isset($_POST['system']) ? $genericTools->filtrando($_POST['system']) : "";
			$this->appKey = isset($_POST['app_key']) ? $genericTools->filtrando($_POST['app_key']) : "";
			$this->externalAppKey = $auth->getExternalAppKey();
			if($this->system === "external"){
				// if($auth->checkAuth()){ //Descomentar quando o login for criado!
					$this->hierarchy = isset($_POST['hierarchy']) ? $genericTools->filtrando($_POST['hierarchy']) : "";
					if($this->appKey === $this->externalAppKey){
						if(intval($pageAccessLevel) === intval($this->hierarchy)){ return true; }
					}
				// }
				$response["status"] = "error";
				$response["data"] = "Erro de autenticação";
				echo $view->render("api", ["dados" => $response]);
				exit();
			}
			if(!$rota){
				if($this->system !== "web"){
					$response["status"] = "error";
					$response["data"] = "Erro de autenticação";
					echo $view->render("api", ["dados" => $response]);
					exit();
				}
			}
			if(session_status() === PHP_SESSION_NONE){ session_start(); }
			if(isset($_SESSION['system'])){
				if($_SESSION['system'] === "web"){
					$this->token = isset($_SESSION['token']) ? $_SESSION['token'] : 0;
					$this->hierarchy = isset($_SESSION['hierarchy']) ? $_SESSION['hierarchy'] : 0;
					if(!$rota){
						/*Se não for rota ou seja um cadastro por exemplo entra aqui*/
						if($this->appKey !== $_SESSION['appkey']){
							/*Quando não é rota a requisição tem que ter uma app_key se não entra aqui*/
							header("Location: ".url());
							exit();
						}
					}
					if(isset($_SESSION['app_key_login'])){
						if($_SESSION['app_key_login'] === $this->externalAppKey){
							if($this->token !== 0 && $this->hierarchy !== 0){
								if(intval($pageAccessLevel) === intval($this->hierarchy)){
									return true; 
								}
							}
						}
					}
				}
			}			
		} catch (Exception $e) {}		
		header("Location: ".url());
		exit();
	}
}