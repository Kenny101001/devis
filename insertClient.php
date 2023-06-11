<?php 
include("function/connexion.php");
include("function/function.php");

if(isset($_GET["insertClient"]))
{
  ajoutClient($_GET['nom']);
}

header("Location: index.php");
exit;

?>