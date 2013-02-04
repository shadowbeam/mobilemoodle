
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
	

});


/* Profile */

$('#page-user-editadvanced').live('pagebeforecreate',function(event, ui){

	$('fieldset').attr('data-role','collapsible');
	
	

});