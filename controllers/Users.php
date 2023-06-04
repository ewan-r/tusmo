<?php

require_once("models\User.php");

Class Users extends Controller{
    private $user;
    public function __construct(){
        $this->user = new User();
    }

    public function updateLevel(string $pseudo){
        $level = $this->user;
        $this->user->updateLevel($pseudo,);
    }


}