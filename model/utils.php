<?php

/**
 * Fetch a POST string given a key.
 *
 * @param mysqli $dbc - Database connection
 * @param string[] $errors REFERENCE to the array in which errors will be appended in
 * @param string $key Key from which the value will be retrieved
 *
 * @return null|string Null if errors, otherwise the POST string retrieved from the given key
 */
function getPostString($dbc, &$errors, $key)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // if parameters are valid
        if ($key == null) {
            $errors[] = "key null: " . $key;
            return null;
        } else if (empty($key)) {
            $errors[] = "key is an empty string: " . $key;
            return null;
        } else if (!isset($_POST[$key])) {
            $errors[] = "key is not set as post data: " . $key;
            return null;
        } else {
            $post_value = $_POST[$key];

            if ($post_value == null) {
                $errors[] = 'A post value was null: ' . $key;
                return null;
            } else if (empty($post_value)) {
                $errors[] = 'A post value was empty: ' . $key;
                return null;
            }

            $result = mysqli_real_escape_string($dbc, trim($post_value));
            return $result;
        }
    } else {
        $errors[] = "Server request method was not post";
        return null;
    }
}

/**
 * Creates an alert dialog that report the errors.
 *
 * @param array $errors errori interni
 * @param array $alertErrors errori da mostrare graficamente all'utente
 * @param $alert - var that will contain the alert div body
 * @param bool $display whether to display the alert to the user or not; true by default
 * @param string $bgcolor background color of the alert div 'yellow' by default
 */
function reportErrors($errors, $alertErrors, &$alert = null, bool $display = false, string $bgcolor = 'yellow')
{
    if ($display && isset($alert) && $alert != null)
        $alert = alert($bgcolor, "Si sono verificati i seguenti errori: ", json_encode($alertErrors), "Per favore riprova un'altra volta.");

    // $log_folder = $_SERVER["DOCUMENT_ROOT"] . '\mysmoweb\private\logs\errors\\';

    // logData($log_folder . date('d-m-Y') . '.log', gmdate('Y-m-d H:i:s') . json_encode($errors));
}

/**
 * Creates a log file and log given data.
 * If log file does not exists, the <i>file_put_contents()</i> function will create it.
 *
 * inspired by <a href="https://stackoverflow.com/a/8400489">this</a>
 *
 * @param string $file Path where the log file will be generated
 * @param mixed $data Data to log
 * @param mixed $first_row Whether the first row of the file should be different
 */
function logData($file, $data, $first_row = null)
{
    if (!is_dir(dirname($file))) {
        // dir doesn't exist, make it
        mkdir(dirname($file), 0777, true);
    }

    if ($first_row != null) {
        clearstatcache();
        if (!file_exists($file) or !filesize($file)) {
            // the file is empty or does not exists yet
            file_put_contents($file, $first_row . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }

    // Write the contents to the file,
    // using the FILE_APPEND flag to append the content to the end of the file
    // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
    file_put_contents($file, $data . PHP_EOL, FILE_APPEND | LOCK_EX);
}

/**
 * Returns the true query (without ? as params) executed by the prepared statement.
 *
 * https://stackoverflow.com/a/1376838
 *
 * Replaces any parameter placeholders in a query with the value of that
 * parameter. Useful for debugging. Assumes anonymous parameters from
 * $params are are in the same order as specified in $query
 *
 * @param string $query The sql query with parameter placeholders
 * @param array $params The array of substitution parameters
 * @return string The interpolated query
 */
function interpolateQuery($query, $params)
{
    try {
        $keys = array();

        # build a regular expression for each parameter
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/:' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }
        }

        $query = preg_replace($keys, $params, $query, 1, $count);

        #trigger_error('replaced '.$count.' keys');

        return $query;
    } catch (Exception $e) {
        // interpolating error
        return '';
    }
}

/**
 * Generates a custom alert using MDL colors with the given data.
 * This alert is standalone, its position is fixed and it can be closed thanks to its embedded close button.
 *
 * @param string $bgcolor the color of the alert div
 * @param array ...$messages the messages to print in the alert below the title, they are splitted into paragraphs
 *
 * @return string The resulting div element
 */
function alert(string $bgcolor, ...$messages)
{
    $result = "";

    $result .= '<div id="alertbox" class="alert-box mdl-card__title mdl-color--' . $bgcolor . '" style="display: none;"><div class="flex-alert">';

    for ($i = 0; $i < count($messages); $i++) {
        // if an argument is an array, iterate through it or it will be printed 'Array' as a message.
        if (is_array($messages[$i])) {
            $result .= '<br>';

            foreach ($messages[$i] as $array_row) {
                $result .= '<p>' . $array_row . '</p>';
            }
        } else {
            $result .= '<p>' . $messages[$i] . '</p>';
        }
    }

    $result .= '

<button class="mdl-button mdl-js-button mdl-button--icon" onclick="$(this.parentNode.parentNode).slideUp();">
  <i class="material-icons">close</i>
</button>

</div></div>';

    return $result;
}

function handleAlerts($alert)
{
    if (isset($alert) and $alert != null and !empty($alert)) {

        //echo '<div class="alert-container">';
        echo $alert;
        //echo '</div>';
    }
}

function validateField($field)
{
    $field = stripcslashes($field);
    $field = htmlspecialchars($field);
    $field = htmlentities($field);

    return $field;
}

?>