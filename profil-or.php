<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
<header>
        <a href="index.php"><h2>Sign-in/Log-in Simulator</h2></a>
        <?php
            session_start();
            if (isset($_SESSION['login'])) {
                $username = $_SESSION['login'];
                echo "<div class='sign_out'><p class='login_check'>Bienvenue, " .strip_tags($username). "!</p><form method='post'><button type='submit' name='signout'>Sign Out</button></form></div>";
                if (isset($_POST['signout'])) {
                    session_destroy();
                    header('location: index.php');
                    exit();
                }
            } else {
                
            }
        ?>
        <div class="nav">
            <a href="connexion-or.php">connexion</a>
            <a href="inscription-or.php">inscription</a>
            <a href="profil-or.php">profil</a>
            <a href='livre-or.php'>livre d'or</a>
            <?php
            session_start();
            if (isset($_SESSION['login'])) {
                echo "<a href='put_comment.php'>faire un commentaire</a>";
            }
            if ($_SESSION['type'] == 'admin') {
                echo "<a href='admin-or.php'>admin</a>";
            }
        ?>
</header>
    <?php
        session_start();
        if (isset($_SESSION['login'])) {
            $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');
            $requete = $bdd->prepare("SELECT * FROM user WHERE login = :login");
            $requete->bindParam(':login', $_SESSION['login']);
            $requete->execute();
            $login = '';
            $prenom = '';
            $nom = '';
            $id = '';
            
            while ($row = $requete->fetch()) {
                $id = $row['id'];
                $login_save = $row['login'];
                $login = $row['login'];
            }
        }
    ?>
    <form class = "mainForm" method="post">
            <label for="login">Login</label>
            <input type="text" name="login" id="login" value="<?php echo $login ?>" onfocus="this.value='';">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <label for="password2">Password</label>
            <input type="password" name="password2" id="password2">
        </div>
        <div class="error">
            <p></p>
        </div>
        <button type="submit" name="submit">Modifier profil</button>
    </form>


    <?php

        include("user.php");
        function checkForm( $login, $password, $password2){
            if (isset($login) && isset($password) && isset($password2)){
                if ($password == $password2){
                    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/", $password)){
                            return true;
                        }
                    }
                    else {
                        return ('Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial');
                    }
                } else {
                    return ('Les mots de passe ne correspondent pas');
                }
            return false;
        }

        
        if (isset($_POST['submit'])) {
            if (!$_SESSION['login']) {
                header('location: connexion-or.php');
            } else {
                $formresult = checkForm($_POST['login'], $_POST['password'], $_POST['password2']);
                if ($formresult === true) {
                    $user = new User($_POST['login'], $_POST['password']);
                    $user->changeProfile($user->getId(), $_POST['login'], ($_POST['password']));
                    $_SESSION['login'] = $_POST['login'];
                    header('location: index.php');
                } else {
                    echo "<div class='error'><p>" .$formresult. "</p></div>";
                }
            }
            }
    ?>
</body>
</html>