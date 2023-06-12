<?php
include("function/connexion.php");
include("function/function.php");

if (isset($_GET['insert'])) {

	$nbDevis = $_GET['nbDevis'];

	insertAchat($_GET['idClient'],$_GET['achat'],$_GET['quantité'],$_GET['prix'],$_GET['tva'],$nbDevis);

}

header("Location: achat.php?idClient=".$_GET['idClient']);
exit;

?>