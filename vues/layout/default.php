<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <header>
        <h1>tusmo</h1>
    </header>
    <body>
    <div class=bandeau>
        <nav>
            <ul>
                <li><a href="index.php?p=accueils">Accueil</a></li>
                <li><a href="index.php?p=mots">Mots</a></li>
                <?php if(isset($_SESSION['success'])){
                    echo "<li><a href='index.php?p=profils'>Profil</a></li>";
                    echo "<li><a href='index.php?p=deconnexions'>Déconnexion</a></li>";
                }
                else{
                    echo "<li><a href='index.php?p=connexions'>Connexion</a></li>";
                }?>
            </ul>
        </nav>
    </div>
    <div class="containers">
        <main>
            <?= $content; ?>
        </main>
    </div>
    </body>
</html>
