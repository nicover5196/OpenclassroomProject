<?php

    require_once 'connect_bdd.php';
    
    if(isset($_POST['submit']))
    {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $question = htmlspecialchars($_POST['question']);
        $reponse = htmlspecialchars($_POST['reponse']);
    
        
        
        if((!empty($nom)) && (!empty($prenom)) && (!empty($username)) && (!empty($password)) && (!empty($question)) && (!empty($reponse)))
        {
            // Insertion du message à l'aide d'une requête préparée
            
            $req = $bdd->prepare('INSERT INTO compte (nom, prenom, username, password, question, reponse) VALUES(?,?,?,?,?,?)');
            $req->execute(array($nom, $prenom, $username, $password, $question, $reponse));
            header('Location: connexion.php?idMessage=3');
            exit();
        }           
    }
    // Redirection du visiteur vers la page d'inscription
    header('Location: registre.php');

?>