<?php

if (!empty($_GET['id'])) {
    $statement = $dbc->prepare("SELECT email, nome, percorso_logo, scrittura, id_questionario_qrcode FROM amministratore WHERE id_amministratore = ?");
    $statement->bind_param("i", $id_amministratore);
    $id_amministratore = $_GET['id'];
    $statement->execute();
    $statement->bind_result($email, $nome, $percorso_logo, $scrittura, $id_questionario_qrcode);
    $statement->fetch();
    $statement->close();
    $output['email'] = $email;
    $output['nome'] = $nome;
    $output['percorso_logo'] = $percorso_logo;
    if (isset($id_questionario_qrcode)) {
        $output['id_questionario_qrcode'] = $id_questionario_qrcode;
    }
    $output['esercizi'] = array();
    $statement = $dbc->prepare("SELECT paese FROM esercizio WHERE id_amministratore = ?");
    $statement->bind_param("i", $id_amministratore);
    $id_amministratore = $_GET['id'];
    $statement->execute();
    $statement->bind_result($paese);
    while ($statement->fetch()) {
        array_push($output['esercizi'], $paese);
    }
    if ($scrittura === 0) {
        echo json_encode($output);
    }
}
