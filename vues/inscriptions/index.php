<?php
    session_start();
    if (isset($_SESSION['errors'])){
        echo '<ul>';
        foreach($_SESSION['errors'] as $error){
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
    }
    if (isset($_POST['pseudo'])&& isset($_POST['email'])&& isset($_POST['password'])&& isset($_POST['password_confirm'])){
        $inscriptions= new Inscriptions();
        $inscriptions->inscription_post();
    }

?>



<h1> Inscription </h1>
<form action="index.php?p=inscriptions" method="post">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo" required>
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <br>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" required>
    <br>
    <label for="password_confirm">Confirmation du mot de passe</label>
    <input type="password" name="password_confirm" id="password_confirm" required>
    <br>
    <input type="submit" value="M'inscrire">
</form>
