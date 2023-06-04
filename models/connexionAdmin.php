<?php
class ConnexionAdmin extends Model{
    public function __construct(){
       $this->table = 'admin';
       $this->getConnection();
    }

    public function findByPassword(string $Password){
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
}