<?php

class Mot extends Model{
    public function __construct(){
        $this->table = 'word';
        $this->getConnection();
     }

     public function selectByDifficulty(int $difficulty){
         $words = [];
         $sql = "SELECT * FROM {$this->table} WHERE difficulte <= '" . $difficulty . "'";
         $query = $this->_connexion->prepare($sql);
         $query->execute();
         while ($row= $query->fetch(PDO::FETCH_ASSOC)){
         $words[] = $row['word'];
         }
         return $words;
     }
}