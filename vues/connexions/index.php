<?php 
session_start();

if (isset($_POST['pseudo'])&& isset($_POST['password'])){
    if(!isset($_SESSION['bruteforce'])) $_SESSION['bruteforce'] = 0;
    if($_SESSION['bruteforce'] < 3){
        $connexions= new Connexions();
        if($connexions->connexion_post()) header("Location: index.php?p=mots");
        else {
            $_SESSION['bruteforce']++;
            echo 'Mauvais identifiants';
        }
        if (isset($_SESSION['errors'])){
            echo '<ul>';
            foreach($_SESSION['errors'] as $error){
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
        }
    }else{
        echo 'Vous avez été bloqué pour 1 minute';
        sleep(60);
        $_SESSION['bruteforce'] = 0;
    }
}
?>

<h1> Connexion </h1>
<form action="index.php?p=connexions" method="post">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" required>
    <br>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <br>
    <input type="submit" value="Me connecter">
</form>