<?php 

session_start();

header("Cache-Control: max-age=2592000");

require_once "Core/Define.php";
require_once "Core/Init.php";
require_once "Core/Head.php";

if (isset($_POST['Register']))
{
	echo Input::Get('Token');
	if (Token::Check(Input::Get('Token'))) 
	{
		//echo "Submitted!";
		//echo Input::get('username');
		//echo Input::get('password');
		//echo Input::get('password_again');
		$Validate = new Validate();
		$Validation = $Validate->Check($_POST, array(
			'Username' => array(
			  'required' => true,
			  'min' => 2,
			  'max' => 20,
			  'unique' => 'User'
			),
			'Password' => array(
			  'required' => true,
			  'min' => 6
			),
			'Password_Again' => array(
			  'required' => true,
			  'matches' => 'Password'
			),
			'Name' => array(
			  'required' => true,
			  'min' => 2,
			  'max' => 50
			)
		));
		if ($Validation->Passed()) 
		{
			//Session::flash('success', 'You registered successfully!');
			//header('Location: index.php');
			$User = new User();
			try 
			{
				$Salt = Hash::Salt(32);
				$User->Create(array(
				'Username' => Input::Get('Username'),
				'Password' => Hash::Make(Input::Get('Password'), $Salt),
				'Salt' => $Salt,
				'Name' => Input::Get('Name'),
				'Joined' => date('Y-m-d H:i:s'),
				'GroupType' => 1,
				'uid' => 'asd123uid',
				'uidkey' => 'asd123uikey',
				'permissions' => '00002',
				'ipaddress' => 'ipaddress',
				'theme_uid' => 'bebfbdbe9f5d3b90e1dd56702398a3a4',
				'a' => '1',
				'filename' => 'Default_Profile_Picture.png',
				'email' => 'asd@asd.asd'
				));
			} 
			catch (Exception $e) 
			{
				echo $e->getMessage();
			}
			// here to
			$Remember = (Input::Get('Remember') === 'on') ? true : false;
			$Login = $User->Login(Input::Get('Username'), Input::Get('Password'), $Remember);
			
			if ($Login) 
			{
				Redirect::to('index.php');
			} 
			else 
			{
				echo "<p>Sorry, logging in failed.</p><br>";
			}
			//here
		} 
		else 
		{
			//print_r($validation->errors());
			$a=0;
			foreach ($Validation->Errors() as $Error) 
			{
				echo "Line     : 114-".$a.".<br>";
				echo "Error : 114-".$a." : ".$Error."<br>";
				$a++;
			}
		}

	} 
} 
?>

<div id="PageWrapper">
	<div id="wBox">
		<div id="TitleBar">
			<img id="Img24" src="Images/Icons/Register.png"></img>
			<p id="Text_H1">Register.php</p>		
		</div>
		<div id="Contents">
			<form class="" action="" method="Post">
				<div class="TextAlignLeft">
					<p id="Line:labels"  for="Name">Your real name</p>
				</div>
				<input id="FormIputText" type="text" class="form-control" name="Name" value="<?php //echo escape(Input::Get('Name')); ?>" id="name" autocomplete="off">
				<div class="TextAlignLeft">
					<p id="Line:labels"  for="Username">Username</p>
				</div>
				<input id="FormIputText" type="text" class="form-control" name="Username" value="<?php //echo escape(Input::Get('Username')); ?>" id="username" autocomplete="off">
				<div class="TextAlignLeft">
					<p id="Line:labels"  for="Password">Password</p>
				</div>
				<input id="FormIputText" type="password" class="form-control" name="Password" value="" id="password" autocomplete="off">
				<div class="TextAlignLeft">
					<p id="Line:labels"  for="password_again">Password again</p>
				</div>
				<input id="FormIputText" type="password" class="form-control" name="Password_Again" value="" id="password_again" autocomplete="off">
				<input name="Token" type="hidden" value="<?php $remeres = Token::Generate(); echo $remeres?>"></input>
				<div class="TextAlignRight">
					<input type="Checkbox" id="Checkbox" class="Checkbox" name="Remember" id="Remember" checked></input>
					<label for="Checkbox"></label>
					<label class="Checkbox_RememberMe" for="Checkbox">Remember me</label>
				</div>
				<div class="TextAlignRight">
					<button id="button" type="submit" class="input" name="Register">Next></button>
				</div>
			</form>
			<button id="button" type="Submit" class="input" name="Login" onclick="window.location=&quot;Login.php&quot;">or Login</button>
		</div>
	</div>
</div>