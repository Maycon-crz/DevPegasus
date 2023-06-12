<?php
    namespace Source\Models\Lib;
    
    use Source\Models\Lib\Conn;
    
    use \PDO;
    use PDOException;
    
    //outras Exceptions
    use Exception;
    use InvalidArgumentException;
    
	class GenericTools{
	    // private static $con;
		// private $response = array();
		// private $result;
	    public function __construct(){
	        // self::$con = (new Conn())->getConn();
	    }
	    public function filtrando($dados){
			if($dados != null){
				$dados = trim($dados);
				$dados = htmlspecialchars($dados);
				$dados = addslashes($dados);
			}			
			return $dados;
		}    	
	}
