<?php

//Page name: Init.php.
//Page function: Initialises classes, functions, user, db connection, autoload, and more. 
//Dependencies: Core/Define.php.
//Executes AJAX from page: Nil
//Includes: $_SERVER['DOCUMENT_ROOT'].'\\'.$s6.'\\classes\\'. $class . '.php';
//Techs: Php, session, db

//Start global settings session

//Autoload Functions:
/*
include $_SESSION['Sdir'].'Functions/Jsonerrorcheck.php';
include $_SESSION['Sdir'].'Functions/ModalError.php';
include $_SESSION['Sdir'].'Functions/Permissions.php';
*/
include $_SESSION['www_root'].$_SESSION['base_dir'].'Functions/Sanitise.php';
include 'Sanitize.php';

//Define Globals ConfigGlobal, Remember and Session
if(include $_SESSION['www_root'].$_SESSION['base_dir'].'Core/Globals.php')
{
	//echo 'included';
}
else
{
	echo 'ERROR: Init.php: Line 28: (include $_SERVER[DOCUMENT_ROOT].\\.$_SESSION[B].\\Core\Globals.php) not included';
}
/*
if(include $_SESSION['www_root'].$_SESSION['base_dir'].'Core/GlobalsGuest.php')
{
	//echo 'included';
}
else
{
	echo 'ERROR: Init.php: Line 14: (include $_SERVER[DOCUMENT_ROOT].\\.$_SESSION[B].\\Core\Globals.php) not included';
}
*/
//Autoload Classes:
spl_autoload_register
(
	function($Class) 
	{
		require_once $_SESSION['www_root'].$_SESSION['base_dir'].'Classes/'. $Class . '.php';
	}
);





