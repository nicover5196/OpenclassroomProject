<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css" type="text/css" media="all" />
        <title>GBAF</title>
    </head>
    
    <body>

<!-- tête de page -->

    <header>
            <a href="index.php"><img src="img_css/gbaf_logo.png"></a>
            <h1>Le Groupement Banque Assurance Français</h1>
    </header>

        <div class="mdp">
            <form action="recover.php" method="POST">
                    <label for="user">Nom d'utilisateur</label>
                    <input type="text" name="user" id="user">
                    <button type="submit" >Envoyer</button>
            </form>
        </div>
<!-- Pied de page -->

<?php require_once 'footer.php' ?>

</body>
</html>