<?php

//PageName: Fs/Cs/Fs/Feedstadium/SocialNetwork/Profile/Editing/Index.php
//PageFunction:
//Dependencies:
//Executes AJAX from page:
//Includes: 
//Techs: 

//Require the Vars
require_once ''.str_replace($_SERVER['SCRIPT_NAME'],'',$_SERVER['SCRIPT_FILENAME']).'/Vars2.php';

$user = new User();

//echo $User->data()->Username;
if ($user->isLoggedIn()) 
{
	
	$user->Logout();

}
else
{
	echo 'was not logged in';
}