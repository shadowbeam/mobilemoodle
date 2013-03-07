<?php
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hascenterpost = $PAGE->blocks->region_has_content('center-post', $OUTPUT);

$pagetype = $PAGE->pagetype;

echo $OUTPUT->doctype(); ?>

<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>


<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=320.1" />


+    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />

<link rel="apple-touch-icon-precomposed" href="<?php echo $OUTPUT->pix_url('touch-icon-iphone', 'theme')?>" />

<!-- iPhone -->
<link href="<?php echo $OUTPUT->pix_url('apple-touch-startup-image-iphone', 'theme')?>" media="(device-width: 320px)" rel="apple-touch-startup-image">

<!-- iPhone (Retina) -->
<link href="<?php echo $OUTPUT->pix_url('apple-touch-startup-image-iphone-retina', 'theme')?>" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

<?php /*

<!-- iPad (portrait)   -->   
<link href="<?php echo $OUTPUT->pix_url('apple-touch-startup-image-ipad-portrait', 'theme')?>" media="(device-width: 768px) and (orientation: portrait)" rel="apple-touch-startup-image"/>

<!-- iPad (landscape) -->
<link href="<?php echo $OUTPUT->pix_url('apple-touch-startup-image-ipad-landscape', 'theme')?>" media="(device-width: 768px) and (orientation: portrait)" rel="apple-touch-startup-image"/>

<!-- iPad (Retina, portrait) -->
<link href="<?php echo $OUTPUT->pix_url('apple-touch-startup-image-ipad-retina-portrait', 'theme')?>" media="(device-width: 1536px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

<!-- iPad (Retina, landscape) -->
<link href="<?php echo $OUTPUT->pix_url('apple-touch-startup-image-ipad-retina-landscape', 'theme')?>" media="(device-width: 1536px)  and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

<!-- iPhone 5 (Retina) -->
<link href="<?php echo $OUTPUT->pix_url('apple-touch-startup-image-iphone5', 'theme')?>" rel="apple-touch-startup-image" sizes="640x1096">

*/?>
<title><?php echo $PAGE->title ?></title>
<?php echo $OUTPUT->standard_head_html() ?>

<meta name="apple-mobile-web-app-capable" content="yes">

</head>


<body class="<?php p($PAGE->bodyclasses); ?>">

	<?php $settings = optional_param('mobilev1_settings', false, PARAM_BOOL); ?>
	


	<div id="<?php p($PAGE->bodyid); ?>" class="<?php p($pagetype); ?>"data-role="page" class="general">

		<!-- Panel -->
		<div data-role="panel" id="panel-wrapper" data-dismissible="true" data-swipe-close="true"  data-position="right" data-theme="a" data-display="reveal">
		
			
						<?php echo $OUTPUT->login_info() ?>
							
							
			
					<ul data-role="listview" data-theme='b' class="settingsul">

				<!--	<li data-theme='a' class="Home">
						<a title="Home" href="<?php echo "$CFG->wwwroot/" ?>"><i class="icon-home"></i>Home</a>
					</li>-->
					
<?php $renderer = $PAGE->get_renderer('theme_mobilev1');
echo $renderer->navigation_tree($PAGE->navigation );
?>
</ul>


			<!-- If Logged in -->
			<?php
if (isloggedin()) { ?>
<a id="logout-btn" data-role="button" data-theme="b" data-inline="false" data-rel="popup" href="#logoutpopup">

<?php echo  get_string('logout'); ?>
<i class="icon-exit mybtn"></i>
</a>
	

			<?php if(!$settings){ 	
				echo $OUTPUT -> settings_button(); 
			}//ifsettings 
   }//ifflogged ?>






		</div>
		<!-- /panel-->

		<!--  header -->
		<div id="page-header" data-role="header" data-position="fixed" data-tap-toggle="false">

			<?php if ($PAGE->heading) { ?>

			<div class="headernav">
				<?php if (isloggedin()) { ?>
						
					<a class="icon-menu mybtn ui-btn-right" href="#panel-wrapper"
					data-ajax="false"></a>
					<?php echo $OUTPUT->back_button(); ?>
					
				<?php } else { echo $OUTPUT->login_info();} ?>
				
				
				

				
			
			</div>

			<div class="headerprofile">
				<?php echo $PAGE->headingmenu; ?>
				
			</div>

			<h1 class="headermain">
				<?php echo $PAGE->heading ?>
			</h1>
			<?php } ?>

		</div>


		<div id="page-body" data-role="content">


			<div id="region-main-box">
			
				<div class="region-content">
				
				<!-- For Forums page -->
						<?php if($pagetype == "mod-forum-view"){?>
							<a id="forum-tut-btn" href="#" onclick="open_forum_tut();" data-role="button" data-inline="true" data-mini="true" data-theme="b">Help</a>

						<?php }?>
				
					<!-- For settings page -->
					<?php if($settings){?>
						<ul data-role="listview">
							<?php $renderer = $PAGE->get_renderer('theme_mobilev1');
								echo $renderer->settings_tree($PAGE->settingsnav);	
							?>
						</ul>
					<?php   }
					
					
					/* For Course page */
					 else if ($pagetype == 'course-view-topics' || $pagetype == 'course-view-weeks'){ ?>
					
					<div class="course-info ui-grid-a ui-responsive">
						<div id="blurb" class="ui-block-a ui-bar-c ui-shadow ui-btn-corner-all ui-btn-block">
						
						<div class="inner">
	
								<!--<h1><?php echo $PAGE->heading ?></h1>-->
								<span><?php echo $PAGE->course->summary; ?></span>
								
								<div data-role="controlgroup">
								<a data-inline="false" data-role="button" href="<?php echo $OUTPUT->grades_link(); ?>"><i class="left icon-spell-check"></i>Grades</a>
								<?php 	
									/* Assume a teacher */
									if ($PAGE->user_allowed_editing()) {
										echo $OUTPUT->course_settings_button($PAGE->url);
										echo $OUTPUT->grader_button($PAGE->url);
										echo $OUTPUT->edit_button($PAGE->url);
										
										//echo $OUTPUT->user_role();
										
									}
					
								?>
								</div>
								
							</div>
						</div>
						<div class="ui-block-b accord">
							<div data-role="collapsible-set" data-theme="a">
							
								<?php echo $OUTPUT->blocks_for_region('side-post') ?>
							</div>
						</div>
					</div><!-- /grid-a -->
					
											</div>
					<?php } ?>
					

				<?php  if(!$settings) echo core_renderer::MAIN_CONTENT_TOKEN; ?>					

				</div>


			</div>
			
			<?php 
			global $USER;
			$logout = "$CFG->wwwroot/login/logout.php?sesskey=$USER->sesskey"; ?>
			
			<div data-role="popup" id="logoutpopup" data-position-to="window">
			<div data-role="header" data-them="a"><h1 role="heading">Logout?</h1>
			
			</div>		
				<p>Are you sure you want to logout?<p>
				<a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c" data-corners="true">Cancel</a>
			
				<a href="<?php echo $logout ?>	" data-ajax="false" data-role="button" data-inline="true" data-transition="flow" data-theme="b" data-corners="true"  >Logout</a> 
			</div>
			

			

						
					
		</div>
	
		


	</div>

	</div>

	<div data-role="dialog" id="dialog">My dialog</div>

	<div id="moodle-url" url="<?php echo($CFG->wwwroot) ?>"></div>
</body>
</html>
