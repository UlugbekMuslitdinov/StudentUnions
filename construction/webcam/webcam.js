	//	Production Script
	var isIE = (navigator.userAgent.indexOf( "MSIE" ) > 0 ) ? true : false;
	var imageSrc, 
		previousImage, 
		updatePeriod, 
		now, 
		nextDue, 
		timerPeriod, 
		remoteWin, 
		timerID = null;	
	var imageLoaded = false;
	var imgbuffer = new Image();
	var downloadStart = new Date().getTime();
	var lastSuccess = downloadStart;	
	var isOwner = true;
	var clientVersion = '6.0';
	
	function getClientVersion() {
		return clientVersion;
	}
	function camInit(period) {
		updatePeriod = period*1000;
		downloadStart = new Date().getTime();
		lastsuccess = downloadStart;
		imageSrc = document.refrimage.src;
		if( imageSrc.indexOf( "?" ) > 0 ) {
			imageSrc = imageSrc.substr( 0, imageSrc.indexOf( "?" ) );
		}
		imgbuffer.onload =  function () { imageLoad();  };
		imgbuffer.onerror = function () { imageError(); };
		startTimer();
		if( checkForClock() )
			startClockUpdates();
	}

	function startTimer() {
		if (timerID != null) {
			window.clearTimeout(timerID);
			timerID = null;
		}
		
		nextDue = lastSuccess + updatePeriod;
		now = new Date().getTime();
		timerPeriod = Math.max((nextDue-now),0);

		if (timerPeriod > 0) {
			timerID = window.setTimeout("timerExpire()", timerPeriod);
		} else { 
			timerExpire();
		}
	}

	function timerExpire() {
		timerID = null;
		getImage();
	}

	function getImage() {
		imageLoaded = false;
		downloadStart = new Date().getTime();
		imgbuffer.src = imageSrc + "?" + downloadStart ;
	}

	function imageLoad() {
		document.refrimage.src = imgbuffer.src;
		imageLoaded = true;
		lastSuccess = downloadStart;
		startTimer();
	}

	function imageError() {
		getImage();
	}
	
	function checkForClock(){
		if( this.document.clock.time ){
			return true;
		}
		return false;
	}
	
	function startClockUpdates() {
		window.setInterval("updateClock()", 100);
	}

	function updateClock() {
		now = new Date().getTime();
		var timeLeft = Math.ceil((nextDue - now)/1000);
		var value = (timeLeft > 0) ? timeLeft : "-";
		if( document.clock.time ) {
			if (value != document.clock.time.value) {	// update if changed
				document.clock.time.value = value;
			}
		}
	}
