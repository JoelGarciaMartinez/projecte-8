<?php
if (!isset($_GET['id'])) {
    die("No s'ha especificat cap llibre per eliminar.");
}

$id = intval($_GET['id']);

$conn = new mysqli("localhost", "root", "", "biblioteca");
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Sentència preparada per eliminar el llibre
$stmt = $conn->prepare("DELETE FROM llibres WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    // Redirigim a la pàgina principal amb confirmació
    header("Location: index.php?eliminat=1");
    exit();
} else {
    echo "Error eliminant el llibre: " . $conn->error;
}
?>
