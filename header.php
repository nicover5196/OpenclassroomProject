<?php 
    if (session_status() === PHP_SESSION_NONE)
    {
       session_start();
    }
    require_once 'function.php' ?>

    <header>
        <a href="index.php"><img src="img_css/gbaf_logo.png" alt="logo"></a>
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <div class="utilisateur">
            <ul>
            
                <?php if (est_connecte()): ?>
                    <li><button><a href="deconnexion.php"> Se déconnecter</a></button></li>
                <?php endif ?>
                <li><img src="img_css/utilisateur.jpg" alt="utilisateur"/> <?php echo $_SESSION['prenom'] . '.' . $_SESSION['nom']; ?></li>
            </ul>
        </div>
    </header>

   