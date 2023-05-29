<?php 

class Inscription extends Model{
    public function __construct(){
       $this->table = 'user';
       $this->getConnection();
    }

    public function findByEmail(string $email){
        $sql = "SELECT * FROM {$this->table} WHERE email = '" . $email . "'";
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

    public function insert(string $pseudo, string $email, string $password){
        $sql = "INSERT INTO {$this->table} (pseudo, email, password) VALUES ('" . $pseudo . "', '" . $email . "', '" . $password . "')";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }
}
?>