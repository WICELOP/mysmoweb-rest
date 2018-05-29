<?php

class Database {
    public static function connect($hostname, $username, $password, $database) {
        $db = new mysqli($hostname, $username, $password, $database);
        if ($db->connect_error) {
            die ("Error while trying to connect to database: " . $db->connect_error);
        }
        return $db;
    }

    public static function authenticate($json, $hostname, $username, $password, $database) {
        if (!empty($json)) {
            $jsonObject_auth = json_decode($json);

            $db_auth = Database::connect($hostname, $username, $password, $database);
            $statement_auth = $db_auth->prepare("SELECT id_utente, admin FROM utente WHERE email = ? AND password = ?");
            $statement_auth->bind_param("ss", $email_auth, $password_auth);

            $email_auth = $jsonObject_auth->{'email'};
            $password_auth = $jsonObject_auth->{'password'};

            $statement_auth->execute();

            $statement_auth->bind_result($id_utente_auth, $admin_auth);
            $statement_auth->fetch();

            $statement_auth->close();
            $db_auth->close();

            if ($id_utente_auth === null) {
                die ("Access denied.");
            } else {
                return array($id_utente_auth, $admin_auth);
            }
        } else {
            die ("Access denied.");
        }
    }
}
