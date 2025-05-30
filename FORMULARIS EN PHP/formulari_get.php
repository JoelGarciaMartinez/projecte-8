<?php
/**
 * Nom del fitxer: formulari_get.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Formulari amb camps nom i edat, amb mètode GET, que mostra les dades rebudes.
 */
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Formulari GET</title>
</head>
<body>

<form method="get">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required>
    <br><br>
    <label for="edat">Edat:</label>
    <input type="number" id="edat" name="edat" min="0" required>
    <br><br>
    <button type="submit">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nom"]) && isset($_GET["edat"])) {
    $nom = htmlspecialchars($_GET["nom"]);
    $edat = (int)$_GET["edat"];
    echo "<p>Nom rebut: <strong>$nom</strong></p>";
    echo "<p>Edat rebuda: <strong>$edat</strong></p>";
}
?>

</body>
</html>
