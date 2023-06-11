<?php 
include("function/connexion.php");
include("function/function.php");

if (isset($_GET['idClient'])) {

	$id = $_GET['idClient'];

	$executAchat = getAchat($id);
}

if (isset($_GET['idClientHisto'])) {

	$id = $_GET['idClientHisto'];
	$nbDevis = $_GET['nbDevis'];

	$executAchatHisto = getAchatHisto($id,$nbDevis);
}

$nomClient = getClientNom($id);
$executInfo = getClientInfo($id);
$donneInfo = mysqli_fetch_assoc($executInfo);

$totalGlobal = 0;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Achat</title>
</head>

<style type="text/css">
	body {
			font-family: monospace, sans-serif;
		}

		h1 {
			color: #333;
			text-align: center;
			margin-top: 20px;
		}

		form {
			margin-top: 20px;
			text-align: center;
		}

		label {
			display: block;
			margin-bottom: 10px;
		}

		form {
			margin: 20px auto;
			width: 300px;
			padding: 20px;
			background-color: #f2f2f2;
			border-radius: 5px;
		}

		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}

		input[type="text"],
		input[type="number"],
		select {
			width: 100%;
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			margin-bottom: 10px;
		}

		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #45a049;
		}

		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 20px;
		}

		table th, table td {
			border: 1px solid #ccc;
			padding: 8px;
			text-align: left;
		}

		table th {
			background-color: #f2f2f2;
		}

		table tr:first-child th {
			vertical-align: middle;
		}

		table td a {
			color: blue;
			text-decoration: underline;
		}

		footer {
			background-color: #333;
			color: #fff;
			padding: 20px 0;
		}

		.container {
			max-width: 960px;
			margin: 0 auto;
			padding: 0 20px;
		}

		.footer-content {
			display: flex;
			justify-content: space-between;
			flex-wrap: wrap;
		}

		.footer-column {
			width: 30%;
			margin-bottom: 20px;
		}

		h3 {
			font-size: 18px;
			margin-bottom: 10px;
		}

		p {
			margin-bottom: 10px;
		}

		.social-icons {
			list-style: none;
			padding: 0;
		}

		.social-icons li {
			display: inline-block;
			margin-right: 10px;
		}

		.social-icons li a {
			color: #fff;
			font-size: 20px;
		}

		.social-icons li a:hover {
			color: #4CAF50;
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

	<h1>Zone D'Achat</h1>

	<?php 
	if (isset($_GET['idClient'])) { ?>
		<div class="formulaire">
			<form action="insertAchat.php" method="get">
				<label>Produit</label>
				<input type="text" name="achat">
				<label>Quantité</label>
				<input type="number" name="quantité" min="1" value="1">
				<label>Prix</label>
				<input type="number" name="prix" min="0" value="1">
				<input type="hidden" name="idClient" value="<?php echo $id ?>">
				<input type="hidden" name="nbDevis" value="<?php echo $donneInfo['nb_devis'] ?>">
				<input type="submit" name="insert">
			</form>
		</div>
	<?php }
	?>
	<?php $sommetotale=sumProduitClient($id); ?>
	<a href="index.php">Retour</a>
	<br>
	<br>

	<?php
	if (isset($_GET['idClient'])) { ?>
		<a href="fpdf/index.php?idClient=<?php echo $id; ?>&nomClient=<?php echo $nomClient; ?>&sum=<?php echo $sommetotale; ?>">Télécharger PDF</a>
	<?php }

	if (isset($_GET['idClientHisto'])) { ?>
		<a href="fpdf/index.php?idClient=<?php echo $id; ?>&nbDevis=<?php echo $nbDevis?>&nomClient=<?php echo $nomClient; ?>&sum=<?php echo $sommetotale; ?>">Télécharger PDF</a>
	<?php } ?>
	

	<div class="liste_achat">

		
		<table border="1">
			<tr>
				<th>Designation</th>
				<th>Quantité</th>
				<th>Prix</th>
				<th>Total</th>
				<th>TVA</th>
			</tr>

			<?php 
			if (isset($_GET['idClient'])) {
				while($donneAchat = mysqli_fetch_assoc($executAchat)){ ?>
					<tr>
						<td><input type="textfield" name="achat" value="<?php echo $donneAchat['achat'] ?>"></td>
						<td><?php echo $donneAchat['quantité'] ?></td>
						<td><?php echo $donneAchat['prix'] ?></td>
						<td><?php echo $total = ($donneAchat['quantité']*$donneAchat['prix']) ?></td>
						<td><?php echo $donneAchat['total_TVA'] ?></td>
					</tr>

					<?php $totalGlobal += $donneAchat['total_TVA']; ?>

					<?php
					$achat = array();
					$quantite = array();
					$prix = array();

					$achat[] = $donneAchat['achat'];
					$quantite[] = $donneAchat['quantité'];
					$prix[] = $donneAchat['prix'];
					?>


			<?php } ?>

			<br>
			<form action="insertHistoAchat.php" method="GET">
			<input type="text" name="nom" placeholder="Nom de l'achat" required>
			<input type="hidden" name="idClient" value="<?php echo $donneInfo['id_client'] ?>">
			<input type="hidden" name="nbDevis" value="<?php echo $donneInfo['nb_devis'] ?>">
			<input type="submit" name="validerAchat" value="Valider l'achat">
			</form>

			<?php } ?>


			<?php
			if (isset($_GET['idClientHisto'])) {

				while($donneAchat = mysqli_fetch_assoc($executAchatHisto)){ ?>
					<tr>
						<td><?php echo $donneAchat['achat'] ?></td>
						<td><?php echo $donneAchat['quantité'] ?></td>
						<td><?php echo $donneAchat['prix'] ?></td>
						<td><?php echo $total = ($donneAchat['quantité']*$donneAchat['prix']) ?></td>
						<td><?php echo $donneAchat['total_TVA'] ?></td>
					</tr>

					<?php $totalGlobal += $donneAchat['total_TVA']; ?>

			<?php } 
			} ?>


			<tr>
				<td colspan="4">Total</td>
				<td><?php echo $totalGlobal; ?></td>
			</tr>
		</table>

		
	</div>

</body>
</html>