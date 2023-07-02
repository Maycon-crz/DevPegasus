<?php

namespace Source\Models\UserOptions\Services;

use Source\Models\Lib\GenericTools;
use CoffeeCode\Cropper\Cropper;
use Source\Models\UserOptions\DataTransferObjects\PostDTO;

use PDOException;

class PostBO{
    private $genericTools;
    private $cropper;	
    private $response = array();
    private $data = array();
    private $msg;
    private $path;
	private $image;
	private $imageNameDb;
    private $imageName;
    private $imageNewName;
    private $tmpName;	
    public function __construct(){
		$this->genericTools = new GenericTools();    
		$this->cropper = new Cropper("theme/assets/img/posts/cache");		
	}
    public function postRegistrationValidation($postsModel, PostDTO $postDTO): array{		
        if($postDTO->getFrontEnd() !== "external"){
			if(session_status() === PHP_SESSION_NONE){ session_start(); }
			$postDTO->setAuthor(isset($_SESSION["email"]) ? $_SESSION["email"] : "");
		}
		$this->msg = ($postDTO->getAuthor() == "") ? "" : "";
		$this->msg = ($this->msg == "") ? $this->msg = ($postDTO->getTitlePost() == "") ? "Informe o título" : "" : $this->msg;
		$this->msg = ($this->msg == "") ? $this->msg = ($postDTO->getDescriptionPost() == "") ? "Informe a descrição" : "" : $this->msg;
		$this->msg = ($this->msg == "") ? $this->msg = ($postDTO->getImagePost() == "") ? "Selecione uma imagem" : 1 : $this->msg;
		$this->response["status"] = "error";
		if($this->msg === 1){
			$this->msg = $this->genericTools->checksImageTypeSize($postDTO->getImagePost());
			if($this->msg === 1){				
				$this->data = $postsModel->getPosts($postDTO->getTitlePost(), 1);
				if($this->data["status"] === "success" && empty($this->data["data"])){
                    $postDTO->setImageNamePost($this->upladImagePost($postDTO->getImagePost()));
					if($postDTO->getImageNamePost() !== 0){
                        $this->response["status"] = "success";
						$this->response["data"] = $postDTO->toArray();
					}else{ $this->response["data"] = "Erro no upload da imagem! pode ser que a imagem seja muito grande."; }
				}else{
					$this->response["data"] = "Este título já está em uso"; 
				}
			}else{ $this->response["data"] = $this->msg; }
		}else{ $this->response["data"] = $this->msg; }
		return $this->response;
	}
	public function postEditionValidation(PostDTO $postDTO): array{		
		/*E-mail de quem está editando*/
		if($postDTO->getFrontEnd() !== "external"){
			if(session_status() === PHP_SESSION_NONE){ session_start(); }
			$postDTO->setAuthor(isset($_SESSION["email"]) ? $_SESSION["email"] : "");
		}

		$this->msg = ($postDTO->getAuthor() == "") ? "Erro de autenticação" : "";
		$this->msg = ($this->msg == "") ? $this->msg = ($postDTO->getId() == "") ? "Erro no id do formulário" : "" : $this->msg;
		$this->image = $postDTO->getImagePost();
		$this->imageNameDb = $postDTO->getImageNamePost();
		if($postDTO->getFrontEnd() !== "external"){
	        $this->msg = ($this->msg == "") ? $this->msg = ($this->image["tmp_name"] == "" && $this->imageNameDb == "") ? "Faltou imagem" : "" : $this->msg;
	    }else{
	        $this->msg = ($this->msg == "") ? $this->msg = ($this->image == "" && $this->imageNameDb == "") ? "Faltou imagem" : "" : $this->msg;
	    }
		$this->msg = ($this->msg == "") ? $this->msg = ($postDTO->getTitlePost() == "") ? "Informe um título" : "" : $this->msg;
		$this->msg = ($this->msg == "") ? $this->msg = ($postDTO->getDescriptionPost() == "") ? "Informe uma descrição" : 1 : $this->msg;
		$this->response["status"] = "error";
		if($this->msg === 1){
			if(isset($this->image["tmp_name"]) && !empty($this->image["tmp_name"])){
				/*When Update Image*/
				$this->msg = $this->genericTools->checksImageTypeSize($this->image);
				if($this->msg === 1){										
					// $this->response["data"] = "Pronto para fazer update";
					$this->image = $this->upladImagePost($this->image);
					if($this->image !== 0){
						$this->deleteImagePost($this->imageNameDb);
						$postDTO->setImageNamePost($this->image);
						$this->response["status"] = "success";
						$this->response["data"] = $postDTO->toArray();
					}else{ $this->response["data"] = "Erro no upload da imagem! pode ser que a imagem seja muito grande."; }
				}else{ $this->response["data"] = $this->msg; }
			}else{
				// $this->response["data"] = "update sem imagem nova";
				/*When Not Update Image*/
				$this->response["status"] = "success";
				$this->response["data"] = $postDTO->toArray();
			}
		}else{ $this->response["data"] = $this->msg; }
		return $this->response;
	}
	public function postDeleteValidation(PostDTO $postDTO){

		if($postDTO->getFrontEnd() !== "external"){
			if(session_status() === PHP_SESSION_NONE){ session_start(); }
			$postDTO->setAuthor(isset($_SESSION["email"]) ? $_SESSION["email"] : "");
		}
		$this->msg = ($postDTO->getAuthor() == "") ? "Erro de autenticação" : "";
		$this->msg = ($this->msg == "") ? $this->msg = ($postDTO->getId() == "") ? "Erro no id do formulário" : "" : $this->msg;
		$this->msg = ($this->msg == "") ? $this->msg = ($postDTO->getImageNamePost() == "") ? "Erro na imagem" : 1 : $this->msg;
		$this->response["status"] = "error";
		if($this->msg === 1){
			$this->deleteImagePost($postDTO->getImageNamePost());
			$this->response["status"] = "success";
			$this->response["data"] = $postDTO->toArray();
		}else{ $this->response["data"] = $this->msg; }
		return $this->response;
	}
    private function upladImagePost($image){
		try{		
			$this->path = "theme/assets/img/posts/";
			$this->imageName = $image['name'];
			$this->imageNewName = uniqid().".".$this->imageName;
			$this->tmpName = $image['tmp_name'];
			if(move_uploaded_file($this->tmpName, $this->path.$this->imageNewName)){			
				return $this->imageNewName;
			}else{ return 0; }
		} catch (PDOException $e) {}
	}
	private function deleteImagePost($imageName){
		try{
			$this->cropper->flush($imageName);
			unlink("theme/assets/img/posts/".$imageName);
		} catch (PDOException $e) {}
	}
}
