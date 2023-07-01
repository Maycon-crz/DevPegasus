<?php 

namespace Source\Models\Authentication\DataTransferObjects;

class LoginDTO{    
    private $frontEnd;
    private $email;    
    private $password;
    private $id;
    private $fullName;
    private $token;
    private $appKey;
    private $hierarchy;
    private $phone;
    private $statusUser;

    public function getFrontEnd(){
        return $this->frontEnd;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getID(){
        return $this->id;
    }
    public function getFullName(){
            return $this->fullName;
    }
    public function getToken(){
        return $this->token;
    }
    public function getAppKey(){
        return $this->appKey;
    }
    public function getHierarchy(){
        return $this->hierarchy;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function getStatusUser(){
        return $this->statusUser;
    }
    /*-------------------------------------*/
    public function setFrontEnd($frontEnd){
        $this->frontEnd = $frontEnd;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setID($id) : void{
        $this->id = $id;
    }
    public function setFullName($fullName) : void{
        $this->fullName = $fullName;
    }
    public function setToken($token) : void{
        $this->token = $token;
    }
    public function setAppKey($appKey) : void{
        $this->appKey = $appKey;
    }
    public function setHierarchy($hierarchy) : void{
        $this->hierarchy = $hierarchy;
    }
    public function setPhone($phone) : void{
        $this->phone = $phone;
    }
    public function setStatusUser($statusUser) : void{
        $this->statusUser = $statusUser;
    }
    /*-------------------------------------*/
    public function toArray() {
        $dataExternal = array(
            'password' => $this->password,
            'token' => $this->token,
            'hierarchy' => $this->hierarchy,
            'appKey' => $this->appKey,
        );
        $data = array(
            'frontEnd' => $this->frontEnd,
            'email' => $this->email,            
            'id' => $this->id,
            'fullName' => $this->fullName,
            'phone' => $this->phone,
            $this->frontEnd == "external" ? $dataExternal : null,
            'statusUser' => $this->statusUser
        );
        return $data;
    }
}

?>