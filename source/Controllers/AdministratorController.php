<?php

namespace Source\Controllers;

use League\Plates\Engine;
use CoffeeCode\Optimizer\Optimizer;
use Source\Support\Seo;
use Source\Models\UserOptions\Administrator\ContentGeneratorModel;

class AdministratorController{
	/*@var Engine*/
	private $view;
	/*@var $seo Seo*/
	private $seo;
	private $response = array();
	private $contentGeneratorModel;
	public function __construct($router){
		$this->view = Engine::create(__DIR__."/../../theme", "php");
		$this->view->addData(["router" => $router]);
		$this->seo = new Seo();
		$this->contentGeneratorModel = new ContentGeneratorModel();
	}
	public function luanaIA($data): void{
        
		$head = $this->seo->render(
			"Luana IA | ".SITE,
			"Inteligênci artificial Luana",
			url(),
			/*TODO: Alterar essa URL!*/
			"https://www.recicladarte.com/theme/img/logo_recicladarte_marketing.jpg"
		);
		echo $this->view->render("luana", [
			"head" => $head
		]);
	}
	public function luanaAPI($data){
		switch($data["section"]){
			case "title_generator_openai_gpt_rapidapi":
				$this->response = $this->contentGeneratorModel->titleGeneratorOpenaiGPTRapidapi();
			break;
			case "title_generator_nlp_cloud_api":				
				/* Esta plataforma funciona a requisição a API gratuitamente 
				porém é muito limitado as requisições; */
				$this->response = $this->contentGeneratorModel->titleGeneratorNLPCloudNLPCloudAPI();
			break;			
		}
		
		echo $this->view->render("api", [
			"dados" => $this->response
		]);
	}
}