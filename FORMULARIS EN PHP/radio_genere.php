<?php
/**
 * Nom del fitxer: radio_genere.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Formulari amb radio buttons per seleccionar gènere i mostrar el triat.
 */
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Selecciona Gènere</title>
</head>
<body>

<form method="post">
    <p>Selecciona el teu gènere:</p>
    <label><input type="radio" name="genere" value="Home" required> Home</label><br>
    <label><input type="radio" name="genere" value="Dona"> Dona</label><br>
    <label><input type="radio" name="genere" value="Altres"> Altres</label><br>
    <br>
    <button type="submit">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["genere"])) {
    $genere = htmlspecialchars($_POST["genere"]);
    echo "<p>Has seleccionat el gènere: <strong>$genere</strong>.</p>";
}
?>

</body>
</html>
