<?php
/**
 * Nom del fitxer: formulari_reomplir.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Formulari amb 3 camps que reomple valors si hi ha errors.
 */
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Formulari amb Reomplir Valors</title>
</head>
<body>

<?php
$nom = $email = $missatge = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $missatge = trim($_POST["missatge"] ?? "");

    if ($nom === "") {
        $errors[] = "El camp Nom és obligatori.";
    }
    if ($email === "") {
        $errors[] = "El camp Correu electrònic és obligatori.";
    }
    if ($missatge === "") {
        $errors[] = "El camp Missatge és obligatori.";
    }

    if (empty($errors)) {
        echo "<h3>Dades enviades correctament:</h3>";
        echo "<p><strong>Nom:</strong> " . htmlspecialchars($nom) . "</p>";
        echo "<p><strong>Correu electrònic:</strong> " . htmlspecialchars($email) . "</p>";
        echo "<p><strong>Missatge:</strong> " . nl2br(htmlspecialchars($missatge)) . "</p>";
        exit; // Sortim per no mostrar el formulari després d'enviar correctament
    } else {
        echo "<ul style='color:red;'>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
}
?>

<form method="post">
    <label for="nom">Nom:</label><br>
    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($nom); ?>" required><br><br>

    <label for="email">Correu electrònic:</label><br>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>

    <label for="missatge">Missatge:</label><br>
    <textarea id="missatge" name="missatge" rows="4" cols="30" required><?php echo htmlspecialchars($missatge); ?></textarea><br><br>

    <button type="submit">Enviar</button>
</form>

</body>
</html>
