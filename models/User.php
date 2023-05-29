<?php

class User extends Model{

    private $id;
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
        $row = $query->setFetchMode(PDO::FETCH_CLASS, 'User');
        $this->id = $row->id;
        $this->pseudo = $row->pseudo;
        $this->email = $row->email;
        $this->level = $row->level;
    }


}