<?php
              require_once("userCake/models/db-settings.php"); //Require DB connection
    require_once("userCake/models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

 ?>

 <?php 
//text, text_id, filename
 $text=$_POST['text'];
 $text_id=$_SESSION["text_id"];
 $filename=$_POST['filename'];

 function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
debug_to_console("in save");

       
 $file = fopen($file_directory.$text_id. ".txt","a+");
           
            
            file_put_contents($file_directory.$text_id.".txt", $text);
            fclose($file);

 
          

          ?>