/**
 * Custom Javascript for mobilev1 moodle theme
 * @author Allan Watson
 * @editted 8/03/2012
 */

/* Bind the global settings before jquerymobile is loaded */
$(document).bind("mobileinit", function(){
	$.mobile.defaultPageTransition = "slide";
	$.mobile.touchOverflowEnabled = true; //slicker scrolling for devs that support touch-overflow css 
	$.mobile.page.prototype.options.domCache = true; //enable dom cache 
	$.mobile.defaultHomeScroll = 0; //prevent small content jumps
	$.event.special.swipe.verticalDistanceThreshold = 30; //improve swiping when scrolling
	
});

/* Disable the mouseover to improve menu scrolling performance */
 $(document).bind("vmouseover", function () { });
 
/** 
 * Course Index
 */
$('#page-site-index, #page-course-index')
	.live('pagebeforecreate',function(event, ui){
	
		/* possibly only need this for the local copy of moodle*/
		$(this).find('ul.section').attr("data-role", "listview").attr("data-inset", "true").attr('data-theme', 'a');
		$(this).find('.section li img.activityicon').addClass("ui-li-icon");	
		
		//must remove this otherwise front page course links break
		$(this).find('ul.teachers').remove();
		
		var unlist = $(this).find('.unlist');
		//unwrap the course list
		unlist.find('div.coursebox, div.info, h3.name').contents().unwrap();

		//change available courses to listview with filter
		unlist.attr("data-role", "listview").attr("data-inset", "true").attr("data-filter", "true");

	}).live('pageshow',function(event, ui){
		clear_inactive_pages();
	});
	
/**
 * My Course Index
 */
$('#page-my-index').live('pageshow',function(event, ui){
	clear_inactive_pages();
});		

/*
 * Function to remove inactive pages from DOM Cache 
 */
function clear_inactive_pages(){
	$('.ui-page:not(.ui-page.ui-page-active)').each(function(){
	     $(this).remove();
	});
}

/** 
 * General
 * Calls for every page show and page create
 */

 $('div').live('pageshow',function(event, ui){

	/* clear forward history */
	$.mobile.urlHistory.clearForward();
	
 }).live('pagebeforecreate',function(event, ui){
	
	var $this = $(this); //cache this page
	
	$this.find('.ftoggler').attr('data-role', 'list-divider').addClass('ui-bar-a');
	$this.find('#id_submitbutton').attr('data-theme', 'b');
		
	/* Swipe page header to open panel*/
	$this.find('#page-header').live('swipeleft', function (event, ui) {
	 	 $this.find('#panel-wrapper').panel( "open" );
	});
	
	var moodle_base_url = $('#moodle-url').attr('url'); //get base url
	
	/* Fix for autosubmit on select dropdowns */
    $this.find("select.urlselect, select.autosubmit").live("change",function(event) {	
		event.stopImmediatePropagation(); //prevent default behaviour
		
		sel = $(this).val(); 
		url = moodle_base_url + sel; //forum url
		
        if (sel != "") 
            $.mobile.changePage(url); 
        
    });
	
	/* Calendar block */
	var upc_event = $this.find('.block_calendar_upcoming .event');
	upc_event.attr('data-role', 'button');
	upc_event.tap(function(){
		var url = $(this).find('a:first').attr('href');
		$.mobile.changePage(url);
	});
	
});

/** 
 * Login Page
 */
$('#page-login-index').live('pagebeforecreate',function(event, ui){
	
	var signup = $(this).find('#signup');
	
	//front page needs to force a refresh
	$(this).find('#login').append(signup).attr('data-ajax', 'false');
	
	$(this).find('#password').attr('placeholder','Password');
	$(this).find('#username').attr('placeholder','Username');
	
	$(this).find('#loginbtn').attr('data-theme', 'b');
	$(this).find('.twocolumns').addClass('ui-grid-b my-breakpoint');
});

/** 
 * Course Page
 */
 
$('.course-view-topics, .course-view-weeks').live('pagebeforecreate',function(event, ui){


	/* Course Profile Hack */
	if($(this).find('.userprofile, .userlist').length > 0){
		$(this).find('.course-info').hide();
		$(this).find('table').addClass('responsive-tab');		
	}
	
	/* Course Page */
	else{
		var id = $(this).attr('id');
		var $cc = $(this).find('.course-content');

		/* Find course content replace uls with divs */
		var topx = $cc.find(' ul.topics, ul.weeks'); //get the topics							
		topx.wrap('<div class="courseformat ui-grid-a ui-responsive"/>').contents().unwrap();
		
		var $cf = $cc.find('.courseformat');
		
		/* Single Sections */
		$cc.find('.single-section .section-navigation a').attr('data-role', 'button').attr('data-inline', 'true').attr('data-mini', 'true');
		$cc.find('.single-section li.section .content').unwrap();	

		/* Columns of resources */
		$cf.find('li.section.main:even').addClass('ui-block-b');
		$cf.find('li.section.main:odd').addClass('ui-block-a');
		
		
		//create labels
		$cf.find('li.label').attr('data-role','list-divider').attr('data-theme', 'a');	

		//unwrap h3s so they become collapsible headers
		$cf.find('.section .content h3, .sectionname').unwrap();

		//remove unneeded div sides
		$cf.find('.left.side, .right.side').remove();
		
		//unwrap links
		$cf.find('.mod-indent .activityinstance a').unwrap().unwrap();
		
		//create the collapsible headers, except first section
		$cf.find('li.section.main').not('[id="section-0"]').attr('data-role', 'collapsible').attr('data-collapsed', 'false').attr('data-theme', 'b').attr('data-content-theme','c');
			
		//assign listviews
		$cf.find('ul.section').attr('data-role', 'listview').attr('data-shadow', 'false');
		$cf.find('#section-0 ul.section ').attr('data-inset', 'true');
			
		
		/* Fix for collapsible headings that also act as links */
		$cf.find("h3.section-title:has(a)").bind( "click", function(event, ui) {
			event.preventDefault();
			event.stopImmediatePropagation();
			var link = ($(this).find('span a').attr('href'));
			$.mobile.changePage( link, { transition: "slide"} );
		});
		
		/* Edit section better buttons */
		$cc.find('a:has(img.iconsmall, .smallicon)').addClass('edit_button').attr('data-role', 'button').attr('data-theme', 'a').attr('data-inline', 'true').attr('data-mini', 'true');
		
		var $ci = $(this).find('.course-info');
		
		/* Block_News items */
		$ci.find('.block a:not(.comment-message-meta a, .block_calendar_upcoming a)').attr('data-role', 'button').attr('data-theme', 'c').attr('data-inline', 'false').attr('data-mini', 'true');		
		$ci.find('.block_news_items ul').attr('data-role', 'listview');

	}
});


/** 
 * Profile
 */

$('#page-user-profile, #page-course-view-topics, #page-course-view-topics, #page-course-view-weeks').live('pagebeforecreate',function(event, ui){
	$up = $(this).find('.userprofile');
	if($up.length > 0){
		/* Create Buttons */
		$up.find('a:not(.profilepicture a)').attr('data-role', 'button');
		$up.find('.fullprofilelink a').attr('data-theme', 'b');
		
		//remove unnecessary ','
		$up.find('td:contains(",")').each(function(){
			$(this).html($(this).html().split(",").join(""));
		});
	}
});

/** 
 * Responsive Tables
 */
$('#page-user-profile, #page-mod-assign-view').live('pagebeforecreate',function(event, ui){
	$(this).find('table').addClass('responsive-tab');
});

/** 
 * Forums Topics Index
 */
$('#page-mod-forum-view').live('pagebeforecreate',function(event, ui){

	/* For each discussion row */
	$(this).find('tr.discussion').each(function(index) {
	
		//find the replies for this discussion
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
	var $fhl = $(this).find('table.forumheaderlist');
	$fhl.attr('data-role', 'controlgroup');
	$fhl.find('thead tr').attr("data-role", "button");
	$fhl.find('td.topic a').attr("data-role", "button").attr("data-icon", "arrow-r").attr("data-iconpos", "right");
	
	
});

/**
 * Key
 * #page-mod-forum-discuss		inside a topic
 * #page-mod-forum-post 		single post, eg. editting
 * #page-mod-forum-user			posts by user
 * .dialog-replies				a small screen dialog
 */


/** 
 * Forums Inside Topics
 */
$('#page-mod-forum-discuss, #page-mod-forum-post, #page-mod-forum-user').live('pagebeforecreate',function(event, ui){
    var $fp = $(this).find('.forumpost');
	var $fps = $fp.filter('.starter');
	var $com = $fp.find('.options .commands');
	
	/* Reply posts are blue */
	$fp.find('div.row.header:not(.starter .header)').addClass("ui-li ui-li-divider ui-btn ui-bar-b");
	$(this).find('h2.accesshide').addClass("ui-li ui-li-divider ui-btn ui-bar-b");
	
	/* Starter posts are black*/
	$fps.find('div.row.header').addClass("ui-li ui-li-divider ui-btn ui-bar-a");
	
	/* Post Commands */
		$com.attr("data-role", "controlgroup").attr("data-type", "horizontal");
		$com.find('a').attr("data-role", "button").attr("data-inline", "true").attr('data-mini','true')
			
			/* force commands to load, even if they have a # in their link */
			.bind( "click", function(event, ui) {
				event.preventDefault();
				event.stopImmediatePropagation();
			
				var link = $(this).attr('href');
				
				//this ignores the hash and simply loads the page
				$.mobile.changePage( link, { transition: "slideup"} );
						
			});
			  
		// remove annoying "|" seperators */ 
		$com.contents().filter(function() {
			return this.nodeType == 3; 
		}).remove();
	

	/* Paging Buttons */
	var $pg = $(this).find('.paging');
	
		//remove annoying "( and )"
		if($pg.length > 0 ){
			$pg.html($pg.html().split("(").join("").split(")").join("")); //remove unnecessary "("
				
			/* paging links */
			$pg.find('a')
				//create button style
				.attr('class', 'ui-li ui-li-static ui-btn-up-c')
				
				//change colour on tap
				.tap(function() {
					$(this).toggleClass("ui-btn-up-b ui-btn-up-c");
				});
		}

	/**
	 * Small Screen Forums
	 */	
	if($('html.smallscreen')){
		
		
		/* Show controls for post after tap */
		$fp.click(function(event, ui){
			$(this).find('.commands').toggleClass('showcontrols');
		});
		
		
		/* If there are no reply buttons */
		if($fp.find('.rply-count').length == 0){	
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
				
		 //Swiping over the post or tapping reply button pops up new replies 	
		$('.forumpost.has-replies').live('swiperight swipeleft', function (event, ui) {
			popupReply($(this), event);
		}).find('.rply-count').live('tap', function (event) {
			popupReply($(this).parents('.forumpost'), event);
		});
	}
})
/* Check when page gets created if the user has been taught about forums */
.live('pagecreate',function(event, ui) {
		check_index_tut();
	});
		


/**
 * Function for popping up a replies in new page
 * @params forumpost node, event
 * @author Allan Watson 2013
 */
function popupReply($fp, event){

	event.stopImmediatePropagation(); //prevent double firing
	
	/* Get id from the previous anchor link */
	var id = 'dialog-replies-' + $fp.prev().attr('id');
		
	/* if dialog already exists show it */
	if($('#' + id).length > 0){	
		$.mobile.changePage( $('#' + id), { transition: "fade"} );
	}

	/* otherwise create one */
	else{
		var rpls = '';
		$fp.siblings('.indent').each(function(){ 
			var childpost = $(this).html(); //get contents of indents inline with fp, ie. the next level of replies
			if(typeof(childpost) !== 'undefined') //check for undefined
				rpls += childpost; //collate replies
		});
		
		if(rpls != null){ //if replies exist add them to a new page
			$('body').append('<div id="' + id + '"data-role="page" data-url="' + id +'" data-theme="a" class="dialog-replies"><div id="page-header" data-role="header"><div><a id="back-button" data-direction="reverse" data-transition="slide"  class="icon-close mybtn ui-btn-left" data-rel="back" href="#"></a></div><h1>Replies</h1></div><div data-role="content"><div class="forumpost starter">' + $fp.html() + '</div>' + rpls + '</div></div>');
			$.mobile.changePage( $('#' + id), { transition: "fade"} );	//change to page
		}
	}	
}

/**
 * Marking
 */

$('#page-mod-assign-view').live('pagebeforecreate',function(event, ui){

	$(this).find('#id_savegrade').attr('data-theme', 'b');
	$(this).find('a:has(img.smallicon)').addClass('edit_button').attr('data-role', 'button').attr('data-theme', 'a').attr('data-inline', 'true').attr('data-mini', 'true');
	
	$('.submissionlinks a').attr('data-role', 'button').attr('data-theme', 'b');

});


/** 
 * User Grades 
 */

$('#page-course-user').live('pagebeforecreate',function(event, ui){
	$tab = $(this).find('table.user-grade');
	$tab.addClass('responsive-tab').removeClass('user-grade');
	$tab.find('th').attr('colspan', '1');
	$tab.find('td.oddd1').remove();
	$tab.find('table td a').attr('data-role', 'button').attr('data-mini', 'true');
	
});


/**
 * Resource iFrames
 */
$('#page-mod-resource-view').live('pagebeforecreate',function(event, ui){

    var $iframe = $(this).find('iframe, object');
	$iframe.css({ width: '100%', height: '100%'});
				
	$(this).find('.resourcecontent').attr('style', '-webkit-overflow-scrolling: touch;').css({
        width: $iframe.attr('width'),
        height: $iframe.attr('height'),
        overflow: 'auto'                    
     });
	 
});

/**
 * Messages 
 */
$('#page-message-index').live('pagebeforecreate',function(event, ui){
	$(this).find('.removecontact a, .blockcontact a, .history a').attr('data-role', 'button').attr('data-mini', 'true').attr('data-inline', 'true');
	
	$(this).find('table.message_user_pictures').addClass('responsive-tab');

});

/**
 * Calendar 
 */
$('#page-calendar-view').live('pagebeforecreate',function(event, ui){
	$(this).find('.calendarmonth td .day a').attr('data-role', 'button').attr('data-mini', 'true').attr('data-inline', 'true').attr('data-theme', 'b');
	$(this).find('.arrow_link').attr('data-role', 'button').attr('data-mini', 'true').attr('data-inline', 'true').attr('data-theme', 'a');
	
});

