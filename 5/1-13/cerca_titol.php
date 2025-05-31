<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Cerca per paraula clau al títol</title>
</head>
<body>

<h2>Cerca llibres per paraula clau al títol</h2>
<form method="GET" action="">
    <label for="titol">Paraula clau:</label>
    <input type="text" name="titol" required>
    <input type="submit" value="Cercar">
</form>

<?php
if (isset($_GET['titol'])) {
    $titol = $_GET['titol'];

    // Connexió a la base de dades
    $conn = new mysqli("localhost", "root", "", "biblioteca");
    if ($conn->connect_error) {
        die("Connexió fallida: " . $conn->connect_error);
    }

    // Sentència preparada per cercar per paraula clau al títol
    $stmt = $conn->prepare("SELECT * FROM llibres WHERE titol LIKE ?");
    $buscaTitol = "%" . $titol . "%";
    $stmt->bind_param("s", $buscaTitol);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h3>Resultats per títol amb: " . htmlspecialchars($titol) . "</h3>";
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Títol</th><th>Autor</th><th>Any</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['titol']}</td>
                    <td>{$row['autor']}</td>
                    <td>{$row['any']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No s'han trobat llibres amb la paraula clau: " . htmlspecialchars($titol);
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
