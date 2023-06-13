<?php
require_once("models\inscriptionAdmin.php");

class InscriptionAdmins extends Controller{

    public $inscriptionAdmin;

    public function __construct(){
        $this->inscriptionAdmin = new InscriptionAdmin();
    }

    public function index(){
        $inscriptionAdmin = "";
        $this->loadModel("inscriptionAdmin");
        $this->render('index', ['inscriptionAdmin' => $inscriptionAdmin]);
    }

    public function inscription_post(){
        $pseudo = htmlspecialchar($_POST['pseudo']);
        $email = htmlspecialchar($_POST['email']);
        $password = htmlspecialchar($_POST['password']);
        $password_confirm = htmlspecialchar($_POST['password_confirm']);

        $errors = [];

        if(empty($pseudo) || empty($email) || empty($password) || empty($password_confirm)){
            $errors['empty'] = "Tous les champs n'ont pas été remplis";
        }

        if($this->inscriptionAdmin->findByPseudo($pseudo)){
            $errors['pseudo'] = "Ce pseudo est déjà pris";
        }

        if($this->inscriptionAdmin->findByEmail($email)){
            $errors['email'] = "Cet email est déjà utilisé pour un autre compte";
        }

        if($password != $password_confirm){
            $errors['password'] = "Les deux mots de passe ne correspondent pas";
        }

        if(!empty($errors)){
            $_SESSION['errors'] = $errors;
            $_SESSION['inputs'] = $_POST;
            header('Location: index.php?p=inscriptionAdmins');
        }else{
            $password = hash('sha256', $password);
            $this->inscriptionAdmin->insert($pseudo, $email, $password);
            $_SESSION['success'] = 1;
            $_SESSION['pseudo'] = $pseudo;
            header('Location: index.php?p=ajoutMots');
        }
    }
}