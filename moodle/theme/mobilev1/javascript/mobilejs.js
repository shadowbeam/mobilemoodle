
/*Login Page*/

$('div#page-login-index').live('pagebeforecreate',function(event, ui){
	$('#login').append($('#signup'));
	$('#password').attr('placeholder','Password');
	$('#username').attr('placeholder','Username');
	$('#loginbtn').attr('data-theme', 'b');
	$('.twocolumns').addClass('ui-grid-b my-breakpoint');
	
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
	
	//causes a bug
	var innerweeks= $('ul.weeks').html();
	
	$('ul.weeks').wrap('<div class="weeks"/>').remove();
	$('div.weeks').html(innerweeks);//.attr('data-role', 'collapsible-set', 'data-corners', 'true')


	
	
	$('.left.side, .right.side').remove();
	$('.sectionname').unwrap();
	//unwrap links
	$('.mod-indent .activityinstance a').unwrap().unwrap();
	

	$('.weeks li.section.main').attr('data-role', 'collapsible').attr('data-collapsed', 'false').attr('data-theme', 'b').attr('data-content-theme','d');
	
		
	$('ul.section').attr('data-role', 'listview');
	
	//$('ul.section').listview(); /*errors with beta 1.3*/
//	$('li.activity').attr('data-role','button');
	

});

/* Resources */

