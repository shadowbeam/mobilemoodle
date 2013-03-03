

	var now = Date.now();
		
	lastVisit = localStorage.getItem('mobileMoodleHelp');
	
	isSessionActive = sessionStorage.getItem('mobileMoodleHelpSession');
	isReturningVisitor = lastVisit + 28*24*60*60*1000 > now : true;
	
	if ( !lastVisit ) lastVisit = now;
	
	// If it is expired we need to reissue a new balloon
	isExpired = isReturningVisitor && lastVisit <= now;
		
		

	if(isExpired){
		alert('hi');
	}