<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Cerca per autor</title>
</head>
<body>

<h2>Cerca llibres per autor</h2>
<form method="GET" action="">
    <label for="autor">Autor:</label>
    <input type="text" name="autor" required>
    <input type="submit" value="Cercar">
</form>

<?php
if (isset($_GET['autor'])) {
    $autor = $_GET['autor'];

    // Connexió a la base de dades
    $conn = new mysqli("localhost", "root", "", "biblioteca");
    if ($conn->connect_error) {
        die("Connexió fallida: " . $conn->connect_error);
    }

    // Sentència preparada per cercar per autor
    $stmt = $conn->prepare("SELECT * FROM llibres WHERE autor LIKE ?");
    $buscaAutor = "%" . $autor . "%";
    $stmt->bind_param("s", $buscaAutor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h3>Resultats per autor: " . htmlspecialchars($autor) . "</h3>";
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
        echo "No s'han trobat llibres per l'autor: " . htmlspecialchars($autor);
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
