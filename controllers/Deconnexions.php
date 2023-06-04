<?php

class Deconnexions extends Controller{
    public function index(){
        $this->render('index');
    }

    public function deconnexion(){
        session_start();
        session_destroy();
        header('Location: index.php?p=accueils');
    }
}