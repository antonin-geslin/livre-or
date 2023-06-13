<?php

class Comment {
    public $id;
    public $text;
    public $id_user;
    public $date;

    public function __construct($text, $date, $id_user){
        $this->text = $text;
        $this->date = $date;
        $this->id_user = $id_user;
    }

    public function getText(){
        return $this->text;
    }

    public function getId_user(){
        return $this->id_user;
    }

    /*public function getId(){
        $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');
        $requete = $bdd->prepare("SELECT id FROM user WHERE login = :login");
        $requete->bindParam(':login', $this->login);
        $requete->execute();
        $id = $requete->fetch();
        return $id;
    }*/

    public function getDate(){
        return $this->date;
    }

    function addToBdd ($text,$id_user, $date){
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');
            $requete = $bdd->prepare("INSERT INTO comment (comment, user_id, date) VALUES (:text, :id_user, :date)");
            $requete->bindParam(':text', $text);
            $requete->bindParam(':id_user', $id_user);
            $requete->bindParam(':date', $date);
            $requete->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }
    }

}

?>