<?php
session_start();

// Connexió amb la base de dades (només si cal accedir-hi)
$connexio = new mysqli("db", "root", "root", "autenticacio");

if ($connexio->connect_errno) {
    die("No es pot connectar amb la base de dades 😵: " . $connexio->connect_error);
}

// Tancar sessió si s’indica
if (isset($_GET['fer']) && $_GET['fer'] === 'surt') {
    session_unset();
    session_destroy();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Si ja està autenticat, mostra la zona protegida
if (!empty($_SESSION['usuari_nom'])) {
    echo "<h1>Hola de nou, " . htmlspecialchars($_SESSION['usuari_nom']) . "!</h1>";
    echo "<p>Benvingut/da a l’espai privat 💼</p>";
    echo '<a href="?fer=surt">Sortir</a>';
    exit();
}

// Si arriben dades via POST (intent de login)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entrada_email = $_POST['email'] ?? '';
    $entrada_clau = $_POST['contrasenya'] ?? '';

    // Buscar usuari per email
    $consulta = $connexio->prepare("SELECT nom, contrasenya FROM usuaris WHERE email = ?");
    $consulta->bind_param("s", $entrada_email);
    $consulta->execute();
    $consulta->store_result();

    if ($consulta->num_rows === 1) {
        $consulta->bind_result($nom_obtingut, $hash_obtingut);
        $consulta->fetch();

        if (password_verify($entrada_clau, $hash_obtingut)) {
            // Dades vàlides, inici de sessió
            $_SESSION['usuari_nom'] = $nom_obtingut;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error = "🔐 Clau errònia!";
        }
    } else {
        $error = "🙈 No trobem cap usuari amb aquest correu.";
    }

    $consulta->close();
}

$connexio->close();
?>

<!-- FORMULARI HTML -->
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Accés restringit</title>
</head>
<body>
    <h2>Accedeix al teu espai</h2>
    <?php if (isset($error)) echo "<p style='color:crimson;'>$error</p>"; ?>

    <form method="POST">
        <label>
            Correu electrònic:<br>
            <input type="email" name="email" required>
        </label><br><br>

        <label>
            Contrasenya:<br>
            <input type="password" name="contrasenya" required>
        </label><br><br>

        <input type="submit" value="Entra-hi">
    </form>
</body>
</html>
