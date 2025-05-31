<?php
$conn = new mysqli("localhost", "root", "", "usuaris");
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    if (!empty($nom) && !empty($email)) {
        $stmt = $conn->prepare("UPDATE clients SET nom = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nom, $email, $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error actualitzant client.";
        }

        $stmt->close();
    } else {
        echo "Si us plau, omple tots els camps.";
    }
}

// Obtenir dades client a editar
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT nom, email FROM clients WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nom, $email);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<h2>Editar client</h2>
<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    Nom: <input type="text" name="nom" value="<?php echo htmlspecialchars($nom); ?>" required><br><br>
    Email: <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>
    <input type="submit" value="Desar canvis">
</form>
<a href="index.php">Tornar enrere</a>
