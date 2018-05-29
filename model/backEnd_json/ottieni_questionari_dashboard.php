<?php
/**
 * Created by PhpStorm.
 * User: giovannibrumana
 * Date: 14/05/2018
 * Time: 13:29
 */

// require_once '../config.php';

$datetime = new DateTime();
$week = $datetime->format('W');

//imposto come intervallo le ultime due settimane

$week_start = $week - 2;
$datetime->setISODate(intval($datetime->format('Y')), $week_start);
$data_start = $datetime->format('Y-m-d');

//$anni = date_diff(date_create($data_start), date_create('today'));

$result = $dbc->query("SELECT questionario.id_questionario, questionario.nome as 'nomequestionario', amministratore.nome as 'nomeesercente' FROM questionario, amministratore WHERE questionario.id_amministratore = amministratore.id_amministratore AND questionario.data BETWEEN '" . $data_start . "' AND '" . (new DateTime())->format('Y-m-d') . "' ORDER BY questionario.id_questionario DESC;");
if ($result) {
    $output = array();
    while ($riga = $result->fetch_assoc()) {
        $questionario['id_questionario'] = $riga['id_questionario'];
        $questionario['nome'] = $riga['nomequestionario'];
        $questionario['esercente'] = $riga['nomeesercente'];
        array_push($output, $questionario);
    }
    echo json_encode($output);
}
