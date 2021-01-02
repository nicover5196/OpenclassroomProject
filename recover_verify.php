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
            if(isset($_POST['question']) 
                && isset($_POST['reponse']) 
                && !empty($_POST['question']) 
                && !empty($_POST['reponse']) 
                && isset($_POST['token']) 
                && isset($_POST['token']))
            {
                $check = $bdd->prepare('SELECT * FROM compte WHERE question = ? AND id_user = ?');
                $check->execute(array(htmlspecialchars($_POST['question']), htmlspecialchars($_POST['token'])));
                $data = $check->fetch();
                $row = $check->rowCount();

                if($row == 1){
                    $reponse = $data['reponse'];
                    if($reponse == htmlspecialchars($_POST['reponse'])){
                    ?>
                        <form action="password_change.php" method="POST">
                            <input type="hidden" name="token" value="<?php echo $data['id_user']; ?>"/>
                            <input type="text" name="password" placeholder="nouveau mot de passe ?"/>
                            <input type="text" name="password_repeat" placeholder="re-tapez le mot de passe ?"/>
                            <button type="submit">Modifier</button>
                        </form>
                    <?php 
                    }else{echo "reponse pas correct";}
                }else{echo "compte non existant";}
            }
        ?>
    </div>
<!-- Pied de page -->

<?php require_once 'footer.php' ?>

</body>
</html>