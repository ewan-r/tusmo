<?php

class AjoutMot extends Model{

    public function __construct(){
        $this->table = 'word';
        $this->getConnection();
    }

    private function setDifficulty(string $word){
        $difficulty = 0;
        $length = strlen($word);
        if ($length <= 5){
            $difficulty = 1;
        }
        elseif ($length <= 6){
            $difficulty = 2;
        }
        elseif ($length <= 8){
            $difficulty = 3;
        }
        elseif ($length <= 10){
            $difficulty = 4;
        }
        elseif ($length <= 12){
            $difficulty = 5;
        }
        elseif ($length <= 14){
            $difficulty = 6;
        }
        elseif ($length <= 16){
            $difficulty = 7;
        }
        elseif ($length <= 18){
            $difficulty = 8;
        }
        elseif ($length <= 20){
            $difficulty = 9;
        }
        else{
            $difficulty = 10;
        }
        return $difficulty;
    }

    public function insert(string $word){
        $difficulty = $this->setDifficulty($word);
        $sql = "INSERT INTO {$this->table} (word, difficulte) VALUES ('" . $word . "', '" . $difficulty . "')";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }

}
?>