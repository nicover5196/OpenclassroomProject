<?php

require_once 'connect_bdd.php';

//  On recupere tout le contenu de la table

    $req = $bdd->prepare('SELECT * FROM compte WHERE username = :username');
    $req->execute(array('username' => $_POST['username']));
    $resultat = $req->fetch();

    $passwordcorrect = $_POST['password'] == $resultat['password'];

    if (!$resultat)
    {
        header ('Location: connexion.php?idMessage=1');
    }

    else 
    {
        if(!empty($passwordcorrect))
        {
            session_start();
            $_SESSION['connecte'] = 1;
            $_SESSION['id'] = $resultat['id_user'];
            $_SESSION['prenom'] = $resultat['prenom'];
            $_SESSION['nom'] = $resultat['nom'];
            header('Location: index.php');
            
        }
        else
        {
            header('Location: connexion.php');
        }
    }
    
?>
