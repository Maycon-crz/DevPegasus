<?php
    namespace Source\Models\Lib;
    
    use \PDO;
    use PDOException;
    
    //outras Exceptions
    use Exception;
    use InvalidArgumentException;
    
	class GenericTools {
	    public function filter($dados){
			$dados = trim($dados);
			$dados = htmlspecialchars($dados);			
			$dados = addslashes($dados);
			return $dados;
		}
		public function checksImageTypeSize($image){
			$nameImage = $image['name'] ?? "";
			$sizeImage = $image['size'] ?? 0;
			$permittedFormats = array("png", "PNG", "jpeg", "JPEG", "jpg", "JPG", "gif", "bmp", "webp");
			$extension = pathinfo($nameImage, PATHINFO_EXTENSION);
			if(in_array($extension, $permittedFormats)){
				if(1024*1024*100 < $sizeImage){
					return "Imagem muito grande!";
				}else{ return 1; }
			}else{ return "Arquivo não é uma imagem"; }
		}
	}
?>