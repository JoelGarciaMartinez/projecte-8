<?php
// Activem la visibilitat d’errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mirem si l'usuari ha enviat el formulari
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recollim els valors del formulari de manera segura
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $pass = $_POST['contrasenya'] ?? '';

    // Connectem a la base de dades (Docker: servei 'db')
    $conn = new mysqli('db', 'root', 'root', 'autenticacio');

    // Verifiquem si hi ha error de connexió
    if ($conn->connect_error) {
        die("Ups! Error connectant: " . $conn->connect_error);
    }

    // Busquem l'usuari amb aquest correu
    $consulta = "SELECT contrasenya FROM usuaris WHERE email = ?";
    $preparada = $conn->prepare($consulta);

    if ($preparada) {
        $preparada->bind_param("s", $email);
        $preparada->execute();
        $preparada->store_result();

        if ($preparada->num_rows === 1) {
            $preparada->bind_result($hash_db);
            $preparada->fetch();

            // Comprovem la contrasenya
            if (password_verify($pass, $hash_db)) {
                echo "Benvingut/da! ✅";
            } else {
                echo "Contrasenya incorrecta 😵";
            }
        } else {
            echo "Aquest correu no existeix 🕵️‍♂️";
        }

        $preparada->close();
    } else {
        echo "Error inesperat preparant la consulta 😬";
    }

    $conn->close();
}
?>

<!-- Formulari HTML -->
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Accés d'usuaris</title>
</head>
<body>
    <h2>Entra al sistema</h2>
    <form method="post">
        <label for="email">Correu electrònic:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label for="contrasenya">Clau secreta:</label><br>
        <input type="password" name="contrasenya" id="contrasenya" required><br><br>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>
