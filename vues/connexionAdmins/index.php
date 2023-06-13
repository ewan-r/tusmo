<?php 
session_start();
if (isset($_POST['pseudo'])&& isset($_POST['password'])){
    if(!isset($_SESSION['bruteforceConAdmin'])) $_SESSION['bruteforceConAdmin'] = 0;
    if($_SESSION['bruteforceConAdmin'] < 3){
        $connexions= new ConnexionAdmins();
        if($connexions->connexion_post()) header("Location: index.php?p=ajoutMots");
        else {
            if (isset($_SESSION['errors'])){
                echo '<ul>';
                foreach($_SESSION['errors'] as $error){
                    echo '<li>' . $error . '</li>';
                }
                echo '</ul>';
            }
            $_SESSION['bruteforceConAdmin']++;
            echo 'Mauvais identifiants';
        }
    }else{
        echo 'Vous avez été bloqué pour 1 minute';
        sleep(60);
        $_SESSION['bruteforceConAdmin'] = 0;
    }
}
?>

<h1> Connexion </h1>
<form action="index.php?p=connexionAdmins" method="post">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" required>
    <br>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <br>
    <input type="submit" value="Me connecter">
</form>