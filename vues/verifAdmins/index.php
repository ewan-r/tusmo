<?php
session_start();
if(isset($_SESSION['bruteforceAdminTime']) && $_SESSION['bruteforceAdminTime'] + 300 > time()){
    echo 'Vous avez essayé 3 fois, veuillez attendre 5 minutes';
    header("Location: index.php?p=accueils");
}
if(!isset($_SESSION['bruteforceAdmin'])) $_SESSION['bruteforceAdmin'] = 0;
if(isset($_POST['password'])){
    $verif = new verifAdmins();
    if(!$verif->verif()){
        $_SESSION['bruteforceAdmin']++;
        if($_SESSION['bruteforceAdmin'] >= 3){
            echo 'Vous avez essayé 3 fois, veuillez attendre 5 minutes';
            $_SESSION['bruteforceAdmin'] = 0;
            $_SESSION['bruteforceAdminTime'] = time();
        }
    }
}
echo '<form action="index.php?p=verifAdmins" method="post">
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <br>
    <input type="submit" value="Vérifier">';