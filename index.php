<?php
include("function/connexion.php");
include("function/function.php");

$executClient = getClient();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
</head>
<style type="text/css">
 body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
  padding: 20px;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

nav li {
  display: inline-block;
  margin-right: 10px;
}

nav li a {
  color: grey;
  text-decoration: none;
  padding: 10px;
}

nav li a:hover {
  background-color: #4CAF50;
  color: #fff;
}

h1 {
  color: #333;
  text-align: center;
  margin-top: 20px;
}

form {
  margin: 20px auto;
  width: 300px;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
}

input[type="text"],
input[type="submit"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 10px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  cursor: pointer;
}

section {
  margin-top: 20px;
}

.liste_client {
  background-color: #fff;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h4 {
  margin-bottom: 5px;
}

a {
  color: blue;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}


</style>
<body>
  <nav>
    <ul>
      <li>Acceuil</li>
      <li><a href="index.php?ajout=ajout">Ajout Client</a></li>
    </ul>
  </nav>

  <h1>Ajout Client</h1>
  <form action="insertClient.php" method="get">
    <label>Nom</label>
    <input type="text" name="nom">
    <input type="submit" name="insertClient">
  </form>

  <h1>Devis</h1>
  <h3>Liste Client</h3>

  <section>
    <div class="liste_client">
      <?php 
      
        while($donneClient =mysqli_fetch_assoc($executClient)) { ?>
        <div>
        <h4><?php echo $donneClient['nom'] ?></h4>
        <a href="historique.php?idClient=<?php echo $donneClient['id_client']?>">historique</a>
        <br>
        <br>
        <a href="achat.php?idClient=<?php echo $donneClient['id_client']?>">Achat</a>
      </div>
    <?php } 
       ?>
      
      
    </div>
  </section>

</body>
</html>