function AddUser(){
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
    xhr.open('POST', 'adduser.php');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("text=_id" + $('#text_id').val()+"&username=" + $('#adduser').val());

    // 3. Specify your action, location and Send to the server - End

}



function PostData() {

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
            $('#text_id').val($.trim(xhr.responseText));
           
            }
        }
    }
    // 2. Define what to do when XHR feed you the response from the server - Start

   // var userid = document.getElementById("userid").value;

    // 3. Specify your action, location and Send to the server - Start 
    xhr.open('POST', 'save.php');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("text=" + $('#myform2').val()+"&filename=" + $('#filename').val()+"&text_id=" + $('#text_id').val());
console.log("in post")
    // 3. Specify your action, location and Send to the server - End
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
    
  console.log("<?= p $_POST['text_id'] ?>")
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

  file="text"+$('#text_id').val()+".txt"; }

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


var iFrequency = 5000; // expressed in miliseconds
var myInterval = 0;

// STARTS and Resets the loop if any
function startLoop() {
    if(myInterval > 0) clearInterval(myInterval);  // stop
    myInterval = setInterval( "doSomething()", iFrequency );  // run
}

function doSomething()
{
 PostData();
}