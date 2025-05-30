<?php
/**
 * Nom del fitxer: edat_legal.php
 * Autor: Joel Garcia
 * Data de creació: 31-05-2025
 * Descripció: Demana l’edat d’una persona i mostra si és major d’edat o no.
 */

$edat = 17; // Pots canviar-ho per provar

if ($edat >= 18) {
    echo "Tens $edat anys. Ets major d’edat.";
} else {
    echo "Tens $edat anys. Encara no ets major d’edat.";
}
?>
