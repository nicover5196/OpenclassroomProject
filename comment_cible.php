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

     // Si il n'y a pas de commentaire 
     if($data == false){
         // On insert dans la table post les infos
       $insert = $bdd->prepare('INSERT INTO post(id_user, id_acteur, date_add, post) VALUES(?,?,?,?)');
       $insert->execute(array(
           $_SESSION['id'],
           $hidden,
           date('Y-m-d h:i:s'),
           htmlspecialchars($_POST['post'])
       ));
       // On redirige sur acteur.php + id + msg modif
       header("Location: acteur.php?id=$hidden&modif=1");
       exit(); 
     }else{
       // On update l'article
       $req = $bdd->prepare('UPDATE post SET post = :post WHERE id_acteur = :id_acteur AND id_user = :id_user');
       $req->execute(array(
           'post' => htmlspecialchars($_POST['post']),
           'id_acteur' => $hidden,
           'id_user' => $_SESSION['id']
       ));
       // On redirige sur acteur.php + id + msg modif 
       header("Location: acteur.php?id=$hidden&modif=2");
       exit();
     }
 }
 
// session_start();
// require_once 'connect_bdd.php';
// // var_dump($_POST);
// // var_dump($_SESSION);
// // INSERT INTO `post` (`id_post`, `id_user`, `id_acteur`, `date_add`, `post`) VALUES (NULL, '1', '1', CURRENT_TIMESTAMP, 'Bonjour les amis');
// $req = $bdd->prepare('SELECT * FROM `post` WHERE id_user = :id_user AND id_acteur = :id_acteur');
// $req->bindParam(':id_user', $_SESSION['id']);
// $req->bindParam(':id_acteur', $_POST['id_acteur']);
// $req->execute();
// $user = $req->fetch();
// var_dump($user);
// if($user == false)
// {
//     $req = $bdd->prepare('INSERT INTO post (id_user, id_acteur, date_add, post) VALUES(:id_user, :id_acteur,NOW(), :post)');
//     $req->execute(array('id_user' => $_SESSION['id'], 'id_acteur' => $_POST['id_acteur'],'post' => $_POST['post']));
//     header('Location: acteur.php?id='.$_POST['id_acteur']);
//     exit();
// }
// else
// {
//     $req = $bdd->prepare('UPDATE post SET post = :post WHERE post AND id_post = :id_post');
//     $req->execute(array('post' => $_POST['post']));
//     header('Location: acteur.php?id='.$_POST['id_acteur'], 'id_post' => '?');
//     exit();
// }
// UPDATE `post` SET `post` = 'Coucou' WHERE `post`.`id_post` = 11;

// header('Location: acteur.php?id='.$_POST['id_acteur']);
?>

