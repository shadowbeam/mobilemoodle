//must bind the global settings before jquerymobile is loaded
$(document).bind("mobileinit", function(){
	$.mobile.defaultPageTransition = "slide";
	
	});

/* Only working for initial load */
$('div').live('pagebeforecreate',function(event, ui){

$('.ui-header').live('swiperight', function (event, ui) {
	$('#panel-wrapper').panel( "open" );
});

	    

});

/* General Page Fixes */
	$(document).live('pagebeforecreate',function(event, ui){
		$('ul li.activity a').unwrap().unwrap();
		$('ul.section').attr("data-role", "listview").attr("data-inset", "true");
	    $('.section li img.activityicon').addClass("ui-li-icon");

	});

/*Login Page*/

$('div#page-login-index').live('pagebeforecreate',function(event, ui){
	$('#login').append($('#signup'));
	$('#password').attr('placeholder','Password');
	$('#username').attr('placeholder','Username');
	$('#loginbtn').attr('data-theme', 'b');
	$('.twocolumns').addClass('ui-grid-b my-breakpoint');
	
});


$('div#pannel-wrapper').live('pagebeforecreate',function(event, ui){
	
	$('li.contains_branch').attr('data-role', 'collapsible').attr('data-theme','c');
});



/* Front Page */

$('div#page-site-index,#page-course-index').live('pagebeforecreate',function(event, ui){
		
	//unwrap the course list
	$('.unlist div.coursebox, .unlist div.info, .unlist h3.name').contents().unwrap();

	//change available courses to listview with filter
	$('.unlist').attr("data-role", "listview").attr("data-inset", "true").attr("data-filter", "true");
	
});


/* Course */

$('#page-course-view-topics, #page-course-view-weeks').live('pagebeforecreate',function(event, ui){


var innercontent;

if($('ul.topics').length > 0){
	innercontent = $('ul.topics').html();
	$('ul.topics').wrap('<div class="courseformat"/>').remove();
}

else if ($('ul.weeks').length > 0) {
	innercontent = $('ul.weeks').html();
	$('ul.weeks').wrap('<div class="courseformat"/>').remove();
}

	$('div.courseformat').html(innercontent).addClass('ui-grid-a ui-responsive');

	//create labels
	$('li.label').attr('data-role','list-divider').attr('data-theme', 'a');	

	//unwrap h3s so they become collapsible headers
	$('.sectionname').unwrap();
	
	$('.section .content h3').unwrap();

	//remove unneeded sides
	$('.left.side, .right.side').remove();
	
	//unwrap links
	$('.mod-indent .activityinstance a').unwrap().unwrap();
	
	//create the collapsible headers
	$('.course-content li.section.main').attr('data-role', 'collapsible').attr('data-collapsed', 'false').attr('data-theme', 'b').attr('data-content-theme','d');
		
	
	$('.course-content li.section.main:even').addClass('ui-block-b');
	$('.course-content li.section.main:odd').addClass('ui-block-a');
		
	//assign listviews
	$('ul.section').attr('data-role', 'listview');
	
	//force section 0 full width
	$('#section-0').addClass('ui-grid-solo');
//	$('.section a').attr('data-role', 'button');
//	$('.section img.activityicon').addClass("ui-li-icon");

});


/* Profile */

$('#page-user-editadvanced').live('pagebeforecreate',function(event, ui){

	$('fieldset').attr('data-role','collapsible');


});

/* Assignments */
$('#page-mod-assign-view').live('pagebeforecreate',function(event, ui){

//		$('#my-table').attr('data-role', 'table').attr('data-mode','reflow');


});