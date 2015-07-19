<?php
              require_once("userCake/models/db-settings.php"); //Require DB connection
    require_once("userCake/models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

 ?>

<?php
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}



$text_id=$_POST['text_id'];
$username=$_POST['username'];

//debug_to_console($_POST['username']);


$stmt = $mysqli->prepare("SELECT id FROM uc_users WHERE user_name = ?");
$stmt->bind_param("s",$username);

// set parameters and execute
$username = $username;

$stmt->execute();

 $result = $stmt->get_result();
$result=$result->fetch_assoc();

 $user_id=$result['id'];
 
//print_r($user_id);
 //edw ginetai elegxos an epestrepse apotelesmata


$stmt = $mysqli->prepare("SELECT * FROM user_to_file WHERE (user_id=? AND file_id=?)");
$stmt->bind_param("ii",$user_id,$file_id );
//$stmt->bind_param("isis",$user_id1,$file_id1,$user_id2,$file_id2 );

// set parameters and execute
$user_id = $user_id; //afto prepei na einai logika

$file_id= $text_id;
//$user_id2 = $user_id; //afto prepei na einai logika

//$file_id2 = $text_id;
$stmt->execute();

$found = $stmt->get_result();
$found=$found->fetch_assoc();
print_r($found);


if (empty($found)) {
	
//$stmt = $mysqli->prepare("INSERT INTO user_to_file (user_id,file_id) SELECT ?, ? FROM DUAL WHERE NOT EXISTS (SELECT user_id FROM user_to_file WHERE user_id=? AND file_id=? LIMIT 1)");
$stmt = $mysqli->prepare("INSERT INTO user_to_file (user_id,file_id) VALUES (?,?)");
$stmt->bind_param("ii",$user_id,$file_id );
//$stmt->bind_param("isis",$user_id1,$file_id1,$user_id2,$file_id2 );

// set parameters and execute
$user_id = $user_id; //afto prepei na einai logika

$file_id= $text_id;
//$user_id2 = $user_id; //afto prepei na einai logika

//$file_id2 = $text_id;
$stmt->execute();

//}

}
 
  header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
