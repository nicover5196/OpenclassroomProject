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
    <div class="centre">
        <?php
            require_once "connect_bdd.php";
            if(isset($_POST['password']) && isset($_POST['password_repeat']) && !empty($_POST['password']) && !empty($_POST['password_repeat'])    && isset($_POST['token']) 
                && isset($_POST['token'])){
                $password = htmlspecialchars($_POST['password']);
                $password_repeat = htmlspecialchars($_POST['password_repeat']);
                $token = htmlspecialchars($_POST['token']);

                if($password == $password_repeat){
                    $cost = ['cost' => 12];
                    $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                    $update = $bdd->prepare('UPDATE compte SET password = ? WHERE id_user = ?');
                    $update->execute(array($password, $token));
                    echo "Mot de passe modifié !";
                }else{echo "Re-tapez les mdp";}
            }
        ?>
    <p><button><a href="connexion.php">Se connecter</a></button></p>
    </div>
<!-- Pied de page -->

<?php require_once 'footer.php' ?>

</body>
</html>