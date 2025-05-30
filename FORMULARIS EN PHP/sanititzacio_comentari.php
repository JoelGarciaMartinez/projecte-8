<?php
/**
 * Nom del fitxer: sanititzacio_comentari.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Formulari per enviar un comentari i mostrar-lo amb htmlspecialchars() per evitar injeccions.
 */
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Sanitització de Comentari</title>
</head>
<body>

<form method="post">
    <label for="comentari">Comentari:</label><br>
    <textarea id="comentari" name="comentari" rows="5" cols="40" required></textarea><br><br>
    <button type="submit">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $comentari = trim($_POST["comentari"] ?? "");
    if ($comentari !== "") {
        $comentari_sanititzat = htmlspecialchars($comentari);
        echo "<h3>Comentari rebut:</h3>";
        echo "<p>$comentari_sanititzat</p>";
    } else {
        echo "<p style='color:red;'>El camp comentari no pot estar buit.</p>";
    }
}
?>

</body>
</html>
