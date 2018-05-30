<?php

require_once('../config.php');
require_once '../auth.php';

if (!empty($_POST['id_esercente']) && !empty($_POST['nome'])) {
    //Verificare autenticazione

    $statement = $dbc->prepare("SELECT id_questionario, id_amministratore, nome, punti, tempo_min, tempo_max, metodo_invio, pubblicato FROM questionario WHERE id_amministratore = ? AND nome LIKE ? ORDER BY id_questionario DESC");
    $statement->bind_param("is", $id_amministratore, $nome_like);

    $id_amministratore = $_POST['id_esercente'];
    $nome = $_POST['nome'];
    $percento = "%";
    $nome_like = $percento . $nome . $percento;

    $statement->execute();
    $statement->bind_result($id_questionario, $id_amministratore, $nome, $punti, $tempo_min, $tempo_max, $metodo_invio, $pubblicato);
    $output = array();
    while ($statement->fetch()) {
        $questionario['id_questionario'] = $id_questionario;
        $questionario['id_esercente'] = $id_amministratore;
        $questionario['nome'] = $nome;
        $questionario['punti'] = $punti;
        $questionario['tempo_min'] = $tempo_min;
        $questionario['tempo_max'] = $tempo_max;
        $questionario['metodo_invio'] = $metodo_invio;
        $questionario['pubblicato'] = $pubblicato;
        array_push($output, $questionario);
    }
    echo json_encode($output);
}
