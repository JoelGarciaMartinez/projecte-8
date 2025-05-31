<?php
// Comprovem si s'ha enviat el formulari
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titol = $_POST["titol"];
    $autor = $_POST["autor"];
    $any = $_POST["any"];

    // Connexió a la base de dades
    $conn = new mysqli("localhost", "root", "", "biblioteca");

    // Comprovació de connexió
    if ($conn->connect_error) {
        die("Connexió fallida: " . $conn->connect_error);
    }

    // Preparar la sentència per a inserció segura
    $stmt = $conn->prepare("INSERT INTO llibres (titol, autor, any) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Error en preparar la sentència: " . $conn->error);
    }

    // Enllacem les variables als paràmetres de la consulta (s = string, i = integer)
    $stmt->bind_param("ssi", $titol, $autor, $any);

    // Executem la consulta
    if ($stmt->execute()) {
        echo "Llibre afegit correctament!";
    } else {
        echo "Error en afegir el llibre: " . $stmt->error;
    }

    // Tanquem la sentència i la connexió
    $stmt->close();
    $conn->close();
}
?>

<!-- Formulari HTML -->
<h2>Afegir un llibre nou</h2>
<form method="POST" action="">
    <label for="titol">Títol:</label>
    <input type="text" name="titol" required><br><br>

    <label for="autor">Autor:</label>
    <input type="text" name="autor" required><br><br>

    <label for="any">Any:</label>
    <input type="number" name="any" required><br><br>

    <input type="submit" value="Afegir llibre">
</form>
