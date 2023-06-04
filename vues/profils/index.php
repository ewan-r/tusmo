<?php
session_start();
require_once 'models/User.php';

$user = new User();
$user->findByPseudo($_SESSION['pseudo']);
echo "Bienvenue " . $user->getPseudo() . " !";
echo "<br>";
echo "Votre niveau actuel est : " . $user->getLevel();
echo "<br>";
?>