<?php

namespace app\Controller;

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use app\Model\Database;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class appController
{
    // dependencias / estado
    private $myModel;
    private $twig;

    // JWT config
    private $jwtKey;           // <- aquí guardamos la clave secreta
    private $jwtCookieName = 'session_token';
    private $jwtTtl = 3600;   // segundos

    // estado por request (basado en token)
    private $isLogged = false;
    private $userName = null;

    public function __construct()
    {
        // 1) Modelo y Twig
        $this->myModel = new Database();
        $loader = new FilesystemLoader(__DIR__ . "/../views");
        $this->twig = new Environment($loader);

        // 2) Load .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        // 3) Guardar la clave JWT desde .env en la propiedad $this->jwtKey
        //    Esta es la variable que usarás para firmar/validar tokens.
        $this->jwtKey = $_ENV['DB_KEY'] ?? '';

        // 4) Leer cookie y validar token (si existe)
        $token = $_COOKIE[$this->jwtCookieName] ?? null;
        
        if ($token && $this->jwtKey !== '') {
            $payload = $this->validateToken($token);
            if ($payload !== null) {
                $this->isLogged = true;
                $this->userName = $payload->name ?? null;
            } else {
                // token inválido o caducado -> borramos cookie para limpiar estado
                $this->clearJwtCookie();
            }
        }

        // 5) Variables globales para Twig (disponibles en todas las plantillas)
        $this->twig->addGlobal('is_logged', $this->isLogged);
        $this->twig->addGlobal('user_name', $this->userName);
    }

    // ---------- Vistas públicas / acciones ----------
    public function index()
    {
        echo $this->twig->render("home.html.twig");
    }

    public function formRegister()
    {
        echo $this->twig->render("formRegister.html.twig");
    }

    public function formLogin()
    {
        echo $this->twig->render("login.html.twig");
    }

    // ---------- Registro (crea usuario + token) ----------
    public function registerUser()
    {
        $name = filter_input(INPUT_POST, 'nameUser', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $pin = filter_input(INPUT_POST, 'pinUser', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

        if ($name === '' || $pin === '') {
            echo $this->twig->render('fail.html.twig', ['mensaje' => 'Datos no válidos']);
            return;
        }

        $hash = password_hash($pin, PASSWORD_BCRYPT);

        // Guardar en BBDD -> tu método debe devolver true o el id insertado
        $saved = $this->myModel->saveUser($name, $hash);
        if (!$saved) {
            echo $this->twig->render('fail.html.twig', ['mensaje' => 'No se pudo registrar el usuario']);
            return;
        }

        // Generar JWT con datos mínimos (no sensibles)
        $payload = [
            'name' => $name,
            'iat'  => time(),
            'exp'  => time() + $this->jwtTtl
        ];

        $token = JWT::encode($payload, $this->jwtKey, 'HS256');

        // Guardar cookie HttpOnly
        $this->setJwtCookie($token);

        // Renderizar vista logueado
        echo $this->twig->render('home.html.twig');
    }

    // ---------- Login (verifica credenciales + emite token) ----------
    public function loginUser()
    {
        $name = filter_input(INPUT_POST, 'nameUser', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $pin = filter_input(INPUT_POST, 'pinUser', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

        if ($name === '' || $pin === '') {
            echo $this->twig->render('fail.html.twig', ['mensaje' => 'Datos no válidos']);
            return;
        }

        $user = $this->myModel->searchUser($name);

        if (!$user || !password_verify($pin, $user->password)) {
            echo $this->twig->render('fail.html.twig', ['mensaje' => 'Credenciales incorrectas']);
            return;
        }

        $payload = [
            'name' => $user->nombre ?? $name,
            'iat'  => time(),
            'exp'  => time() + $this->jwtTtl
        ];

        $token = JWT::encode($payload, $this->jwtKey, 'HS256');
        $this->setJwtCookie($token);

        echo $this->twig->render('home.html.twig');
    }

    // ---------- Logout (eliminar cookie) ----------
    public function logout()
    {
        $this->clearJwtCookie();
        header("Location: /");
        exit;
    }

    // ---------- Rutas protegidas ejemplo ----------
    public function shop()
    {
        if (!$this->isLogged) {
            header("Location: /formLogin");
            exit;
        }

        $name = $this->userName;
        $user = $this->myModel->searchUser($name);
        $textoCompra = ($user && $user->compra) ? $user->compra : '';
        echo $this->twig->render('shop.html.twig', ['dataShop' => $textoCompra]);
    }

    public function saveShop()
    {
        if (!$this->isLogged) {
            header("Location: /formLogin");
            exit;
        }

        $dataShop = filter_input(INPUT_POST, 'dataShop', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $name = $this->userName;
        $this->myModel->saveShop($dataShop, $name);

        header("Location: /pageShop");
        exit;
    }

    // ---------------------- MÉTODOS AUXILIARES ----------------------

    // Validar token: retorna payload (objeto) o null
    private function validateToken(string $token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->jwtKey, 'HS256'));

            // El JWT::decode ya verifica la firma; comprobamos expiración (defensivo)
            if (isset($decoded->exp) && time() > $decoded->exp) {
                return null;
            }
            return $decoded;
        } catch (\Exception $e) {
            // opcional: error_log($e->getMessage());
            return null;
        }
    }

    // Setear cookie JWT (HttpOnly). En producción activa 'secure' => true (HTTPS).
    private function setJwtCookie(string $token)
    {
        setcookie($this->jwtCookieName, $token, [
            'expires' => time() + $this->jwtTtl,
            'path' => '/',
            'domain' => '',     // dejar vacío normalmente
            'secure' => false,  // > true en producción (HTTPS)
            'httponly' => true, // evita lectura por JS
            'samesite' => 'Lax' // Lax/Strict según tu necesidad
        ]);
    }

    // Borrar cookie JWT
    private function clearJwtCookie()
    {
        setcookie($this->jwtCookieName, '', [
            'expires' => time() - 3600,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    }
}
