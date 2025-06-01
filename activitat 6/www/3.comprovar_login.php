<?php
// Activem la visibilitat d'errors (només en desenvolupament, cuidado en producció!)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Comprovem que la petició sigui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recollim els camps del formulari
    $emailUsuari = $_POST['email'] ?? '';
    $clau = $_POST['contrasenya'] ?? '';

    // Obrim connexió amb la base de dades (Docker: servei db)
    $connexio = new mysqli('db', 'root', 'root', 'autenticacio');

    // Si peta la connexió...
    if ($connexio->connect_errno) {
        die("💥 Error de connexió amb la BD: " . $connexio->connect_error);
    }

    // Preparem la consulta per comprovar si l'usuari existeix
    $sql = "SELECT contrasenya FROM usuaris WHERE email = ?";
    $consulta = $connexio->prepare($sql);

    if ($consulta) {
        $consulta->bind_param("s", $emailUsuari);
        $consulta->execute();
        $consulta->store_result();

        if ($consulta->num_rows === 1) {
            $consulta->bind_result($hashBD);
            $consulta->fetch();

            if (password_verify($clau, $hashBD)) {
                echo "✅ Hola $emailUsuari! Has entrat amb èxit!";
            } else {
                echo "❌ Ups! Clau incorrecta.";
            }
        } else {
            echo "❌ No hi ha cap compte amb aquest correu.";
        }

        $consulta->close();
    } else {
        echo "🚨 No s'ha pogut preparar la consulta.";
    }

    $connexio->close();
} else {
    echo "⚠️ Has d'enviar el formulari via POST.";
}
?>
