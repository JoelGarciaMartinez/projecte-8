<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    if (!empty($nom) && !empty($email)) {
        $conn = new mysqli("localhost", "root", "", "usuaris");
        if ($conn->connect_error) {
            die("Connexió fallida: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO clients (nom, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $nom, $email);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error en afegir client.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Si us plau, omple tots els camps.";
    }
}
?>

<h2>Afegir client nou</h2>
<form method="post" action="">
    Nom: <input type="text" name="nom" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    <input type="submit" value="Afegir">
</form>
<a href="index.php">Tornar enrere</a>
