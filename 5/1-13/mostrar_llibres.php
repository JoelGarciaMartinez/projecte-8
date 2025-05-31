<?php
// Connexió a la base de dades
$conn = new mysqli("localhost", "root", "", "biblioteca");

// Comprovem la connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Consulta per obtenir els llibres
$sql = "SELECT * FROM llibres";
$result = $conn->query($sql);

// Mostrar resultats en una taula HTML
echo "<h2>Llibres disponibles</h2>";

// Missatge de confirmació si ve d’una eliminació
if (isset($_GET['eliminat']) && $_GET['eliminat'] == 1) {
    echo "<p style='color:green;'>Llibre eliminat correctament.</p>";
}

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    // Capçalera amb la columna Accions
    echo "<tr><th>ID</th><th>Títol</th><th>Autor</th><th>Any</th><th>Accions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['titol']}</td>
                <td>{$row['autor']}</td>
                <td>{$row['any']}</td>
                <td>
                    <a href='editar.php?id={$row['id']}'>Editar</a> | 
                    <a href='eliminar.php?id={$row['id']}' onclick='return confirmEliminar();'>Eliminar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hi ha llibres.";
}

// Tanquem la connexió
$conn->close();
?>

<!-- Afegim la funció JavaScript per a la confirmació -->
<script>
function confirmEliminar() {
    return confirm('Segur que vols eliminar aquest llibre? Aquesta acció no es pot desfer.');
}
</script>
