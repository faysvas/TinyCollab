// Create a connection to http://localhost:9999/echo
var sock = new SockJS('http://localhost:9999/echo');

// Open the connection
sock.onopen = function() {
  console.log('open');
};

// On connection close
sock.onclose = function() {
  console.log('close');
};

// On receive message from server
sock.onmessage = function(e) {
  // Get the content
  var content = JSON.parse(e.data);

if(content.text_id==$('#text_id').val() ){

if (content.chat==""){

$("div").filter(function() {
    return $(this).text() === content.username;
}).css("font-weight", "bold");


 
 setTimeout(
     
        2000
    );

  var start = $("#myform2").selectionStart,
        end = $("#myform2").selectionEnd;

if($("#myform2").val()!=content.message)
$('#myform2').val(content.message)
 //$("#myform2").setSelectionRange(start, end);
 

 //list_id="#names "+username;
 $( "div:contains('"+username+"')" ).css('color', 'red')
 //na ginetai kokkino to xrwma, na perimenei ligaki kai meta na xanaginetai mavro
}

else {

$('#chat').append(content.username+":"+content.chat+"\n");

}

}
  
};

// Function for sending the message to server
function sendMessage(){
  // Get the content from the textbox
console.log("sdf")
  //var message = CKEDITOR.instances['myform'].getData();
  console.log("name"+$('#username').text())
  var message=$("#myform2").val();
 
  var text_id=$('#text_id').val();

  var chat=$('#message').val();
  var username=$('#username').text();
  console.log("text id"+text_id)
 // var has_permission=<?= has_permission(); ?>
  //var username = $('#username').val();

  // The object to send
  var send = {
    message: message,
    text_id:text_id, 
    chat:chat,
    username:username
 //   has_permission: has_permission
  //  ,username: username
  };

  // Send it now
  sock.send(JSON.stringify(send));
}
///Na pairnw xrono kai na anavathmizw opoio einai pio prosfato. 
//Na sugkrnw allages
//h na kanw to send message mono on type