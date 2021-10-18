<?php

class Token {

  public static function Generate()
  {
    return Session::Put(ConfigGlobal::Get('Session/TokenName'), md5(uniqid()));
  }

  public static function Check($Token)
  {
	$TokenName = ConfigGlobal::Get('Session/TokenName');

	if (Session::Exists($TokenName) && $Token === Session::Get($TokenName)) 
	{
		Session::Delete($TokenName);
		return true;
	}
	return false;
  }


}
