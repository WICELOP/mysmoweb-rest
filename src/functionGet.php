<?php

function index($headers, $uri){
    if(strpos($headers["Accept"], 'html') !== false){
        require ('../model/auth.php');
        require ('../view/dashboardApertamente.php');
        visualizzaPagina($dbc);
    }
}

function login($headers, $uri){
    if(strpos($headers["Accept"], 'html') !== false){
        require ('../model/auth.php');
        require ('../view/login.php');
        visualizzaPagina($alert);
    }
}

function notEnoughPermission($headers, $uri){
    if(strpos($headers["Accept"], 'html') !== false){
        require ('../model/auth.php');
        require ('../view/notEnoughPermissions.php');
        visualizzaPagina();
    }
}

function listaEsercenti($headers, $uri){
    if(strpos($headers["Accept"], 'html') !== false){
        require ('../model/auth.php');
        require ('../view/listaEsercenti.php');
        visualizzaPagina($dbc);
    }
}

function aggiungiEsercente($headers, $uri){
    if(strpos($headers["Accept"], 'html') !== false){
        require ('../model/auth.php');
        require ('../view/aggiungiEsercente.php');
        visualizzaPagina();
    }
}

function visualizzaEsercente($headers, $uri){
    if(strpos($headers["Accept"], 'html') !== false){
        require ('../model/auth.php');
        require ('../view/visualizzaEsercente.php');
        visualizzaPagina($dbc);
    }
}

function modificaEsercente($headers, $uri){
    if(strpos($headers["Accept"], 'html') !== false){
        require ('../model/auth.php');
        require ('../view/modificaEsercente.php');
        visualizzaPagina($dbc);
    }
}

function proxyImage($headers, $uri){
    require ('../model/auth.php');
    require ('../view/proxyImage.php');
    visualizzaPagina();
}

function segnalaBug($headers, $uri){
    if(strpos($headers["Accept"], 'html') !== false){
        require ('../model/auth.php');
        require ('../view/segnalaBug.php');
        visualizzaPagina();
    }
}

?>