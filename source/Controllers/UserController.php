<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\User;

class HomeController{

	private $view;

	public function __construct(){
		$this->view = Engine::create(__DIR__."/../../theme", "php");
	}	
}