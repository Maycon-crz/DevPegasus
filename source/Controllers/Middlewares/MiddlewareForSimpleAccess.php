<?php

namespace Source\Controllers\Middlewares;
use Source\Models\Authentication\Services\AuthBO;
use Source\Models\Lib\GenericTools;

use Exception;

class MiddlewareForSimpleAccess{	
	private $appKey;	
	private $frontEnd;
    private $authBO;
    private $genericTools;
	private $appKeySession;
	private $externalAppKey;

    public function __construct(){
        $this->authBO = new AuthBO();
        $this->genericTools = new GenericTools();
    }
	
	public function middleware($view) :bool{		
		try{
			$this->frontEnd = isset($_POST['system']) ? $this->genericTools->filter($_POST['system']) : "";
			$this->appKey = isset($_POST['app_key']) ? $this->genericTools->filter($_POST['app_key']) : "";			
			if($this->frontEnd === "external"){
				if($this->authBO->checkAuth()){
					if($this->appKey === $this->authBO->getExternalAppKey()){
						return true;
					}
				}
				$response["status"] = "error";
				$response["data"] = "Erro de autenticação";
				echo $view->render("api", ["dados" => $response]);
				exit();
			}elseif($this->frontEnd !== "web"){
                $response["status"] = "error";
                $response["data"] = "Erro de autenticação";					
                echo $view->render("api", ["dados" => $response]);
                exit();
            }
			if(session_status() === PHP_SESSION_NONE){ session_start(); }		
			if(isset($_SESSION['appkey'])){
				if($this->appKey === $_SESSION['appkey']){
					return true;
				}
			}            
			
		} catch (Exception $e) {}
		$response["status"] = "error";
        $response["data"] = "Erro de autenticação";					
        echo $view->render("api", ["dados" => $response]);
        exit();
	}
	public function checkAppKey($view) :bool{
		$this->appKey = isset($_POST['app_key']) ? $this->genericTools->filter($_POST['app_key']) : "";
		$this->frontEnd = isset($_POST['front_end']) ? $this->genericTools->filter($_POST['front_end']) : "";
		if($this->frontEnd === "web"){
			if(session_status() === PHP_SESSION_NONE){ session_start(); }
			$this->appKeySession = isset($_SESSION['appkey']) ? $_SESSION['appkey'] : 0;
			if ($this->appKeySession !== 0 && $this->appKey === $this->appKeySession) { return true; }
		}elseif($this->frontEnd === "external"){
			if($this->appKey === $this->authBO->getExternalAppKey()){ return true; }
		}
		$response["status"] = "error";
		$response["data"] = "Erro de autenticação!";
		echo $view->render("api", [
			"dados" => $response
		]);
		exit();
	}
}