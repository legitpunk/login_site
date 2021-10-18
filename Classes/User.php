<?php

class User 
{

	private $_Db,
			$_Data,
			$_SessionName,
			$_CookieName,
			$_IsLoggedIn,
			$_Groups;

	public function __construct($User = null)
	{
		$this->_Db = DbGlobal::GetInstance();
		$this->_SessionName = ConfigGlobal::Get('Session/SessionName');
		$this->_CookieName = ConfigGlobal::Get('Remember/CookieName');

		if(!$User) 
		{
			if(Session::Exists($this->_SessionName)) 
			{
				$User = Session::Get($this->_SessionName);
				if($this->Find($User)) 
				{
					$this->_IsLoggedIn = true;
				} 
				else 
				{
					//Redirect::to("LoginOrRegister.php");
				}
			}
		} 
		else 
		{
			$this->Find($User);
		}
	}

	public function Update($fields = array(), $id = null)
	{
		if (!$id && $this->IsLoggedIn()) 
		{
		  $id = $this->Data()->rowid;
		}

		if (!$this->_Db->Update('user', $id, $fields)) 
		{
		  throw new Exception('There was a problem updating.<br>');
		}
	}

	public function Create($fields)
	{
		if($this->_Db->Insert('user', $fields)->Error())
		{
		}
		else
		{
		}
		
	}

	public function Find($User = null)
	{
		if($User) 
		{
			$field = (is_numeric($User)) ? 'rowid' : 'username';
			try
			{
				$data1 = $this->_Db->Get('user', array($field, '=', $User));
				
				if($data1->count() == 1) 
				{
					$this->_Data = $data1->First();
					return true;
				}
				else
				{
					
				}
			}
			catch(PDOException $e)
			{
				$this->_Error = $e;
				ModalError('Error:'.$e->getCode().':<br>'.$e->getMessage().'<br>'.$e->errorInfo().'<br>'); //die($e->getMessage());
			}
		}
	return false;
	}

	public function Login($Username = null, $Password = null, $Remember = false)
	{
		if (!$Username && !$Password && !$this->Exists())
		{
			Session::Put($this->_SessionName, $this->Data()->rowid);
		}
		else 
		{
			
			$User = $this->Find($Username);
			
			if($User) 
			{
				
				if($this->Data()->password === Hash::make($Password, $this->Data()->salt)) 
				{

					Session::Put($this->_SessionName, $this->Data()->rowid);
					if ($Remember) 
					{
						$hash = Hash::Unique();
						
						$hashCheck = $this->_Db->Get('usersession', array('userid', '=', $this->Data()->rowid));

						if (!$hashCheck->count()) 
						{
							$this->_Db->Insert('usersession', array(
							'userid' => $this->Data()->rowid,
							'hash' => $hash
							));
						} 
						else 
						{
							$hash = $hashCheck->First()->Hash;
						}
						Cookie::Put($this->_CookieName, $hash, ConfigGlobal::Get('Remember/CookieExpiry'));
					}	
					return true;
				}
			}
			else
			{

			}

		}

		return false;
	}

	public function HasPermission($key)
	{
		$group = $this->_db->Get('groups', array('rowid', '=', $this->Data()->grouptype));

		if ($group->count()) 
		{
			$permissions = json_decode($group->First()->permissions, true);

			if ($permissions[$key] == true) 
			{
				return true;
			}
		}
	return false;
	}

	public function Exists()
	{
		return (!empty($this->_Data)) ? true : false;
	}

	public function Logout()
	{
		$this->_Error = false;
			try
			{
				$this->_Db->delete('usersession', array('userid', '=', $this->Data()->rowid));
				Session::delete($this->_SessionName);
				Cookie::delete($this->_CookieName);
			}
			catch(PDOExecption $e) 
			{
				$this->_Error = $e;
			}
		return $this;
	}

	public function Data()
	{
		return $this->_Data;
	}

	public function IsLoggedIn()
	{
		return $this->_IsLoggedIn;
	}

}
