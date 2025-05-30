<?php
/**
 * Nom del fitxer: targeta_personal.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Pàgina HTML amb una targeta que mostra el nom, imatge, data actual i un missatge de benvinguda personalitzat.
 */

$nom = "Joel Garcia";
$data = date("d/m/Y");
$missatge = "Hola! Sóc en Joel i t’agraeixo la visita 😊";
$imatge = "https://i.imgur.com/8Km9tLL.jpg"; // Pots posar una URL o un arxiu local com "joel.jpg"
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Targeta personal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .targeta {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 350px;
        }
        .targeta img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
        .targeta h2 {
            margin: 10px 0 5px 0;
        }
        .targeta .data {
            font-size: 0.9em;
            color: #777;
            margin-bottom: 10px;
        }
        .targeta .missatge {
            font-style: italic;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="targeta">
        <img src="<?php echo $imatge; ?>" alt="Foto de perfil">
        <h2><?php echo $nom; ?></h2>
        <div class="data">Data: <?php echo $data; ?></div>
        <div class="missatge"><?php echo $missatge; ?></div>
    </div>
</body>
</html>
