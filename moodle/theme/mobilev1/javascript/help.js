
/**
 * Make the first time check for opening tutorial
 */
	function check_index_tut(){
		var now = Date.now();
		var lastVisit = localStorage.getItem('mobileMoodleLastVisited_Forums');
				
		if (!lastVisit)	
			open_forum_tut()
		
		localStorage.setItem('mobileMoodleLastVisited_Forums', now);
	}
	
/**
 * Close the forum tutorial screen 
 */
	function close_forum_tut(){
		$('.ui-page-active #forum-tut-screen, #forum-tut-pop').hide();
	}
	
	
/**
 * Open the forum tutorial screen 
 */
	function open_forum_tut(){
		if (!$('#forum-tut-pop').length){
			$('.ui-page-active').append('<div class="ui-popup-screen ui-overlay-a in" id="forum-tut-screen"></div>');
			var url = $('#moodle-url').attr('url');
			
			$('body').append('<div id="forum-tut-pop" class="tut"><h1>To View Replies <br>Swipe or Tap</h1><div class="forum-tut-contents"><img src="' + url + '/theme/mobilev1/pix/reply.png"></div><h1>To View Post Controls</h1><img src="' + url + '/theme/mobilev1/pix/forum-tut-controls.png"><h1>To View Topic Details</h1><img src="' + url + '/theme/mobilev1/pix/forum-tut-topic.png"><a id="forum-tut-close" onclick="close_forum_tut();" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-block ui-btn-up-b"><span class="ui-btn-inner"><span class="ui-btn-text">Close</span></span></a></div>');
		}
		else{
			$('.ui-page-active').append('<div class="ui-popup-screen ui-overlay-a in" id="forum-tut-screen"></div>');
			
			$('#forum-tut-screen, #forum-tut-pop').show();
		}
	}