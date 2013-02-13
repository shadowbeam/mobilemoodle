//must bind the global settings before jquerymobile is loaded
$(document).bind("mobileinit", function(){
	$.mobile.defaultPageTransition = "slide";
});


/* all pages */
$('div').live('pagebeforecreate',function(event, ui){
	//$('ul li.activity a').unwrap().unwrap(); /* causes issues with back and forward */
	//$('a.tooltip').attr('data-rel', 'dialog').attr('data-transition','pop');
 
});

/*Course Index*/
$('#course-page-index, #page-site-index').live('pagebeforecreate',function(event, ui){
	$('ul.section').attr("data-role", "listview").attr("data-inset", "true");
	$('.section li img.activityicon').addClass("ui-li-icon");
});

$('.ui-page').live('pageinit',function(event, ui){


$('#page-header').live('swiperight', function (event, ui) {
     $('#panel-wrapper').panel( "open" );
 });

	    

});

	

/* Login Page */

$('div#page-login-index').live('pagebeforecreate',function(event, ui){
	$('#login').append($('#signup'));
	$('#password').attr('placeholder','Password');
	$('#username').attr('placeholder','Username');
	$('#loginbtn').attr('data-theme', 'b');
	$('.twocolumns').addClass('ui-grid-b my-breakpoint');
	
	
	
	$("form").ajaxForm({url: $(this).attr('action'), type: 'post'});

    
	//front page form needs to force a refresh.
	
});


$('div#pannel-wrapper').live('pagebeforecreate',function(event, ui){
	
	$('li.contains_branch').attr('data-role', 'collapsible').attr('data-theme','c');
});


/* Front Page */

$('div#page-site-index, #page-course-index').live('pagebeforecreate',function(event, ui){
	
	
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
	$('.course-content li.section.main').not('[id="section-0"]').attr('data-role', 'collapsible').attr('data-collapsed', 'false').attr('data-theme', 'b').attr('data-content-theme','d');
		
	
	$('.course-content li.section.main:even').not('[id="section-0"]').addClass('ui-block-b');
	$('.course-content li.section.main:odd').not('[id="section-0"]').addClass('ui-block-a');
		
	//assign listviews
	$('ul.section').attr('data-role', 'listview');
	$('#section-0 ul.section ').attr('data-inset', 'true');
	
	
	//force section 0 full width
	$('#section-0').addClass('ui-grid-solo');
	

});


/* Profile */

$('#page-user-editadvanced').live('pagebeforecreate',function(event, ui){
	$('fieldset').attr('data-role','collapsible');
});

/* Forums */

$('#page-mod-forum-view').live('pagebeforecreate',function(event, ui){
$('tr.discussion').each(function(index) {
	var rply = $(this).find('td.replies a').html();
	$(this).find('td.topic a').append('<span class="reply-count">' + rply + '</span>');
	
	$(this).live('swiperight', function (event, ui) {
		$(this).find('.picture, .author, .lastpost').addClass('displayinline');
    });
	
	$(this).live('swipeleft', function (event, ui) {
		$(this).find('.picture, .author, .lastpost').removeClass('displayinline');
    });
});
	$('.forumheaderlist').attr('data-role', 'controlgroup');
	  $('table.forumheaderlist thead tr').attr("data-role", "button");
	$('table.forumheaderlist td.topic a').attr("data-role", "button").attr("data-icon", "arrow-r").attr("data-iconpos", "right");
});

 //forum discussion page only stuff
$('div#page-mod-forum-discuss, #page-mod-forum-discuss div.generalpage, div.forumtype-single, .forumtype-single div.generalpage, div#page-mod-forum-post, #page-mod-forum-user').live('pagebeforecreate',function(event, ui){
        //actual forum posting
        $('.forumpost div.row.header, h2.accesshide').addClass("ui-li ui-li-divider ui-btn ui-bar-b");
        $('.options div.commands').attr("data-role", "controlgroup").attr("data-type", "horizontal");
        $('.options div.commands a').attr("data-role", "button").attr("data-inline", "true").attr('data-mini','true');
		
	/* Attempt to load the reply form in a popup*/
		$( ".options .commands a" ).bind( "click", function(event, ui) {
			event.preventDefault();
			event.stopPropagation;
		
			var link = $(this).attr('href');
		/*	
			//Implementing scroll to show parent
			
			var currentloc = ($(location).attr('href'));
			
			
			alert(link + " " + currentloc);
			if(link == currentloc){
				
				var target = this.hash,
				$target = $(target);
      
				$('html, body').stop().animate({
					'scrollTop': $target.offset().top-40
				}, 900, 'swing', function () {
					window.location.hash = target;
				});
	

			}
		*/	
			
				//this ignores the hash and simply loads the page
				$.mobile.changePage( link, { transition: "slideup"} );
			
			
			//link.replace('#mformforum,','');
			//$.mobile.loadPage(link);
			
			
			

			
		});
	
		
      //  $('.forumpost div.author a').attr("data-inline", "true");
      
      	//remove the text from the commands
        $('.options div.commands').contents().filter(function() {
            return this.nodeType == 3; 
        }).remove();
		
		$('#id_submitbutton').attr('data-theme', 'b');
        
    });





