<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/


require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$email = trim($_POST["email"]);
	$username = trim($_POST["username"]);
	$displayname = trim($_POST["displayname"]);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);
	$captcha = md5($_POST["captcha"]);
	
	
	if ($captcha != $_SESSION['captcha'])
	{
		$errors[] = lang("CAPTCHA_FAIL");
	}
	if(minMaxRange(5,25,$username))
	{
		$errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25));
	}
	if(!ctype_alnum($username)){
		$errors[] = lang("ACCOUNT_USER_INVALID_CHARACTERS");
	}
	if(minMaxRange(5,25,$displayname))
	{
		$errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT",array(5,25));
	}
	if(!ctype_alnum($displayname)){
		$errors[] = lang("ACCOUNT_DISPLAY_INVALID_CHARACTERS");
	}
	if(minMaxRange(8,50,$password) && minMaxRange(8,50,$confirm_pass))
	{
		$errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50));
	}
	else if($password != $confirm_pass)
	{
		$errors[] = lang("ACCOUNT_PASS_MISMATCH");
	}
	if(!isValidEmail($email))
	{
		$errors[] = lang("ACCOUNT_INVALID_EMAIL");
	}
	//End data validation
	if(count($errors) == 0)
	{	
		//Construct a user object
		$user = new User($username,$displayname,$password,$email);
		
		//Checking this flag tells us whether there were any errors such as possible data duplication occured
		if(!$user->status)
		{
			if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
			if($user->displayname_taken) $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
			if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));		
		}
		else
		{
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if(!$user->userCakeAddUser())
			{
				if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
				if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
			}
		}
	}
	if(count($errors) == 0) {
		$successes[] = $user->success;
	}
}


?>
<!DOCTYPE html>
<html>
    <head>


        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
            <link rel="shortcut icon" href="favicon.ico">  
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
    <!-- Global CSS -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
     <script src="js/bootstrap.min.js"></script>
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/plugins/prism/prism.css">
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="../assets/css/styles.css">
<body>






<?php echo resultBlock($errors,$successes); ?>

<section id="about" class="promo section">
        <div class="container text-center">
        	<h2 class="title">Register</h2>
 <div class="col-xs-4 centercontents center-block">
           </div>

           <div class="col-xs-4 centercontents center-block">

<div id='regbox'>
<form name='newUser' action='".$_SERVER['PHP_SELF']."' method='post'>

<p>
<label >User Name:</label>
<input class="form-control" type='text' name='username' />
</p>

<p>
<label >Display Name:</label>
<input class="form-control" type='text' name='displayname' />
</p>

<p>
<label >Password:</label>
<input class="form-control" type='password' name='password' />
</p>

<p>
<label >Confirm:</label>
<input class="form-control" type='password' name='passwordc' />
</p>

<p>
<label >Email:</label>
<input class="form-control" type='text' name='email' />
</p>

<p>
<label >Security Code:</label>
<img src='models/captcha.php'>
</p>
<p>
<label >Enter Security Code:</label>
<input class="form-control" name='captcha' type='text'>
</p>
<p>
<label >&nbsp;<br>
<input class="form-control" type='submit' value='Register'/>
</p>

</form>




</div>
<div class="col-xs-4 centercontents center-block">
           </div>
        </div>
        </section>
</body>
    <script type="text/javascript" src="../assets/plugins/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/jquery-migrate-1.2.1.min.js"></script>    
    <script type="text/javascript" src="../assets/plugins/jquery.easing.1.3.js"></script>   
    <script type="text/javascript" src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>     
    <script type="text/javascript" src="../assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js"></script> 
    <script type="text/javascript" src="../assets/plugins/prism/prism.js"></script>    
    <script type="text/javascript" src="../assets/js/main.js"></script>   
</html>
