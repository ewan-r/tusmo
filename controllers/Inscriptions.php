<?php
require_once("../models/Inscription.php");

class Inscriptions extends Controller{
    public function __construct(){
        $this->loadModel("Inscription");
    }

    public function inscription(){
        $this->render("inscription");
    }

    public function inscription_post(){
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        $errors = [];

        if(empty($pseudo) || empty($email) || empty($password) || empty($password_confirm)){
            $errors['empty'] = "Tous les champs n'ont pas été remplis";
        }

        if($this->Inscription->findByPseudo($pseudo)){
            $errors['pseudo'] = "Ce pseudo est déjà pris";
        }

        if($this->Inscription->findByEmail($email)){
            $errors['email'] = "Cet email est déjà utilisé pour un autre compte";
        }

        if($password != $password_confirm){
            $errors['password'] = "Les deux mots de passe ne correspondent pas";
        }

        if(!empty($errors)){
            $_SESSION['errors'] = $errors;
            $_SESSION['inputs'] = $_POST;
            header('Location: inscription');
        }else{
            $password = hash('sha256', $password);
            $this->Inscription->insert($pseudo, $email, $password);
            $_SESSION['success'] = 1;
            header('Location: connexion');
        }
    }
}