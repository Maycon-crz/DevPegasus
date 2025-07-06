<?php

namespace Source\Controllers;

use League\Plates\Engine;
use CoffeeCode\Optimizer\Optimizer;
use Source\Models\Authentication\Services\AuthBO;
use Source\Models\Lib\GenericTools;
use Source\Controllers\Middlewares\MiddlewareAccess;
use Source\Support\Seo;
use Source\Models\UserOptions\Administrator\ContentGeneratorModel;

class AdministratorController extends MiddlewareAccess{
	/*@var Engine*/
	private $view;
	/*@var $seo Seo*/
	private $seo;
	private $response = array();
	private $genericTools;
	private $authBO;
	private $pageAccessLevel = 3;
	private $isRoute;
	private $subject;
	private $keywords;
	private $contentGeneratorModel;
	public function __construct($router){
		$this->view = Engine::create(__DIR__."/../../theme", "php");
		$this->view->addData(["router" => $router]);
		$this->seo = new Seo();
		$this->authBO = new AuthBO();
		$this->genericTools = new GenericTools();
		$this->contentGeneratorModel = new ContentGeneratorModel();
	}
	
}