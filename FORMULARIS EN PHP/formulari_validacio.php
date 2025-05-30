<?php
/**
 * Nom del fitxer: formulari_validacio.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Formulari amb camps nom, correu electrònic i missatge amb validació bàsica.
 */
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Formulari Validació Bàsica</title>
</head>
<body>

<form method="post">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required>
    <br><br>
    <label for="correu">Correu electrònic:</label>
    <input type="email" id="correu" name="correu" required>
    <br><br>
    <label for="missatge">Missatge:</label><br>
    <textarea id="missatge" name="missatge" rows="4" cols="30" required></textarea>
    <br><br>
    <button type="submit">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $correu = trim($_POST["correu"] ?? "");
    $missatge = trim($_POST["missatge"] ?? "");

    if ($nom === "" || $correu === "" || $missatge === "") {
        echo "<p style='color:red;'>Tots els camps són obligatoris.</p>";
    } else {
        echo "<p>Nom: <strong>" . htmlspecialchars($nom) . "</strong></p>";
        echo "<p>Correu electrònic: <strong>" . htmlspecialchars($correu) . "</strong></p>";
        echo "<p>Missatge: <strong>" . nl2br(htmlspecialchars($missatge)) . "</strong></p>";
    }
}
?>

</body>
</html>
