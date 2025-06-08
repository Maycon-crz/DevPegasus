<?php

namespace Source\Controllers;

use League\Plates\Engine;
use CoffeeCode\Optimizer\Optimizer;
use Source\Support\Seo;
use Source\Models\UserOptions\PostModel;
use Source\Models\FeedRSS\FeedRssModel;

class WebController{
	/*@var Engine*/
	private $view;
	/*@var $seo Seo*/
	private $seo;
	/* --- */
	private $postModel;
	private $response = array();
	private $feedRssModel;
	/*Web constructor*/
	public function __construct($router){
		$this->view = Engine::create(__DIR__."/../../theme", "php");
		$this->view->addData(["router" => $router]);
		$this->seo = new Seo();
		$this->postModel = new PostModel();
		$this->feedRssModel = new FeedRssModel();
	}
	public function home($data): void{
		$this->response = $this->postModel->getPosts("", 1);
		$head = $this->seo->render(
			"Home | ".SITE,
			"Ferramentas Grátis para Desenvolvedores, Web Designers, Criadores de Conteúdo e Programadores.",			
			url(),
			/*TODO: Alterar essa URL!*/
			"https://via.placeholder.com/1200x628.png?text=Contato+DevPegasus"
		);
		echo $this->view->render("home", [
			"head" => $head,
			"posts" => $this->response
		]);
	}

	public function contact($data): void{
		$head = $this->seo->render(
			"Contato | ".SITE,
			"Entre em contato com a DevPegasus",
			url("contato"),
			"https://via.placeholder.com/1200x628.png?text=Contato+DevPegasus"
		);

		echo $this->view->render("contact", [
			"head" => $head,
		]);
	}
	public function about($data): void{
		$head = $this->seo->render(
			"Sobre | ".SITE,
			"Sobre a plataforma DevPegasus",
			url("sobre"),
			"https://via.placeholder.com/1200x628.png?text=Sobre+DevPegasus"
		);

		echo $this->view->render("about", [
			"head" => $head,
		]); 
	}
	public function text($data): void{
		$head = $this->seo->render(
			"Ferramentas de Texto | ".SITE,
			"Ferramentas para Converter Textos, Contar Caracteres, ENCriptador.",
			url("texto"),
			"https://via.placeholder.com/1200x628.png?text=Sobre+DevPegasus"
		);

		echo $this->view->render("text", [
			"head" => $head,
		]);
	}
	public function tips_knowledge($data): void{/*TODO: Por em camel case*/
		$head = $this->seo->render(
			"Dicas e Conhecimento | ".SITE,
			"Dicas para encontrar Ferramentas Gratuitas online e offline.",
			url("tips_knowledge"),
			"https://via.placeholder.com/1200x628.png?text=Sobre+DevPegasus"
		);

		echo $this->view->render("tips_knowledge", [
			"head" => $head,
		]);
	}
	public function color_palette($data): void{/*TODO: Por em camel case*/
		$head = $this->seo->render(
			"Palheta de Cores | ".SITE,
			"Encontre Cores RGB () em Breve Mais Cores e Também Opções Hexadecimal, HSL (), HSV (), HWB (), CMYK ()",
			url("color_palette"),
			"https://via.placeholder.com/1200x628.png?text=Sobre+DevPegasus"
		);

		echo $this->view->render("color_palette", [
			"head" => $head,
		]);
	}
	public function contentGenerator($data): void{
		$head = $this->seo->render(
			"Gerador de conteúdo | ".SITE,
			"Gerador de conteúdo",
			url("gerador_de_conteudo"),
			"https://via.placeholder.com/1200x628.png?text=Sobre+DevPegasus"
		);
		echo $this->view->render("content_generator", [
			"head" => $head,
		]);
	}
	
	public function politics($data): void{
		$head = $this->seo->render(
			"Politica de Privacidade | ".SITE,
			"Política de Privacidade",
			url("politica"),
			"https://via.placeholder.com/1200x628.png?text=Politica+Cine_7D"
		);

		echo $this->view->render("politics", [
			"head" => $head,
		]);
	}
	public function curriculumGenerator(): void{
		$head = $this->seo->render(
			"Gerador de currículo | ".SITE,
			"Crie seu currículo profissional de forma rápida e fácil na nossa plataforma. Destaque suas habilidades e conquiste oportunidades!",
			url("curriculum_generator"),
			"https://via.placeholder.com/1200x628.png?text=Gerador+de+Curriculo"
		);
		echo $this->view->render("curriculum_generator", [
			"head" => $head,
		]);
	}
	public function developmentService(){
		$head = $this->seo->render(
			"Serviço de Desenvolvimento de Sistemas | ".SITE,
			"Transforme ideias em soluções digitais com nossos serviços de desenvolvimento de software. Da web ao mobile, criamos tecnologia que impulsiona seu sucesso.",
			url("development_service"),
			"https://www.devpegasus.com/theme/assets/img/desenvolvimento_de_sistemas.png"
		);
		echo $this->view->render("development_service", [
			"head" => $head,
		]);
	}
	public function portfolio($data){
		// $this->response["tab_description"] = "";
		// $this->response["description"] = "";
		$this->response["url"] = "error";
		switch($data["section"]){
			case "projeto_floricultura":
				// $this->response["tab_description"] = "Projeto Floricultura";
				// $this->response["description"] = "Modelo de site para Floricultira";
				$this->response["url"] = "portfolio_floriculture";
			break;
			case "projeto_painel_solar":
				// $this->response["tab_description"] = "Projeto Painel solar";
				// $this->response["description"] = "Modelo de site para Empresa de Painel solar";
				$this->response["url"] = "portfolio_solar_panel";
			break;
			case "projeto_peixaria":
				// $this->response["tab_description"] = "Projeto Peixaria";
				// $this->response["description"] = "Modelo de site para Peixaria";
				$this->response["url"] = "portfolio_fish_shop";
			break;
		}
		echo $this->view->render("portfolio/".$this->response["url"], [
			// "head" => $head,
		]);
	}
	public function feed($data): void{
		$head = $this->seo->render(
			"Feed | ".SITE,
			"Feed de conteúdo",
			url("feed"),
			"https://via.placeholder.com/1200x628.png?text=FeedRSS+DevPegasus"
		);
		$this->response = $this->feedRssModel->renderRss(url());
		echo $this->view->render("feed", [
			"data" => $this->response
		]);
	}
	public function error(array $data): void{
		$head = $this->seo->render(
			"Error {$data['errcode']} | ".SITE,
			/*TODO: Alterar e por o E-mail de contato do cliente*/
			"Aconteceu algum erro no site entre en contato: ",
			url("ops/{$data['errcode']}"),
			"https://via.placeholder.com/1200x628.png?text=Erro+{$data['errcode']}"
		);

		echo $this->view->render("error", [
			"head" => $head,
			"error" => $data["errcode"]
		]); 	
	}
}