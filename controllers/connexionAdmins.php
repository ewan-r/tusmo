<?php
//session_start();
require_once ('models\connexionAdmin.php');  

class ConnexionAdmins extends Controller{

    private $connexionsAdmin;

    public function __construct(){
        $this->connexionsAdmin = new ConnexionAdmin();
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
            if(!$this->connexionsAdmin->findPseudo($pseudo)){
                echo "Pseudo incorrect";
                return false;
            }

            if(!$this->comparePassword($pseudo, $password)){
                echo 'Mot de passe incorrect';
                return false;
            }
            $_SESSION['success'] = 1;
            $_SESSION['type'] = 'admin';
            $_SESSION['pseudo'] = $pseudo;
            return true;
        }
    }

    public function comparePassword (string $pseudo, string $mdp){
        $password = hash('sha256', $mdp);
        $user = $this->connexionsAdmin->findByPseudo($pseudo);
        if($user){
            if($user['password'] == $password){
                return true;
            }
        }
        return false;
    }
}