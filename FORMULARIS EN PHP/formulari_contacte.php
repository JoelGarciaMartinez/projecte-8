<?php
/**
 * Nom del fitxer: formulari_contacte.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Formulari de contacte complet amb validació de camps i email, mostra errors i confirmació.
 */
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Formulari de Contacte</title>
    <style>
        .error { color: red; }
        .correcte { color: green; }
        label { display: block; margin-top: 10px; }
    </style>
</head>
<body>

<?php
$nom = $email = $assumpte = $missatge = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $assumpte = trim($_POST["assumpte"] ?? "");
    $missatge = trim($_POST["missatge"] ?? "");

    // Validació camps obligatoris
    if ($nom === "") {
        $errors[] = "El camp Nom és obligatori.";
    }
    if ($email === "") {
        $errors[] = "El camp Email és obligatori.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El correu electrònic no és vàlid.";
    }
    if ($assumpte === "") {
        $errors[] = "El camp Assumpte és obligatori.";
    }
    if ($missatge === "") {
        $errors[] = "El camp Missatge és obligatori.";
    }

    if (empty($errors)) {
        echo "<p class='correcte'>Gràcies per contactar amb nosaltres, <strong>" . htmlspecialchars($nom) . "</strong>. Hem rebut el teu missatge.</p>";
        // Aquí normalment es faria l'enviament de l'email o es processaria la dada
        exit; // No mostrarem el formulari després d'enviar correctament
    } else {
        echo "<ul class='error'>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
}
?>

<form method="post" action="">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($nom); ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

    <label for="assumpte">Assumpte:</label>
    <input type="text" id="assumpte" name="assumpte" value="<?php echo htmlspecialchars($assumpte); ?>" required>

    <label for="missatge">Missatge:</label>
    <textarea id="missatge" name="missatge" rows="5" cols="40" required><?php echo htmlspecialchars($missatge); ?></textarea>

    <br><br>
    <button type="submit">Enviar</button>
</form>

</body>
</html>
