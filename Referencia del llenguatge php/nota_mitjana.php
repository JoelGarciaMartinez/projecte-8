<?php
/**
 * Nom del fitxer: nota_mitjana.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Calcula la mitjana de notes i mostra si l’alumne està aprovat.
 */

$notes = [7.5, 6, 8, 4.5, 5.5];
$mitjana = array_sum($notes) / count($notes);

echo "Nota mitjana: $mitjana<br>";

if ($mitjana >= 5) {
    echo "Estàs aprovat! 🎉";
} else {
    echo "Has de millorar 😞";
}
?>
