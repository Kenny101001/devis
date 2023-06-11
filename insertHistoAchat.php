<?php 
include("function/connexion.php");
include("function/function.php");

if (isset($_GET['validerAchat'])) {

	$idClient = $_GET['idClient'];
	$nbDevis = $_GET['nbDevis'];
	$nom = $_GET['nom'];

	ValidationAchat($idClient, $nom, $nbDevis);

}

header("Location: achat.php?idClient=".$_GET['idClient']);
exit;

?>