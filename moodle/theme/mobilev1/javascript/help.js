

function check_index_tut(){
		var now = Date.now();
		var lastVisit = localStorage.getItem('mobileMoodleLastVisited_Forums');
		
			
			var sinceLast = (now - lastVisit)/24/60/60/1000;
				
			if (!lastVisit){
				//$('.ui-page-active').append('<div  id="tut-index-welcome" class="tut"><h1>Welcome to Forums</h1></div>');
			
			
				if (!$('#forum-tut-pop').length){
					$('.ui-page-active').append('<div class="ui-popup-screen ui-overlay-a in" id="forum-tut-screen"></div>');
					var url = $('#moodle-url').attr('url') 
					$('body').append('<div id="forum-tut-pop" class="tut"><h1>To View Replies <br>Swipe or Tap</h1><div class="forum-tut-contents"><img src="' + url + '/theme/mobilev1/pix/reply.png"></div><a id="forum-tut-close" onclick="close_forum_tut();" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-block ui-btn-up-b"><span class="ui-btn-inner"><span class="ui-btn-text">Close</span></span></a></div>');
				}
				else{
					$('.ui-page-active').append('<div class="ui-popup-screen ui-overlay-a in" id="forum-tut-screen"></div>');
					$('#forum-tut-screen, #forum-tut-pop').show();
				}
				

			} 
	

		localStorage.setItem('mobileMoodleLastVisited_Forums', now);
	}
	
	function close_forum_tut(){
		$('#forum-tut-close').tap(function(){
			$('.ui-page-active #forum-tut-screen, #forum-tut-pop').hide();
		});
	}