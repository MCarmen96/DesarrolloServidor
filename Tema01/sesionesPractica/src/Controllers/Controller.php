<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Controller
{
    private Environment $twig;

    public function __construct()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);


        $this->twig->addGlobal('state_active', isset($_SESSION['username']));
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

        $validUsername = 'mikel';
        $hashedPassword = password_hash('mikel', PASSWORD_BCRYPT);
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
