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
            if(isset($_GET['token']) && !empty($_GET['token'])){
                $token = htmlspecialchars($_GET['token']);
                $token = base64_decode($token);

                $check = $bdd->prepare('SELECT * FROM compte WHERE id_user = ?');
                $check->execute(array($token));
                $data = $check->fetch();
                $row = $check->rowCount();

                if($row == 1){
                    ?>
                        <form action="recover_verify.php" method="POST">
                            <input type="hidden" name="token" value="<?php echo $token ?>">
                            <input type="text" name="question" value="<?php echo $data['question']; ?>">
                            <input type="text" name="reponse" placeholder="Reponse ?">
                            <button type="submit">Verifier</button>
                        </form>
                <?php 
                }else{
                    echo "Compte non existant";
                }
            }
        ?>
    </div>
<!-- Pied de page -->

<?php require_once 'footer.php' ?>

</body>
</html>