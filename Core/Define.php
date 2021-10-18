<?php

$meta_tag_domain_name	='';

$_SESSION['current_file']							=	basename(__FILE__);
$_SESSION['base_script_filename'] 		= 	substr($_SERVER["SCRIPT_FILENAME"], strrpos($_SERVER["SCRIPT_FILENAME"], '/') + 1);
$_SESSION['www_root'] 							=	str_replace($_SERVER['PHP_SELF'], '', $_SERVER["SCRIPT_FILENAME"]);		// asdasd  				C:/wamp650/www/LegitPunk.com/templates/file_explorer_iterator/
$_SESSION["base_dir"]								=	str_replace($_SESSION['base_script_filename'], '', $_SERVER["SCRIPT_NAME"]);		// asdasd          				/LegitPunk.com/templates/file_explorer_iterator/
$_SESSION["http_domain"]						=	(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}";	

//reads the config.cfg file where the site's settings are stored and puts the contents into an array, each line being an element. This is editable by opening config.php file in a browser.
//defaults to the "drive_base_dir" variable's location, for example: "C:/wamp/www/domain_name.com/LegitPunk.com/templates/file_explorer_iterator/config.cfg".
$lines = file($_SESSION['www_root'].$_SESSION['base_dir'].'config.cfg');	

//clears the whitespace from each line and creates an array via the ";" as a node pointer.
foreach($lines as $line)
{
	$linee						=	preg_replace('/\s+/', '', $line);
	$array_of_lines[]	=	str_replace(";", "", $linee);
}

//assigns http encryption protocol in use.
if($array_of_lines[0] === '1')
{
	$_SESSION['http']							=	'http://';
}
else
{
	$_SESSION['http']							=	'https://';
}

//assign session vars for use with index.php
$_SESSION['version']									=	$array_of_lines[1];
$_SESSION['domain']									=	$array_of_lines[2];
$_SESSION['images_logo']						=	$array_of_lines[3];
$_SESSION['apache_alias']						=	$array_of_lines[4];  	 //		'http://domain_name_or_host_name/alias_made_in_apache2/';
$_SESSION['original_dir']							=	$array_of_lines[5];  	//		'C:/folder/subfolder_with_folders_and_files_to_use_for_browsing/'
$_SESSION['DbHost'] 								= 	$array_of_lines[6];
$_SESSION['DbUser'] 								= 	$array_of_lines[7];
$_SESSION['DbPassword']						=	$array_of_lines[8];
$_SESSION['DbDatabase']						= 	$array_of_lines[9];

//make some session vars so it's easy to create standard paths with:
$_SESSION['http_site_dir']						=	$_SESSION["http_domain"].$_SESSION["base_dir"].'updates/'.$_SESSION['version'].'/';
$_SESSION['http_base_dir']						=	$_SESSION["http_domain"].$_SESSION['base_dir'];
$_SESSION['drive_base_dir']					=	$_SESSION['www_root'].$_SESSION['base_dir'];

//if you wana check the database connection prior to running script, uncomment this:
/*
$_SESSION['mysqli'] = new mysqli($_SESSION['DbHost'], $_SESSION['DbUser'], $_SESSION['DbPassword'], $_SESSION['DbDatabase']);
if($_SESSION['mysqli']->connect_error)
{
	ModalError("Error:index.php:24");
	//exit;
}
*/

//this is to echo out all the session vars in case you run into any path problems:

/*
echo $_SESSION['current_file'];							//		Define.php
echo '<br>';
echo $_SESSION['base_script_filename'];		//		Login.php
echo '<br>';
echo $_SESSION['www_root'];							//		C:/wamp650/www
echo '<br>';
echo $_SESSION['base_dir'];								//		/Login4/
echo '<br>';
echo $_SESSION['http_site_dir'];						//		http://localhost/Login4/updates/00002/
echo '<br>';
echo $_SESSION['http_base_dir'];						//		http://localhost/Login4/
echo '<br>';
echo $_SESSION["http_domain"];						//		http://localhost
echo '<br>';
echo $_SERVER['PHP_SELF'];								//		/Login4/index.php
echo '<br>';
echo $_SESSION['drive_base_dir'];					//		C:/wamp650/www/Login5/
*/












