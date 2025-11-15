<?php

namespace app\Controller;

use app\Model\Database;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class appController
{

    private $twig;
    private $modelUser;

    public function __construct()
    {
        $this->modelUser = new Database();
        $loader = new FilesystemLoader(__DIR__ . "/../View");
        $this->twig = new Environment($loader);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->twig->addGlobal('state_active', isset($_SESSION['name']));
        $this->twig->addGlobal('name', $_SESSION['name'] ?? null);
    }

    public function index()
    {
        echo $this->twig->render("home.html.twig");
    }

    public function form()
    {
        echo $this->twig->render("registro.html.twig");
    }

    public function saveUser()
    {

        error_log("entra en el function de save user");
        $nameLimpio = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $pinLimpio = filter_input(INPUT_POST, 'pin', FILTER_SANITIZE_SPECIAL_CHARS);

        $hashedPin = password_hash($pinLimpio, PASSWORD_BCRYPT);

        $validSave = $this->modelUser->saveUSer($nameLimpio, $hashedPin);

        if ($validSave) {

            $_SESSION['name'] = $nameLimpio;
            $this->twig->addGlobal('state_active', true);
            $this->twig->addGlobal('name', $nameLimpio);
            echo $this->twig->render('bienvenido.html.twig', [
                'name' => $nameLimpio
            ]);
        } else {
            echo $this->twig->render('fallo.html.twig');
        }
    }
    public function formLogin()
    {

        echo $this->twig->render('loginForm.html.twig');
    }

    public function login()
    {

        $nameLimpio = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $pinLimpio = filter_input(INPUT_POST, 'pin', FILTER_SANITIZE_SPECIAL_CHARS);




        //busco el usuario en la base de datos
        $userData = $this->modelUser->searchUser($nameLimpio);

        //si el usuario existe...
        if ($userData) {
            //compara el pin introducido con el has de la bbdd
            if (password_verify($pinLimpio, $userData->password)) {

                setcookie('user_name', $userData->nombre, time() + 3600, '/');
                $_SESSION['name'] = $userData->nombre;
                $this->twig->addGlobal('state_active', true);
                $this->twig->addGlobal('name', $userData->nombre);

                echo $this->twig->render('bienvenido.html.twig', [
                    'name' => $userData->nombre
                ]);
            } else {
                echo $this->twig->render('fallo.html.twig', [
                    'mensaje' => 'PIN incorrecto'
                ]);
            }
        } else {
            echo $this->twig->render('fallo.html.twig', [
                'mensaje' => 'Usuario no encontrado'
            ]);
        }
    }

    public function exit()
    {
        setcookie('user_name', '', time() - 3600, '/');

        session_unset();
        session_destroy();

        header("Location: /");
        exit;
    }

    public function shop()
    {

        if (!isset($_COOKIE['user_name'])) {
            header("Location: /");
            exit;
        }

        $name = $_COOKIE['user_name'];
        $user = $this->modelUser->searchUser($name);
        $textoCompra = $user && $user->compra ? $user->compra : '';
        echo $this->twig->render('shop.html.twig', ['dataShop' => $textoCompra]);
    }

    public function saveShop()
    {
        // Verificamos que exista cookie con el nombre del usuario
        if (!isset($_COOKIE['user_name'])) {
            header("Location: /");
            exit;
        }

        $name = $_COOKIE['user_name'];
        $dataShop = filter_input(INPUT_POST, 'dataShop', FILTER_SANITIZE_SPECIAL_CHARS);

        // Guardamos en la base de datos
        $this->modelUser->saveShop($dataShop, $name);

        // Redirigimos de nuevo a la vista del shop
        header("Location: /");
        exit;
    }
}
