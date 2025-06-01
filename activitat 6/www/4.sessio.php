<?php
session_start();

// Errors visibles només per a desenvolupament
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Tancament de sessió si es prem el botó
if (isset($_POST['surt'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Si ja hi ha sessió iniciada, mostrar la zona protegida
if (isset($_SESSION['id'])) {
    echo "<h1>Hola, " . htmlspecialchars($_SESSION['nom']) . "!</h1>";
    echo "<p>Aquesta zona és privada, només per a iniciats 😎</p>";
    echo "<form method='post'><button type='submit' name='surt'>Sortir</button></form>";
    exit();
}

// Si ens han enviat les dades del formulari, comencem la màgia
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email']) && !empty($_POST['contrasenya'])) {
    $bd = new mysqli('db', 'root', 'root', 'autenticacio');

    if ($bd->connect_error) {
        die("Error de connexió: " . $bd->connect_error);
    }

    $correu = $_POST['email'];
    $clau = $_POST['contrasenya'];

    // Comprovem si existeix l'usuari
    $consulta = $bd->prepare("SELECT id, nom, contrasenya FROM usuaris WHERE email = ?");
    $consulta->bind_param("s", $correu);
    $consulta->execute();
    $resultat = $consulta->get_result();

    if ($resultat->num_rows === 1) {
        $fila = $resultat->fetch_assoc();

        if (password_verify($clau, $fila['contrasenya'])) {
            // Si tot quadra, iniciem sessió
            $_SESSION['id'] = $fila['id'];
            $_SESSION['nom'] = $fila['nom'];
            header("Location: login.php");
            exit();
        } else {
            $missatge = "❌ Clau incorrecta, torna-ho a provar.";
        }
    } else {
        $missatge = "❌ No hem trobat cap usuari amb aquest correu.";
    }

    $consulta->close();
    $bd->close();
}
?>

<!-- FORMULARI HTML -->
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Zona d'accés</title>
</head>
<body>
    <h2>Accedeix al sistema</h2>
    <?php if (isset($missatge)) echo "<p style='color:crimson;'>$missatge</p>"; ?>
    <form method="POST">
        <label>Correu electrònic:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Clau secreta:</label><br>
        <input type="password" name="contrasenya" required><br><br>

        <button type="submit">Endavant!</button>
    </form>
</body>
</html>
