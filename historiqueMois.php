<?php 
	include("function/connexion.php");
	include("function/function.php");
	$mois=$_POST['mois'];
	$valiny=getHistoMois($mois);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique mensuel</title>
</head>
<style>
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
<h1>Historique mensuel</h1>

    <table border="1">
                <tr>
                    <th>Nom du client</th>
                    <th>Mois</th>
                    <th>Total</th>
                </tr>

            <?php  while($donneAchat = mysqli_fetch_assoc($valiny)){ ?>
                        <tr>
                            <td><?php echo $donneAchat['nom'] ?></td>
                            <td><?php echo $donneAchat['mois'] ?></td>
                            <td><?php echo $donneAchat['total'] ?></td>
                        </tr>
                <?php } ?>
    </table>
</body>
</html>