
//must bind the global settings before jquerymobile is loaded
$(document).bind("mobileinit", function(){
	$.mobile.defaultPageTransition = "slide";
	$.mobile.touchOverflowEnabled = true;
	$.mobile.page.prototype.options.domCache = true;
	$.mobile.defaultHomeScroll = 0; //fix for content jumping on opening panel
	
});

 $(document).bind("vmouseover", function () { });
 
/** 
 * Course Index
 */
$('#course-page-index, #page-site-index, #page-my-index')
	.live('pagebeforecreate',function(event, ui){
		$('ul.section').attr("data-role", "listview").attr("data-inset", "true").attr('data-theme', 'a');
		$('.section li img.activityicon').addClass("ui-li-icon");	
		
		//must remove this otherwise the link breaks
		$('ul.teachers').remove();
	
		//unwrap the course list
		$('.unlist div.coursebox, .unlist div.info, .unlist h3.name').contents().unwrap();

		//change available courses to listview with filter
		$('.unlist').attr("data-role", "listview").attr("data-inset", "true").attr("data-filter", "true");
		
	}).live('pageshow',function(event, ui){

		/* DOM Management remove all pages when returning to the course page */
		$('.ui-page:not(.ui-page-active)').each(function(){
			$(this).remove();
		});	
	});


/** 
 * General
 */
 $('div').live('pagebeforecreate',function(event, ui){
	$('.ftoggler').attr('data-role', 'list-divider').addClass('ui-bar-a');
	$('#id_submitbutton').attr('data-theme', 'b');
		
	/* Swipe page header to open panel*/
	 $('.ui-page-active #page-header').live('swipeleft', function (event, ui) {
	 	 $('.ui-page-active #panel-wrapper').panel( "open" );
	});
		
		
});

/** 
 * Login Page
 */
$('#page-login-index').live('pagebeforecreate',function(event, ui){
	$('#login').append($('#signup'));
	$('#password').attr('placeholder','Password');
	$('#username').attr('placeholder','Username');
	$('#loginbtn').attr('data-theme', 'b');
	$('.twocolumns').addClass('ui-grid-b my-breakpoint');
	
	$("#login").attr('data-ajax', 'false');//front page form needs to force a refresh.

});

/** 
 * Course Page
 */
$('.course-view-topics, .course-view-weeks').live('pagebeforecreate',function(event, ui){


	/* Course Profile Hack */
	if($(this).find('.userprofile').length > 0){
		$('.course-info').hide();
		$('.userprofile table').addClass('responsive-tab');		
	}
	
	/* Course Page */
	else{

		var innercontent;

		/* Topics Course Page */
		if($('ul.topics').length > 0){
			innercontent = $('ul.topics:not(.single-section ul.topics)').html();
			var singlecontent = $('.single-section ul.topics').html();
			
			$('ul.topics:not(.single-section ul.topics)').wrap('<div class="courseformat"/>');
			$('.single-section ul.topics').wrap('<div class="courseformat-single"/>');
			
			$('.courseformat ul.topics').remove();
			$('.courseformat-single ul.topics').remove();
			
			$('div.courseformat').html(innercontent).addClass('ui-grid-a ui-responsive');
			$('div.courseformat-single').html(singlecontent).addClass('ui-grid-a ui-responsive');
		}
		
		/* Weeks Course Page */
		else if ($('ul.weeks').length > 0) {
			innercontent = $('ul.weeks').html();
			$('ul.weeks').wrap('<div class="courseformat"/>').remove();
			$('div.courseformat').html(innercontent).addClass('ui-grid-a ui-responsive');

		}

		/* Single Section */
		$('.single-section .section-navigation a:not(.ui-btn)').attr('data-role', 'button').attr('data-inline', 'true').attr('data-mini', 'true');
		$('.single-section li.section .content').unwrap();	

		/* Columns of resources */
		$('.course-content .courseformat li.section.main:even').addClass('ui-block-b');
		$('.course-content .courseformat li.section.main:odd').addClass('ui-block-a');
		
		
		//create labels
		$('li.label').attr('data-role','list-divider').attr('data-theme', 'a');	

		//unwrap h3s so they become collapsible headers
		$('.courseformat .section .content h3, .sectionname').unwrap();

		//remove unneeded div sides
		$('.left.side, .right.side').remove();
		
		//unwrap links
		$('.mod-indent .activityinstance a').unwrap().unwrap();
		
		//create the collapsible headers
		$('.course-content li.section.main').not('[id="section-0"]').attr('data-role', 'collapsible').attr('data-collapsed', 'false').attr('data-theme', 'b').attr('data-content-theme','c');
			
		//assign listviews
		$('ul.section').attr('data-role', 'listview');
		$('#section-0 ul.section ').attr('data-inset', 'true');
			
		
		/* Fix for collapsible headings that also act as links */
		$("h3.section-title:has(a)").bind( "click", function(event, ui) {
				event.preventDefault();
				event.stopPropagation;
			var link = ($(this).find('span a').attr('href'));
			$.mobile.changePage( link, { transition: "slide"} );

		});
		
		/* Edit section */
		$('a:has(img.iconsmall)').addClass('edit_button').attr('data-role', 'button').attr('data-theme', 'a').attr('data-inline', 'true').attr('data-mini', 'true');
		$('#changenumsections').find('.increase-sections, .reduce-sections').attr('data-role', 'button').attr('data-inline', 'true').attr('data-theme', 'a');

		/* Block_News items */
		$('.block a:not(.comment-message-meta a)').attr('data-role', 'button').attr('data-theme', 'c').attr('data-inline', 'false').attr('data-mini', 'true');		
		$('.block_news_items ul').attr('data-role', 'listview');


		
	}
});


/** 
 * Profile
 */

$('#page-user-editadvanced, #page-user-profile, #page-course-view-topics, #page-course-view-topics').live('pagebeforecreate',function(event, ui){

	/*Create Buttons*/
	$('.info.c1 a, .messagebox a, .fullprofilelink a').attr('data-role', 'button');
	$('.messagebox a, .fullprofilelink a').attr('data-theme', 'b');
	
	//remove unnecessart ','
	$('td:contains(",")').each(function(){
		$(this).html($(this).html().split(",").join(""));
	});
});

/** 
 * Responsive Tables
 */
$('#page-user-editadvanced, #page-user-profile, #page-mod-assign-view').live('pagebeforecreate',function(event, ui){
	$('table').addClass('responsive-tab');
});

/** 
 * Forums Topics Index
 */
$('#page-mod-forum-view').live('pagebeforecreate',function(event, ui){

	/* For each discussion row */
	$('tr.discussion').each(function(index) {
	
		//find the reply count
		var rply = $(this).find('td.replies a').html();
		
		//add the reply counts
		$(this).find('td.topic a').append('<span class="reply-count">' + rply + '</span>');
	
		/* Swipe over the topic to reveal more information */
		$(this).live('swiperight', function (event, ui) {
			$(this).find('.picture, .author, .lastpost').addClass('displayinline');
		});
	
		$(this).live('swipeleft', function (event, ui) {
			$(this).find('.picture, .author, .lastpost').removeClass('displayinline');
		});
	});
	
	/* Create a group of buttons for the forum topics */
	$('.forumheaderlist').attr('data-role', 'controlgroup');
	$('table.forumheaderlist thead tr').attr("data-role", "button");
	$('table.forumheaderlist td.topic a').attr("data-role", "button").attr("data-icon", "arrow-r").attr("data-iconpos", "right");
	$('.forumaddnew a').attr('data-theme', 'a');
	
});

/** 
 * Forums Inside Topic
 */
$('#page-mod-forum-discuss, #page-mod-forum-post, #page-mod-forum-user').live('pagebeforecreate',function(event, ui){
        
		/* Starter posts are black*/
        $('.forumpost:not(.starter) div.row.header, h2.accesshide').addClass("ui-li ui-li-divider ui-btn ui-bar-b");
		
		/* Reply posts are blue */
        $('.forumpost.starter div.row.header, h2.accesshide').addClass("ui-li ui-li-divider ui-btn ui-bar-a");
        
		/* Commands */
        $('.options .commands').attr("data-role", "controlgroup").attr("data-type", "horizontal");
        $('.options .commands a').attr("data-role", "button").attr("data-inline", "true").attr('data-mini','true');


			//force commands to load, even if they have a # in their link */
			$( ".options .commands a" ).bind( "click", function(event, ui) {
				event.preventDefault();
				event.stopPropagation;
			
				var link = $(this).attr('href');
				
				//this ignores the hash and simply loads the page
				$.mobile.changePage( link, { transition: "slideup"} );
							
			});
				  
			// remove annoying "|" seperators */ 
			$('.options div.commands').contents().filter(function() {
				return this.nodeType == 3; 
			}).remove();
		
		$('#id_submitbutton').attr('data-theme', 'b'); //do we need?
		
		/* Paging Buttons */
		$('.paging a').attr('class', 'ui-li ui-li-static ui-btn-up-c');
		
			//remove annoying "("
			$('.paging:contains("(")').each(function(){
				$(this).html($(this).html().split("(").join("")); //remove unnecessary "("
			});
			
			//remove annoying ")"
			$('.paging:contains(")")').each(function(){
				$(this).html($(this).html().split(")").join("")); //remove unnecessary ")"
			});
			
			//hover change colour
			$( ".paging a" ).hover(function() {
				   $( this ).addClass( "ui-btn-up-b" ).removeClass( "ui-btn-up-c" );
			 }, function() {
				$( this ).removeClass( "ui-btn-up-b" ).addClass( "ui-btn-up-c" );
			   });
        
    });
    
/** 
 * Forum Replies
 */
$('#page-mod-forum-discuss, #page-mod-forum-post, #page-mod-forum-user, .dialog-replies').live('pagebeforecreate',function(event, ui){
	
	/* If there are no reply buttons */
	if($('.rply-count').length == 0){
	
		//for each post
		$('.forumpost').each(function(){
			var count = 0;
			var parent = $(this).parent();
			if(parent.attr('class') == 'indent'){
				parent.children('.indent').each(function(){
					count += $(this).children('.forumpost').size();
				});
				if(count > 0)
					$(this).addClass('has-replies').find('.content').prepend('<div data-role="button" data-mini="true" data-theme="b" class=" rply-count clearfix">' + count + '</div>');
				
			}
		});
	}
		
		
	/* Force links to load, without the # */
			$( ".options .commands a" ).bind( "click", function(event, ui) {
				event.preventDefault();
				event.stopPropagation;
			
				var link = $(this).attr('href');
					//this ignores the hash and simply loads the page
					$.mobile.changePage( link, { transition: "slideup"} );
			});
});

/* 
 * Small Screen Forums 
 */

$('.smallscreen #page-mod-forum-discuss, .smallscreen .forumtype-single, .smallscreen #page-mod-forum-post,.smallscreen #page-mod-forum-user,.smallscreen #dialog-replies, .smallscreen .dialog-replies').live('pagebeforecreate',function(event, ui){
	
		
	
	/* Show controls for post after tap
	$('.forumpost').click(function(event, ui){
			event.preventDefault();
			event.stopImmediatePropagation();
			$(this).find('.commands').toggleClass('showcontrols');
		});*/
	
	/* Conceal indentation*/
	$('.indent .indent').hide();

/* Causes issues when scrolling */
	 //Swiping over the post shows replies 	
	$('.forumpost.has-replies').live('swiperight swipeleft', function (event, ui) {
			popupReply($(this), event);
	});
	
	/* Clicking the reply button pops up new posts */
	$('.rply-count').click(function (event) {
		popupReply($(this).parents('.forumpost'), event);
	});
}).live('pageshow',function(event, ui) {
	/* Check first time visitor*/
	check_index_tut();
});

/*
 * Function for popping up a reply
 */
function popupReply($this, event){

	event.stopImmediatePropagation(); //prevent double firing
	
	/* Get id from the previous anchor link */
	var id = 'dialog-replies-' + $this.prev().attr('id');
		
	/* if dialog already exists */
	if($('#' + id).length > 0){	
		$.mobile.changePage( $('#' + id), { transition: "fade"} );
	}
			
	else{
		var rpls = '';
		$this.parent().children('.indent').each(function(){
			var childpost = $(this).html();
			if(typeof(childpost) !== 'undefined')
				rpls += childpost;
		});
		
		if(rpls != null){
			$('body').append('<div id="' + id + '"data-role="page" data-url="' + id +'" data-theme="a" class="dialog-replies"><div id="page-header" data-role="header"><div><a id="back-button" data-direction="reverse" data-transition="slide"  class="icon-close mybtn ui-btn-left" data-rel="back" href="#"></a></div><h1>Replies</h1></div><div data-role="content"><div class="forumpost starter">' + $this.html() + '</div>' + rpls + '</div></div>');
				
			//change to page
			$.mobile.changePage( $('#' + id), { transition: "fade"} );
			$('.indent .indent').hide();
		}
	}	
}

/* Grades*/

$('#page-mod-assign-view').live('pagebeforecreate',function(event, ui){

	$('#id_savegrade, #id_submitbutton').attr('data-theme', 'b');
	$('a:has(img.smallicon)').addClass('edit_button').attr('data-role', 'button').attr('data-theme', 'a').attr('data-inline', 'true').attr('data-mini', 'true');
	
	$('.submissionlinks a').attr('data-role', 'button').attr('data-theme', 'b');

});


/* User Profile */

$('#page-course-user').live('pagebeforecreate',function(event, ui){
	$('th').attr('colspan', '1');
	$('td.oddd1').remove();
	$('table.user-grade').addClass('responsive-tab').removeClass('user-grade');
	$('table td a').attr('data-role', 'button').attr('data-mini', 'true');
	
});


/* Resource */
$('#page-mod-resource-view').live('pagebeforecreate',function(event, ui){

    var $this = $('iframe, object');
	$this.css({ width: '100%', height: '100%'});
				
	$('.resourcecontent').attr('style', '-webkit-overflow-scrolling: touch;').css({
        width: $this.attr('width'),
        height: $this.attr('height'),
        overflow: 'auto'                    
     });


});



