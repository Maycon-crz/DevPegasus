<?php

namespace Source\Controllers\Middlewares;

use Exception;

abstract class MiddlewareAccess{
	private $appKey;
	private $frontEnd;
	private $externalAppKey;
	private $token;
	protected function middleware($genericTools, $view, $authBO, $rota = true) :bool{		
		try{
			$this->frontEnd = isset($_POST['front_end']) ? $genericTools->filter($_POST['front_end']) : "";
			$this->appKey = isset($_POST['app_key']) ? $genericTools->filter($_POST['app_key']) : "";
			$this->externalAppKey = $authBO->getExternalAppKey();
			if($this->frontEnd === "external"){
				if($authBO->checkAuth()){
					if($this->appKey === $this->externalAppKey){
						return true;
					}
				}
				$response["status"] = "error";
				$response["data"] = "Erro de autenticação";
				echo $view->render("api", ["dados" => $response]);
				exit();
			}
			if(!$rota){
				if($this->frontEnd !== "web"){
					$response["status"] = "error";
					$response["data"] = "Erro de autenticação";
					echo $view->render("api", ["dados" => $response]);
					exit();
				}
			}
			if(session_status() === PHP_SESSION_NONE){ session_start(); }
			if(isset($_SESSION['front_end'])){
				if($_SESSION['front_end'] === "web"){
					$this->token = isset($_SESSION['token']) ? $_SESSION['token'] : 0;
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
							if($this->token !== 0){
								return true;
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