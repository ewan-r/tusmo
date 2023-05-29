<?php
require_once("C:\\xampp\htdocs\\tusmo\models\Mot.php");
require_once("C:\\xampp\htdocs\\tusmo\models\User.php");

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
        $words = $this->mot->selectDifficulty($user->getLevel());
        $word = $words[rand(0, count($words)-1)];
        return $word;
    }

    public function drawTable(){
        $this->word = $this->getWord();
        for($i=0; $i < 6; $i++){
            echo "<tr>";
            for($j = 0; $j < strlen($word); $j++){
                echo "<td><input type='text' name='letter".$j"' id='letter' maxlength='1' size='1' /></td>";
            }
            echo "</tr>";
        }
    }

    public function checkLetter(){
        for($i = 0; $i < strlen($word); $i++){
            if($word[$i] == $_POST['letter'.$i]){
                echo "true";
            }else{
                for($j = 0; $j < strlen($word); $j++){
                    if($word[$i] == $_POST['letter'.$j]){
                        echo "trueMoyen";
                    }
                    else{
                        echo "false";
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