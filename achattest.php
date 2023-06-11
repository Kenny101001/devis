<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Créer une instance de Dompdf
$dompdf = new Dompdf();

// Contenu HTML à convertir en PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Achat</title>
    <style>
        /* Votre style CSS ici */
    </style>
</head>
<body>
    <h1>Zone D\'Achat</h1>
    
    <div class="liste_achat">
        <table border="1">
            <tr>
                <th>Designation</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Total</th>
            </tr>';

// Boucle pour ajouter les données du tableau dans le PDF
while ($donneAchat = mysqli_fetch_assoc($executAchat)) {
    $html .= '
            <tr>
                <td>' . $donneAchat['achat'] . '</td>
                <td>' . $donneAchat['quantité'] . '</td>
                <td>' . $donneAchat['prix'] . '</td>
                <td>' . ($donneAchat['quantité'] * $donneAchat['prix']) . '</td>
            </tr>';
}

$html .= '
            <tr>
                <td colspan="3">Total</td>
                <td>' . $totalGlobal . '</td>
            </tr>
        </table>
    </div>

</body>
</html>';

// Charger le contenu HTML dans Dompdf
$dompdf->loadHtml($html);

// Rendre le PDF
$dompdf->render();

// Enregistrer le PDF sur le serveur
$dompdf->stream("nom_du_fichier.pdf");
?>
