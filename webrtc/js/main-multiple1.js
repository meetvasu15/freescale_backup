'use strict';
var localStream;
var whoAmI;
var amIinvolved;
var isInitiator =false;
var pc_config = {'iceServers': [{'url': 'stun:stun.l.google.com:19302'}]};
var pcArr = new Array();
var currPCPtr;
var pc_constraints = {'optional': [{'DtlsSrtpKeyAgreement': true}]};
// Set up audio and video regardless of what devices are present.
var sdpConstraints = {'mandatory': {
  'OfferToReceiveAudio':true,
  'OfferToReceiveVideo':true }}; 
// setting up a room or logiing into room
//var room = location.pathname.substring(1);

var room = 'myRoom';
if (room === '') { 
  room = 'foo';
} else {

} 
var socket = io.connect('http://webrtc6.nodejitsu.com:80');

if (room !== '') {
  console.log('Create or join room', room);
  socket.emit('create or join', room);
}

var localVideo = document.querySelector('#localVideo');
//var remoteVideo = document.querySelector('#remoteVideo');


socket.on('created', function (room){
  console.log('Created room ' + room); 
  whoAmI = 0;
  isInitiator = true;
  console.log('I created the room so I am 0')
});

socket.on('full', function (room){
  console.log('Room ' + room + ' is full');
});

socket.on('join', function (newJoinee){
  console.log('This peer joined the room : newJoinee ' + newJoinee);  
  
});

socket.on('joined', function (myIdentity){
  console.log('I was identified as ' + myIdentity); 
  whoAmI = myIdentity;
  amIinvolved=true;
});

socket.on('log', function (array){
  console.log.apply(console, array);
});

socket.on('connectingPeers', function (connectWhom){
  console.log('These peer should initiate conection '+ connectWhom);
  var callerCallee = connectWhom.split(" ");	
  if(callerCallee.length == 2){
	  var caller = callerCallee[0];
	  var answerer = callerCallee[1];
	  if(caller == answerer){
		 console.log('We all are connected now'); 
		amIinvolved = false;
	  }else if(answerer == whoAmI){
			amIinvolved = true;
	  } else if(caller == whoAmI){
		console.log('I need to make a call to '+answerer);  
		amIinvolved = true;
		createPeerConnection();
		
		console.log('Initiating a call, calling method docall' ); 
		pcArr[currPCPtr].doCall();
		
	  }else if(caller > answerer){
		console.log('I knew it, we have a retard in the room. He is '+answerer);  
		amIinvolved = false;
	  } else{
	    console.log('I am not involved in this conversation'); 
		amIinvolved = false;
	  }
  }else{
	  console.log('The cloud server is retarded.... I am out of here! '); 
	  
		amIinvolved = false;
  }
});

socket.on('message', function (message){
  console.log('Client received message:', message);
  if (amIinvolved){
	if (message.type === 'offer') {
	if (!isInitiator) {
		  createPeerConnection();
    }
    pcArr[currPCPtr].peerConnecObj.setRemoteDescription(new RTCSessionDescription(message));
	console.log('Sending answer');
    pcArr[currPCPtr].doAnswer();
  } 
  else if (message.type === 'answer' ) {
    pcArr[currPCPtr].peerConnecObj.setRemoteDescription(new RTCSessionDescription(message));
  } 
  else if (message.type === 'candidate' ) {
    var candidate = new RTCIceCandidate({
      sdpMLineIndex: message.label,
      candidate: message.candidate
    });
    pcArr[currPCPtr].peerConnecObj.addIceCandidate(candidate);
  }  
  }else{
	console.log('I am not involved in this conversation ');  
  }
});


// get the users webcam and audio

var constraints = {video: true};
console.log('Getting user media with constraints', constraints);
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
navigator.getUserMedia(constraints, handleUserMedia, handleUserMediaError);

// This invokes all connections once it gets the user media
function handleUserMedia(stream) {
  console.log('Adding local stream.');
  localVideo.src = window.URL.createObjectURL(stream);
  localStream = stream;
  //sendMessage('got user media');
  //invoke connection with the initiator 
  if(!isInitiator){ 
	var wheretowhere = '0 '+whoAmI;
		socket.emit('connectingPeers', wheretowhere);
  }
}
// invokes the next connecting peers, it is invoked after the remote stream is added
function invokeNextConnectingPeers(){
/*setTimeout( function(){
	if(whoAmI !=pcArr.length )	{
		var wheretowhere = whoAmI+1+' '+pcArr.length ;
		socket.emit('connectingPeers', wheretowhere);
	}
	},1000);*/
}
/*/Utility function/*/
function sendMessage(message){
	console.log('Client sending message: ', message); 
  socket.emit('message', message);
}

function createPeerConnection() {

  try {
   currPCPtr = pcArr.length;
   var remoteVidEltId = "remoteVideo"+currPCPtr;
   var content =  "<video id='"+remoteVidEltId+"' autoplay></video>";
   $("#videos").append(content);
    var remoteVideo = $("#"+remoteVidEltId);
   pcArr[currPCPtr]= new MyPeerClass(remoteVideo, console);  
   console.log('Created a connection object in pcArr at'+currPCPtr);
    pcArr[currPCPtr].peerConnecObj.addStream(localStream);
  } catch (e) {
    console.log('Failed to create my Peer Class obj, exception: ' + e.message); 
  }
}

function handleUserMediaError(error){
  console.log('navigator.getUserMedia error: ', error);
}

window.onbeforeunload = function(e){
	sendMessage('bye');
}