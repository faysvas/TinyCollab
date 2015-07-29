<!DOCTYPE html>
<html>
    <head>
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


     <?php


     
        require_once("userCake/models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//require_once("userCake/models/header.php");
require_once("userCake/models/db-settings.php");
  if(!isUserLoggedIn()) { require_once("userCake/login.php"); die(); }
?>   
</head>
    <body data-spy="scroll">
          <header id="header" class="header">  
        <div class="container">            
            <h1 class="logo pull-left">
                <a class="scrollto" href="index.php">
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
                       <li class="nav-item  ">   <div id="notification" ></div></li>
                     <li class="nav-item  ">   <div style="color:#0a7396">Filename:</div></li>
                          <li class="nav-item  "> <form class="form-inline"><div class="form-group"><input style="color=black;" class="form-control" value="" id="filename"></div><button type="button" class="newfile btn btn-default" id="newfile" value="New File" >New File </button> </form></li>                
                        <li class="nav-item last"><a href="userCake/logout.php">Logout</a></li>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div>
    </header><!--//header-->
  

        
<section id="about" class="promo section">
        <div class="container text-center">
       
              <?php

if ($stmt = $mysqli->prepare("SELECT documents.name, user_to_file.file_id FROM (documents INNER JOIN user_to_file ON documents.id= user_to_file.file_id) WHERE user_to_file.user_id=? ORDER BY documents.id DESC")) {

    /* bind parameters for markers */
    $stmt->bind_param("i", $loggedInUser->user_id);

    /* execute query */
    /* execute query */
    $stmt->execute();

    /* instead of bind_result: */
    $result = $stmt->get_result();
?>
<div>
  


<form id ="browsefile" name="browsefile" method="post" action="editfile.php">
<div class="list-group">
  
<div class="row">
  <div class="col-sm-6 col-md-4">

<?php
//$myrow['file_id']
 // use your $myrow array as you would with any other fetch
    while ($myrow = $result->fetch_assoc()) {
?>
 <div class="thumbnail">
  <div class="caption">
        <h3> <?php
        printf("%s", $myrow['name']);
        ?></h3>
       
        <p>   <button type="button" class="edit btn btn-default" id="<?php echo $myrow['file_id'] ?>" value="Edit file" name="edit">
      Edit File
        
        </button> </p>


      </div>

    
      
        <input type="hidden" value="<?php echo $myrow['file_id'] ?>" name="input2"/>
       </div>

      
    
<?php
    }

}

    ?>
     </div>
      </div> 
</div>




 </form name="openfile" method="post" action=""  >

 </div>



 </div>
</section>

 <div id="inset_form"></div>
 <script type="text/javascript">

$(".edit").click(function(){
  var text_id = this.id;

$('#inset_form').html('<form  action="Editfile.php" name="form" method="post" style="display:none;"><input type="text" name="text_id" value="' + text_id + '" /></form><input style="display:none;" type="submit" name="inset_form" value="Submit form">');
   
document.forms['form'].submit();


});

  $('#newfile').click(function() {
    if ($('#filename').val()==''){

        $('#notification').text("Filename cannot be empty")
    }
    else{
// 1. Create XHR instance - Start
    var xhr;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
    }
    else {
        throw new Error("Ajax is not supported by this browser");
    }
    // 1. Create XHR instance - End
    
    // 2. Define what to do when XHR feed you the response from the server - Start
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status == 200 && xhr.status < 300) {
            location.reload();
           // $("#notification").text($.trim(xhr.responseText))    
            }
        }
    }
    // 2. Define what to do when XHR feed you the response from the server - Start

   // var userid = document.getElementById("userid").value;

    // 3. Specify your action, location and Send to the server - Start 
    xhr.open('POST', 'savenew.php');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("filename=" + $('#filename').val());

    // 3. Specify your action, location and Send to the server - End   
}
    });




</script>

    </body>
        <script type="text/javascript" src="assets/plugins/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-migrate-1.2.1.min.js"></script>    
    <script type="text/javascript" src="assets/plugins/jquery.easing.1.3.js"></script>   
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>     
    <script type="text/javascript" src="assets/plugins/jquery-scrollTo/jquery.scrollTo.min.js"></script> 
    <script type="text/javascript" src="assets/plugins/prism/prism.js"></script>    
    <script type="text/javascript" src="assets/js/main.js"></script>   
</html>

