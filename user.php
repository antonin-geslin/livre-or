<?php

class User {
    public $id;
    public $login;
    public $password;

    public function __construct($login, $password){
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin(){
        return $this->login;
    }

    public function getId(){
        $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');
        $requete = $bdd->prepare("SELECT id FROM user WHERE login = :login");
        $requete->bindParam(':login', $this->login);
        $requete->execute();
        $id = $requete->fetch();
        return $id;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setLogin($login){
        $this->login = $login;
    }

    function addToBdd ($login, $password){
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');
            $requete = $bdd->prepare("INSERT INTO user (login, password) VALUES (:login, :password)");
            $requete->bindParam(':login', $login);
            $requete->bindParam(':password', $password);
            $requete->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }
    }

    function changeProfile($id,$login,$password) {
        $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');
        $requete = $bdd->prepare("UPDATE user SET login = :login, password = :password WHERE id = :id");
        $requete->bindParam(':login', $login);
        $requete->bindParam(':id', $id);
        $requete->bindParam(':password', $password);
        $requete->execute();
    }

}

?>