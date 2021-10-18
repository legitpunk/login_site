<?php

if (Cookie::Exists(ConfigGlobal::Get('Remember/CookieName')) && !Session::Exists(ConfigGlobal::Get('Session/SessionName'))) {
  $Hash = Cookie::Get(ConfigGlobal::Get('Remember/CookieName'));
  $HashCheck = DbGlobal::GetInstance()->get('UsersSession', array('Hash', '=', $Hash));
  if ($HashCheck->count()) {
    //echo 'Hash matches, log user in';
    $User = new User($HashCheck->First()->UserId);
    $User->Login();
  }
}

?>