<?php

namespace Source\Models\Authentication\Services;

class AuthBO{
    private static $key;
    private static $externalAppKey;
    public function __construct(){
		self::$key = "chave_de_api";
        self::$externalAppKey = "chave_externa_de_api";
	}
    public function generateAppKey() : array{
        /*Caso o acesso da API for pelo site*/
        session_start();
        $appkey = bin2hex(random_bytes(16));
        $_SESSION['appkey'] = $appkey;
        return array('appkey' => $appkey);
    }
    public function getExternalAppKey(){
        /*Caso o acesso da API for externo*/
        return self::$externalAppKey;
    }
    public function getGenerateToken(string $email){
        $payloadParameter = [			    
            'name' => 'Nome do usuario',
            'email' => $email,
        ];
        /*Retorna o Token gerado*/
        return $this->generateToken($payloadParameter);
    }
    private function generateToken($payloadParameter){
        /*E-mail usado na geração da chave externa: nmaycon304@gmail.com*/
        /*Header Token*/
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        /*Payload - Content*/
        $payload = $payloadParameter;

        /*JSON*/
        $header = json_encode($header);
        $payload = json_encode($payload);

        /*Base 64*/
        $header = self::base64UrlEncode($header);
        $payload = self::base64UrlEncode($payload);

        /*Sign*/
        $sign = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
        $sign = self::base64UrlEncode($sign);

        /*Token*/
        $token = $header . '.' . $payload . '.' . $sign;

        return $token;
    }
    private static function base64UrlEncode($data){
        /* First of all you should encode $data to Base64 string */
        $b64 = base64_encode($data);

        /* Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do */
        if ($b64 === false) {
            return false;
        }

        /* Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_” */
        $url = strtr($b64, '+/', '-_');

        /* Remove padding character from the end of line and return the Base64URL result */
        return rtrim($url, '=');
    }
    private static function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
    private static function getBearerToken() {
        $headers = self::getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
    public static function checkAuth(){
        /*Essa funação foi aprimorada com as funções:
            getAuthorizationHeader();
            getBearerToken();
        porque assim ele pega mais formas de envio antes pegava apenas quando a requisição era feita pelo postman... agora pega quando a requisição é feita pelo http no flutter, também! ou seja é feita uma verificação completa.
        */
        $getBearerToken = self::getBearerToken();
        if($getBearerToken != null){
            $token = explode('.', $getBearerToken);
            $header = $token[0] ?? "";
            $payload = @$token[1];
            $sign = @$token[2];

            /* Conferir Sign */
            $valid = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
            $valid = self::base64UrlEncode($valid);

            if($sign === $valid){
                return true;
            }
        }
        return false;
    }
}