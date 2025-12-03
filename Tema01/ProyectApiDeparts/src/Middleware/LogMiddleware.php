<?php

namespace app\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class LogMiddleware{

    private $fileLog;

    public function __construct(){
        
        $fileLog="resgistro.log";

    }

    public function handle(){

        $authHeader=$headers['Authorization'] ?? $headers['authorization'] ?? null;
        
    }

}