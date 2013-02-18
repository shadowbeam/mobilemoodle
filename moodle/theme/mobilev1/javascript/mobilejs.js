/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-fontface-cssclasses-teststyles-load
 */
;window.Modernizr=function(a,b,c){function v(a){j.cssText=a}function w(a,b){return v(prefixes.join(a+";")+(b||""))}function x(a,b){return typeof a===b}function y(a,b){return!!~(""+a).indexOf(b)}function z(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:x(f,"function")?f.bind(d||b):f}return!1}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m={},n={},o={},p=[],q=p.slice,r,s=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},t={}.hasOwnProperty,u;!x(t,"undefined")&&!x(t.call,"undefined")?u=function(a,b){return t.call(a,b)}:u=function(a,b){return b in a&&x(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=q.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(q.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(q.call(arguments)))};return e}),m.fontface=function(){var a;return s('@font-face {font-family:"font";src:url("https://")}',function(c,d){var e=b.getElementById("smodernizr"),f=e.sheet||e.styleSheet,g=f?f.cssRules&&f.cssRules[0]?f.cssRules[0].cssText:f.cssText||"":"";a=/src/i.test(g)&&g.indexOf(d.split(" ")[0])===0}),a};for(var A in m)u(m,A)&&(r=A.toLowerCase(),e[r]=m[A](),p.push((e[r]?"":"no-")+r));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)u(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},v(""),i=k=null,e._version=d,e.testStyles=s,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+p.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};

Modernizr.addTest('baddevice', function () {
	if (!!navigator.userAgent.match(/(Android (2.0|2.1))|(Nokia)|(Opera (Mini|Mobi))|(w(eb)?OSBrowser)|(UCWEB)|(Windows Phone)|(XBLWP)|(ZuneWP)/)) {
		return true;
	}
});

/*
Modernizr.load({
  test: !Modernizr.baddevice,
  yep : '/~xvb09137/moodle/theme/mobilev1/javascript/yep.js',
  nope: '/~xvb09137/moodle/theme/mobilev1/javascript/nope.js'
});
*/


//must bind the global settings before jquerymobile is loaded
$(document).bind("mobileinit", function(){
	$.mobile.defaultPageTransition = "slide";
	
});
 $(document).bind("vmouseover", function () { });


/*Course Index*/
$('#course-page-index, #page-site-index').live('pagebeforecreate',function(event, ui){
	$('ul.section').attr("data-role", "listview").attr("data-inset", "true");
	$('.section li img.activityicon').addClass("ui-li-icon");
});

$('.ui-page').live('pageinit',function(event, ui){


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
  
    
//  $("#loginbtn").click(function(){
//
//		var thedata = $("#login").serialize();
//
//		$.ajax({
//			type: 'POST',
//			url: form.attr('action'),
//			cache: false,
//			data: thedata,
//			beforeSend:function(){
//				$.mobile.loading('show'); //show loading animation
//			  
//			},
//			success:function(data){
//				var $response=$(data); //convert response to DOM
//
				//Query the jQuery object for the values
//				var loginland = $response.filter('#page-login-index').text();
//				
			//	alert(loginland);
//				
//				if(loginland == ""){ //if text is null change page
//					$.mobile.changePage( 'https://devweb2012.cis.strath.ac.uk/~xvb09137/moodle/index.php', { transition: "slideup"} ); //unhardcode
//				}
//				else //otherwise submit form again
//					form.submit(); //TODO could try replacing DOM contents with
//					
//				
//			},
//			error:function(){
//					alert('Error Loading Page');
//			},
//			complete:function(){
//					$.mobile.loading('hide');
//			}
//		});
//
//return false;
//
//});
	
	$('form').attr('data-ajax', 'false');//front page form needs to force a refresh.

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
		
	
	$('.course-content li.section.main:even').addClass('ui-block-b');
	$('.course-content li.section.main:odd').addClass('ui-block-a');
		
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


/* Grades*/
$('#page-course-user').live('pagebeforecreate',function(event, ui){
	$('table.user-grade').attr('data-role', 'table');
});


/* Resource */
$('#page-mod-resource-view').live('pagebeforecreate',function(event, ui){
	$('#resourceobject').remove();
});



