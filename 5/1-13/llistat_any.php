<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Llistat de llibres ordenat per any</title>
</head>
<body>

<h2>Llistat de llibres ordenat per any (descendent)</h2>

<?php
// Connexió a la base de dades
$conn = new mysqli("localhost", "root", "", "biblioteca");
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Consulta per obtenir els llibres ordenats per any descendent
$sql = "SELECT * FROM llibres ORDER BY any DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Títol</th><th>Autor</th><th>Any</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['titol']}</td>
                <td>{$row['autor']}</td>
                <td>{$row['any']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hi ha llibres.";
}

$conn->close();
?>

</body>
</html>
