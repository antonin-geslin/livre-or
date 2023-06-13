<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
    <form class = "mainForm" method="post">
            <label for="text">Text</label>
            <textarea id="message" name="message" rows="5" cols="40"></textarea><br>
            <button type="submit" name="submit">Send comment</button>
    </form>

    <?php
        include('comment.php');

        if (isset($_POST['submit'])){
            $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');
            $requete = $bdd->prepare("SELECT id FROM user WHERE login = :login");
            $requete->bindParam(':login', $_SESSION['login']);
            $requete->execute();
            $id = $requete->fetchColumn();
            date_default_timezone_set('Europe/Paris');
            $dateTime = date('Y-m-d-H-i');
            $comment = new Comment($_POST['message'], $id, $dateTime);
            $comment->addToBdd($comment->getText(), $comment->getDate(),  $comment->getId_user());
            header('location: livre-or.php');
        }

    ?>
</body>
</html>