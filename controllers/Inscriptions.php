<?php
require_once("C:\\xampp\htdocs\\tusmo\models\Inscription.php");

class Inscriptions extends Controller{

    //déclare une variable inscription qui est un objet de la classe Inscription
    private $inscription;

    public function __construct(){
        $this->inscription = new Inscription();
    }

    public function index(){
        $inscription = "";
        $this->loadModel("Inscription");
        $this->render('index', ['inscription' => $inscription]);
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

        if($this->inscription->findByPseudo($pseudo)){
            $errors['pseudo'] = "Ce pseudo est déjà pris";
        }

        if($this->inscription->findByEmail($email)){
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
            $this->inscription->insert($pseudo, $email, $password);
            $_SESSION['success'] = 1;
            $_SESSION['pseudo'] = $pseudo;
            header('Location: index.php?p=accueils');
        }
    }
}