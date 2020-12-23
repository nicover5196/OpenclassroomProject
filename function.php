<?php

// Si la session n'est pas active, j'ouvre la session

function est_connecte (): bool {
	if (session_status() === PHP_SESSION_NONE)
	 {
		session_start();
	 }
	return !empty($_SESSION['connecte']);
}

// Si l'utilisateur n'est pas connecter, rediriger vers connexion 

function forcer_utilisateur_connecte(): void 

	{
	if(!est_connecte())
	{
	   header('Location: connexion.php');
	   exit();
	}
   
}
?>