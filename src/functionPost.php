<?php
function loginPost(){
	require ("../model/auth.php");
	require ('../view/login.php');
	visualizzaPagina($alert);
}

function aggiungiEsercentePost(){
	require ("../model/auth.php");
	require ('../model/backEnd_json/aggiunta_esercente.php');
}

function modificaEsercentePost(){
	require ("../model/auth.php");
	require ('../model/backEnd_json/modifica_esercente.php');
}

function uploadImage(){
	require ("../model/auth.php");
	require ('../model/backEnd_json/upload.php');
}
?>