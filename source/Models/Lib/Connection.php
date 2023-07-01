<?php
namespace Source\Models\Lib;

use \PDO;
use PDOException;

//outras Exceptions
use Exception;
use InvalidArgumentException;

abstract class Connection{
	private static $conn;
	
	protected static function getConn(){
		try {
			if (self::$conn == null) {/*Singleton - para uma instanciação única*/
				self::$conn = new PDO('mysql: host=localhost; dbname=modelo_site_db; charset=utf8', 'root', 'root');
				// Configurações adicionais, se necessário
			}
			
			return self::$conn;
		} catch (PDOException $e) {
			return 'Error: ' . $e->getMessage();
		}
	}

	protected static function closeConn(){
		self::$conn = null;
	}
}
