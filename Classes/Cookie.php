<?php

class Cookie {

  public static function Exists($name)
  {
    return (isset($_COOKIE[$name])) ? true : false;
  }

  public static function Get($name)
  {
    return $_COOKIE[$name];
  }

  public static function Put($name, $value, $expiry)
  {
    if(setcookie($name, $value, time() + $expiry, '/')) {
      return true;
    }
    return false;
  }

  public static function delete($name)
  {
    Self::Put($name, '', time() - 1);
  }

} //fim classe
