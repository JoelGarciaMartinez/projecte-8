<?php
session_start();

// Errors en pantalla per debugging (desactiva en producció)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexió BDD
$db = new mysqli("db", "root", "root", "autenticacio");
if ($db->connect_error) {
    die("💥 Error de connexió: " . $db->connect_error);
}

// TANCAR SESSIÓ
if (isset($_GET['sortir'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?missatge=Sessió tancada amb èxit.");
    exit();
}

// LOGIN
$missatge_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $clau = $_POST['contrasenya'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $missatge_error = "⚠️ Correu invàlid.";
    } else {
        $stmt = $db->prepare("SELECT id, nom, contrasenya FROM usuaris WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 1) {
            $fila = $res->fetch_assoc();
            if (password_verify($clau, $fila['contrasenya'])) {
                $_SESSION['id_usuari'] = $fila['id'];
                $_SESSION['nom_usuari'] = $fila['nom'];
                header("Location: index.php");
                exit();
            } else {
                $missatge_error = "❌ La contrasenya no quadra.";
            }
        } else {
            $missatge_error = "❌ Cap usuari trobat amb aquest correu.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Accés al sistema</title>
</head>
<body>
<?php
// Missatges informatius
if (isset($_GET['missatge'])) {
    echo "<p style='color:green;'>✅ " . htmlspecialchars($_GET['missatge']) . "</p>";
}
if (!empty($missatge_error)) {
    echo "<p style='color:crimson;'>$missatge_error</p>";
}
?>

<?php if (isset($_SESSION['nom_usuari'])): ?>
    <!-- Zona protegida -->
    <h2>🎉 Hola, <?= htmlspecialchars($_SESSION['nom_usuari']) ?>!</h2>
    <p>Aquesta part és només per a usuaris amb accés.</p>
    <p><a href="index.php?sortir=1">Tanca la sessió</a></p>

<?php else: ?>
    <!-- Formulari d'accés -->
    <h2>Accedeix al teu compte</h2>
    <form method="POST" action="index.php">
        <label for="email">Correu electrònic:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label for="contrasenya">Contrasenya:</label><br>
        <input type="password" name="contrasenya" id="contrasenya" required><br><br>

        <button type="submit">Endavant!</button>
    </form>
<?php endif; ?>
</body>
</html>
