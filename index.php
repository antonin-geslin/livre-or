<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in/Log-in Simulator</title>
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
        </div>
    </header>
    <div class="content">
        <h1>Welcome on Sign-in/Log-in Simulator !</h1>
        <p>Discover the world's first registration and login simulation game! Immerse yourself in an immersive experience that will make you feel the excitement of navigating a real website.</p>
        <p>Are you ready for an intense and authentic experience? Our revolutionary game pushes the boundaries of simulation by faithfully recreating every detail of the online login and registration process. Discover a wide range of true-to-life features that will put you right in the middle of the action.</p>
        <p>Face the challenges of forgotten passwords, e-mail confirmations (next update), searching for usernames and more... The simulator takes you deep into the world of online logins, where every interaction counts.</p>
        <p>Are you ready for the challenge? Join us now and get ready for some exciting times. The future of online simulation <a class="link" href="inscription.php">starts here.</a></p>
        <p class ='disclaimer'>Alpha Version - More content comming soon</p>
    </div>
</body>
</html>

<?php

?>