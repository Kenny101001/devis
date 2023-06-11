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

function insertAchat($id, $achat,$quantite,$prix, $nbDevis)
{
    include("function/connexion.php");

    $sql = "INSERT INTO `Achat`(`id_client`, `achat`, `quantité`, `prix`, `nb_devis`) VALUES (%d,'%s',%d,%d,%d)";
    $sql = sprintf($sql, $id, $achat,$quantite,$prix,$nbDevis);

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

function insertAchatHisto($id, $achat,$quantite,$prix, $nbDevis)
{
    include("function/connexion.php");

    $sql = "INSERT INTO `AchatHistorique`(`id_client`, `achat`, `quantité`, `prix`, `nb_devis`) VALUES (%d,'%s',%d,%d,%d)";
    $sql = sprintf($sql, $id, $achat,$quantite,$prix,$nbDevis);

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

    $sql = "INSERT INTO `historique`(`id_client`, `designation`, `nb_devis`) VALUES ( %d,'%s',%d)";

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
       insertAchatHisto($donneAchat['id_client'] , $donneAchat['achat'], $donneAchat['quantité'], $donneAchat['prix'], $donneAchat['nb_devis']); 
    }

    insertHistorique($idClient,$designation,$nbDevis);

    $nbDevis += 1;
    updateNbDevis($nbDevis, $idClient);

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

    $sql = "SELECT * FROM `Achat` where id_client = %d ";
    $sql = sprintf($sql, $id);

    $execut = mysqli_query($bdd, $sql);

    $donnee = mysqli_fetch_assoc($execut);

    return $donnee;
}


?>