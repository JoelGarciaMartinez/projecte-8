<?php
/**
 * Nom del fitxer: taula_presentacio.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Crea una taula HTML amb etiquetes i valors personals generats amb PHP.
 */

$nom = "Joel Garcia";
$edat = 22;
$ciutat = "Barcelona";
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Taula de presentació</title>
</head>
<body>
    <h2>Informació personal</h2>
    <table border="1" cellpadding="5">
        <tr>
            <td><strong>Nom</strong></td>
            <td><?php echo $nom; ?></td>
        </tr>
        <tr>
            <td><strong>Edat</strong></td>
            <td><?php echo $edat; ?></td>
        </tr>
        <tr>
            <td><strong>Ciutat</strong></td>
            <td><?php echo $ciutat; ?></td>
        </tr>
    </table>
</body>
</html>
