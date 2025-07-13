<?php
    namespace Source\Controllers;

    use League\Plates\Engine;
    use Source\Support\Seo;
    use Source\Controllers\Middlewares\MiddlewareAccess;
    // use Source\Controllers\Middlewares\MiddlewareForSimpleAccess;
    use Source\Models\Authentication\Services\AuthBO;
    use Source\Models\Lib\GenericTools;
    use Source\Models\UserOptions\Administrator\ContentGeneratorModel;
    use Source\Models\Luana\LuanaModel;

    class LuanaController extends MiddlewareAccess{
        /*@var Engine*/
        private $view;
        /*@var $seo Seo*/
        private $seo;
        private $response = array();
        private $genericTools;
        private $authBO;
        private $pageAccessLevel = 3;
        private $isRoute;
        private $subject;
        private $keywords;
        private $contentGeneratorModel;
        private LuanaModel $luanaModel;
        public function __construct($router){
            $this->view = Engine::create(__DIR__."/../../theme", "php");
            $this->view->addData(["router" => $router]);
            $this->seo = new Seo();
            $this->authBO = new AuthBO();
            $this->genericTools = new GenericTools();
            $this->contentGeneratorModel = new ContentGeneratorModel();
        }
        public function luanaIA($data): void{
            $this->middleware($this->pageAccessLevel, $this->genericTools, $this->view, $this->authBO, false);
            $head = $this->seo->render(
                "Luana IA | ".SITE,
                "Inteligência artificial Luana",
                url(),
                /*TODO: Alterar essa URL!*/
                "https://www.recicladarte.com/theme/img/logo_recicladarte_marketing.jpg"
            );
            echo $this->view->render("luana", [
                "head" => $head
            ]);
        }
        public function luanaAPI($data){
            $this->middleware($this->pageAccessLevel, $this->genericTools, $this->view, $this->authBO, false);
            /*QUANDO por login descomentar 2 nível de acesso no middleware*/
            switch($data["section"]){
                case "title_generator_openai_gpt_rapidapi":				
                    $this->subject = isset($_POST["subject"]) ? $this->genericTools->filter($_POST["subject"]) : "";
                    $this->keywords = isset($_POST["keywords"]) ? $this->genericTools->filter($_POST["keywords"]) : "";				
                    if($this->subject != "" && $this->keywords != ""){
                        $this->response = $this->contentGeneratorModel->titleGeneratorOpenaiGPTRapidapi($this->subject, $this->keywords);
                    }else{
                        $this->response["status"] = "error";
                        $this->response["data"] = "Faltou informar assunto ou palavras chave";
                    }

                    // $this->response = $this->contentGeneratorModel->imageGeneratorProdia();
                    // $this->response = $this->contentGeneratorModel->getURLImageGeneratorProdia("0f35090a-c6f5-4156-831b-fcc548a9ad7e");
                    // $this->response = $this->contentGeneratorModel->imageSearchPexels();
                    // $this->response = $this->contentGeneratorModel->websearchRapidapi();
                break;
                case "title_generator_nlp_cloud_api":
                    /* Esta plataforma funciona a requisição a API gratuitamente 
                    porém é muito limitado as requisições; */
                    // $this->response = $this->contentGeneratorModel->titleGeneratorNLPCloudNLPCloudAPI();
                break;			
            }
            
            echo $this->view->render("api", [
                "dados" => $this->response
            ]);
        }
        function karaokeRegisterMusicController(){
            $this->luanaModel = new LuanaModel();
            $jsonPayload = file_get_contents('php://input');
            // Decodifica o JSON para um array associativo do PHP
            // O segundo parâmetro "true" transforma o JSON em um array. Sem ele, viraria um objeto.
            $data = json_decode($jsonPayload, true);
            
            echo $this->view->render("api", [
                "dados" => $this->luanaModel->karaokeRegisterMusicModel($data)
            ]);
        }
    }

?>