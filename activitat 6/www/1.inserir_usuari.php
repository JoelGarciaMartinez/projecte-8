<?php
// Activem els errors
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Dades de connexió
$host = 'db';
$usuari = 'root';
$clau = 'root';
$bbdd = 'autenticacio';

// Connectem amb la base de dades
$connexio = new mysqli($host, $usuari, $clau, $bbdd);

// Comprovem si hi ha error de connexió
if ($connexio->connect_errno) {
    exit("Error de connexió: " . $connexio->connect_error);
}

// Credencials de l'usuari a inserir
$nouUsuari = [
    'nom' => 'admin',
    'email' => 'admin@exemple.com',
    'contrasenya' => '1234'
];

// Hashegem la contrasenya
$contrasenyaHashejada = password_hash($nouUsuari['contrasenya'], PASSWORD_DEFAULT);

// Preparem la consulta SQL
$sql = "INSERT INTO usuaris (nom, email, contrasenya) VALUES (?, ?, ?)";
$sentencia = $connexio->prepare($sql);

// Comprovem si la preparació ha anat bé
if (!$sentencia) {
    exit("Error en la preparació de la consulta: " . $connexio->error);
}

// Assignem els valors
$sentencia->bind_param("sss", $nouUsuari['nom'], $nouUsuari['email'], $contrasenyaHashejada);

// Executem la consulta
if ($sentencia->execute()) {
    echo "Usuari afegit correctament!";
} else {
    echo "Error afegint usuari: " . $sentencia->error;
}
?>
