<?php
    $idMessage = null;
    if(isset($_REQUEST['idMessage'])){
        $idMessage = $_REQUEST['idMessage'];
    }

?>
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

    <main>
            
<!-- Formulaire -->

        <div class="form">

            <h2> Connectez-vous</h2>

            <form method="POST" action="auth.php">
                <label>Nom d'utilisateur  </label> :  </br><input type="text" name="username" size="500" /></br>
                <label>Mot de passe       </label> :  </br><input type="password" name="password" size="500" /></br>
                <button type="submit">Connexion </button></br>
            </form>

        </div>
        <p class="message">
        <?php
                
                switch ($idMessage)
                { 
                    case 1: // dans le cas où $idMessage vaut 1
                        echo "Identifiant incorrect";
                    break;
                    
                    case 2: // dans le cas où $idMessage vaut 2
                        echo "Deconnexion réussi";
                    break;
                    case 3: // dans le cas où $idMessage vaut 3
                        echo "Inscription validée";
                    break;
                    
                    default:
                        echo "Veuilliez vous authentifiez";
                }
        ?>
        </p>
<!-- Liens -->

        <div class="lien">

            <p><a href="forget.php">Mot de passe oublié ?</a></p>
            <p>Pas encore inscrit ? <a href="registre.php">S'inscrire</a></p>

        </div>    

    </main>
        
<!-- Pied de page -->

        <?php require_once 'footer.php' ?>

    </body>
</html>