<?php

class Hash {

  public static function Make($string, $salt = '')
  {
    return hash('sha256', $string . $salt);
  }

  public static function Salt($length)
  {
    return password_hash($length, PASSWORD_DEFAULT);
  }

  public static function Unique()
  {
    return Self::Make(uniqid());
  }

}
