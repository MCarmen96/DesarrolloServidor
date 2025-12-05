<?php
// 1 namespace
namespace app\Controller;

use app\Model\Database;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class appController
{

    //variable para instanciar la database
    private $myModel;
    private $twig;

    private $jwtKey;
    private $jwtCookieName = 'session_token';
    private $isLogged = false;
    private $userName = null;

    public function __construct()
    {   //1 instancia el database,abro la conexion con la base de datos
        $this->myModel = new Database();

        //2 preparar twig, indicandole donde estan mis vistas
        $loader = new FilesystemLoader(__DIR__ . "/../views");
        $this->twig = new Environment($loader); //creo el motor de twig


        //3cargar varibales del .env. le iendico donde esta y lo cargo $_ENV[]
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../..");
        $dotenv->load();

        // 4 la clave del jwt esta en
        // busco la cookie llamada token si no existe se obtine null
        $payload = $this->validateToken();

        if ($payload !== null) {
            $this->isLogged = true;
            $this->userName = $payload['name'] ?? null;
        }

        //6 varaible globales para twig
        $this->twig->addGlobal('is_logged', $this->isLogged);
        $this->twig->addGlobal('name', $this->userName);
    }

    public function index()
    {
        echo $this->twig->render("home.html.twig");
    }
    public function formLogin()
    {
        echo $this->twig->render("login.html.twig");
    }
    public function formRegister()
    {
        echo $this->twig->render('formRegister.html.twig');
    }
    public function formShop()
    {
        if (!$this->isLogged) {
            header('Location: /formLogin');
            exit;
        }
        $user = $this->myModel->searchUser($this->userName);
        $textoCompra = $user && $user->compra? $user->compra: '';
        echo $this->twig->render('formShop.html.twig', ['compra' => $textoCompra]);
    }

    public function registerUser()
    {

        $name = filter_input(INPUT_POST, 'nameUser', FILTER_SANITIZE_SPECIAL_CHARS);
        $pin = filter_input(INPUT_POST, 'pinUser', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name === '' || $pin === '') {
            echo $this->twig->render('fail.html.twig', ['mensaje' => 'Datos no validos']);
            return;
        }
        $pinHashed = password_hash($pin, PASSWORD_BCRYPT);
        error_log($name);
        $validSave = $this->myModel->saveUser($name, $pinHashed);
        error_log($validSave);

        if (!$validSave) {
            echo $this->twig->render('fail.html.twig', ['mensaje' => 'No se poudo registrar al usuario']);
            return;
        } else {
            $this->crearToken($name);
            header('Location: /');
        }
    }

    public function saveShop()
    {
        $shop = filter_input(INPUT_POST, 'shop', FILTER_SANITIZE_SPECIAL_CHARS);
        $saveShop = $this->myModel->saveShop($shop, $this->userName);
        if ($saveShop) {
            header('Location: /shop');
            exit;
        } else {
            echo $this->twig->render('fail.html.twig', ['mensaje' => 'no se han podido guardar los datos de la compra']);
        }
    }

    public function loginUser()
    {

        $name = filter_input(INPUT_POST, 'nameUser', FILTER_SANITIZE_SPECIAL_CHARS);
        $pin = filter_input(INPUT_POST, 'pinUser', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name === '' && $pin === '') {
            echo $this->twig->render('fail.html.twig', ['mensaje' => 'Datos invalidos']);
            return;
        }

        $user = $this->myModel->searchUser($name);
        //verifico que el usuario esta guardado en la bbdd y que el pin conincide con el de la bbdd
        if (!$user || !password_verify($pin, $user->password)) {
            echo $this->twig->render('fail.html.twig', ['mensaje' => 'CREDENCIALES INCORRECTAS']);
            return;
        } else {
            $this->crearToken($name);
            header('Location: /');
        }
    }

    public function logOut()
    {
        setcookie($this->jwtCookieName, '', time() - 3600, '/', '', false, true);
        header('Location: /');
        exit;
    }

    public function validateToken()
    {
        $this->jwtKey = $_ENV['DB_KEY'];
        // 5 LEER LA COOKIE Y VALIDAR SI EL TOKEN EXISTE
        $token = $_COOKIE[$this->jwtCookieName] ?? null;

        if ($token) {
            try {
                $decoded = JWT::decode($token, new Key($this->jwtKey, 'HS256'));
                return json_decode(json_encode($decoded), true);
            } catch (\Exception $e) {
                return null;
            }
        } else {
            return null;
        }
    }

    public function crearToken($name)
    {
        if ($this->jwtKey === false) {
            die('Error la variable de entorno key no esta definida');
        }
        $payload = [
            'name' => $name,
            'iat' => time(),
            'exp' => time() + 3600
        ];

        $token = JWT::encode($payload, $this->jwtKey, 'HS256');
        setcookie($this->jwtCookieName, $token, time() + 3600, '/', '', false, true);
    }
}
