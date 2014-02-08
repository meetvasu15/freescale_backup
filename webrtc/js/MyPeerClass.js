function MyPeerClass(remoteVideoElt, console){
this.remoteVideo = remoteVideoElt;

console.log('Trying to create a peer connection obj' );
  try {
		this.peerConnecObj = new webkitRTCPeerConnection(null);
		var myPCConnecRef = this.peerConnecObj ;
		this.peerConnecObj.onicecandidate = function(event){
			  console.log('handleIceCandidate event: ', event);
			  if (event.candidate) {
				sendMessage({
				  type: 'candidate',
				  label: event.candidate.sdpMLineIndex,
				  id: event.candidate.sdpMid,
				  candidate: event.candidate.candidate});
			  } else {
				console.log('End of candidates.');
			  }
		};
		this.peerConnecObj.onaddstream = function(event){
			  console.log('Remote stream added.');
			  remoteVideo.src = window.URL.createObjectURL(event.stream);
			  remoteStream = event.stream;
		};
		this.peerConnecObj.onremovestream = function(event){
			  console.log('Remote stream removed. Event: ', event);
		};
	} catch (e) {
		console.log('Failed to create PeerConnection, exception: ' + e.message);
		alert('Cannot create RTCPeerConnection object.');
		return;
	}
  
	this.doCall = function(){
		console.log('Sending offer to peer');
		this.peerConnecObj.createOffer(this.setLocalAndSendMessage,  handleCreateOfferError);
	};
	this.doAnswer = function() {
		  console.log('Sending answer to peer.');
		  this.peerConnecObj.createAnswer(this.setLocalAndSendMessage, null, sdpConstraints);
	};
	this.setLocalAndSendMessage= function( sessionDescription){
	console.log('setLocalAndSendMessage start');
		  // Set Opus as the preferred codec in SDP if Opus is present.
		  sessionDescription.sdp = preferOpus(sessionDescription.sdp);
		  myPCConnecRef.setLocalDescription(sessionDescription);
		  console.log('setLocalAndSendMessage sending message' , sessionDescription);
		  sendMessage(sessionDescription);
	console.log('setLocalAndSendMessage stop');
	}
	this.stop = function(){
		console.log('Inside Stop, terminating connection');
		this.peerConnecObj.close();
		this.peerConnecObj = null;
	};
	
	this.hangup = function(){
		console.log('Hanging up.');
		this.peerConnecObj.stop(); 
		sendMessage('bye');
	};
}

 
function handleCreateOfferError(event){
  console.log('createOffer() error: ', e);
} 
 


function requestTurn(turn_url) {
  var turnExists = false;
  for (var i in pc_config.iceServers) {
    if (pc_config.iceServers[i].url.substr(0, 5) === 'turn:') {
      turnExists = true;
      turnReady = true;
      break;
    }
  }
  if (!turnExists) {
    console.log('Getting TURN server from ', turn_url);
    // No TURN server. Get one from computeengineondemand.appspot.com:
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if (xhr.readyState === 4 && xhr.status === 200) {
        var turnServer = JSON.parse(xhr.responseText);
      	console.log('Got TURN server: ', turnServer);
        pc_config.iceServers.push({
          'url': 'turn:' + turnServer.username + '@' + turnServer.turn,
          'credential': turnServer.password
        });
        turnReady = true;
      }
    };
    xhr.open('GET', turn_url, true);
    xhr.send();
  }
}
  
// Set Opus as the default audio codec if it's present.
function preferOpus(sdp) {
  var sdpLines = sdp.split('\r\n');
  var mLineIndex;
  // Search for m line.
  for (var i = 0; i < sdpLines.length; i++) {
      if (sdpLines[i].search('m=audio') !== -1) {
        mLineIndex = i;
        break;
      }
  }
  if (mLineIndex === null) {
    return sdp;
  }

  // If Opus is available, set it as the default in m line.
  for (i = 0; i < sdpLines.length; i++) {
    if (sdpLines[i].search('opus/48000') !== -1) {
      var opusPayload = extractSdp(sdpLines[i], /:(\d+) opus\/48000/i);
      if (opusPayload) {
        sdpLines[mLineIndex] = setDefaultCodec(sdpLines[mLineIndex], opusPayload);
      }
      break;
    }
  }

  // Remove CN in m line and sdp.
  sdpLines = removeCN(sdpLines, mLineIndex);

  sdp = sdpLines.join('\r\n');
  return sdp;
}

function extractSdp(sdpLine, pattern) {
  var result = sdpLine.match(pattern);
  return result && result.length === 2 ? result[1] : null;
}

// Set the selected codec to the first in m line.
function setDefaultCodec(mLine, payload) {
  var elements = mLine.split(' ');
  var newLine = [];
  var index = 0;
  for (var i = 0; i < elements.length; i++) {
    if (index === 3) { // Format of media starts from the fourth.
      newLine[index++] = payload; // Put target payload to the first.
    }
    if (elements[i] !== payload) {
      newLine[index++] = elements[i];
    }
  }
  return newLine.join(' ');
}

// Strip CN from sdp before CN constraints is ready.
function removeCN(sdpLines, mLineIndex) {
  var mLineElements = sdpLines[mLineIndex].split(' ');
  // Scan from end for the convenience of removing an item.
  for (var i = sdpLines.length-1; i >= 0; i--) {
    var payload = extractSdp(sdpLines[i], /a=rtpmap:(\d+) CN\/\d+/i);
    if (payload) {
      var cnPos = mLineElements.indexOf(payload);
      if (cnPos !== -1) {
        // Remove CN payload from m line.
        mLineElements.splice(cnPos, 1);
      }
      // Remove CN line in sdp
      sdpLines.splice(i, 1);
    }
  }

  sdpLines[mLineIndex] = mLineElements.join(' ');
  return sdpLines;
}