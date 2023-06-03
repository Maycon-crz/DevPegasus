<?php

namespace Source\Controllers;

use League\Plates\Engine;
use CoffeeCode\Optimizer\Optimizer;
use Source\Support\Seo;
use Source\Models\User;

class WebController{
	/*@var Engine*/
	private $view;
	/*@var $seo Seo*/
	private $seo;
	/*Web constructor*/
	public function __construct($router){
		$this->view = Engine::create(__DIR__."/../../theme", "php");
		$this->view->addData(["router" => $router]);
		$this->seo = new Seo();
	}
	public function home($data): void{
		$head = $this->seo->render(
			"Home | ".SITE,
			"Ferramentas Grátis para Desenvolvedores, Web Designers, Criadores de Conteúdo e Programadores.",			
			url(),
			/*TODO: Alterar essa URL!*/
			"https://www.recicladarte.com/theme/img/logo_recicladarte_marketing.jpg"
		);
		echo $this->view->render("home", [
			"head" => $head
		]);
	}

	public function contact($data): void{
		$head = $this->seo->render(
			"Contato | ".SITE,
			"Entre em contato com a DevPegasus",
			url("contato"),
			"https://via.placeholder.com/1200x628.png?text=Contato+Recicladarte"
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
			"https://via.placeholder.com/1200x628.png?text=Sobre+RecicladArte"
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
			"https://via.placeholder.com/1200x628.png?text=Sobre+RecicladArte"
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
			"https://via.placeholder.com/1200x628.png?text=Sobre+RecicladArte"
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
			"https://via.placeholder.com/1200x628.png?text=Sobre+RecicladArte"
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
			"https://via.placeholder.com/1200x628.png?text=Sobre+RecicladArte"
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