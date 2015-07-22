<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
$string = trim(preg_replace('/\s\s+/', ' ', $output));
    echo $string;
}



require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$username = sanitize(trim($_POST["username"]));
	$password = trim($_POST["password"]);
	
	//Perform some validation
	//Feel free to edit / change as required
	if($username == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!usernameExists($username))
		{
			$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
		
			
		}
		else
		{
			$userdetails = fetchUserDetails($username);
			//See if the user's account is activated
			if($userdetails["active"]==0)
			{
				$errors[] = lang("ACCOUNT_INACTIVE");
			}
			else
			{
				//Hash the password and use the salt from the database to compare the password.
				$entered_pass = generateHash($password,$userdetails["password"]);
				
				if($entered_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
				}
				else
				{
					//Passwords match! we're good to go'
					
					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->title = $userdetails["title"];
					$loggedInUser->displayname = $userdetails["display_name"];
					$loggedInUser->username = $userdetails["user_name"];
					
					//Update last sign in
					$loggedInUser->updateLastSignIn();
					$_SESSION["userCakeUser"] = $loggedInUser;
					
					//Redirect to user account page
		
				}
			}
		}
	}
debug_to_console($errors);
		header('Location: ../index.php');

					die();
}


require_once("models/header.php");
?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
            <link rel="shortcut icon" href="favicon.ico">  
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
     <script src="js/bootstrap.min.js"></script>
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="assets/plugins/prism/prism.css">
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">
<script type="text/javascript">


</script>

<body>
  <header id="header" class="header">  
        <div class="container">            
            <h1 class="logo pull-left">
                <a class="scrollto" href="#promo">
                    <span class="logo-title">Collaborative Text Editor</span>
                </a>
            </h1><!--//logo-->              
            <nav id="main-nav" class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->            
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active nav-item sr-only"><a class="scrollto" href="index.php">Home</a></li>
                                           
                     
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div>
    </header><!--//header-->
<!-- ******PROMO****** -->
    <section id="promo" class="promo section offset-header">
        <div class="container text-center">
            <h2 class="title">Tiny<span class="highlight">Collab</span></h2>
            <p class="intro">A real-time collaborative text editor</p>

           <div class="col-xs-4 centercontents center-block">
           </div>

           <div class="col-xs-4 centercontents center-block">
<form name='login' action='usercake/login.php' method='post'>
<p id="errors">
	<?php

echo resultBlock($errors,$successes);


	 ?>
</p>
<p>
<label>Username:</label>
<input class="form-control" type='text' name='username' />
</p>
<p>
<label>Password:</label>
<input class="form-control"  placeholder="" type='password' name='password' />
</p>
<p>

<input class="btn btn-default" type='submit' value='Login' class='submit' />
</p>
</form>

<form name='register' action='usercake/register.php' method='post'>

<p>

<input class="btn btn-default" type='submit' value='New User' class='submit' />
</p>
</form>

</div>

 <div class="col-xs-4 centercontents center-block">
           </div>
        </div><!--//container-->
    
    </section><!--//promo-->


<script>
$(document).ready(function() {
$("#errors").text(<?php echo implode($errors) ?>)
});
</script>
</body>
</html>













