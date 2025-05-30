<?php
/**
 * Nom del fitxer: factorial.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Funció que calcula el factorial d’un número enter positiu.
 */

function factorial($num) {
    $resultat = 1;
    for ($i = 1; $i <= $num; $i++) {
        $resultat *= $i;
    }
    return $resultat;
}

echo "El factorial de 5 és: " . factorial(5);
?>
