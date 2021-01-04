<?php 
session_start(); // demarrage des sessions

// Utilisée la fonction obligeant l'utilisateur à se connecter pour accéder à la page
require_once 'function.php';
forcer_utilisateur_connecte();
?>

<?php

require_once 'connect_bdd.php'; // on inclut la base de données

// Récuperation de toute les données de la table acteur

    $PDO_listeActeur = $bdd->query('SELECT * FROM acteur');

?>

<!DOCTYPE html>
<html>

<!-- En tête de page -->

    <head>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" />
        <title>GBAF</title>

    </head>

<!-- Corp de la page  -->

    <body>

        <?php require_once 'header.php'; ?>

<!-- Page d'accueil -->

                <div class="accueil">

                    <h1>Le Groupement Banque Assurance Français</h1>

                    <p>Le Groupement Banque Assurance Français (GBAF) est une fédération
                    représentant les 6 grands groupes français :</p>

                    <ul>
                        <li>BNP Paribas</li>
                        <li>BPCE</li>
                        <li>Crédit Agricole</li>
                        <li>Crédit Mutuel-CIC</li>
                        <li>Société Générale</li>
                        <li>La Banque Postale</li>
                    </ul>   

                    <p>Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler
                    de la même façon pour gérer près de 80 millions de comptes sur le territoire
                    national.
                    Le GBAF est le représentant de la profession bancaire et des assureurs sur tous
                    les axes de la réglementation financière française. Sa mission est de promouvoir
                    l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des
                    pouvoirs publics</p>

                </div>

                <p><a href="img_css/paris.jpg"><img class="paris" src="img_css/paris.jpg" alt="paris"></p></a>

            <section>

<!--  Liste des acteur & description -->  

            <h2 class="border_h2">Liste des acteurs</h2>

             <p>
                 Le GBAF est le représentant de la profession bancaire et des assureurs sur tous
                les axes de la réglementation financière française.</br>
                Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des
                pouvoirs publics.
            </p>

<!-- Section PHP -->

            <?php

                    while ($acteur = $PDO_listeActeur->fetch())
                {
                    $lien = '<a href="acteur.php?id=' . $acteur['id_acteur'] . '">Lire la suite </a>';

            ?>
            
            <div class="actbloc">
                
                
                <a href="img/<?=$acteur['logo']?>"><img src="img_mini/<?=$acteur['logo']?>" alt="logo_acteur"></a>

                <h3><?php echo $acteur['acteur'];?></h3>

                <p><?php echo substr(htmlspecialchars($acteur['description']),0, 179);?>...</p><a href="#"><?php echo $acteur['acteur'];?></a>
                <div class="button">    
                    <button><?php echo ($lien); ?></button>
                </div>
            </div>
            
            <?php

                }

                $PDO_listeActeur->closeCursor(); // Termine le traitement de la requête

            ?>

            </section>

<!-- Pied de page -->

        <?php require 'footer.php' ?>

    </body>
</html>
