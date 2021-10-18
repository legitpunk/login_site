<?php

//PageName: Core/Sanitise.php
$PageName = 'Core_Sanitise';
//PageFunction:
//Dependencies:
//Executes AJAX from page:
//Includes: 
//Techs: 

//
function Sanitise($var)
{
	$var = str_replace(".", "", $var);
	return $var;
}

?>