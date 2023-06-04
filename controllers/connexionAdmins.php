<?php
//session_start();
require_once ('models\connexionAdmin.php');  

class Connexions extends Controller{

    private $connexionsAdmin;

    public function __construct(){
        $this->connexionsAdmin = new Connexion();
    }

    public function index(){
        $connexionsAdmin = "";
        $this->loadModel('ConnexionAdmin');
        $this->render('index', ['connexionsAdmin' => $connexionsAdmin]);
    }

    public function connexion_post(){
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];

        $errors = [];

        if(empty($pseudo) || empty($password)){
            $errors['empty'] = "Tous les champs n'ont pas été remplis";
        }

        if(!empty($errors)){
            $_SESSION['errors'] = $errors;
            $_SESSION['inputs'] = $_POST;
            header('Location: index.php?p=connexionAdmins');
        }else{
            $password = hash('sha256', $password);
            if($this->connexionsAdmin->findByPseudo($pseudo)){
                $errors['pseudo'] = "Ce pseudo n'existe pas";
            }
    
            if($this->connexionsAdmin->findByPassword($password)){
                $errors['password'] = "Ce mot de passe n'existe pas";
            }
            $_SESSION['success'] = 1;
            $_SESSION['pseudo'] = $pseudo;
            header("Location: index.php?p=ajoutMots");
        }
    }
}