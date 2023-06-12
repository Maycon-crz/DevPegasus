<?php

namespace source\Models\UserOptions\Administrator;

use Exception;

class ContentGeneratorModel{    
    private $client;
    private $response = array();
    private $tokenOpenaiGPTRapidapi = "fc29db6f34mshdf0a3198f1baa2dp1dbc25jsnec150c975184";    
    private $tokenTextcortex = "gAAAAABkgG3hycetteQDOOagPWlzqFrgA5kYTyweNi-HH_hzRl1ZkObw1L9mX4ObqkTQHxTz8iPjZXeIdDUj8GnWfiiTd46H3o6bQEaZfZdcTNqWXx0J2PmwoIO0GK7WB5mOlgEuDGjK";
    private $subject = "";
    private $keywords = "";
    // private $tokenNLPCloudNLPCloudAPI = "0ffd104c1554eb5875cf9f2b774c14677f9bd44e";
    // private $model = "";    
    
    function __construct(){}
    public function titleGeneratorOpenaiGPTRapidapi($subjectParameter, $keywordsParameter){
        $this->subject = $subjectParameter;
        $this->keywords = $keywordsParameter;
        /*
        Link: https://rapidapi.com/openai-api-openai-api-default/api/openai80
        */
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://openai80.p.rapidapi.com/chat/completions",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => 'Gere um título atraente em termos de SEO para uma postagem com o assunto: '.$this->subject
                    ]
                ]
            ]),
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: openai80.p.rapidapi.com",
                "X-RapidAPI-Key: ".$this->tokenOpenaiGPTRapidapi,
                "content-type: application/json"
            ],
        ]);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);/*Se não funcionar pode ser porque aqui esta como false e o servidor deles só aceita true*/

        $responseServer = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            $this->response["status"] = "error";
            $this->response["data"] = $err;
        } else {
            $responseData = json_decode($responseServer, true);

            if ($responseData === null) {
                $this->response["status"] = "error";
                $this->response["data"] = "Erro ao decodificar os dados da resposta";
                return $this->response;
            } else {
                $this->response["status"] = "success";
                $this->response["data"]["openaiGPTRapidapi"] = $responseData;
                $this->response["data"]["textcortex"] = $this->textGeneratorTextcortex();
                $this->response["data"]["imageSearchPexels"] = $this->imageSearchPexels();
                $this->response["data"]["websearchRapidapi"] = $this->websearchRapidapi();

                // var_dump($this->response["data"]["openaiGPTRapidapi"]);
                // var_dump($this->response["data"]["textcortex"]);
                // var_dump($this->response["data"]["imageSearchPexels"]);
                // var_dump($this->response["data"]["websearchRapidapi"]);

                // $this->combinedData['textcortex'] = $this->textGeneratorTextcortex($this->response['data']['choices'][0]['message']['content']);
                return $this->response;
            }

        }
    }    
    function textGeneratorTextcortex(){
        $keywordsArray = array_map('trim', explode(',', $this->keywords));
        try{
            $curl = curl_init();
            $data = array(
                "context" => "Sustentabilidade",
                "keywords" => $keywordsArray,
                "max_tokens" => 512,
                "model" => "sophos-1",
                "n" => 1,
                "source_lang" => "pt",
                "target_lang" => "pt-br",
                "temperature" => 0.65,
                "title" => $this->response["data"]["openaiGPTRapidapi"]['choices'][0]['message']['content'],
            );
            $dataJson = json_encode($data);
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.textcortex.com/v1/texts/blogs",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $dataJson,
                CURLOPT_HTTPHEADER => [
                "Authorization: Bearer ".$this->tokenTextcortex,
                "Content-Type: application/json"
                ],
            ]);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);/*Se não funcionar pode ser porque aqui esta como false e o servidor deles só aceita true*/

            $responseServer = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                // echo "cURL Error #:" . $err;
                return "cURL Error #:" . $err;
            } else {
                // echo $responseServer;
                return json_decode($responseServer, true);
            }
        } catch (Exception $e) {
            return "Erro na requisição";
        }
    }
    
    public function imageSearchPexels(){        
        // curl -H "Authorization: arfihOKYY9j7x1ObD4EfhkPY2nDAAnlPFI45a37VqpPDf2QkjrpXPaV6" \
        // "https://api.pexels.com/v1/search?query=nature&per_page=1"
        try{
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.pexels.com/v1/search?query=".$this->subject."&per_page=1",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: arfihOKYY9j7x1ObD4EfhkPY2nDAAnlPFI45a37VqpPDf2QkjrpXPaV6"
                ),
            ));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);/*Se não funcionar pode ser porque aqui esta como false e o servidor deles só aceita true*/

            $responseServer = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #: " . $err;
            } else {            
                return json_decode($responseServer, true);
            }
        } catch (Exception $e) {
            return "Erro na requisição";
        }
    }

    public function  websearchRapidapi(){
        try{
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://contextualwebsearch-websearch-v1.p.rapidapi.com/api/Search/ImageSearchAPI?q=".$this->subject."&pageNumber=1&pageSize=10&autoCorrect=true",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: contextualwebsearch-websearch-v1.p.rapidapi.com",
                    "X-RapidAPI-Key: fc29db6f34mshdf0a3198f1baa2dp1dbc25jsnec150c975184"
                ],
            ]);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);/*Se não funcionar pode ser porque aqui esta como false e o servidor deles só aceita true*/

            $responseServer = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {            
                return json_decode($responseServer, true);
            }
        } catch (Exception $e) {
            return "Erro na requisição";
        }
    }

    // public function imageGeneratorProdia(){
    //     /*
    //     DOCUMENTAÇÃO: https://docs.prodia.com/reference/generate        
    //     */

    //     $curl = curl_init();

    //     $data = array(
    //         "prompt" => "Imagem relacionada a Sustentabilidade",
    //         "negative_prompt" => "badly drawn",
    //         "steps" => 25,
    //         "cfg_scale" => 7,
    //         "seed" => -1,
    //         "upscale" => false
    //     );

    //     $data_json = json_encode($data);

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.prodia.com/v1/job",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => $data_json,
    //         CURLOPT_HTTPHEADER => array(
    //             "X-Prodia-Key: fb70f95b-5b0f-4f29-a7b3-a30055096a94",
    //             "accept: application/json",
    //             "content-type: application/json"
    //         ),
    //     ));
    //     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);/*Se não funcionar pode ser porque aqui esta como false e o servidor deles só aceita true*/

    //     $responseServer = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //         // echo "cURL Error #: " . $err;
    //     } else {
    //         echo "-------------------";
    //         echo $responseServer;
    //         echo "-------------------";
    //         $responseData = json_decode($responseServer, true);            
    //         $this->getURLImageGeneratorProdia($responseData["job"]);
    //     }        
    // }
    // public function getURLImageGeneratorProdia($uri){
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.prodia.com/v1/job/".$uri,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => array(
    //             "X-Prodia-Key: fb70f95b-5b0f-4f29-a7b3-a30055096a94",
    //             "accept: application/json"
    //         ),
    //     ));
    //     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);/*Se não funcionar pode ser porque aqui esta como false e o servidor deles só aceita true*/

    //     $responseServer = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //         echo "cURL Error #: " . $err;
    //     } else {
    //         echo "-------------------";
    //         echo $responseServer;
    //         echo "-------------------";
    //     }
    // }

    // public function titleGeneratorNLPCloudNLPCloudAPI(){        
    //     $this->model = "chatdolphin";
    //     /*
    //     - DOCUMENTAÇÃO E OUTROS MODELOS: https://docs.nlpcloud.com/?shell#generation
    //     - O modelo { finetuned-gpt-neox-20b } funcionu só que já atingi o limite de requisições
    //     - Não conssegui testar bem os outros modelos muito pouco crédito para requisições;
    //     */


    //     // Dados da requisição
    //     $url = 'https://api.nlpcloud.io/v1/gpu/'.$this->model.'/generation';

    //     $data = array(
    //         'text' => 'Gere 3 opções de títulos em português BR para uma posta sobre reciclagem',            
    //         0,
    //         50,
    //         True,
    //         NULL,
    //         False,
    //         True,
    //         1,
    //         False,
    //         0,
    //         1,
    //         50,
    //         1,
    //         0.8,
    //         1,
    //         1,
    //         NULL,
    //         False            
    //     );

    //     $jsonData = json_encode($data);

    //     $headers = array(
    //         'Authorization: Token ' . $this->tokenNLPCloudNLPCloudAPI,
    //         'Content-Type: application/json'
    //     );
    
    //     $ch = curl_init($url);
    
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);/*Se não funcionar pode ser porque aqui esta como false e o servidor deles só aceita true*/
    
    //     $responseServer = curl_exec($ch);
    //     $error = curl_error($ch);
    
    //     curl_close($ch);
    
    //     if ($error) {
    //         $this->response["status"] = "error";
    //         $this->response["data"] = "Erro na requisição cURL: " . $error;
    //     } else {
    //         $this->response["status"] = "succees";
    //         $this->response["data"] = $responseServer;
    //         return $this->response;
    //     }        
    // }
}
