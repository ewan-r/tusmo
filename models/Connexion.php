<?php
class Connexion extends Model{
    public function __construct(){
       $this->table = 'user';
       $this->getConnection();
    }

    public function findByPassword(string $password){
        $sql = "SELECT * FROM {$this->table} WHERE password = '" . $password . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function findByPseudo(string $pseudo){
        $sql = "SELECT * FROM {$this->table} WHERE pseudo = '" . $pseudo . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function findPseudo (string $pseudo){
        $sql = "SELECT pseudo FROM {$this->table} WHERE pseudo = '" . $pseudo . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

}