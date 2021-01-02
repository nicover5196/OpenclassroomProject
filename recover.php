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
            if(isset($_POST['user']) && !empty($_POST['user'])){
                $user = htmlspecialchars($_POST['user']);

                $get = $bdd->prepare('SELECT * FROM compte WHERE username = ?');
                $get->execute(array($user));
                $data = $get->fetch();
                $row = $get->rowCount();

                if($row == 1){
                    $data['id_user'] = base64_encode($data['id_user']);
                    $link = 'http://localhost/exercice/recover_send?token='.$data['id_user'];
                    echo "<a href='$link'>cliquez pour recover le mdp</a>";
                }else{
                    echo "Compte non existant";
                }
            }
?>
    </div>
<?php require_once 'footer.php' ?>

</body>
</html>