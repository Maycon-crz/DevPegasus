<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Support\Seo;
use Source\Models\Lib\GenericTools;
use Source\Models\Authentication\Services\AuthBO;
use Source\Controllers\Middlewares\MiddlewareAccess;

class UserController extends MiddlewareAccess{
	private $view;
	private $seo;
	private $genericTools;
	private $authBO;	

	public function __construct($router){
		$this->view = Engine::create(__DIR__."/../../theme", "php");
		$this->view->addData(["router" => $router]);
		$this->seo = new Seo();
		$this->genericTools = new GenericTools();
		$this->authBO = new AuthBO();
	}
	
	public function dashboard($data): void{
		// $this->middleware($this->genericTools, $this->view, $this->authBO);
		$head = $this->seo->render(
			"Painel | ".SITE,
			"Pinel do usuário",
			url(),
			"https://via.placeholder.com/1200x628.png?text=modelo"
		);
		echo $this->view->render("user", [
			"head" => $head,
		]);
	}
}