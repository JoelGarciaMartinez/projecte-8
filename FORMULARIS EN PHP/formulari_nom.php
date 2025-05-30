<?php
/**
 * Nom del fitxer: formulari_nom.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Formulari amb un sol camp per introduir el nom i mostrar un missatge personalitzat.
 */
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Formulari de Nom</title>
</head>
<body>

<form method="post">
    <label for="nom">Escriu el teu nom:</label>
    <input type="text" id="nom" name="nom" required>
    <button type="submit">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["nom"])) {
    $nom = htmlspecialchars($_POST["nom"]);
    echo "<p>Benvingut/da, <strong>$nom</strong>!</p>";
}
?>

</body>
</html>
