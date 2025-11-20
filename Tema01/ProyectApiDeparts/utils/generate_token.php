<?php
require './../vendor/autoload.php';

use Firebase\JWT\JWT;


$secretKey="1234";

$payload=[
    'iss'=>'http://localhost:8000',
    'aud'=>'http://localhost:8000',
    'iat'=>time(),
    'exp'=>time()+3600,
    'user_id'=>'carmenchu'
];

$jwt=JWT::encode($payload,$secretKey,'HS256');
echo json_encode(['token'=>$jwt]);