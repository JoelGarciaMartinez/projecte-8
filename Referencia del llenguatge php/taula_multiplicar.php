<?php
/**
 * Nom del fitxer: taula_multiplicar.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Demana un número de l’1 al 10 i mostra la seva taula de multiplicar amb un bucle.
 */

$numero = 6; // Introdueix un número entre 1 i 10

if ($numero >= 1 && $numero <= 10) {
    echo "Taula de multiplicar del $numero:<br>";
    for ($i = 1; $i <= 10; $i++) {
        echo "$numero x $i = " . ($numero * $i) . "<br>";
    }
} else {
    echo "El número ha d’estar entre 1 i 10.";
}
?>
