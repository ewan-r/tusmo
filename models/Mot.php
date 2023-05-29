<?php

class Mot extends Models{
    public function __construct(){
        $this->table = 'word';
        $this->getConnection();
     }

     public function selectByDifficulty(int $difficulty){
         $words = [];
         $sql = "SELECT * FROM {$this->table} WHERE difficulty = '" . $difficulty . " ans id = '";
         $query = $this->_connexion->prepare($sql);
         $query->execute();
         while ($row= $query->fetch(PDO::FETCH_ASSOC)){
         $words[] = $row;
         }
         return $words;
     }
}