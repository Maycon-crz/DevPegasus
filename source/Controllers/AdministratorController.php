<?php

namespace Source\Controllers;

use League\Plates\Engine;
use CoffeeCode\Optimizer\Optimizer;
use Source\Models\Authentication\Auth;
use Source\Models\Lib\GenericTools;
use Source\Controllers\Middleware\MiddlewareAccess;
use Source\Support\Seo;
use Source\Models\UserOptions\Administrator\ContentGeneratorModel;

class AdministratorController extends MiddlewareAccess{
	/*@var Engine*/
	private $view;
	/*@var $seo Seo*/
	private $seo;
	private $response = array();
	private $genericTools;
	private $auth;
	private $pageAccessLevel = 3;
	private $isRoute;
	private $subject;
	private $keywords;
	private $contentGeneratorModel;	
	public function __construct($router){
		$this->view = Engine::create(__DIR__."/../../theme", "php");
		$this->view->addData(["router" => $router]);
		$this->seo = new Seo();
		$this->auth = new Auth();
		$this->genericTools = new GenericTools();
		$this->contentGeneratorModel = new ContentGeneratorModel();
	}
	public function luanaIA($data): void{
        // $this->middleware($this->pageAccessLevel, $this->genericTools, $this->view, $this->auth, false);
		$head = $this->seo->render(
			"Luana IA | ".SITE,
			"Inteligência artificial Luana",
			url(),
			/*TODO: Alterar essa URL!*/
			"https://www.recicladarte.com/theme/img/logo_recicladarte_marketing.jpg"
		);
		echo $this->view->render("luana", [
			"head" => $head
		]);
	}
	public function luanaAPI($data){
		$this->middleware($this->pageAccessLevel, $this->genericTools, $this->view, $this->auth, false);
		/*QUANDO por login descomentar 2 nível de acesso no middleware*/
		switch($data["section"]){
			case "title_generator_openai_gpt_rapidapi":
				/*
				Dados de acesso:
				app_key=xZy6U/ttRcevPu9bwHqOy3j0se+sj3KONu/bEMgL5IlXT3f/i9Q7kEX5IDj22nNIoKX+1+mQF0dyCYKA8v5SjoDKnkG1d8pLa7YUx7NKeJXMVaoVdUjNFeRIbSHeLlIdiw/8jQj2tvQ1de59yYZ8W44RdtKt7P9JVgFqqrQPzy/K2RD9UhtTpz7JLhw6mxENHQcW/2TcbNJkg9w6IV3HMyLz8aozgzCMhnlqSWbjttsqUOisDV38CANveNkKRjjxNqLRfhlDdYn0cOU26xXv1w==
				system=external
				hierarchy=3
				subject=Sustentabilidade
				keywords=Reciclagem, Meio ambiente
				*/
				$this->subject = isset($_POST["subject"]) ? $this->genericTools->filtrando($_POST["subject"]) : "";
				$this->keywords = isset($_POST["keywords"]) ? $this->genericTools->filtrando($_POST["keywords"]) : "";				
				if($this->subject != "" && $this->keywords != ""){
					$this->response = $this->contentGeneratorModel->titleGeneratorOpenaiGPTRapidapi($this->subject, $this->keywords);
				}else{
					$this->response["status"] = "error";
					$this->response["data"] = "Faltou informar assunto ou palavras chave";
				}

				// $this->response = $this->contentGeneratorModel->imageGeneratorProdia();
				// $this->response = $this->contentGeneratorModel->getURLImageGeneratorProdia("0f35090a-c6f5-4156-831b-fcc548a9ad7e");
				// $this->response = $this->contentGeneratorModel->imageSearchPexels();
				// $this->response = $this->contentGeneratorModel->websearchRapidapi();
			break;
			case "title_generator_nlp_cloud_api":
				/* Esta plataforma funciona a requisição a API gratuitamente 
				porém é muito limitado as requisições; */
				// $this->response = $this->contentGeneratorModel->titleGeneratorNLPCloudNLPCloudAPI();
			break;			
		}
		
		echo $this->view->render("api", [
			"dados" => $this->response
		]);
	}
}