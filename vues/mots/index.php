<?php
session_start();
require_once 'controllers/Users.php';
if($_SESSION['type'] != 'normal') header("Location: index.php?p=accueils");
if(!isset($_SESSION['success'])){
    header("Location: index.php?p=accueils");
}
if (isset($_POST['letter0_'.$_SESSION['essai']])) {
    $word = $_SESSION['word'];
    $_SESSION['essai']++;
    for($i=$_SESSION['essai']-1;$i<$_SESSION['essai'];$i++){
        for($j = 0; $j < strlen($word); $j++){
            if(strlen($_POST['letter'.$j.'_'.$i]) == 1){
                $_SESSION['letter'.$j.'_'.$i] = $_POST['letter'.$j.'_'.$i];
            }
            else{
                header("Location: index.php?p=mots");
            }
        }
    }
    $array = str_split($word);
    $color ="";
    echo "<form action='index.php?p=mots' method='post'>";
    for($i=0;$i<$_SESSION['essai'];$i++){
        echo "<tr>";
        for($j = 0; $j < strlen($word); $j++){
            if($_SESSION['letter'.$j.'_'.$i] == $array[$j]){
                $color = "green";
            }
            else{
                for($k = 0; $k < strlen($word); $k++){
                    if($_SESSION['letter'.$j.'_'.$i] == $array[$k]){
                        $color = "orange";
                    }
                }
                $color = "red";
            }
            echo "<td><input type='text' name='letter".$j."_".$i."' maxlength='1' size='1' value='". $_SESSION['letter'.$j.'_'.$i]."' disabled='disabled'></td>";
        }
        echo "</tr><br>";
    }
    $mot = "";
    for($i = 0;$i<strlen($word);$i++){
        $mot .= $_SESSION['letter'.$i.'_'.($_SESSION['essai']-1)];
    }
    if($mot == $word){
        $user = new Users();
        $user->updateLevel($_SESSION['pseudo']);
        echo "<p>Vous avez gagné !</p>";
        echo "<a href='index.php?p=mots'>Rejouer</a>";
    }
    else{
        if ($_SESSION['essai'] == 3) {
            echo "<p>Vous avez perdu !</p>";
            echo "<p>Le mot était : ".$_SESSION['word']."</p>";
            echo "<a href='index.php?p=mots'>Rejouer</a>";
        }
        else{
            for($j = 0; $j < strlen($word); $j++){
                echo "<td><input type='text' name='letter".$j."_".$_SESSION['essai']."' maxlength='1' size='1'></td>";
            }
            echo "<input type='submit' name='checkLetter' value='Vérifier'>";
            echo "</form>";
        }
    }
}
else{
    $mot = new Mots();
    $word = $mot->getWord();
    $_SESSION['essai'] = 0;
    $_SESSION['word'] = $word;

    echo "<form action='index.php?p=mots' method='post'>";
        for($j = 0; $j < strlen($word); $j++){
            echo "<td><input type='text' name='letter".$j."_".$_SESSION['essai']."' maxlength='1' size='1'></td>";
        }
    echo "<input type='submit' name='checkLetter' value='Vérifier'>";
    echo "</form>";
}
?>