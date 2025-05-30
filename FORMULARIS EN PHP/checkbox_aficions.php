<?php
/**
 * Nom del fitxer: checkbox_aficions.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Formulari amb checkbox d’aficions que mostra les seleccionades en una llista.
 */
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Aficions - Checkbox</title>
</head>
<body>

<form method="post">
    <p>Selecciona les teves aficions:</p>
    <label><input type="checkbox" name="aficions[]" value="Llegir"> Llegir</label><br>
    <label><input type="checkbox" name="aficions[]" value="Esport"> Esport</label><br>
    <label><input type="checkbox" name="aficions[]" value="Música"> Música</label><br>
    <label><input type="checkbox" name="aficions[]" value="Cinema"> Cinema</label><br>
    <label><input type="checkbox" name="aficions[]" value="Jocs"> Jocs</label><br>
    <br>
    <button type="submit">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["aficions"])) {
    echo "<h3>Aficions seleccionades:</h3><ul>";
    foreach ($_POST["aficions"] as $aficio) {
        echo "<li>" . htmlspecialchars($aficio) . "</li>";
    }
    echo "</ul>";
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<p style='color:red;'>No has seleccionat cap afició.</p>";
}
?>

</body>
</html>
