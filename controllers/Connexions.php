<?php
//session_start();
require_once ('models\Connexion.php');  

class Connexions extends Controller{

    private $connexions;

    public function __construct(){
        $this->connexions = new Connexion();
    }

    public function index(){
        $connexions = "";
        $this->loadModel('Connexion');
        $this->render('index', ['connexions' => $connexions]);
    }

    public function connexion_post(){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);

        $errors = [];

        if(empty($pseudo) || empty($password)){
            $errors['empty'] = "Tous les champs n'ont pas été remplis";
        }

        if(!empty($errors)){
            $_SESSION['errors'] = $errors;
            $_SESSION['inputs'] = $_POST;
        }else{
            $password = hash('sha256', $password);
            if(!$this->connexions->findPseudo($pseudo)){
                echo "Pseudo incorrect";
                return false;
            }

            if(!$this->comparePassword($pseudo, $password)){
                echo 'Mot de passe incorrect';
                return false;
            }

            $_SESSION['success'] = 1;
            $_SESSION['type'] = 'normal';
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['essai'] = 0;
            return true;
        }
    }

    public function comparePassword (string $pseudo, string $mdp){
        $password = hash('sha256', $mdp);
        $user = $this->connexions->findByPseudo($pseudo);
        if($user){
            if($user['password'] == $password){
                return true;
            }
        }
        return false;
    }
}