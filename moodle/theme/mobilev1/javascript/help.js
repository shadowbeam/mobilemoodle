

function check_index_tut(){
		var now = Date.now();
		var lastVisit = localStorage.getItem('mobileMoodleLastVisit_Forum');
		var doNotShow = localStorage.getItem('mobileMoodleDoNotShow');
		
		if(!doNotShow){
			
			var sinceLast = (now - lastVisit)/24/60/60/1000;
				
			if (!lastVisit){
				//$('.ui-page-active').append('<div  id="tut-index-welcome" class="tut"><h1>Welcome to Forums</h1></div>');
				
				//$('.ui-page-active').append('<div class="ui-popup-screen ui-overlay-a in" id="general_popup-screen"></div>');

				
				//$('.ui-page-active #panel-wrapper').panel( "open" );
//
			//	$('#general_popup .pop-contents').html('Welcome first time visitor');
				// $('#general_popup').popup("open");
			} else if(sinceLast > 30){ //greater than a month
				alert('expired');	
			}
		}

		localStorage.setItem('mobileMoodleLastVisit_Indexa', now);
	}