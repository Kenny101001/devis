<?php 

//Uwamp
	// $bdd = mysqli_connect('localhost', 'root', 'root', 'statistique_mais');
	// mysqli_set_charset($bdd,"utf8");



//Xampp

$host = 'localhost'; // Nom d'hôte
$user = 'root'; // Nom d'utilisateur de la base de données
$password = 'root'; // Mot de passe de la base de données (par défaut, vide pour XAMPP)
$database = 'devis'; // Nom de la base de données

// Établir une connexion à la base de données
$bdd = mysqli_connect($host, $user, $password, $database);

// Vérifier si la connexion a réussi
if (!$bdd) {
    die('Erreur de connexion : ' . mysqli_connect_error());
}

// Définir le jeu de caractères de la connexion
mysqli_set_charset($bdd, 'utf8');


?>
