<?php
include("function/connexion.php");
include("function/function.php");

if (isset($_GET['insert'])) {
	insertAchat($_GET['idClient'],$_GET['achat'],$_GET['quantité'],$_GET['prix']);
}

header("Location: achat.php?idClient=".$_GET['idClient']);
exit;

?>