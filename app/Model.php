<?php 

abstract class Model{
    private $host = "localhost";
    private $dbname = "tusmo";
    private $username = "root";
    private $password = "";
    protected $_connexion;
    public $table;
    public $id;

    public function getConnection()  
    {
        $this->_connexion = null;
        try
        {
            $this->_connexion = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname, 
                $this->username, 
                $this->password
            );
        }
        catch(PDOException $e)
        {
            echo "Erreur de connexion: " . $e->getMessage();
        }
        return $this->_connexion;
    }

    public function getAll(){
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getOne(){
        $sql = "SELECT * FROM " . $this->table . " WHERE id = " . $this->id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}
?>