<?php

require ('../database/db.php');

define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST']);


/*
 * #-----------#
 * # Constants #
 * #-----------#
 *
 *
 * Costanti usate come chiavi per ottenere i valori da POST, GET, SESSION
 *
 * In questo modo nel caso bisogna cambiare la chiave, basterà modificarla qui
 *
 *
 *
 * esempio pratico:
 *
 * invece che fare:
 *
 * <esempio1.php>
 * $user = $_POST['user'];
 * ...
 *
 * <esempio2.php>
 * $user = $_POST['user'];
 * ...
 *
 * e quindi dovere modificare il codice in entrambi i file, nel caso si voglia
 * scegliere una chiave differente da 'user'; basterà modificarla soltanto qui
 * e il valore si aggiornerà in automatico in ogni file.
 *
 */

// Session
define('KEY_LOGGED_IN', 'logged_user');
define('KEY_NAME', 'nome');
define('KEY_ROLE', 'scrittura');
define('KEY_POS', 'percorso');

// Login Form
define('KEY_LOGIN_USERNAME', 'username');
define('KEY_LOGIN_PASSWORD', 'password');
// pulsante di login
define('KEY_LOGIN_SUBMIT', 'login_clicked');

// Used in login.php
define('KEY_LOGRESET_USERNAME', 'lou');
define('KEY_LOGRESET_TOKEN', 'lot');
define('KEY_LOGINRESET_LINK', 'key_loginreset_link');

// #---------------------#
// # MySQL configuration #
// #---------------------#

// Fa il parsing del file di configurazione config.ini.php
$config = parse_ini_file("../private/config.ini.php", true);

// Esegue la connessione al database:
$dbc = Database::connect($config['mysql']['host'], $config['mysql']['user'], $config['mysql']['password'], $config['mysql']['dbname']);

// Imposta l'encoding...
mysqli_set_charset($dbc, 'utf8');

function authenticate($json)
{
    $config = parse_ini_file("../private/config.ini.php", true);
    return Database::authenticate($json, $config['mysql']['host'], $config['mysql']['user'], $config['mysql']['password'], $config['mysql']['dbname']);
}

?>