<?php

namespace Source\Controllers\Middleware;
use Source\Models\Authentication\Auth;
use Source\Models\Lib\GenericTools;

use Exception;

class MiddlewareForSimpleAccess{	
	private $appKey;	
	private $system;
    private $auth;
    private $genericTools;

    public function __construct(){
        $this->auth = new Auth();
        $this->genericTools = new GenericTools();
    }
	
	public function middleware($view) :bool{		
		try{
			$this->system = isset($_POST['system']) ? $this->genericTools->filtrando($_POST['system']) : "";
			$this->appKey = isset($_POST['app_key']) ? $this->genericTools->filtrando($_POST['app_key']) : "";			
			if($this->system === "external"){
				if($this->auth->checkAuth()){
					if($this->appKey === $this->auth->getExternalAppKey()){
						return true;
					}
				}
				$response["status"] = "error";
				$response["data"] = "Erro de autenticação";
				echo $view->render("api", ["dados" => $response]);
				exit();
			}elseif($this->system !== "web"){
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
}