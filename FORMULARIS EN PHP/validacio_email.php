<?php
/**
 * Nom del fitxer: validacio_email.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Formulari per validar que un correu electrònic és vàlid amb FILTER_VALIDATE_EMAIL.
 */
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Validació de Correu Electrònic</title>
</head>
<body>

<form method="post">
    <label for="email">Correu electrònic:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"] ?? "");

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:green;'>El correu <strong>" . htmlspecialchars($email) . "</strong> és vàlid.</p>";
    } else {
        echo "<p style='color:red;'>El correu <strong>" . htmlspecialchars($email) . "</strong> no és vàlid. Torna-ho a provar.</p>";
    }
}
?>

</body>
</html>
