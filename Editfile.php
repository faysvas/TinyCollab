<!DOCTYPE html>
<html>
      <head >



<meta charset="utf-8">
        <title>Collaborative Text Editor</title>
<!-- Latest compiled and minified CSS -->

        <script src="js/jquery-1.11.3.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.min.css">


     

        <script type="text/javascript" src="markitup/jquery.markitup.js"></script>
        <script type="text/javascript" src="markitup/sets/default/set.js"></script>
        <link rel="stylesheet" type="text/css" href="markitup/skins/markitup/style.css" />
        <link rel="stylesheet" type="text/css" href="markitup/sets/default/style.css" />
        <script src="js/bootstrap.min.js"></script>
        <script src="js/sockjs.min.js"></script>
        <script src="js/sockjs-client.js"></script>
         <script src="editfile.js"></script>
             <link rel="shortcut icon" href="favicon.ico">  
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
    <!-- Global CSS -->
  
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="assets/plugins/prism/prism.css">
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/styles.css">


       <?php
        require_once("userCake/models/config.php");
        require_once("userCake/models/db-settings.php"); //Require DB connection
   
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("userCake/models/header.php");
if(!isUserLoggedIn()) { require_once("userCake/login.php"); die(); }
?>      

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$_SESSION["text_id"]=$_POST['text_id'];
}


function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
$string = trim(preg_replace('/\s\s+/', ' ', $output));
    echo $string;
}

debug_to_console($_SESSION["text_id"]);
require_once("userCake/models/db-settings.php"); //Require DB connection
if ($stmt = $mysqli->prepare("SELECT uc_users.user_name FROM uc_users INNER JOIN user_to_file ON uc_users.id= user_to_file.user_id WHERE user_to_file.file_id=?")) {

    /* bind parameters for markers */
    $stmt->bind_param("i", $_POST['text_id']);

    /* execute query */
    /* execute query */
    $stmt->execute();

    /* instead of bind_result: */
    $result_users = $stmt->get_result();

for ($x = 1; $x <= $mysqli->affected_rows; $x++) {
    $rows[] = $result_users->fetch_assoc();
}


}






 ?></head>

  <body >

    <header id="header" class="header">  
        <div class="container">            
            <h1 class="logo pull-left">
                <a class="scrollto" href="#promo">
                    <span class="logo-title">Tiny Collab</span>
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
                     
                                      
                        <li class="nav-item last"><a href="userCake/logout.php">Logout</a></li>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div>
    </header><!--//header-->


      <section id="about" class="promo section">
        <div class="container-fluid">
     <div class="row">   

      <div class="col-md-2">
  <div class="form-group">      
<div class="row">
 
    <div class="thumbnail">
        <div class="caption">

         <form name="openfile" id="openfile" method="post" action="save.php">
         
 
                                                     
            <input type="hidden" name="text_id" value="<?php echo $_SESSION['text_id'] ?>" id="text_id">
          
           <div id="username"><?php echo "$loggedInUser->displayname"." " ?>you are editing 

<?php

 $text_id=$_SESSION["text_id"];
$stmt = $mysqli->prepare("SELECT name FROM documents WHERE id = ?");
$stmt->bind_param("i",$text_id);

// set parameters and execute
$text_id = $text_id;

$stmt->execute();

 $result = $stmt->get_result();
$result=$result->fetch_assoc();
echo implode($result);
?>
    </div>
</div>
</div>
</row>





           

   <input class="form-control"  type="text" name="add_user" id="add_user" value="" ><br/>
        <input class="btn btn-default"  type="button" value ="Add a collaborator" onclick="AddUser()" />
        <div id="notify"></div>
<div class="list-group"><?php foreach($rows as $val) {?><div id="<?php echo implode( ',', $val) ;?>"><?php $name=implode( ',', $val) ; echo trim($name);}?>
</div>
</div>         
         

        </form>
      </div>
    </div>
  
</div>
         </div>
      
      <div class="col-md-8">




        <textarea class="form-control"  rows="25" id="myform2" name="myform2" ><?php
//na vrw giati de vgazi swsta ta display names kai molis ta vrw na ftiaxw mia lista pou tha exei ta onomata
if(isset($file_directory)){
  global $file_directory;
 $file=$file_directory.$_SESSION["text_id"].".txt";
}
 //$file_handler = fopen($file, "r");  

    // to open a local file use this instead  
         $file_handler = fopen($file, "r+");  
 $size=filesize($file);   
if(filesize($file)==0)
  $size=1;

    // read the contents  
    $contents = fread($file_handler, $size);  

    // close the file  
    fclose($file_handler);  

    // print the contents on your page  
    echo $contents; 



?></textarea>
      </div>

      <div class="col-md-2">
        
        
        <textarea readonly rows="20" class="form-control" style="resize:none;" id="chat" name="chat"  >Welcome!</textarea>


        <input type="text" class="form-control" name="message" id="message" value="" ><br/>
        <input class="edit btn btn-default"  type="button" value ="Send" onclick="sendMessage();" />

         
</div>
       
</row>
</section>

        <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
?>
          
        <script type="text/javascript">
 

  $(document).ready(function(){

    $('#save').click(function() {

        $.ajax({
            type : 'POST',
            url : 'save.php',           
            data: {
                text : $('#myform2').val(),
                text_id  : $('#text_id').val(),
                filename  : $('#filename').val()
            },
            success:function (data) {
              
            }          
        });     
    });
});


    $(document).ready(function(){
  
      
 $('#myform2').on('keyup', function() {
        sendMessage();
       
    });

$("#save").hide();
 // getTextInfo();
  console.log("in read")
  startLoop();
 
          });

        </script>
           <?php
}
?>
   

          <script type="text/javascript">   

$("#myform2").markItUp(mySettings);


  console.log(  $('#myform2').val() )

          </script> 



 <div id="inset_form"></div>
     <input type="button" id="save" value ="Save"  />

</row>
</div>
   
    </body>
 
    <script type="text/javascript" src="assets/plugins/jquery-migrate-1.2.1.min.js"></script>    
    <script type="text/javascript" src="assets/plugins/jquery.easing.1.3.js"></script>   
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>     
    <script type="text/javascript" src="assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js"></script> 
    <script type="text/javascript" src="assets/plugins/prism/prism.js"></script>    
    <script type="text/javascript" src="assets/js/main.js"></script>   
</html>
