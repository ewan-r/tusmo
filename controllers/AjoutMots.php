<?php
require_once("models\AjoutMot.php");
class AjoutMots extends Controller{

    public function index(){
        $this->loadModel("AjoutMot");
        $this->render('index');
    }

    public function ajoutMots_post(string $word){
        $ajoutMot = new AjoutMot();
        $ajoutMot->insert($word);
        header('Location: index.php?p=ajoutMots');
    }
}