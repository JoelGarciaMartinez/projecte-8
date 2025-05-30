<?php
echo "<h1>Hola món!</h1>";

$host = 'db';
$user = 'usuari';
$password = 'contrasenya';
$database = 'exemple';

$conn = mysqli_connect($host, $user, $password, $database);

if ($conn) {
    echo "<p>Connexió a la base de dades correcta ✅</p>";
} else {
    echo "<p>Error de connexió ❌: " . mysqli_connect_error() . "</p>";
}
?>
