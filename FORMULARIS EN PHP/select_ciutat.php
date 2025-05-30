<?php
/**
 * Nom del fitxer: select_ciutat.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Formulari amb menú desplegable per triar ciutat d’origen i mostrar la seleccionada.
 */
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Selecció Ciutat</title>
</head>
<body>

<form method="post">
    <label for="ciutat">Tria la teva ciutat d’origen:</label>
    <select name="ciutat" id="ciutat" required>
        <option value="" disabled selected>Selecciona...</option>
        <option value="Barcelona">Barcelona</option>
        <option value="València">València</option>
        <option value="Madrid">Madrid</option>
        <option value="Sevilla">Sevilla</option>
        <option value="Bilbao">Bilbao</option>
    </select>
    <button type="submit">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["ciutat"])) {
    $ciutat = htmlspecialchars($_POST["ciutat"]);
    echo "<p>Has seleccionat la ciutat: <strong>$ciutat</strong>.</p>";
}
?>

</body>
</html>
