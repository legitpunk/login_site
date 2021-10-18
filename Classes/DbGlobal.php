<?php

/**
 * Database Class
 */
 
class DbGlobal 
{

  private static $_instance = null;

  private $_Pdo,
          $_Query,
          $_Error = false,
          $ModalError = false,
          $_Results,
          $_Count = 0;


	private function __construct()
	{
		try
		{
			try 
			{
				$this->_Pdo = new PDO('mysql:host='. ConfigGlobal::get('mysql/host') .';dbname='. ConfigGlobal::get('mysql/db'), ConfigGlobal::get('mysql/username'), ConfigGlobal::get('mysql/password'));
				$this->_Pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); 			//WarningEXCEPTION
			} 
			catch (PDOException $e) 
			{
				echo 'DbGlobal.php : Line : 33 : Error:'.$e->getCode().':<br>'.$e->getMessage().'<br>'.$e->errorInfo().'<br>'; //die($e->getMessage());
			}
		}
		catch(customException $e)
		{
			//throw new MyCustomDbException('asd');
			echo 'DbGlobal.php : Line : 39 : Error:'.$e->getCode().':<br>'.$e->getMessage().'<br>'.$e->errorInfo().'<br>'; //die($e->getMessage());
		}
	}

	  
	public static function GetInstance()
	{
		if(!isset(Self::$_instance)) 
		{
			Self::$_instance = new DbGlobal();
		}
		return Self::$_instance;
	}

	public function Query($sql, $params = array())
	{
		$this->_Error = false;
		if($this->_Query = $this->_Pdo->Prepare($sql)) 
		{
			$x = 1;
			
			if(count($params)) 
			{
				foreach($params as $param) 
				{
					$this->_Query->BindValue($x, $param);
					$x++;
				}
			}
			if($this->_Query->Execute()) 
			{
				$this->_Results = $this->_Query->FetchAll(PDO::FETCH_OBJ);
				$this->_Count = $this->_Query->RowCount();
			} 
			else 
			{
				$this->_Error = true;
			}
		}
	return $this;
	}
		
	public function Close()
	{
	  $this->_Results = null;
	}
	
	public function Action($action, $table, $where = array())
	{
		if (count($where) === 3) 
		{
			$operators = array('=','>','<','>=', '<=');

			$field    = $where[0];
			$operator = $where[1];
			$value    = $where[2];


			if (in_array($operator, $operators)) 
			{
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				if (!$this->Query($sql, array($value))->Error()) 
				{
					return $this;
				}
			}
		}
    return false;
	}

	public function Get($dbntable, $where)
	{
		return $this->Action('SELECT *', $dbntable, $where);
	}

	public function Delete($table, $where = array())
	{
		if (count($where) === 3) 
		{
			$operators = array('=','>','<','>=', '<=');

			$field    = $where[0];
			$operator = $where[1];
			$value    = $where[2];

			if (in_array($operator, $operators)) 
			{
			$sql = "DELETE FROM {$table} WHERE {$field} {$operator} {$value}";

				$this->_Error = false;

				if($this->_Query = $this->_Pdo->Prepare($sql))
				{
					try
					{
						$this->_Query->Execute();
					} 
					catch(PDOExecption $e) 
					{
						$this->_Error = $e;
					}
				}
			}
		}
    return $this;
	}
	
	public function Insert($table, $fields = array())
	{
		$keys = array_keys($fields);
		$values = null;
		$x = 1;

		foreach($fields as $field) 
		{
			$values .= '?';
			if($x < count($fields)) 
			{
				$values .= ', ';
			}
			$x++;
		}

		$sql = "INSERT INTO {$table} (`" . implode('`,`' , $keys) . "`) VALUES ({$values})";
		
		$this->_Error = false;

		if($this->_Query = $this->_Pdo->Prepare($sql, $fields)) 
		{
			
			$x = 1;
			
			if(count($fields)) 
			{
				foreach($fields as $fieldss) 
				{
					$this->_Query->BindValue($x, $fieldss);
					$x++;
				}
			}
			try
			{
				
				$this->_Query->Execute();
			} 
			catch(PDOExecption $e) 
			{
				$this->_Error = $e;
			}
		}
		return $this;
	}
	
	public function Update($table, $id, $fields)
	{
		$set = '';
		$x = 1;

	foreach($fields as $name => $value) 
	{
		$set .= "{$name} = ?";
		if($x < count($fields)) 
		{
			$set .= ', ';
		}
		$x++;
	}

	$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

	if (!$this->Query($sql, $fields)->Error()) 
	{
		return true;
	}
	return false;
	}

	public function Results()
	{
		return $this->_Results;
	}

	public function First()
	{
		return $this->_Results[0];
	}

	public function Error()
	{
		return $this->_Error;
	}

	public function count()
	{
		return $this->_Count;
	}
	public function Clear()
	{
		return $this->CloseCursor();
	}
}
