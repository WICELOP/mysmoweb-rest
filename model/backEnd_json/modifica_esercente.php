<?php

if (!empty($_POST['esercente'])) {
    $jsonObject = json_decode($_POST['esercente']);

    $statement = $dbc->prepare("UPDATE amministratore SET email = ?, nome = ?, percorso_logo = ? WHERE id_amministratore = ?");
    $statement->bind_param("sssi", $email, $nome, $percorso_logo, $id_amministratore);

    $email = $jsonObject->{'email'};
    $nome = $jsonObject->{'nome'};
    $percorso_logo = $jsonObject->{'percorso_logo'};
    $id_amministratore = $_POST['id_amministratore'];

    $statement->execute();
    $statement->close();

    $statement = $dbc->prepare("DELETE FROM esercizio WHERE id_amministratore = ?");
    $statement->bind_param("i", $id_amministratore);

    $id_amministratore = $_POST['id_amministratore'];

    $statement->execute();
    $statement->close();

    $statement = $dbc->prepare("INSERT INTO esercizio (id_amministratore, paese) VALUES (?, ?)");
    $statement->bind_param("is", $id_amministratore, $paese);

    for ($i = 0; $i < count($jsonObject->{'esercizi'}); $i += 1) {
        $id_amministratore = $_POST['id_amministratore'];
        $paese = $jsonObject->{'esercizi'}[$i];
        $statement->execute();
    }
    $statement->close();
    $dbc->close();
}
