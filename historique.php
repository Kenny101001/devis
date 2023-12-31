<?php 
include("function/connexion.php");
include("function/function.php");

if (isset($_GET['idClient'])) {

	$id = $_GET['idClient'];

	$executHisto = getHisorique($id);
	$executInfo = getClientInfo($id);

	$donneInfo = mysqli_fetch_assoc($executInfo);

	$executTotalMois = getTotalMois($_GET['idClient']);
}

$prixTotalDevis = 0;

$prixTotalDevisGlobal = 0;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Historique</title>
</head>
<style type="text/css">
	body {
	  font-family: Arial, sans-serif;
	  background-color: #f2f2f2;
	  padding: 20px;
	}

	h1 {
	  color: #333;
	  text-align: center;
	  margin-top: 20px;
	}

	h2 {
	  color: #333;
	  text-align: center;
	  margin-top: 10px;
	}

	ul {
	  list-style-type: none;
	  padding: 0;
	}

	li {
	  background-color: #fff;
	  padding: 10px;
	  margin-bottom: 10px;
	  border-radius: 4px;
	  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	}

	li:hover {
	  background-color: #f2f2f2;
	}
	
	a {
	  display: inline-block;
	  padding: 10px 20px;
	  background-color: #4CAF50;
	  color: white;
	  text-decoration: none;
	  border-radius: 4px;
	  transition: background-color 0.3s;
	}

	a:hover {
	  background-color: #45a049;
	}


</style>
<body>
	<h1>Historique</h1>
	<h2>de <?php echo $donneInfo['nom'] ?></h2>

	<a href="index.php">Retour</a>

	<div>
		<ul>
			<?php 
			if (isset($id)) {
				while($donneHisto = mysqli_fetch_assoc($executHisto))
				{ ?>

					<li><a href="achat.php?idClientHisto=<?php echo $donneHisto["id_client"] ?>&idHisto=<?php echo $donneHisto["id_historique"]?>&nbDevis=<?php echo $donneHisto["nb_devis"] ?>"> <?php echo $donneHisto["designation"]?> </a></li>

					<?php 
					$executPrixDevis = getHistoriquePrix($donneHisto["id_client"], $donneHisto["nb_devis"]);

					while($donnePrixDevis = mysqli_fetch_assoc($executPrixDevis)){
						$prixTotalDevis += ($donnePrixDevis['total_TVA']);

						$prixTotalDevisGlobal += ($donnePrixDevis['total_TVA']);
					} ?>

					<li>Pris total : <?php  echo $prixTotalDevis ?></li>


					<p><?php echo $donneHisto["date"]?></p>

					<?php $prixTotalDevis= 0; ?>
			<?php	}
			}
			?>
			
		</ul>
		<div>
			<ul>
				<?php while($donneTotalMois = mysqli_fetch_assoc($executTotalMois)) { ?>
					<li><?php echo $donneTotalMois['mois'] ?> : <?php echo $donneTotalMois['total'] ?></li>
				<?php }?>
				<li><p style="font-weight: bold";>total de tout les achats : <?php echo $prixTotalDevisGlobal ?></p></li>
			</ul>
		</div>
	</div>
</body>
</html>