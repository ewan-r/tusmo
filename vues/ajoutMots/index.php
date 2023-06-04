<?php
if (isset($_POST['mot'])){
    $ajoutMots = new AjoutMots();
    $ajoutMots->ajoutMots_post($_POST['mot']);
}
?>


<h1> Ajouter un mot </h1>
<form action="index.php?p=ajoutMots" method="post">
    <label for="mot">Mot</label>
    <input type="text" name="mot" id="mot" required>
    <input type="submit" value="Ajouter">
</form>