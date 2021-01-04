<?php

require_once 'connect_bdd.php'; // on inclut la base de données

    $req = $bdd->prepare('SELECT * FROM compte WHERE username = :username'); //  On recupere tout le contenu de la table compte
    $req->execute(array('username' => $_POST['username']));
    $resultat = $req->fetch();

    $passwordcorrect = password_verify($_POST['password'], $resultat['password']);
    
    if (!$resultat) 
    {
        header ('Location: connexion.php?idMessage=1'); // Si c'est différent de la variable, on redirige sur la page de connexion en affichant un message correspondant à la valeur 1
    }

    else 
    {
        if(!empty($passwordcorrect)) // Si les champs ne sont pas vide et correspondent aux données enregistrer
        {
            session_start();
            $_SESSION['connecte'] = 1;
            $_SESSION['id'] = $resultat['id_user'];
            $_SESSION['prenom'] = $resultat['prenom'];
            $_SESSION['nom'] = $resultat['nom'];
            header('Location: index.php'); // On redirige sur index et on ouvre la session à l'utilisateur
            
        }
        else
        {
            header('Location: connexion.php'); // Si c'est différent de la variable, on redirige sur la page de connexion
        }
    }
    
?>
