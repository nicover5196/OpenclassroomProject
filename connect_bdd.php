<?php

// On se connecte à MySQL

    try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=partenaires;charset=utf8', 'root', '');
        }

// En cas d'erreur, on affiche un message et on arrête tout

    catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
?>