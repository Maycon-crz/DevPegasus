<?php

namespace Source\Models\UserOptions\DataTransferObjects;

class PostDTO{
    private $frontEnd;
    private $id;
    private $author;
    private $titlePost;
    private $descriptionPost;
    private $imagePost;
    private $imageNamePost;
    private $registrationDate;    
    public function getFrontEnd(){
        return $this->frontEnd;
    }
    public function getId(){
        return $this->id;
    }
    public function getAuthor(){
        return $this->author;
    }
    public function getTitlePost(){
        return $this->titlePost;
    }
    public function getDescriptionPost(){
        return $this->descriptionPost;
    }
    public function getImagePost(){
        return $this->imagePost;
    }
    public function getImageNamePost(){
        return $this->imageNamePost;
    }
    public function getRegistrationDate(){
        return $this->registrationDate;
    }
    public function setFrontEnd($frontEnd):void{
        $this->frontEnd = $frontEnd;
    }
    public function setId($id):void{
        $this->id = $id;
    }
    public function setAuthor($author):void{
        $this->author = $author;
    }
    public function setTitlePost($titlePost):void{
        $this->titlePost = $titlePost;
    }
    public function setDescriptionPost($descriptionPost):void{
        $this->descriptionPost = $descriptionPost;
    }
    public function setImagePost($imagePost):void{
        $this->imagePost = $imagePost;
    }
    public function setImageNamePost($imageNamePost):void{
        $this->imageNamePost = $imageNamePost;
    }
    public function setRegistrationDate($registrationDate):void{
        $this->registrationDate = $registrationDate;
    }
    
    public function toArray(): array
{
    return [
        'id' => $this->id,
        'title' => $this->titlePost,
        'descriptions' => $this->descriptionPost,
        'image' => $this->imagePost,
        'imageNamePost' => $this->imageNamePost,
        'frontEnd' => $this->frontEnd,
        'author' => $this->author,
        'registrationDate' => $this->registrationDate,
    ];
}
}

?>