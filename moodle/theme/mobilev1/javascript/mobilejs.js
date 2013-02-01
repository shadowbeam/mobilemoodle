
/*Login Page*/

$('div#page-login-index').live('pageinit',function(event, ui){
	$('#login').append($('#signup'));
	$('#password').attr('placeholder','Password');
	$('#username').attr('placeholder','Username');
	
});


/* Front Page */

$('div#page-site-index').live('pagebeforecreate',function(event, ui){
		
	//unwrap the course list
	$('.unlist div.coursebox, .unlist div.info, .unlist h3.name').contents().unwrap();

	//change available courses to listview with filter
	$('.unlist').attr("data-role", "listview").attr("data-inset", "true").attr("data-filter", "true");
	
	


});
 

/* Course */

$('div#page-course-view-weeks').live('pagebeforecreate',function(event, ui){
		
	//change available courses to listview with filter
	//$('ul.weeks').attr("data-role", "listview");

//	$('.content ul.section').attr("data-role", "listview").attr("data-inset", "true");
	
//	$('li.section').attr("data-role", "collapsible");
//	$('.course-content').attr("data-role", "collapsible-set");
	
//	$('.section li img.activityicon').addClass("ui-li-icon");
	   
//	  $('.course-content ul.section, .sitetopic ul.section').attr("data-role", "listview").attr("data-inset", "true");

//$('.modtype_resource a').attr('data-rel', 'dialog');


	$('.modtype_resource a').click(function(event,ui) {
  		//event.preventDefault();
  		//event.stopImmediatePropagation();
	});

});

/* Resources */

