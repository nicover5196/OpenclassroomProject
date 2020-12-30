<?php 
 session_start(); // demarrage des sessions
 require_once 'connect_bdd.php'; // on inclut la base de données
    
    $id = $_REQUEST['id'];
    $statementActeur = $bdd->prepare('SELECT * FROM acteur WHERE id_acteur=:id'); // On récupère tout le contenu de la table acteur
    $statementActeur->bindParam(':id', $id);
    $statementActeur->execute();
    
?>
<?php 
    $compte = $bdd->query('SELECT * FROM compte'); // On récupère tout le contenu de la table compte
        $account = $compte->fetch();
?>
<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>GBAF</title>
        <link rel="stylesheet" href="styles.css" type="text/css" />
    </head>
    <body>

    <?php require_once 'header.php'; ?>

<!-- Acteur  -->

    <?php

    if ($acteur = $statementActeur->fetch()) // Après avoir définit la variable par une autre comprenant le contenu située plus haut, je peux l'utiliser pour afficher le contenu de la table sur ma base de donnée.
    {

    ?>
        <div class="act1">
            
            <img src="img/<?= $acteur['logo']?>" alt="logo">
            <h2><?php echo $acteur['acteur']; ?></h2>
            <a href="#"><?php echo $acteur['acteur'];?></a>
            <p><?php echo nl2br(htmlspecialchars($acteur['description'])); ?></p>
            
    </div>
    <div class="vote">
        <?php 
            $like = $bdd->prepare('SELECT COUNT(vote) AS nb_like FROM vote WHERE id_acteur = ? AND vote = 1'); // On récupère tout le contenu suivant le select de la table vote
            $like->execute(array(htmlspecialchars($_GET['id'])));
            $data_like = $like->fetch(); // Après avoir définit la variable et se qu'elle représente, je peux l'utiliser
            
            $dislike = $bdd->prepare('SELECT COUNT(vote) AS nb_dislike FROM vote WHERE id_acteur = ? AND vote = -1'); // On récupère tout le contenu suivant le select de la table vote
            $dislike->execute(array(htmlspecialchars($_GET['id'])));
            $data_dislike = $dislike->fetch(); // Après avoir définit la variable et se qu'elle représente, je peux l'utiliser
        ?>   
        <button><div class="like"><?php echo $data_like['nb_like'];?> <a href="vote_cible.php?vote=1&id_acteur=<?=$acteur['id_acteur']?>">J'aime</a></div></button> <!-- Utilisatation de la variable pour afficher les données -->
        <button><div class="dislike"><?php echo $data_dislike['nb_dislike'];?> <a href="vote_cible.php?vote=-1&id_acteur=<?=$acteur['id_acteur']?>">Je n'aime pas</a></div></button> <!-- Utilisatation de la variable pour afficher les données -->

    </div>
    <?php
    }
    ?>

<!-- Section Commentaire -->

    <div class="commentaire">
            
        <h2>Commentaires :</h2>

        <form action="comment_cible.php" method="post"> <!-- Formulaire renvoyant sur comment_cible -->
            <p>
                <input id="com" type="text" name="post" />
                <input type="hidden" name="id_acteur" value="<?= $acteur['id_acteur'] ?>"/></br></br>
                <input id="sub" type="submit" value="poster ou modifier mon commentaire" />
            </p>
        </form>
        <?php
        if(isset($_GET['modif']))
        {
            $hidden = htmlspecialchars($_GET['modif']);
            switch($hidden)
                {
                    case 1: // dans le cas où modif vaut 1 (Premier com)
                        echo "Commentaire envoyée";
                    break;
                    
                    case 2: // dans le cas où modif vaut 2 (Si premier com a été fait, on peux modif le com)
                        echo "Modification réussi";
                    break;
                }
        }
        ?>
    </div>
    <div class="commentaire_post">
            <?php
            
            $get = htmlspecialchars($_GET['id']); // Je récupère la valeur id dans l'url avec get
            $r = $bdd->prepare('SELECT compte.id_user, post.post, compte.nom, compte.prenom, post.date_add FROM post, compte WHERE id_acteur = ? AND post.id_user=compte.id_user'); // On récupère tout le contenu suivant le select de la table compte/post
            $r->execute(array($get));
            
            while ($donnees = $r->fetch())
            {
                echo  '</br>'.'<strong>' . htmlspecialchars($donnees['prenom']).' '. htmlspecialchars($donnees['nom']) .' : '.'</strong>'. '</br>' .
                    htmlspecialchars($donnees['date_add']).' : '. htmlspecialchars($donnees['post']);
            }

            ?>
    </div>
<!-- Pied de page -->

        <?php require_once 'footer.php'; ?>

    </body>
</html>


