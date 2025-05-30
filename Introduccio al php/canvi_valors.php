<?php
/**
 * Nom del fitxer: canvi_valors.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Intercanvia els valors de dues variables i mostra els resultats abans i després.
 */

$a = 10;
$b = 20;

echo "Abans del canvi: a = $a, b = $b<br>";

// Intercanvi de valors
$temp = $a;
$a = $b;
$b = $temp;

echo "Després del canvi: a = $a, b = $b";
?>
