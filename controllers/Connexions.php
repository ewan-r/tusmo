<?php
//session_start();
require_once ('/var/www/html/projet_web/models/Connexion.php');  

class Connexions extends Controller{

    public function index(){
        $this->loadModel('Connexion');
        $this->render('index', ['connexions' => $connexions]);
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
            header('Location: connexion');
        }else{
            $password = hash('sha256', $password);
            if($this->Connexion->findByPseudo($pseudo)){
                $errors['pseudo'] = "Ce pseudo n'existe pas";
            }
    
            if($this->Connexion->findByPassword($password)){
                $errors['password'] = "Ce mot de passe n'existe pas";
            }
            $_SESSION['success'] = 1;
        }
    }
}