<?php

session_start();

//checks if the ajax post has a "value" variable.
if(isset($_POST['value']))
{
	//checks if the ajax post has a "type" variable.
	if(isset($_POST['type']))
	{
		//if so, check the "type" needed to edit.
		if($_POST['type']	===	'select_encryption')
		{
			include('select_encryption.php');
		}
		if($_POST['type']	===	'select_version')
		{
			include('select_version.php');
		}
		if($_POST['type']	===	'select_domain')
		{
			include('select_domain.php');
		}
		if($_POST['type']	===	'select_logo')
		{
			include('select_logo.php');
		}
		if($_POST['type']	===	'select_alias')
		{
			include('select_alias.php');
		}
		if($_POST['type']	===	'select_folder')
		{
			include('select_folder.php');
		}
		if($_POST['type']	===	'select_dbhost')
		{
			include('select_dbhost.php');
		}
		if($_POST['type']	===	'select_dbuser')
		{
			include('select_dbuser.php');
		}
		if($_POST['type']	===	'select_dbpassword')
		{
			include('select_dbpassword.php');
		}
		if($_POST['type']	===	'select_dbname')
		{
			include('select_dbname.php');
		}
	}
}
else
{
	//display an error
}
