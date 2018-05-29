<?php

/*
 * #----------#
 * # Auth.PHP #
 * #----------#
 *
 *
 * Questo script verrà incluso in ogni altri script.
 *
 * Contiene:
 * - il codice per gestire l'autenticazione
 *
 */

require_once ('config.php');
require ('utils.php');

// login tramite le sessioni
session_start();

// messaggio di alert che apparirà nel caso si verifichino errori
$alert = [];

$errors = []; // internal errors written in logs
$errors_public = []; // public errors shown in alerts

// Se l'utente sta cercando di loggarsi (cliccato sul pulsante login)
if (isset($_POST[KEY_LOGIN_SUBMIT]))
{
    $user = getPostString($dbc, $errors, KEY_LOGIN_USERNAME);
    $pass = getPostString($dbc, $errors, KEY_LOGIN_PASSWORD);

    $q = "SELECT id_amministratore FROM amministratore WHERE email=? AND password=?";
    $stmt = $dbc->prepare($q);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();

    $stmt_result = $stmt->get_result();

    // corrispondenza utente trovata, salvare il valore tramite le sessioni
    if ($stmt_result->num_rows == 1)
    {
        $_SESSION[KEY_LOGGED_IN] = $user;

        // redirect on index page
        echo '<script type="text/javascript"> window.open("' . BASE_URL . '" , "_self");</script>';
    }
    else
    {
        $alert = alert("red", "Combinazione username e password errata!");
    }

    $stmt->close();
} else {

    $guest_links = ['/login', '/notEnoughPermissions'];

    // logged in
    if(isset($_SESSION[KEY_LOGGED_IN]))
    {
        $user = $_SESSION[KEY_LOGGED_IN];

        $q = "SELECT id_amministratore FROM amministratore WHERE email=?";
        $stmt = $dbc->prepare($q);
        $stmt->bind_param("s", $user);
        $stmt->execute();

        $stmt_result = $stmt->get_result();

        // not found
        if ($stmt_result->num_rows != 1)
        {
            unset($_SESSION[KEY_LOGGED_IN]);

            if (!in_array(basename($_SERVER['SCRIPT_NAME']), $guest_links))
            {
                echo '<script type="text/javascript"> window.open("' . BASE_URL . '/notEnoughPermissions" , "_self");</script>';
            }
        }

        $stmt->close();
    } else {
        if (!in_array($uri, $guest_links))
        {
            echo '<script type="text/javascript"> window.open("' . BASE_URL . '/notEnoughPermissions" , "_self");</script>';
        }
    }
}

?>