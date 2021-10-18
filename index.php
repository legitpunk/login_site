<?php


//need to create an apache_alias to the folder that holds the file files you want the explorer to navigate

//start a session for $_SESSION vars to work
session_start();

//make the browser cache last a long time
header("Cache-Control: max-age=2592000");

require_once "Core/Define.php";
require_once "Core/Init.php";

//gets index file associated with the version detailed on the config file
include('updates/'.$_SESSION['version'].'/index.php');




?>