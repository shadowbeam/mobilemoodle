/* Add to Home */
var addToHomeConfig = {
	message: 'This is a custom message. Your device is an <strong>%device</strong>. The action icon is %icon.'
};


//must bind the global settings before jquerymobile is loaded
$(document).bind("mobileinit", function(){
	$.mobile.defaultPageTransition = "slide";
	$.mobile.touchOverflowEnabled = true;
	$.mobile.page.prototype.options.domCache = true;
});
 $(document).bind("vmouseover", function () { });
 

 
/*Course Index*/
$('#course-page-index, #page-site-index').live('pagebeforecreate',function(event, ui){
	$('ul.section').attr("data-role", "listview").attr("data-inset", "true").attr('data-theme', 'a');
	$('.section li img.activityicon').addClass("ui-li-icon");
	
	/*remove unnecessary pages*/
	$('.ui-page:not(.ui-page.ui-page-active)').each(function(){
			$(this).remove();
		});
	
});

$('#course-page-index, #page-site-index').live('pageinit',function(event, ui){
		
});

/* General */
	$('div').live('pagebeforecreate',function(event, ui){
		$('.ftoggler').attr('data-role', 'list-divider').addClass('ui-bar-a');
		$('#id_submitbutton').attr('data-theme', 'b');
		
		$('.ui-panel-content-wrap-open').live('swiperight', function (event, ui) {
		 $('#panel-wrapper').panel( "close" );
	 });
	 
	 $('#page-header').live('swipeleft', function (event, ui) {
	 	 $('#panel-wrapper').panel( "open" );
	  });
		
		
	});

/* Login Page */

$('#page-login-index').live('pagebeforecreate',function(event, ui){
	$('#login').append($('#signup'));
	$('#password').attr('placeholder','Password');
	$('#username').attr('placeholder','Username');
	$('#loginbtn').attr('data-theme', 'b');
	$('.twocolumns').addClass('ui-grid-b my-breakpoint');
	
	var form = $("#login");	
	$('form').attr('data-ajax', 'false');//front page form needs to force a refresh.

});


$('div#pannel-wrapper').live('pagebeforecreate',function(event, ui){
	$('li.contains_branch').attr('data-role', 'collapsible').attr('data-theme','c');
});


/* Front Page */

$('div#page-site-index, #page-course-index').live('pagebeforecreate',function(event, ui){
	
	$('ul.teachers').remove();
	
	//unwrap the course list
	$('.unlist div.coursebox, .unlist div.info, .unlist h3.name').contents().unwrap();

	//change available courses to listview with filter
	$('.unlist').attr("data-role", "listview").attr("data-inset", "true").attr("data-filter", "true");
	


});
 

/* Course */

$('#page-course-view-topics, #page-course-view-weeks').live('pagebeforecreate',function(event, ui){

var innercontent;

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

else if ($('ul.weeks').length > 0) {
	innercontent = $('ul.weeks').html();
	$('ul.weeks').wrap('<div class="courseformat"/>').remove();
	$('div.courseformat').html(innercontent).addClass('ui-grid-a ui-responsive');

}

	/* Single Section */
	$('.single-section .section-navigation a').attr('data-role', 'button').attr('data-inline', 'true').attr('data-mini', 'true');
	$('.single-section li.section .content').unwrap();	

	//create labels
	$('li.label').attr('data-role','list-divider').attr('data-theme', 'a');	

	//unwrap h3s so they become collapsible headers
	$('.sectionname').unwrap();
	
	$('.courseformat .section .content h3').unwrap();

	//remove unneeded sides
	$('.left.side, .right.side').remove();
	
	//unwrap links
	$('.mod-indent .activityinstance a').unwrap().unwrap();
	
	//create the collapsible headers
	$('.course-content li.section.main').not('[id="section-0"]').attr('data-role', 'collapsible').attr('data-collapsed', 'false').attr('data-theme', 'b').attr('data-content-theme','c');
		
	
	
	//assign listviews
	$('ul.section').attr('data-role', 'listview');
	$('#section-0 ul.section ').attr('data-inset', 'true');
	
	
	//force section 0 full width
	//$('#section-0').addClass('ui-grid-solo');
	
	
	$("h3.section-title:has(a)").bind( "click", function(event, ui) {
			event.preventDefault();
			event.stopPropagation;
		var link = ($(this).find('span a').attr('href'));
		$.mobile.changePage( link, { transition: "slide"} );

	});
	
	/* edit section */
	$('a:has(img.iconsmall)').addClass('edit_button').attr('data-role', 'button').attr('data-theme', 'a').attr('data-inline', 'true').attr('data-mini', 'true');
	
	/* block news items */
	
	$('.block a').attr('data-role', 'button').attr('data-theme', 'c').attr('data-inline', 'false').attr('data-mini', 'true');
	
	$('.block_news_items ul').attr('data-role', 'listview');

	/* hack for the profile */
	if($(this).find('.userprofile').length > 0){
		$('.course-info').hide();
		$('.userprofile table').addClass('responsive-tab');		
	}
	
	$('.course-content .courseformat li.section.main:even').addClass('ui-block-b');
	$('.course-content .courseformat li.section.main:odd').addClass('ui-block-a');
});


/* Profile */

$('#page-user-editadvanced, #page-user-profile, #page-course-view-topics, #page-course-view-topics').live('pagebeforecreate',function(event, ui){
	//$('fieldset').attr('data-role','collapsible');
	$('.info.c1 a, .messagebox a, .fullprofilelink a').attr('data-role', 'button');
	$('.messagebox a, .fullprofilelink a').attr('data-theme', 'b');
	
	$('td:contains(",")').each(function(){
		$(this).html($(this).html().split(",").join("")); //remove unnecessary ,
	});
});

/* Responsive Tables */
$('#page-user-editadvanced, #page-user-profile, #page-mod-assign-view').live('pagebeforecreate',function(event, ui){
	$('table').addClass('responsive-tab');

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
	$('.forumaddnew a').attr('data-theme', 'a');
	
	
});

 /* forum discussion page only stuff */
$('#page-mod-forum-discuss, #page-mod-forum-post, #page-mod-forum-user').live('pagebeforecreate',function(event, ui){
        //actual forum posting
        $('.forumpost:not(.starter) div.row.header, h2.accesshide').addClass("ui-li ui-li-divider ui-btn ui-bar-b");
        $('.forumpost.starter div.row.header, h2.accesshide').addClass("ui-li ui-li-divider ui-btn ui-bar-a");
        
        $('.options .commands').attr("data-role", "controlgroup").attr("data-type", "horizontal");
        $('.options .commands a').attr("data-role", "button").attr("data-inline", "true").attr('data-mini','true');

		
		
		// Load the reply form in a popup
		$( ".options .commands a" ).bind( "click", function(event, ui) {
			event.preventDefault();
			event.stopPropagation;
		
			var link = $(this).attr('href');
			
			//this ignores the hash and simply loads the page
			$.mobile.changePage( link, { transition: "slideup"} );
						
		});
		      
      	//remove all text from the commands annoying "|" seperators
        $('.options div.commands').contents().filter(function() {
            return this.nodeType == 3; 
        }).remove();
		
		$('#id_submitbutton').attr('data-theme', 'b'); //do we need?
		
		/* Paging Buttons */
		$('.paging a').attr('class', 'ui-li ui-li-static ui-btn-up-c');
		
		$('.paging:contains("(")').each(function(){
			$(this).html($(this).html().split("(").join("")); //remove unnecessary "("
		});
		
		$('.paging:contains(")")').each(function(){
			$(this).html($(this).html().split(")").join("")); //remove unnecessary ")"
		});
		
		$( ".paging a" ).hover(function() {
		       $( this ).addClass( "ui-btn-up-b" ).removeClass( "ui-btn-up-c" );
		 }, function() {
		    $( this ).removeClass( "ui-btn-up-b" ).addClass( "ui-btn-up-c" );
		   });
        
    });
    
$('#page-mod-forum-discuss, #page-mod-forum-post, #page-mod-forum-user, .dialog-replies').live('pagebeforecreate',function(event, ui){
		
	if($('.rply-count').length == 0){

		$('.forumpost').each(function(){
			var count = 0;
			var parent = $(this).parent();
			if(parent.attr('class') == 'indent'){
				parent.children('.indent').each(function(){
					count += $(this).children('.forumpost').size();
				});
				if(count > 0)
					$(this).find('.content').prepend('<div data-role="button" data-mini="true" data-theme="b" class=" rply-count clearfix">' + count + '</div>');
				
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

/* Small Screen Forums */

$('.smallscreen #page-mod-forum-discuss, .smallscreen .forumtype-single, .smallscreen #page-mod-forum-post,.smallscreen #page-mod-forum-user,.smallscreen #dialog-replies, .smallscreen .dialog-replies').live('pagebeforecreate',function(event, ui){
	
	$('.forumpost:not(.starter)').click(function(event, ui){
			$(this).find('.commands').toggleClass('showcontrols');
		});
	
	$('.indent .indent').hide();

		
		$('.forumpost:not(.starter)').live('swiperight', function (event, ui) {
			popupReply($(this), event);
		});
		
		$('.rply-count').live('tap, click', function (event, ui) {
			$(this).parent('.forumpost').hide();
			popupReply($(this).parent('.forumpost'), event);
		});
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
				$.mobile.changePage( $('#' + id), { transition: "pop"} );
			}
			
			else{
				var rpls;
				$this.parent().children('.indent').each(function(){
					rpls += $(this).html();
				});
				
				if(rpls != null){
					$('body').append('<div id="' + id + '"data-role="page" data-theme="a" class="dialog-replies"><div id="page-header" data-role="header"><div><a id="back-button" data-direction="reverse" data-transition="slide"  class="icon-close mybtn ui-btn-left" data-rel="back" href="#"></a></div><h1>Replies</h1></div><div data-role="content"><div class="forumpost starter">' + $this.html() + '</div>' + rpls + '</div></div>');
					
					//initialise the page
					$.mobile.initializePage();
					//change to page
					$.mobile.changePage( $('#' + id), { transition: "pop"} );
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



