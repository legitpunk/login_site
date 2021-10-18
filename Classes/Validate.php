<?php

class Validate {

  private $_Passed = false,
          $_Errors = array(),
          $_Db     = null;

  public function __construct()
  {
    $this->_Db = DbGlobal::GetInstance();
  }

	public function escape()
	{
		return htmlentities($string, ENT_QUOTES, 'UTF-8');
	}
  public function Check($source, $items = array())
  {
    foreach ($items as $item => $rules) 
	{

      foreach($rules as $rule => $rule_value) 
	  {
        //echo "{$item} {$rule} must be {$rule_value}<br>";
        $value =  trim($source[$item]);
        $item = escape($item);
        // echo $value;
        if ($rule === 'required' && empty($value)) 
		{
          $this->AddError("{$item} is required");
        } 
		else if(!empty($value))
		{
          switch ($rule) 
		  {

            case 'min':
              if (strlen($value) < $rule_value) {
                $this->AddError("{$item} must be a minimun of {$rule_value} characters.");
              }
            break;

            case 'max':
            if (strlen($value) > $rule_value) {
              $this->AddError("{$item} must be a maximum of {$rule_value} characters.");
            }
            break;

            case 'matches':
              if ($value != $source[$rule_value]) {
                $this->AddError("{$rule_value} must match {$item}");
              }
            break;

            case 'unique':
              $check = $this->_Db->Get($rule_value, array($item, '=', $value));
              if ($check->count()) {
                $this->AddError("{$item} already exists.");
              }
            break;

            default:
              # code...
              break;
          }
        }
      }
    }
    if (empty($this->_Errors)) 
	{
      $this->_Passed = true;
    }
    return $this;
  }

  private function AddError($error)
  {
    $this->_Errors[] = $error;
  }

  public function Errors()
  {
    return $this->_Errors;
  }

  public function Passed()
  {
    return $this->_Passed;
  }

}
