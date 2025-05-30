<?php
/**
 * Nom del fitxer: usuaris_taula.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Mostra una taula amb usuaris i indica si són majors d’edat.
 */

$usuaris = [
    ["nom" => "Anna", "correu" => "anna@example.com", "edat" => 17],
    ["nom" => "Joel", "correu" => "joel@example.com", "edat" => 21],
    ["nom" => "Pau", "correu" => "pau@example.com", "edat" => 18]
];

function esMajorEdat($edat) {
    return $edat >= 18 ? "Sí" : "No";
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Llista d’usuaris</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Nom</th>
            <th>Correu</th>
            <th>Edat</th>
            <th>Major d’edat</th>
        </tr>
        <?php foreach ($usuaris as $usuari): ?>
            <tr>
                <td><?= $usuari['nom'] ?></td>
                <td><?= $usuari['correu'] ?></td>
                <td><?= $usuari['edat'] ?></td>
                <td><?= esMajorEdat($usuari['edat']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
