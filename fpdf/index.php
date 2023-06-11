<?php
require('fpdf.php');

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
function LoadData($file)
{
    // Lecture des lignes du fichier
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}
// Tableau amélioré
function ImprovedTable($header, $data)
{
    // Largeurs des colonnes
    $w = array(20, 85, 30, 40, 20);
    // En-tête
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],0,0);
    $this->Ln(7);
    // Données
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0]);
        $this->Cell($w[1],6,$row[1]);
        $this->Cell($w[2],6,$row[2]);
        $this->Cell($w[3],6,$row[3]);
        $this->Ln();
    }
    // Trait de terminaison
    // $this->Cell(array_sum($w),0,'','T');
}

}
$labels = array(
    'Date de : ' ,
    'Nom : RAKOTO Jean',
    'Facture n  :',
);
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

$header = array('Achat', 'Quantite', 'Prix', 'Total');
// Chargement des données
$data = $pdf->LoadData('donnees.txt');
$pdf->SetFont('Times','',12);
$pdf->ImprovedTable($header,$data);
$header = array('', 'Semestre 1', '30', 'Note/20', 'Resultat');


$pdf->Output();
?>