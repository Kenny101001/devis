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
    $sql = "INSERT INTO `historique`(`id_client`, `designation`, `nb_devis`) VALUES ( %d,'%s',%d)";

    $sql = sprintf($sql, $id, $designation,$nbDevis);

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

    $executAchat = getAchat($id);

    while($donneAchat = mysqli_fetch_assoc($executAchat))
    {
       insertAchatHisto($donneAchat['id_client'] , $donneAchat['achat'], $donneAchat['quantité'], $donneAchat['prix'], $donneAchat['nb_devis']); 
    }

    insertHistorique($idClient,$designation,$nbDevis);

    deleteAchat($idClient);
}

////////////

function selectSecteur()
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `secteur` ";

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function getInfo()
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `information` ";

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function getInfoPrecis($id)
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `information` where `idDesignation` = %d";

    $sql = sprintf($sql, $id);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function getDepense()
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `depense` ";

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function getDepensePrecis($id)
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `depense` where `idDepense` = %d";

    $sql = sprintf($sql, $id);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function getDepenseLast()
{
    include("function/connexion.php");

    $sql = "SELECT MAX(idDepense) as max FROM `depense`";

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

function ajoutDepense($nom, $unité, $nature)
{
    include("function/connexion.php");

    $sqlav = "INSERT INTO `depense`(`designation`, `unite_oeuvre`, `nature`) VALUES ('%s','%s','%s')";

    $sqlav = sprintf($sqlav, $nom,$unité,$nature);

    $executav = mysqli_query($bdd, $sqlav);
}

function ajoutPF($idDesignation,$idsecteur,$prixF)
{
    include("function/connexion.php");

    $sql = "INSERT INTO `information`(`idDesignation`, `idSecteur`, `P_fixe`, `P_variable`)VALUES (%d,%d,%d,0)";

    $sql = sprintf($sql, $idDesignation,$idsecteur,$prixF);

    $execut = mysqli_query($bdd, $sql);

    return $execut;
}

function ajoutPV($idDesignation,$idsecteur,$prixV)
{
    include("function/connexion.php");
    
    $sql = "INSERT INTO `information`(`idDesignation`, `idSecteur`, `P_fixe`, `P_variable`)VALUES (%d,%d,0,%d)";

    $sql = sprintf($sql, $idDesignation,$idsecteur,$prixV);

    $execut = mysqli_query($bdd, $sql);

    return $execut;
}
function modif($prixF,$prixV,$idDesignation,$idSecteur)
{
    include("function/connexion.php");
    
    $sql = "UPDATE `information` SET `P_fixe` = %d , `P_variable` = %d WHERE `idDesignation` =  %d  AND `idSecteur` = %d";

    $sql = sprintf($sql, $prixF,$prixV,$idDesignation,$idSecteur);

    $execut = mysqli_query($bdd, $sql);

    return $execut;
}

function modif_P_fixe($prixF,$idDesignation,$idSecteur)
{
    include("function/connexion.php");
    
    $sql = "UPDATE `information` SET `P_fixe` = %d WHERE `idDesignation` =  %d  AND `idSecteur` = %d";

    $sql = sprintf($sql, $prixF,$idDesignation,$idSecteur);

    $execut = mysqli_query($bdd, $sql);

    return $execut;
}

function modif_P_Var($prixV,$idDesignation,$idSecteur)
{
    include("function/connexion.php");
    
    $sql = "UPDATE `information` SET `P_variable` = %d WHERE `idDesignation` =  %d  AND `idSecteur` = %d";

    $sql = sprintf($sql, $prixV,$idDesignation,$idSecteur);

    $execut = mysqli_query($bdd, $sql);

    return $execut;
}

function getDataPrecis($id)
{
    include("function/connexion.php");

    $sql = "SELECT * FROM `data` where `idDesignation` = %d";

    $sql = sprintf($sql, $id);

    $execut = mysqli_query($bdd, $sql);

    // $donnee = mysqli_fetch_assoc($execut);

    return $execut;
}

?>