<?php

namespace Source\Models\UserOptions;

use Source\Models\Lib\GenericTools;
use CoffeeCode\Cropper\Cropper;
use Source\Models\Lib\Connection;
use Source\Models\UserOptions\DataTransferObjects\PostDTO;
use Source\Models\UserOptions\Services\PostBO;

use \PDO;
use PDOException;

class PostModel extends Connection{
	private static $con;
	private $genericTools;
	private $postBO;
    private $response = array();
	private $data = array();
	private $result  = array();
	private $msg;
	private $stmt;
	private $limitForPage;
	private $total;
	// private $totalPages;
	private $offset;
	private $todayFormat;
	private $contador;
	private $formattedDate;	
    public function __construct(){
		$this->postBO = new PostBO();
		self::$con = $this->getConn();
		$this->genericTools = new GenericTools();
	}
    public function getPosts($title, $page): array{
		if(empty($title) && !empty($page)){
            /*Retornar posts com paginação*/
            $this->limitForPage = 3;
            /*Get the total number of records*/
            $this->total = self::$con->query('SELECT COUNT(*) FROM posts')->fetchColumn();
            /*Calcular o número total de páginas*/
            // $this->totalPages = ceil($this->total / $this->limitForPage);
            /*Calcular o registro inicial a ser exibido*/
            $this->offset = ($page - 1) * $this->limitForPage;
            $this->stmt = "SELECT id, author, title, descriptions, `image`, `like`, `dislike`, registration_date FROM posts ORDER BY id DESC LIMIT :qtd OFFSET :offset";
            $this->stmt = self::$con->prepare($this->stmt);
            $this->stmt->bindValue(':qtd', $this->limitForPage, PDO::PARAM_INT);
            $this->stmt->bindValue(':offset', $this->offset, PDO::PARAM_INT);
        }else{
            /*Retorna uma busca com postagens contendo o título informado*/
            $this->stmt = "SELECT id, author, title, descriptions, `image`, `like`, `dislike`, registration_date FROM posts WHERE title LIKE :title ORDER BY id DESC";
            $this->stmt = self::$con->prepare($this->stmt);
            $title = "%".$title."%";
            $this->stmt->bindParam(":title", $title);
        }
        if($this->stmt->execute()){
            $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);            
            $this->response["status"] = "success";
            $this->response["data"] = array();
            $this->todayFormat = date('Y-m-d');
            $this->contador=0;
            foreach( $this->result as $this->result){
                $this->response["data"][$this->contador]["id"] = isset($this->result["id"]) ? $this->result["id"] : null;
                $this->response["data"][$this->contador]["author"] = isset($this->result["author"]) ? $this->result["author"] : "";
                $this->response["data"][$this->contador]["title"] = isset($this->result["title"]) ? $this->result["title"] : "";
                $this->response["data"][$this->contador]["descriptions"] = isset($this->result["descriptions"]) ? $this->result["descriptions"] : "";
                $this->response["data"][$this->contador]["image"] = isset($this->result["image"]) ? $this->result["image"] : "";
                $this->response["data"][$this->contador]["like"] = isset($this->result["like"]) ? $this->result["like"] : 0;
                $this->response["data"][$this->contador]["dislike"] = isset($this->result["dislike"]) ? $this->result["dislike"] : 0;
                if(isset($this->result["registration_date"])){
                    $this->formattedDate = date('Y-m-d H:i:s', strtotime($this->result["registration_date"]));
                    $this->response["data"][$this->contador]["registration_date"] = isset($this->result["registration_date"]) ? $this->result["registration_date"] : "";
                    if (substr($this->formattedDate, 0, 10) == $this->todayFormat) {
                        $this->response["data"][$this->contador]["registration_date"] = "Hoje às " . date('H:i', strtotime($this->result["registration_date"]));
                    } else { $this->response["data"][$this->contador]["registration_date"] = date('d/m/Y H:i:s', strtotime($this->result["registration_date"])); }
                }
                $this->contador++;
            }
        } else {
            $this->response["status"] = "error";
            $this->response["data"] = "Erro ao buscar postagens";
        }
        return $this->response;
    }
	public function postRegistration(PostDTO $postDTO):array{
		try{
			$this->data = $this->postBO->postRegistrationValidation($this, $postDTO);
			if($this->data["status"] == "success"){
				$this->data = $this->data["data"];
				date_default_timezone_set('America/Sao_Paulo');
				$this->data["registration_date"] = date("Y/m/d H:i:s");    
				$this->stmt = "INSERT INTO posts(author, title, descriptions, `image`, registration_date)
				VALUES(:author, :title, :descriptions, :image, :registration_date)";
				$this->stmt = self::$con->prepare($this->stmt);
				$this->stmt->bindParam(":author", $this->data["author"]);
				$this->stmt->bindParam(":title", $this->data["title"]);
				$this->stmt->bindParam(":descriptions", $this->data["descriptions"]);
				$this->stmt->bindParam(":image", $this->data["imageNamePost"]);
				$this->stmt->bindParam(":registration_date", $this->data["registration_date"]);
				if($this->stmt->execute()){
					$this->response["status"] = "success";
					$this->response["data"] = "Postagem cadastrada com sucesso!";
				}else{
					$this->response["status"] = "error";
					$this->response["data"] = "Erro ao cadastrar postagem";
				}
			}else{
				$this->response = $this->data;
			}
        } catch (PDOException $e) {            
            $this->response["status"] = "error";
            $this->response["data"] = "Ocorreu um erro nesta operação";
        }        
        return $this->response;
	}
	public function postEdition(PostDTO $postDTO):array{
		try{
			$this->data = $this->postBO->postEditionValidation($postDTO);
			if($this->data["status"] == "success"){
				$this->data = $this->data["data"];
				date_default_timezone_set('America/Sao_Paulo');
				$this->data["registration_date"] = date("Y/m/d H:i:s");    
				$this->stmt = "UPDATE posts SET title = :title, descriptions = :descriptions, `image` = :image, author = :author, registration_date = :registration_date WHERE id = :id";
				$this->stmt = self::$con->prepare($this->stmt);
				$this->stmt->bindParam(":title", $this->data["title"]);
				$this->stmt->bindParam(":descriptions", $this->data["descriptions"]);
				$this->stmt->bindParam(":image", $this->data["imageNamePost"]);        
				$this->stmt->bindParam(":author", $this->data["author"]);
				$this->stmt->bindParam(":registration_date", $this->data["registration_date"]);
				$this->stmt->bindParam(":id", $this->data["id"], PDO::PARAM_INT);
				if($this->stmt->execute()){
					$this->response["status"] = "success";
					$this->response["data"] = "Postagem editada com sucesso!";
				}else{
					$this->response["status"] = "error";
					$this->response["data"] = "Erro ao editar postagem";
				}
			}else{
				$this->response = $this->data;
			}            
        } catch (PDOException $e) {            
            $this->response["status"] = "error";
            $this->response["data"] = "Ocorreu um erro nesta operação";
        }        
        return $this->response;
	}
	public function postDelete(PostDTO $postDTO):array{		
		try {
			$this->data = $this->postBO->postDeleteValidation($postDTO);
			if($this->data["status"] == "success"){
				$this->data = $this->data["data"];
				$this->stmt = "DELETE FROM posts WHERE id=:id";
				$this->stmt = self::$con->prepare($this->stmt);
				$this->stmt->bindParam(":id", $this->data["id"], PDO::PARAM_INT);
				if($this->stmt->execute()){
					$this->response["status"] = "success";
					$this->response["data"] = "Excluido com sucesso";
				} else {
					$this->response["status"] = "error";
					$this->response["data"] = "Erro ao excluir a postagem";
				}
			}else{
				$this->response = $this->data;
			}            
        } catch (PDOException $e) {            
            $this->response["status"] = "error";
            $this->response["data"] = "Erro ao excluir a postagem";            
        }        
		return $this->response;
	}
}

?>