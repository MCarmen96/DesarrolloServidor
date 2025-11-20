<?php

namespace app\Middleware;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

class AuthMiddleware{
    private $secretKey;

    public function __construct(){
        $dotenv=Dotenv::createImmutable(__DIR__ . "/../../");
        $dotenv->load();
        $this->secretKey="1234";
    }

    public function handle($headers){

        $authHeader=$headers['Authorization']?? $headers['authorization'] ?? null;
        if(!$authHeader){
            error_log(json_encode($headers));
            http_response_code(401);
            echo json_encode(['error'=>'Token NO propocionado']);
            exit;

        }

        $token=str_replace('Bearer ','',$authHeader);

        try{
            $decoded=JWT::decode($token,new key($this->secretKey,'HS256'));
            return (array) $decoded;
        }catch(\Exception $e){
            http_response_code(401);
            echo json_encode(['error'=>'Token invalido o expirado','details'=>$e->getMessage()]);
        }
    }
}
