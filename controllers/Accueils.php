<?php
require_once("C:\\xampp\htdocs\\tusmo\models\Accueil.php");

Class Accueils extends Controller{
    public function index(){
        $accueil = new Accueil();
        $this->loadModel("Accueil");
        $this->render('index', ['accueil' => $accueil]);
    }
}