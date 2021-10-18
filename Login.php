<?php 

session_start();

header("Cache-Control: max-age=2592000");

require_once "Core/Define.php";
require_once "Core/Init.php";
require_once "Core/Head.php";

$User = new User();

if ($User->IsLoggedIn()) 
{
	Redirect::To('index.php');
} 
else
{
	if(isset($_POST['Login'])) 
	{
		//echo "teste";
		if(Token::Check(Input::Get('token'))) 
		{	
			//echo "testeasd";
			$Validate = new Validate();
			$Validation = $Validate->Check($_POST, array(
			  'Usernamea' => array('required' => true),
			  'Passworda' => array('required' => true)
			));
			if($Validation->Passed()) 
			{
				//echo "Passou!";
				$User = new User();
				$Remember = (Input::Get('Remembera') === 'on') ? true : false;
				$_SESSION['Username'] = Input::Get('Usernamea');
				$_SESSION['user_uid']	=	$_SESSION['Username'];
				$_SESSION['LoggedIn']	=	1;
				$_SESSION['Admin_LoggedIn']	=	1;
				$Login = $User->Login(Input::Get('Usernamea'), Input::Get('Passworda'), $Remember);
				if($Login) 
				{
					//echo $_SESSION['user'];
					//print_r($_SESSION['user']);
					Redirect::To('index.php');
				} 
				else 
				{
					echo "<p>Sorry, logging in failed.</p><br><br>";
				}

			} 
			else 
			{
				foreach($Validation->Errors() as $Error) 
				{
					echo $Error, '<br>';
				}
			}
		}
	}
	?>

<html>

	<head>
	
	</head>
	
	<body>
		
		<main>
			
			<content>
			
				<div id="PageWrapper">
				
					<div id="wBox">
					
						<div id="TitleBar">
						
							<img id="Img24" src="Images/Icons/Login_before.png"></img>
							
							<p id="Text_H1">Login.php</p>
							
						</div>
						
						<div id="TitleBar">
						
							<p id="Text_H1">If not logged in, index.php redirects</p>
							<p id="Text_H1"> to this page, Login.php. Upon login,</p>
							<p id="Text_H1">it redirects to index.php</p>
							<p id="Text_H1">Config.php will also redirect here</p>
							<p id="Text_H1">if not logged in</p>
							
						</div>
						
						<div id="Contents">
						
							<form class="" action="" method="Post">
							
								<div class="TextAlignLeft">
								
									<p id="Error:labels" for="Usernamea">Username</p>
									
								</div>
								
								<input id="FormIputText" type="text" class="input" name="Usernamea" id="Usernamea" autocomplete="off" placeholder="joey">
								
								<div class="TextAlignLeft">
								
									<p id="Error:labels"  for="Passworda">Password</p>
									
								</div>
								
								<input id="FormIputText" type="password" class="input" name="Passworda" id="Passworda" autocomplete="off" placeholder="asd123">
								
								<div class="TextAlignRight">
								
									<input type="Checkbox" id="Checkbox" class="Checkbox" name="Remembera" id="Remembera" checked></input>
									
									<label for="Checkbox"></label>
									
									<label class="Checkbox_RememberMe" for="Checkbox">Remember me</label>
									
								</div>
								
								<input id="token" type="hidden" name="token" value="<?php $Remeres = Token::Generate(); echo $Remeres?>">
								
								<div class="TextAlignRight">
								
									<button id="button" type="Submit" class="input" name="Login">Next></button>
									
								</div>
								
							</form>
							
							<button id="button" type="Submit" class="input" name="ForgotPassword" onclick="window.location=&quot;Register.php&quot;">or Register</button>	
							
						</div>
						
					</div>
					
				</div>	

			</content>
			
		</main>	
		
		<footer>
		
		</footer>
		
	</body>
	
</html>
	
<?php
}


