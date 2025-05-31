<?php
// Connexió a la base de dades
$conn = new mysqli("localhost", "root", "", "biblioteca");
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Agafem l'id del llibre que volem editar (per GET)
if (!isset($_GET['id'])) {
    die("No s'ha especificat cap llibre.");
}

$id = intval($_GET['id']);

// Si s'ha enviat el formulari, processem l'actualització
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titol = trim($_POST['titol']);
    $autor = trim($_POST['autor']);
    $any = trim($_POST['any']);

    // Validem que no hi hagi camps buits
    if (empty($titol) || empty($autor) || empty($any)) {
        echo "<p style='color:red;'>Tots els camps són obligatoris.</p>";
    } else {
        // Actualitzem el registre a la base de dades
        $stmt = $conn->prepare("UPDATE llibres SET titol = ?, autor = ?, any = ? WHERE id = ?");
        $stmt->bind_param("ssii", $titol, $autor, $any, $id);

        if ($stmt->execute()) {
            // Pas 11: mostrar confirmació (farem després)
            echo "<p style='color:green;'>Llibre actualitzat correctament.</p>";
        } else {
            echo "<p style='color:red;'>Error actualitzant el llibre: " . $conn->error . "</p>";
        }

        $stmt->close();
    }
}

// Consulta per obtenir les dades actuals del llibre i omplir el formulari
$stmt = $conn->prepare("SELECT titol, autor, any FROM llibres WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($titol, $autor, $any);
if (!$stmt->fetch()) {
    die("Llibre no trobat.");
}
$stmt->close();

$conn->close();
?>

<h2>Editar llibre</h2>
<form method="POST" action="">
    <label for="titol">Títol:</label><br>
    <input type="text" name="titol" value="<?php echo htmlspecialchars($titol); ?>" required><br><br>

    <label for="autor">Autor:</label><br>
    <input type="text" name="autor" value="<?php echo htmlspecialchars($autor); ?>" required><br><br>

    <label for="any">Any:</label><br>
    <input type="number" name="any" value="<?php echo htmlspecialchars($any); ?>" required><br><br>

    <input type="submit" value="Actualitzar llibre">
</form>
