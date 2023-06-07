<?php 

class InscriptionAdmin extends Model{
    public function __construct(){
       $this->table = 'admin';
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
        $mdp = hash('sha256', $password);
        $sql = "INSERT INTO {$this->table} (pseudo, email, password) VALUES ('" . $pseudo . "', '" . $email . "', '" . $mdp . "')";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
    }
}
?>