<?php

// require_once ('../config.php');
// require_once ('../utils.php');

if (!empty($_POST['esercente'])) {
    //Verificare autenticazione
    $jsonObject = json_decode($_POST['esercente']);
    
    $statement = $dbc->prepare("INSERT INTO `amministratore` (email, password, nome, percorso_logo, lettura, scrittura, `data`) VALUES (?, SHA2(?, 256), ?, ?, '1', '0', CURDATE())");
    $statement->bind_param("ssss", $email, $password, $nome, $percorso_logo);

    $email = $jsonObject->{'email'};
    $password = $jsonObject->{'password'};
    $nome = validateField($jsonObject->{'nome'});
    $percorso_logo = $jsonObject->{'percorso_logo'};
    
    $statement->execute();
    $statement->close();
    
    $result = $dbc->query("SELECT `id_amministratore` FROM `amministratore` ORDER BY `id_amministratore` DESC LIMIT 1");
    $id_amministratore = $result->fetch_assoc()['id_amministratore'];
    
    $statement = $dbc->prepare("INSERT INTO `esercizio` (id_amministratore, paese) VALUES ('" . $id_amministratore . "', ?)");
    $statement->bind_param("s", $paese);

    for ($i = 0; $i < count($jsonObject->{'esercizi'}); $i += 1) {
        $paese = $jsonObject->{'esercizi'}[$i];
        $statement->execute();
    }

    $statement->close();

/*    $extension = explode(".", $percorso_logo)[1];
    switch ($extension) {
        case "jpg":
            $img = resize_imagejpg($percorso_logo, 512, 512);
            imagejpeg($img, $percorso_logo);
            break;
        case "png":
            $img = resize_imagepng($percorso_logo, 512, 512);
            imagepng($img, $percorso_logo);
            break;
    }*/
    
}

$dbc->close();

// function resize_imagejpg($file, $w, $h) {
//     list($width, $height) = getimagesize($file);
//     $src = imagecreatefromjpeg($file);
//     $dst = imagecreatetruecolor($w, $h);
//     imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
//     return $dst;
// }

// function resize_imagepng($file, $w, $h) {
//     list($width, $height) = getimagesize($file);
//     $src = imagecreatefrompng($file);
//     $dst = imagecreatetruecolor($w, $h);
//     imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
//     return $dst;
// }

