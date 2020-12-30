<?php
 session_start(); // demarrage des sessions
 require_once 'connect_bdd.php'; // on inclut la base de données

 if(!empty($_POST['id_acteur'])){ // si le post existe et si il n'est pas vide alors on continue
     $hidden = htmlspecialchars($_POST['id_acteur']); // on met dans htmlspecialchars pour éviter la faille XSS et on indique que hidden seras notre valeur 'id acteur'

     // On regarde dans la table post si il existe un commentaire avec l'id_user de la personne qui est connecté + l'id de l'article
     $req = $bdd->prepare('SELECT * FROM post WHERE id_user = :id_user AND id_acteur = :id_acteur'); 
     $req->execute(array(
         'id_user' => $_SESSION['id'],
         'id_acteur' => $hidden
     ));
     $data = $req->fetch();

     
     if($data == false){ // Si il n'y a pas de commentaire 
         
       $insert = $bdd->prepare('INSERT INTO post(id_user, id_acteur, date_add, post) VALUES(?,?,?,?)'); // On insert dans la table post les infos
       $insert->execute(array(
           $_SESSION['id'],
           $hidden,
           date('Y-m-d h:i:s'),
           htmlspecialchars($_POST['post'])
       ));
       
       header("Location: acteur.php?id=$hidden&modif=1"); // On redirige sur acteur.php + id + msg modif
       exit(); 
     }else{ //Sinon, on update l'article
       
       $req = $bdd->prepare('UPDATE post SET post = :post WHERE id_acteur = :id_acteur AND id_user = :id_user');
       $req->execute(array(
           'post' => htmlspecialchars($_POST['post']),
           'id_acteur' => $hidden,
           'id_user' => $_SESSION['id']
       ));
       
       header("Location: acteur.php?id=$hidden&modif=2"); // On redirige sur acteur.php + id + msg modif 
       exit();
     }
 }
 
?>

