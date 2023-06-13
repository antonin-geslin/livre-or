<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
    <div class="tab">
        <table>
            <thead>
            <tr>
                <th>Date</th>
                <th>User</th>
                <th>Comment</th>
            </tr>
            </thead>
            <tbody>
            <?php 
                $bdd = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8', 'root', 'root');
                $requete = $bdd->prepare("SELECT * FROM comment ORDER BY date DESC");
                $requete->execute();
                $comments = $requete->fetchAll();
                foreach ($comments as $comment) {
                    $requete2 = $bdd->prepare("SELECT login FROM user WHERE id = :user_id");
                    $requete2->bindParam(':user_id', $comment['user_id']);
                    $requete2->execute();
                    $user = $requete2->fetch();
                    echo '<tr>';
                    echo '<td>'.$comment['date'].'</td>';
                    echo '<td>'.$user['login'].'</td>';
                    echo '<td>'.$comment['comment'].'</td>';
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>