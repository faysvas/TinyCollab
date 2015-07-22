    <?php
              require_once("userCake/models/db-settings.php"); //Require DB connection
    require_once("userCake/models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

 ?>

 <?php 
//text, text_id, filename

 $filename=$_POST['filename'];
global $file_directory;
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
debug_to_console("in save new");

    if(!file_exists($filename."/text.txt")){
                $file = tmpfile();
            }
//Na dinetai ena displayname gia to keimeno alla afto tha apothikevetai me vash to id
$stmt = $mysqli->prepare("INSERT INTO documents (name) VALUES (?)");
$stmt->bind_param("s",$name );

// set parameters and execute
$name = $filename;
$stmt->execute();
$last_file_id=$mysqli->insert_id;



            $file = fopen($file_directory."/text".$last_file_id.".txt","a+");
           
           
            if(file_put_contents($file_directory."/text".$last_file_id.".txt", ""))
             
            
            fclose($file);
           echo "File Created!";
?>

 <?php 
            // Check connection
//An apotuxei h apothikefsi tou arxeiou diagrafetai h teleftaia eggrafi apo to pinaka


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
//Na ftiaxw: na mh mporei o idios xrhsths na exei duo arxeia me to idio onoma. Genika omos na psaxnei me vash to id oxi to onoma
//insert filename in database



//map permission to file

$stmt = $mysqli->prepare("INSERT INTO user_to_file (user_id,file_id) VALUES (?,?)");
$stmt->bind_param("ii",$user_id,$file_id );

// set parameters and execute
$user_id = $loggedInUser->user_id;

$file_id = $last_file_id;
$stmt->execute();
 $_SESSION["text_id"]=$last_file_id; 
  //echo $last_file_id;
  header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;

      
   ?>