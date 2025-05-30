<?php
/**
 * Nom del fitxer: alumnes_edat.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Mostra només els alumnes de 18 anys o més d’un array associatiu.
 */

$alumnes = [
    "Anna" => 17,
    "Joel" => 19,
    "Marta" => 18,
    "Pau" => 16,
    "Laia" => 20
];

foreach ($alumnes as $nom => $edat) {
    if ($edat >= 18) {
        echo "$nom té $edat anys i és major d’edat.<br>";
    }
}
?>
