<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Support\Seo;
use Source\Models\Lib\GenericTools;
use Source\Models\Authentication\Services\AuthBO;
use Source\Controllers\Middlewares\MiddlewareAccess;
use Source\Controllers\Middlewares\MiddlewareForSimpleAccess;
use Source\Models\UserOptions\PostModel;
use Source\Models\UserOptions\DataTransferObjects\PostDTO;

class UserController extends MiddlewareAccess{
	private $view;
	private $seo;
	private $genericTools;
	private $authBO;
	// private $middlewareForSimpleAccess;	
	private $postModel;
	private $postDTO;
	private $response;
	private $isRoute;
	private $title;
	private $page;
	public function __construct($router){
		$this->view = Engine::create(__DIR__."/../../theme", "php");
		$this->view->addData(["router" => $router]);
		$this->seo = new Seo();
		$this->genericTools = new GenericTools();
		$this->authBO = new AuthBO();
		// $this->middlewareForSimpleAccess = new MiddlewareForSimpleAccess();		
		$this->postModel = new PostModel();
		$this->postDTO = new PostDTO();
	}
	public function dashboard($data): void{
		$this->middleware($this->genericTools, $this->view, $this->authBO);
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
	public function post($data){
		$this->isRoute = false;
		$this->middleware($this->genericTools, $this->view, $this->authBO, $this->isRoute);
		switch($data["section"]){
			case "get_posts":
				$this->title = isset($_POST["title"]) ? $this->genericTools->filter($_POST["title"]) : "";
				$this->page = isset($_POST["page"]) ? $this->genericTools->filter($_POST["page"]) : 1;
				$this->response = $this->postModel->getPosts($this->title, $this->page);
			break;
			case "post_registration":
				$this->postDTO->setFrontEnd(isset($_POST["front_end"]) ? $this->genericTools->filter($_POST["front_end"]) : "");
				$this->postDTO->setAuthor(isset($_POST["author"]) ? $this->genericTools->filter($_POST["author"]) : "");
				$this->postDTO->setTitlePost(isset($_POST["title"]) ? $this->genericTools->filter($_POST["title"]) : "");
				$this->postDTO->setDescriptionPost(isset($_POST["descriptions"]) ? $this->genericTools->filter($_POST["descriptions"]) : "");
				$this->postDTO->setImagePost(isset($_FILES['image']) ? $_FILES['image'] : "");
				$this->response = $this->postModel->postRegistration($this->postDTO);				
			break;
			case "post_edition":
				$this->postDTO->setFrontEnd(isset($_POST["front_end"]) ? $this->genericTools->filter($_POST["front_end"]) : "");
				$this->postDTO->setId(isset($_POST["id"]) ? $this->genericTools->filter($_POST["id"]) : "");
				$this->postDTO->setAuthor(isset($_POST["email"]) ? $this->genericTools->filter($_POST["email"]) : "");
				$this->postDTO->setTitlePost(isset($_POST["title"]) ? $this->genericTools->filter($_POST["title"]) : "");
				$this->postDTO->setDescriptionPost(isset($_POST["descriptions"]) ? $this->genericTools->filter($_POST["descriptions"]) : "");
				$this->postDTO->setImagePost(isset($_FILES['image']) ? $_FILES['image'] : "");
				$this->postDTO->setImageNamePost(isset($_POST["image_name_db"]) ? $this->genericTools->filter($_POST["image_name_db"]) : "");
				$this->response = $this->postModel->postEdition($this->postDTO);				
			break;
			case "post_delete":
				$this->postDTO->setFrontEnd(isset($_POST["front_end"]) ? $this->genericTools->filter($_POST["front_end"]) : "");
				$this->postDTO->setId(isset($_POST["id"]) ? $this->genericTools->filter($_POST["id"]) : "");
				$this->postDTO->setAuthor(isset($_POST["email"]) ? $this->genericTools->filter($_POST["email"]) : "");
				$this->postDTO->setImageNamePost(isset($_POST["image_name_db"]) ? $this->genericTools->filter($_POST["image_name_db"]) : "");				
				$this->response = $this->postModel->postDelete($this->postDTO);
			break;
			default:
				$this->response["status"] = "error";
				$this->response["data"] = "error";
		}		
		echo $this->view->render("api", [
			"dados" => $this->response
		]);
	}
}