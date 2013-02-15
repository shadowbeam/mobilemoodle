<?php
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);

echo $OUTPUT->doctype(); ?>

<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $PAGE->title ?></title>
<?php echo $OUTPUT->standard_head_html() ?>

<meta name="apple-mobile-web-app-capable" content="yes">



</head>


<body class="<?php p($PAGE->bodyclasses); ?>">

	<?php $settings = optional_param('mobilev1_settings', false, PARAM_BOOL); ?>


	<div id="<?php p($PAGE->bodyid); ?>" data-role="page" class="general">

		<!-- Panel -->
		<div data-role="panel" id="panel-wrapper" data-position="right" data-theme="a"	data-display="reveal">
		
			
							
							
			
					<ul data-role="listview" data-theme='b' class="settingsul">

<?php $renderer = $PAGE->get_renderer('theme_mobilev1');
echo $renderer->navigation_tree($PAGE->navigation );
?>
</ul>


			<!-- If Logged in -->
			<?php
if (isloggedin()) { ?>
<a data-role="button" data-theme="b" data-inline="true" data-rel="popup" href="#logoutpopup">

<?php echo  get_string('logout'); ?>

</a>
	

			<?php if(!$settings){ ?>
			<?php $urlsettings = new moodle_url($PAGE->url, array('mobilev1_settings' => 'true'));?>

			<a data-role="button" data-theme="b" data-inline="true" href="<?php echo $urlsettings->out(); ?>">
				<?php p(get_string('settings')); ?>
			</a>

			<?php }//ifsettings 
   }//ifflogged ?>






		</div>
		<!--panel-->

		<!--  header -->
		<div id="page-header" data-role="header" data-position="">

			<?php if ($PAGE->heading) { ?>

			<div class="headernav">
				<?php if (isloggedin()) { ?>
						
					<a class="icon-menu ui-btn-right" href="#panel-wrapper"
					data-ajax="false"></a>
				<?php } else { echo $OUTPUT->login_info();} ?>
				
				<?php echo $OUTPUT->back_button(); ?>
				

				
			
			</div>

			<div class="headerprofile">
				<?php
				echo $PAGE->headingmenu;
				?>
				
			</div>

			<h1 class="headermain">
				<?php echo $PAGE->heading ?>
			</h1>
			<?php } ?>

		</div>


		<div id="page-body" data-role="content">


			<div id="region-main-box">

				<div class="region-content">

					<!-- For settings page -->
					<?php if($settings){?>
						<ul data-role="listview">
							<?php $renderer = $PAGE->get_renderer('theme_mobilev1');
								echo $renderer->settings_tree($PAGE->settingsnav);	
							?>
						</ul>
					<?php   } ?>
					
					<!-- For Course page -->
					<?php if ($PAGE->pagetype == 'course-view-topics' || $mypagetype == 'course-view-weeks'){ ?>
						<div class="course-info">
							<h1><?php echo $PAGE->heading ?></h1>
							<span><?php echo $PAGE->course->summary; ?></span>
							<a data-role='button' href='<?php $this->page->course->id; ?>'>Grades</a>
							<?php echo $OUTPUT->blocks_for_region('side-post') ?>
						</div>
					<?php } ?>
					

				<?php	echo $OUTPUT->main_content(); ?>
					

				</div>


			</div>
			
			<?php 
			global $USER;
			$logout = "$CFG->wwwroot/login/logout.php?sesskey=$USER->sesskey";
			 ?>
			
			<div data-role="popup" id="logoutpopup" data-position-to="window">
			<div data-role="header" data-them="a">
			<h1 role="heading">Logout?</h1>
			</div>				<p>Are you sure you want to logout?<p>
				<a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c" data-corners="true">Cancel</a>
			
				<a href="<?php echo $logout ?>	" data-ajax="false" data-role="button" data-inline="true" data-transition="flow" data-theme="b" data-corners="true"  >Logout</a> 
				
			</div>
			
			<div data-role="popup" id="freepopup">
				<p>This is a completely basic popup, no options set.<p>
			</div>
					
		</div>
		
		


	</div>

	</div>
	

	
</body>
</html>
