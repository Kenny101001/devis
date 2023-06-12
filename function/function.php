<?php

function ajoutClient($nom)
{
    include("function/connexion.php");

    $sqlav = "INSERT INTO `client`(`nom`) VALUES ('%s')";

    $sqlav = sprintf($sqlav, $nom);

    $executav = mysqli_query($bdd, $sqlav);
}

function getClient()
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `client` ";

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function getClientInfo($id)
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `client` where id_client = %d";
    $sql = sprintf($sql, $id);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function insertAchat($id, $achat,$quantite,$prix,$nbDevis)
{
    include("function/connexion.php");

    $prixTva = ($prix+(($prix*20)/100))*$quantite;

    $sql = "INSERT INTO `Achat`(`id_client`, `achat`, `quantité`, `prix`, `total`,`total_TVA`,`nb_devis`) VALUES (%d,'%s',%d,%d,%d,%d,%d)";
    $sql = sprintf($sql, $id, $achat,$quantite,$prix,($quantite*$prix),$prixTva,$nbDevis);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;   
}
function updateNbDevis($idClient,$nbDevis){

    include("function/connexion.php");

    $sql = "UPDATE `client` SET `nb_devis`= %d WHERE id_client = %d ";
    $sql = sprintf($sql,$nbDevis, $idClient);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;   
}

function getAchat($id)
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `Achat` where id_client = %d ";
    $sql = sprintf($sql, $id);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function deleteAchat($id)
{
    include("function/connexion.php");

    $sql = "DELETE FROM `Achat` WHERE id_client = %d ";
    $sql = sprintf($sql, $id);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function insertAchatHisto($id, $achat,$quantite,$prix, $Totaltva,$nbDevis)
{
    include("function/connexion.php");

    $sql = "INSERT INTO `AchatHistorique`(`id_client`, `achat`, `quantité`, `prix`, `total`,`total_TVA`,`nb_devis`) VALUES (%d,'%s',%d,%d,%d,%d,%d)";

    $sql = sprintf($sql, $id, $achat,$quantite,$prix,($quantite*$prix),$Totaltva,$nbDevis);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;  
}

function getAchatHisto($id, $nbDevis)
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `AchatHistorique` where id_client = %d AND nb_devis = %d";
    $sql = sprintf($sql, $id, $nbDevis);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function insertHistorique($idClient,$designation,$nbDevis)
{
    include("function/connexion.php");

    $sql = "INSERT INTO `historique` VALUES ( %d,'%s',%d,NOW())";

    $sql = sprintf($sql, $idClient, $designation,$nbDevis);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function getHisorique($id)
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `historique` where id_client = %d ";
    $sql = sprintf($sql, $id);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function ValidationAchat($idClient,$designation, $nbDevis)
{
    include("function/connexion.php");

    $executAchat = getAchat($idClient);

    while($donneAchat = mysqli_fetch_assoc($executAchat))
    {
       insertAchatHisto($donneAchat['id_client'] , $donneAchat['achat'], $donneAchat['quantité'], $donneAchat['prix'],$donneAchat['total_TVA'] ,$donneAchat['nb_devis']); 
    }

    insertHistorique($idClient,$designation,$nbDevis);

    $nbDevis += 1;
    updateNbDevis($idClient,$nbDevis);

    deleteAchat($idClient);
}

function getHistoriquePrix($idClient, $nbDevis)
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `AchatHistorique` where id_client = %d And nb_devis = %d";
    $sql = sprintf($sql, $idClient, $nbDevis);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function getAchatPDF($id)
{
    include("../function/connexion.php");

    $sql = "select achat ,quantité ,prix, prix*quantité,total_TVA from achat where id_client = %d";
    $sql = sprintf($sql, $id);

    $execut = mysqli_query($bdd, $sql);
    $result = array();
    while ($data = mysqli_fetch_array($execut)) {
        $result[] = $data;
    }
    mysqli_free_result($execut);
    return $result;
}
function getClientNom($id)
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `client` where id_client = %d";
    $sql = sprintf($sql, $id);

    $execut = mysqli_query($bdd, $sql);
    while ($data = mysqli_fetch_assoc($execut)) {
        $nom = $data['nom'];
    }
    mysqli_free_result($execut);
    return $nom;
}

function getAchatHistoPDF($id, $nbDevis)
{
    include("../function/connexion.php");

    $sql = "SELECT * FROM `AchatHistorique` where id_client = %d AND nb_devis = %d";
    $sql = sprintf($sql, $id, $nbDevis);

    $execut = mysqli_query($bdd, $sql);

    $donnee = mysqli_fetch_assoc($execut);

    return $donnee;
}

function getPrixmois()
{
    include("../function/connexion.php");

    $sql = "SELECT * FROM `V_prixTotal_mois` where id_client = %d ";
    
    $execut = mysqli_query($bdd, $sql);

    $donnee = mysqli_fetch_assoc($execut);

    return $donnee;

}

function sumProduitClient($id)
{
    include("function/connexion.php");


    $sql = "select SUM(total_TVA*quantité) as sum from achat where id_client = %d";
    $sql = sprintf($sql, $id);

    $execut = mysqli_query($bdd, $sql);
    while ($data = mysqli_fetch_assoc($execut)) {
        $sum = $data['sum'];
    }
    mysqli_free_result($execut);
    return $sum;
}
?>