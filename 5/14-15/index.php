<?php
$conn = new mysqli("localhost", "root", "", "usuaris");
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

echo "<h2>Llista de clients</h2>";
echo "<a href='afegir.php'>Afegir client nou</a><br><br>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nom']}</td>
                <td>{$row['email']}</td>
                <td>
                    <a href='editar.php?id={$row['id']}'>Editar</a> | 
                    <a href='eliminar.php?id={$row['id']}' onclick='return confirm(\"Segur que vols eliminar aquest client?\")'>Eliminar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hi ha clients.";
}

$conn->close();
?>
