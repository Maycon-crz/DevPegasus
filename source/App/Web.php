<?php

namespace Source\App;

use League\Plates\Engine;
// use Source\Models\User;

class Web{

	private $View;

	public function __construct(){
		$this->view = Engine::create(__DIR__."/../../theme", "php");
	}
	public function home($data): void{
		//Usar isso para listar os futuros conteúdos do banco de dados
// 		$users = (new User())->find()->fetch(true);
		//----
		echo $this->view->render("home", [
			"title" => "Home | ".SITE,			
			"description" => "Ferramentas Grátis para Desenvolvedores, Web Designers, Criadores de Conteúdo e Programadores.",
			"subject" => "Desenvolvimento Web, Criação de conteúdos e ferramentas úteis!"
		]);
		?>
		<script src="source/Models/JS/bancoDeTextosAleatorios.js"></script>
		<script src="source/Models/JS/geradorDeTextoAleatorio.js"></script>
		<script src="source/Models/JS/visualizador_de_border_radius.js"></script>
		<?php
	}

	public function contact($data): void{
		echo $this->view->render("contact", [
			"title" => "Contato | ".SITE,
			"description" => "Entre em contato com a DevPegasus",
			"subject" => "Contato DevPegasus"
		]); 
	}

	public function about($data): void{
		echo $this->view->render("about", [
			"title" => "Sobre | ".SITE,
			"description" => "Entendendo um pouco a plataforma DevPegasus",
			"subject" => "Um pouco Sobre a DevPegasus"
		]); 
	}

	public function text($data): void{
		echo $this->view->render("text", [
			"title" => "Ferramentas de Texto | ".SITE,
			"description" => "Ferramentas para Converter Textos, Contar Caracteres, ENCriptador",
			"subject" => "Converter textos e palavras, Conta Palavras e Caracteres, Criptografar E Descriptografar Textos."
		]);
		?>
		<script src="source/Models/JS/contadorDeCaracteres.js"></script>
		<script src="source/Models/JS/Encriptador.js"></script>
		<script src="source/Models/JS/conversorDeTextos.js"></script>
		<?php
	}
	public function tips_knowledge($data): void{
		echo $this->view->render("tips_knowledge", [
			"title" => "Dicas e Conhecimento | ".SITE,
			"description" => "Dicas para encontrar Ferramentas Gratuitas online e offline.",
			"subject" => "Sites, Apps, Programas, Sistemas, Livros e Redes Sociais."
		]);
	}
	public function color_palette($data): void{
		echo $this->view->render("color_palette", [
			"title" => "Palheta de Cores | ".SITE,
			"description" => "Encontre Cores RGB () em Breve Mais Cores e Também Opções Hexadecimal, HSL (), HSV (), HWB (), CMYK ()",
			"subject" => "Ferramenta para Encontrar a Cor Certa"
		]);
		?>
		<script src="source/Models/JS/paletadecorescodigos.js"></script>
		<?php
	}	

	public function error(array $data): void{
		echo $this->view->render("error", [
			"title" => "Error {$data['errcode']} | ".SITE,
			"error" => $data["errcode"],
			"description" => "Erro",
			"subject" => "Erro"
		]); 	
	}
}