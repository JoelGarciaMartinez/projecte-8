<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $conn = new mysqli("localhost", "root", "", "usuaris");
    if ($conn->connect_error) {
        die("Connexió fallida: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("DELETE FROM clients WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: index.php");
        exit;
    } else {
        echo "Error eliminant client.";
    }
}
?>
