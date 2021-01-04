<?php
 session_start(); // demarrage des sessions
 require_once 'connect_bdd.php'; // on inclut la base de données
 ?>
        
<?php

if(isset($_GET['id_acteur']) && !empty($_GET['id_acteur']) && isset($_GET['vote']) && !empty($_GET['vote'])){ // On détermine si la variable est existante
    // Check si il y a un vote 
    $check = $bdd->prepare('SELECT * FROM vote WHERE id_acteur = ? AND id_user = ?'); // On extrait les données de la table
    $check->execute(array(
        htmlspecialchars($_GET['id_acteur']),
        $_SESSION['id']
    ));
    $row = $check->rowCount(); // retourne le nombre de lignes affectées par la dernière requête

    if($row == 0){
        $insert = $bdd->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUES(?,?,?)'); // Si sa n'existe pas, on insert les données
        $insert->execute(array(
            $_SESSION['id'],
            htmlspecialchars($_GET['id_acteur']),
            htmlspecialchars($_GET['vote'])
        ));
        header('Location: acteur.php?id='.htmlspecialchars($_GET['id_acteur'])); // On redirige sur la page en utilisant l'url pour récupérer la valeur de l'acteur
        die();
    }else{
        $update = $bdd->prepare('UPDATE vote SET vote = ? WHERE id_acteur = ? AND id_user = ?'); // Si elle existe, on modifie la donnée
        $update->execute(array(
            htmlspecialchars($_GET['vote']),
            htmlspecialchars($_GET['id_acteur']),
            $_SESSION['id']
        ));
        header('Location: acteur.php?id='.htmlspecialchars($_GET['id_acteur'])); // On redirige sur la page en utilisant l'url pour récupérer la valeur de l'acteur
        die();
    }
}

?>
