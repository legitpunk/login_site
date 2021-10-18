<?php

//Page name: Globals.php
//Page function: Defines Config, Remember and Session
//Dependencies: Core/Define, Core/Init
//Executes AJAX from page:
//Includes: 
//Techs: 

//Define globals:
$GLOBALS['ConfigGlobal'] = array
(
	'mysql' => array
	(
		'host' => $_SESSION['DbHost'], 
		'username' => $_SESSION['DbUser'],
		'password' => $_SESSION['DbPassword'],
		'db' => $_SESSION['DbDatabase']
	),
	'Remember' => array
	(
		'CookieName' => 'Hash',
		'CookieExpiry' => 604800
	),

	'Session' => array
	(
		'SessionName' => 'User',
		'TokenName' => 'Token'
	)
);



?>