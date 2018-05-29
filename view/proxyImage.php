<?php
function visualizzaPagina(){

    // define absolute path to image folder
    $image_folder = 'C:/images/uploads/';
    // get the image name from the query string
    // and make sure it's not trying to probe your file system
    if (isset($_GET['pic']) && basename($_GET['pic']) == $_GET['pic']) {
        $pic = $image_folder.$_GET['pic'];
        if (file_exists($pic) && is_readable($pic)) {

            //controllo per file jpeg
            $ext = substr($pic, -4);

            if($ext == "jpeg"){
                $mime = 'image/jpeg';
            }else{
                // get the filename extension
                $ext = substr($pic, -3);
                // set the MIME type
                switch ($ext) {
                    case 'jpg':
                    $mime = 'image/jpeg';
                    break;
                    case 'gif':
                    $mime = 'image/gif';
                    break;
                    case 'png':
                    $mime = 'image/png';
                    break;
                    default:
                    $mime = false;
                }

            }
        // if a valid MIME type exists, display the image
        // by sending appropriate headers and streaming the file
            if ($mime) {
                header('Content-type: '.$mime);
                header('Content-length: '.filesize($pic));
                $file = @ fopen($pic, 'rb');
                if ($file) {
                    fpassthru($file);
                    echo "<img src='25.png'>";
                    exit;
                }
            }
        }
    }
}

?>