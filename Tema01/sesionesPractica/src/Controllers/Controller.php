<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Controller
{
    private Environment $twig;

    public function __construct()
    {
        //inciamos el mecanimos de sesiones de PHP para poder leer o escribir datos
        if (session_status() === PHP_SESSION_NONE) {
            session_start();// si solo lo hago en el login no podre acceder al estado de las sesiones en otros metodos
        }

        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);

        // añado una variable global para que este disponible en todas las plnatilla
        $this->twig->addGlobal('state_active', isset($_SESSION['username']));
        //si existe una session en $session guarda el valor en username
        $this->twig->addGlobal('username', $_SESSION['username'] ?? null);
    }

    public function index()
    {
        echo $this->twig->render('base.html.twig');
    }

    public function loginForm()
    {
        echo $this->twig->render('form.html.twig');
    }

    public function login($data)
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

        $validUsername = 'carmen';
        $hashedPassword = password_hash('carmen', PASSWORD_BCRYPT);
        $validPassword = password_verify($password, $hashedPassword);

        if ($username === $validUsername && $validPassword) {

            $_SESSION['username'] = $username;
            $this->twig->addGlobal('state_active', true);
            $this->twig->addGlobal('username', $username);

            echo $this->twig->render('succes.html.twig', [
                'username' => $username
            ]);
        } else {

            echo $this->twig->render('fail.html.twig');
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /");
        exit;
    }
}
