<?php

class User extends Model{

    
    private $pseudo;
    private $email;
    private $level;

    public function __construct(){
        $this->table = 'user';
        $this->getConnection();
    }

    public function getPseudo(){
        return $this->pseudo;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getLevel(){
        return $this->level;
    }

    public function findByPseudo(string $pseudo){
        $sql = "SELECT * FROM {$this->table} WHERE pseudo = '" . $pseudo . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $this->pseudo = $row['pseudo'];
        $this->email = $row['email'];
        $this->level = $row['level'];
    }

    public function updateLevel(string $pseudo){
        $this->findByPseudo($pseudo);
        $level = $this->level + 1;
        $sql = "UPDATE {$this->table} SET level = '" . $level . "' WHERE pseudo = '" . $pseudo . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }


}