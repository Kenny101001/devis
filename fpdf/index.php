<?php
require('fpdf.php');
include("../function/connexion.php");
include("../function/function.php");

$id = $_GET['idClient'];
$idHisto = $_GET['idHisto'];
$nomClient = $_GET['nomClient'];


    $nbDevis = $_GET['nbDevis'];
    $executAchat = getAchatHistoPDF($id,$nbDevis);
    $executDate = getDateAchat($_GET['idClient'],$_GET['nbDevis']);

class PDF extends FPDF
{
    
// En-tête
function Header()
{
    // Logo
    $this->SetFont('Times','B',10);
    $this->SetTextColor(196,201,199);
    // Décalage à droite
    $this->Cell(130);
    // Titre
    $this->Cell(30,10,'',0,0,'C');
    $this->Ln(5);
    // Police Times gras 15
    $this->SetFont('Times','B',13);
    $this->SetTextColor(34,66,124);
    // Décalage à droite
    $this->Cell(80);
    // Titre
    $this->Cell(30,40,'FACTURE',0,0,'C');
    
    // Saut de ligne
    $this->Ln(27);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Times italique 8
    $this->SetFont('Times','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
private $data;
function LoadData()
{
    // Lecture des lignes du fichier
    $data = array();
    $this->data = $data;
    return $data;
}
// Tableau amélioré
function ImprovedTable($header, $data)
{
    // Largeurs des colonnes
    $w = array(20, 30, 40, 40, 40,30);
    // En-tête
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],0,0);
    $this->Ln(7);
    // Données
    foreach($data as $row)
    {
        $this->Cell($w[0],10,$row[0]);
        $this->Cell($w[1],10,$row[1]);
        $this->Cell($w[2],10,$row[2]);
        $this->Cell($w[3],10,$row[3]);
        $this->Cell($w[4],10,$row[4]);
        $this->Cell($w[5],10,$row[5]);
        $this->Ln();
        
    }
    // Trait de terminaison
    $this->Cell(30,40,'Total TTC : '. $_GET['sum'].'  Ariary' ,0,0,'B');

    // $this->Cell(array_sum($w),0,'','T');
}

}
$labels = array(
    'Date de : '.$executDate,
    'Nom du client : '. $nomClient,
    'Facture n  : ' .$idHisto,
);
$data = $executAchat;

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
// for($i=1;$i<=40;$i++)
foreach ($labels as $label) {
    $pdf->Cell(10);
    $pdf->Cell(0,7,$label,0,1);
}
$pdf->Ln(10);

$header = array('Achat', 'Quantite', 'Prix Unitaire', 'Total','% TVA','Total TVA');
// Chargement des données
$pdf->LoadData($data);
$pdf->SetFont('Times','',12);
$pdf->ImprovedTable($header,$data);

$pdf->Output();
?>