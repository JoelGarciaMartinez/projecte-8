<?php
/**
 * Nom del fitxer: calcular_iva.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Funció que rep un preu i un % d’IVA, i retorna el preu amb l’IVA aplicat.
 */

function preuAmbIVA($preu, $iva) {
    return $preu + ($preu * $iva / 100);
}

echo "Preu final: " . preuAmbIVA(100, 21) . " €";
?>
