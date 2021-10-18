<?php

session_start();

header("Cache-Control: max-age=2592000");

require_once "Core/Define.php";
require_once "Core/Init.php";
require_once "Core/Head.php";

$User = new User();
$User->Logout();

?>