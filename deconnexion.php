<?php

    // Deconnecte l'utilisateur et redirection vers se connecter

    session_start();
    unset($_SESSION['connecte']);
    header('Location: connexion.php?idMessage=2');
    
?>
