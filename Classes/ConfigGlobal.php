<?php

class ConfigGlobal
{
  public static function get($path = null)
  {
    if ($path) 
	{
      $ConfigGlobal = $GLOBALS['ConfigGlobal'];
      $path = explode('/', $path);
      // print_r($path);

      foreach ($path as $bit) 
	  {

        //echo $bit, ' ';

        // if (isset($ConfigGlobal[$bit])) {
        //   echo 'Set';
        // }

          if (isset($ConfigGlobal[$bit])) 
		  {
            $ConfigGlobal = $ConfigGlobal[$bit];
          }
      }

      return $ConfigGlobal;
    }

    return false;

  }


}

?>