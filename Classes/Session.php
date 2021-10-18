<?php

class Session {

  public static function Exists($name)
  {
    return (isset($_SESSION[$name])) ? true : false;
  }

   public static function Put($name, $value)
   {
     return $_SESSION[$name] = $value;
   }

   public static function Get($name)
   {
    return $_SESSION[$name];
   }

   public static function delete($name)
   {
     if (Self::Exists($name)) {
       unset($_SESSION[$name]);
     }
   }

   public static function flash($name, $string = '')
   {

     if (Self::Exists($name)) {

      $session = Self::Get($name);
      Self::delete($name);
      return $session;

    } else {

      Self::Put($name, $string);

    }
    // return '';
   }




} //fim classe
