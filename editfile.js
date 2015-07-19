
function AddUser(){
    if($("#add_user").val() != '') {
$('#inset_form').html('<form action="add_user.php" name="form" method="post" style="display:none;"><input type="text" name="username" value="' + $("#add_user").val() + '" /><input type="text" name="text_id" value="' + $("#text_id").val() + '" /></form><input type="submit" name="inset_form" value="Submit form">');
   
document.forms['form'].submit();
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
            //Na tupwnei ena minima oti prosthese to xrhsth
         //   $('#text_id').val($.trim(xhr.responseText));
           
            }
        }
    }
    // 2. Define what to do when XHR feed you the response from the server - Start

   // var userid = document.getElementById("userid").value;

    // 3. Specify your action, location and Send to the server - Start 
    xhr.open('POST', 'add_user.php');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("text=_id" + $('#text_id').val()+"&username=" + $('#adduser').val());

    // 3. Specify your action, location and Send to the server - End
}
else
{
    $("#notify").html("username cannot be emtpty")
}

}




function PostData() {
console.log("in post")
   $.ajax({
            type : 'POST',
            url : 'save.php',           
            data: {
                text : $('#myform2').val(),
                text_id  : $('#text_id').val(),
                filename  : $('#filename').val()
            },
            success:function (data) {

                $('#text_id').val(data);

}

}); 
}





function getXMLHttp() {
    var xmlhttp;
    if (window.ActiveXObject) {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } else if (window.XMLHttpRequest) {
       xmlhttp = new XMLHttpRequest();
    } else {
        alert("Your browser does not support XMLHTTP!");
    }
    return xmlhttp;
}










function getTextInfo() {

  file=""

if ($('#text_id').val()=="")
{ 
  $('#text_id').val("<?php echo $_POST['text_id'] ?>");
  console.log("text_id is empty");
  //file="text"+"<?php echo $_POST['text_id'] ?>"+".txt";
//file="text122.txt"
}
else
 { 

  file="C:/textfiles/text"+$('#text_id').val()+".txt"; }

console.log("file:"+file)





    xmlhttp1=getXMLHttp();
    xmlhttp1.open("GET",file,true); 
    xmlhttp1.onreadystatechange = updateInfo;
    xmlhttp1.send(null); 
    return false;



}
function updateInfo() { 
    if(xmlhttp1.readyState == 4) { 
        if ( $('#myform2').val()=="")
        $('#myform2').val(xmlhttp1.responseText)
        
    }      
}


var iFrequency = 3000; // expressed in miliseconds
var myInterval = 0;

// STARTS and Resets the loop if any
function startLoop() {
    if(myInterval > 0) clearInterval(myInterval);  // stop
    myInterval = setInterval( "doSomething()", iFrequency );  // run
}

function doSomething()

{ console.log("dsfdsf")
    $( "#save" ).trigger( "click" );

}