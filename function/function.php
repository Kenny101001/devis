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

function insertAchat($id, $achat,$quantite,$prix,$tva,$nbDevis)
{
    include("function/connexion.php");

    $prixTva = ($prix+(($prix*$tva)/100))*$quantite;

    $sql = "INSERT INTO `Achat`(`id_client`, `achat`, `quantité`, `prix`, `total`,`pourcentage_tva`,`total_TVA`,`nb_devis`) VALUES (%d,'%s',%d,%d,%d,%d,%d,%d)";
    $sql = sprintf($sql, $id, $achat,$quantite,$prix,($quantite*$prix),$tva,$prixTva,$nbDevis);

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

function insertAchatHisto($id, $achat,$quantite,$prix, $tva,$Totaltva,$nbDevis)
{
    include("function/connexion.php");

    $sql = "INSERT INTO `AchatHistorique`(`id_client`, `achat`, `quantité`, `prix`, `total`,`pourcentage_tva`,`total_TVA`,`nb_devis`) VALUES (%d,'%s',%d,%d,%d,%d,%d,%d)";

    $sql = sprintf($sql, $id, $achat,$quantite,$prix,($quantite*$prix),$tva,$Totaltva,$nbDevis);

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

function insertHistorique($idClient,$designation,$nbDevis, $date)
{
    include("function/connexion.php");

    // $sql = "INSERT INTO `historique`  (`id_client`, `designation`, `nb_devis`, `date`) VALUES (%d,'%s',%d,now())";
    $sql = "INSERT INTO `historique`  (`id_client`, `designation`, `nb_devis`, `date`) VALUES (%d,'%s',%d,'%s')";

    $sql = sprintf($sql, $idClient, $designation,$nbDevis, $date);

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

function ValidationAchat($idClient,$designation, $nbDevis, $date)
{
    include("function/connexion.php");

    $executAchat = getAchat($idClient);

    while($donneAchat = mysqli_fetch_assoc($executAchat))
    {
       insertAchatHisto($donneAchat['id_client'] , $donneAchat['achat'], $donneAchat['quantité'], $donneAchat['prix'],$donneAchat['pourcentage_tva'],$donneAchat['total_TVA'] ,$donneAchat['nb_devis']); 
    }

    insertHistorique($idClient,$designation,$nbDevis, $date);

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

    $sql = "select achat ,quantité ,prix, prix*quantité from AchatHistorique where id_client = %d";

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

    $sql = "SELECT achat ,quantité ,prix, (prix*quantité) as total, pourcentage_tva,total_TVA FROM `AchatHistorique` where id_client = %d AND nb_devis = %d";
    $sql = sprintf($sql, $id, $nbDevis);

    $execut = mysqli_query($bdd, $sql);

    $result = array();
    while ($data = mysqli_fetch_array($execut)) {
        $result[] = $data;
    }
    mysqli_free_result($execut);
    return $result;
}

function getPrixmois()
{
    include("../function/connexion.php");

    $sql = "SELECT * FROM `V_prixTotal_mois` where id_client = %d ";
    
    $execut = mysqli_query($bdd, $sql);

    $donnee = mysqli_fetch_assoc($execut);

    return $donnee;

}

function sumProduitClient($id,$nbDevis)
{
    include("function/connexion.php");

    $sql = "select SUM(total_TVA) as sum from AchatHistorique where id_client = %d and nb_devis = %d";

    $sql = sprintf($sql, $id,$nbDevis);

    $execut = mysqli_query($bdd, $sql);
    while ($data = mysqli_fetch_assoc($execut)) {
        $sum = $data['sum'];
    }
    mysqli_free_result($execut);
    return $sum;
}

function getDateAchat($idClient,$idHisto)
{
    include("../function/connexion.php");

    $sql = "SELECT `date` FROM `historique` where id_client = %d and nb_devis = %d";
    $sql = sprintf($sql, $idClient, $idHisto);

    $execut = mysqli_query($bdd, $sql);

    $donnee = mysqli_fetch_assoc($execut);

    return $donnee['date'];
}

function getTotalMois($idClient)
{
    include("function/connexion.php");

    $sql = "SELECT * from V_prixTotal_mois where id_client = %d";

    $sql = sprintf($sql, $idClient);

    $execut = mysqli_query($bdd, $sql);

    return $execut;
}

function getHistoMois($mois)
{
    include("function/connexion.php");

    $sql = "SELECT DISTINCT v_totalclient.id_client, nom, MonthName(historique.date) AS mois, v_totalclient.total FROM v_totalclient JOIN historique ON v_totalclient.id_client = historique.id_client WHERE MonthName(historique.date) = '%s' ORDER BY v_totalclient.id_client ";
    $sql = sprintf($sql, $mois);

    $execut = mysqli_query($bdd, $sql);
    return $execut;
}    

?>