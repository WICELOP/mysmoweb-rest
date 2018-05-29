<?php

/*require_once ('../config.php');
require_once ('../auth.php');*/

//Verificare autenticazione

$query = "SELECT * FROM `amministratore` WHERE `scrittura` = FALSE;";

$result = $dbc->query($query);

$i = 0;
while ($riga = $result->fetch_assoc()) {
    $riga['esercizi'] = array();
    $result_esercizi = $dbc->query("SELECT `paese` FROM `esercizio` WHERE `id_amministratore` = " . $riga['id_amministratore']);
    while ($riga_esercizi = $result_esercizi->fetch_assoc()) {
        array_push($riga['esercizi'], $riga_esercizi['paese']);
    }
    $output[$i] = $riga;
    $i += 1;
}

$dbc->close();

echo json_encode($output);
