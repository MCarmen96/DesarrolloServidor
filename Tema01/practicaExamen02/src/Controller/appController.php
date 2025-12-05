<?php
namespace app\Controller;

use app\Models\Database;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Twig\Node\Expression\ReturnNumberInterface;

class appController{

    private $myModel;
    private $twig;

    private $key;
    private $cookieName='session_token';
    private $isLogged=false;
    private $userName=null;

    public function __construct()
    {
        $this->myModel=new Database();
        $laoder=new FilesystemLoader(__DIR__."/../Views");
        $this->twig=new Environment($laoder);

        $dotenv=Dotenv::createImmutable(__DIR__."/../..");
        $dotenv->load();

        $payload=$this->validToken();

        if($payload){
            $this->isLogged=true;
            $this->userName=$payload['name']??null;
        }
        $this->twig->addGlobal('isLogged',$this->isLogged);
        $this->twig->addGlobal('name',$this->userName);
    }

    public function index(){
        echo $this->twig->render('home.html.twig');
    }

    public function formLogin(){
        echo $this->twig->render('formLogin.html.twig');
    }

    public function formRegister(){
        
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

    public function login(){
        $name=filter_input(INPUT_POST,'nameUser',FILTER_SANITIZE_SPECIAL_CHARS);
        $pin=filter_input(INPUT_POST,'pinUser',FILTER_SANITIZE_SPECIAL_CHARS);
        if($name===''&&$pin===''){
            echo $this->twig->render('fails.html.twig',['log'=>'ERROR LOS CAMPOS ESTAN VACIOS']);
            return;
        }
        $user=$this->myModel->searchUser($name);

        if(!$user|| !password_verify($pin,$user->password)){
            echo $this->twig->render('fails.html.twig',['log'=>'CREDENCIALES INCORRECTAS']);
        }else{
            echo "estas logueado";
        }
    }

    public function logout(){
        setcookie($this->cookieName,'',time()-3600,'/','',false,true);
        header('Location: /');
        exit;
    }

    public function register(){

        $name=filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
        $pin=filter_input(INPUT_POST,'pin',FILTER_SANITIZE_SPECIAL_CHARS);

        if($name===''&&$pin===''){
            echo $this->twig->render('fails.html.twig',['log'=>'ERROR LOS CAMPOS ESTAN VACIOS']);
            return;
        }
        $hassedPin=password_hash($pin,PASSWORD_BCRYPT);
        $saveUser=$this->myModel->register($name,$hassedPin);

        if($saveUser){
            echo "te has regsitrado correctamente";
        }else{
            echo $this->twig->render('fails.html.twig',['log'=>'ERROR NO TE HAS REGISTRADO']);
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

    public function createToken($name){

        if($this->key===false){
            die('ERROR LA VARIABLE DE ENTONRO NO SE ENCUENTRA');
        }
        $payload=[
            'name'=>$name,
            'iat'=>time(),
            'exp'=>time()+3600

        ];

        $token=JWT::encode($payload,$this->key,'HS256');
        setcookie($this->cookieName,$token,time()+3600,'/','',false,true);
    }

    public function validToken(){
        $this->key=$_ENV['key'];

        $cookie=$_COOKIE[$this->cookieName]??null;

        if($cookie){
            try{
                $decoded=JWT::decode($cookie,new Key($this->key,'HS256'));
                return json_decode(json_encode($decoded),true);
            }catch(\Exception $e){
                return null;
            }
        }else{
            return null;
        }

    }

}