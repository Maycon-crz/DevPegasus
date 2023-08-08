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
use Source\Models\UserOptions\DataTransferObjects\CurriculumDTO;
use stdClass;

class UserController extends MiddlewareAccess{
	private $view;
	private $seo;
	private $genericTools;
	private $authBO;
	// private $middlewareForSimpleAccess;	
	private $postModel;
	private $postDTO;
	private $curriculumDTO;
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
	public function curriculumGeneratorController(){
		$this->curriculumDTO = new CurriculumDTO();
		$this->curriculumDTO->nomeCompleto = isset($_POST["nomeCompleto"]) ? $this->genericTools->filter($_POST["nomeCompleto"]) : "";
		$this->curriculumDTO->nacionalidade = isset($_POST["nacionalidade"]) ? $this->genericTools->filter($_POST["nacionalidade"]) : "";
		$this->curriculumDTO->sexo = isset($_POST["sexo"]) ? $this->genericTools->filter($_POST["sexo"]) : "";
		$this->curriculumDTO->idade = isset($_POST["idade"]) ? $this->genericTools->filter($_POST["idade"]) : "";
		$this->curriculumDTO->estadoCivil = isset($_POST["estadoCivil"]) ? $this->genericTools->filter($_POST["estadoCivil"]) : "";
		$this->curriculumDTO->temFilhos = isset($_POST["temFilhos"]) ? $this->genericTools->filter($_POST["temFilhos"]) : "";
		$this->curriculumDTO->estado = isset($_POST["estado"]) ? $this->genericTools->filter($_POST["estado"]) : "";
		$this->curriculumDTO->cidade = isset($_POST["cidade"]) ? $this->genericTools->filter($_POST["cidade"]) : "";
		$this->curriculumDTO->endereco = isset($_POST["endereco"]) ? $this->genericTools->filter($_POST["endereco"]) : "";
		$this->curriculumDTO->email = isset($_POST["email"]) ? $this->genericTools->filter($_POST["email"]) : "";
		$this->curriculumDTO->telefone1 = isset($_POST["telefone1"]) ? $this->genericTools->filter($_POST["telefone1"]) : "";
		$this->curriculumDTO->telefone2 = isset($_POST["telefone2"]) ? $this->genericTools->filter($_POST["telefone2"]) : "";
		$this->curriculumDTO->linkedin = isset($_POST["linkedin"]) ? $this->genericTools->filter($_POST["linkedin"]) : "";
		$this->curriculumDTO->instagram = isset($_POST["instagram"]) ? $this->genericTools->filter($_POST["instagram"]) : "";
		$this->curriculumDTO->github = isset($_POST["github"]) ? $this->genericTools->filter($_POST["github"]) : "";
		$this->curriculumDTO->objetivoProfissional = isset($_POST["objetivoProfissional"]) ? $this->genericTools->filter($_POST["objetivoProfissional"]) : "";

		/*Capturando os dados dos cursos*/
		$qtdCourses = isset($_POST["qtdCourses"]) ? intval($_POST["qtdCourses"]) : 0;
		for ($i = 0; $i <= $qtdCourses; $i++) {
			$course = new stdClass();
			$course->curso = isset($_POST["curso{$i}"]) ? $this->genericTools->filter($_POST["curso{$i}"]) : "";
			$course->instituicao = isset($_POST["instituicao{$i}"]) ? $this->genericTools->filter($_POST["instituicao{$i}"]) : "";
			$course->conclusaoCurso = isset($_POST["conclusaoCurso{$i}"]) ? $this->genericTools->filter($_POST["conclusaoCurso{$i}"]) : "";
			$course->anoDeConclusaoCurso = isset($_POST["anoDeConclusaoCurso{$i}"]) ? $this->genericTools->filter($_POST["anoDeConclusaoCurso{$i}"]) : "";
			$this->curriculumDTO->courses[] = $course;
		}

		/*Capturando os dados de experiência profissional*/
		$counter = 0;
		while (isset($_POST["empresa{$counter}"])) {
			$experience = new stdClass();
			$experience->empresa = $this->genericTools->filter($_POST["empresa{$counter}"]);
			$experience->anoDeEntrada = $this->genericTools->filter($_POST["anoDeEntrada{$counter}"]);
			$experience->anoDeSaida = $this->genericTools->filter($_POST["anoDeSaida{$counter}"]);
			$experience->cargo = $this->genericTools->filter($_POST["cargo{$counter}"]);
			$experience->principaisAtividades = $this->genericTools->filter($_POST["principaisAtividades{$counter}"]);
			$this->curriculumDTO->professionalExperiences[] = $experience;

			$counter++;
		}

		/*Capturando as qualificações e atividades complementares*/
		$counter = 0;
		while (isset($_POST["qualificacoes{$counter}"])) {
			$this->curriculumDTO->qualificacoes[] = $this->genericTools->filter($_POST["qualificacoes{$counter}"]);
			$counter++;
		}

		/*Capturando as informações adicionais*/
		$counter = 0;
		while (isset($_POST["informacoesAdicionais{$counter}"])) {
			$this->curriculumDTO->informacoesAdicionais[] = $this->genericTools->filter($_POST["informacoesAdicionais{$counter}"]);
			$counter++;
		}
		
		echo $this->view->render("api", [
			"dados" => $this->curriculumDTO->toArray()
		]);
	}
}