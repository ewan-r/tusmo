<?php
require_once("models\Mot.php");
require_once("models\User.php");

class Mots extends Controller{
    private $mot;
    private $word;

    public function __construct(){
        $this->mot = new Mot();
    }

    public function index(){
        $mot = "";
        $this->loadModel("Mot");
        $this->render('index', ['mot' => $mot]);
    }

    public function getWord(){
        $user = new User();
        $user->findByPseudo($_SESSION['pseudo']);
        $words = $this->mot->selectByDifficulty($user->getLevel());
        $word = $words[rand(0, count($words)-1)];
        return $word;
    }

    public function checkLetter(){
        $result = "";
        for($i = 0; $i < strlen($word); $i++){
            if($word[$i] == $_POST['letter'.$i]){
                echo "true";
                $result = true;
            }else{
                for($j = 0; $j < strlen($word); $j++){
                    if($word[$i] == $_POST['letter'.$j]){
                        echo "trueMoyen";
                        $result = false;
                    }
                    else{
                        echo "false";
                        $result = false;
                    }
                }
            }
        }
    }

    public function checkWord(){
        $word = $_POST['word'];
        if($word == $this->word){
            echo "true";
        }else{
            echo "false";
        }
    }

    public function checkLetterRightPlace(){

    }
}