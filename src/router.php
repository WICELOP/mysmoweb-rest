<?php
function get($uri){
    $headers = apache_request_headers();
    $array = explode('?',$uri);
    //divido l'uri per le richieste get con parametri
    $uri = $array[0];
    if(count($array) != 1){
        $uriget = $array[1];
    }
    require ("functionGet.php");

    switch ($uri) {

        //homepage del sito
        case '/':
        if(isset($uriget)){
            notFound();
            break;
        }else{
            index($headers, $uri);
            break;
        }

        //pagina di login
        case '/login':
        if(isset($uriget)){
            notFound();
            break;
        }else{
            login($headers, $uri);
            break;
        }

        //pagina di reindirizzamento per utenti non loggati
        case '/notEnoughPermissions':
        if(isset($uriget)){
            notFound();
            break;
        }else{
            notEnoughPermission($headers, $uri);
            break;
        }
        //pagina di visualizzazione esercenti
        case '/listaEsercenti':
        if(isset($uriget)){
            listaEsercenti($headers, $uriget);
            break;
        }else{
            listaEsercenti($headers, $uri);
            break;
        }

        //pagina di login
        case '/aggiungiEsercente':
        if(isset($uriget)){
            notFound();
            break;
        }else{
            aggiungiEsercente($headers, $uri);
            break;
        }

        //pagina per la visualizzazione/gestione degli esercenti
        case '/visualizzaEsercente':
        if(isset($uriget)){
            // $uri = $uri.'?'.$uriget;
            visualizzaEsercente($headers, $uriget);
            break;
        }else{
            notFound();
            break;
        }

        //pagina per la visualizzazione dell'immagine
        case '/proxyImage':
        if(isset($uriget)){
            // $uri = $uri.'?'.$uriget;
            proxyImage($headers, $uriget);
            break;
        }else{
            notFound();
            break;
        }

        //pagina segnalaBug
        case '/segnalaBug':
        if(isset($uriget)){
            notFound();
            break;
        }else{
            segnalaBug($headers, $uri);
            break;
        }

        //last resort
        default:
        notFound();
        break;
    }
}

function post($uri){
    $headers = apache_request_headers();
    require ("functionPost.php");
    switch ($uri) {

        case '/login':
        loginPost();
        break;
        
        case '/aggiungiEsercente':
        aggiungiEsercentePost(); 
        break;

        case '/uploadImage':
        uploadImage();
        break;

        default:
        notFound();
        break;
    }
}

function notFound(){
    http_response_code(404);
    require ('../view/404.php');
    visualizzaPagina();
}

function badRequest(){
    http_response_code(400);
    require ('../view/400.php');
    visualizzaPagina();
}

?>