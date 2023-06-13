<?php

class verifAdmins extends Controller{
    public function index(){
        $this->render('index');
    }
    public function verif(){
        if(isset($_POST['password'])){
            $password = htmlspecialchars($_POST['password']);
            if($password == 'testMdp'){
                $_SESSION['verif'] = true;
                header("Location: index.php?p=inscriptionAdmins");
            }else{
                echo 'Mauvais mot de passe';
                return false;
            }
        }
    }
}