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

	<!-- <?php echo $OUTPUT->standard_top_of_body_html() ?> //is this needed?-->


	<div id="<?php p($PAGE->bodyid); ?>" data-role="page" class="general">

		<!-- Panel -->
		<div data-role="panel" id="panel-wrapper" data-position="left"
			data-display="reveal">
					<ul data-role="listview" class="settingsul">

<li><a href="<?php echo $CFG->wwwroot; ?>">Courses</a></li>

<?php $renderer = $PAGE->get_renderer('theme_mobilev1');
echo $renderer->navigation_tree($PAGE->navigation );
?>
</ul>


			<!-- If Logged in -->
			<?php
if (isloggedin()) {


echo '<a data-role="button" data-rel="popup" href="#logoutpopup">' . get_string('logout') . "</a>";
?>

		


			<?php if(!$settings){ ?>
			<?php $urlsettings = new moodle_url($PAGE->url, array('mobilev1_settings' => 'true'));?>

			<a data-role="button" href="<?php echo $urlsettings->out(); ?>">
				<?php p(get_string('settings')); ?>
			</a>

			<?php }//ifsettings 
   }//ifflogged ?>



		</div>
		<!--panel-->

		<!--  header -->
		<div id="page-header" data-role="header" data-position="fixed">

			<?php if ($PAGE->heading) { ?>

			<div class="headernav">
				<?php if ($hassidepre OR (right_to_left() AND $hassidepost)) { ?>

				<a class="ui-btn-left" data-role="button" href="#panel-wrapper"
					data-ajax="false">Menu</a>
				<?php } ?>
				
				<?php echo $OUTPUT->login_info(); ?>
				
			
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


					<?php 
					/* For the settings page */
                    if($settings){?>

					<ul data-role="listview" class="settingsul">

						<?php $renderer = $PAGE->get_renderer('theme_mobilev1');
						echo $renderer->settings_tree($PAGE->settingsnav);
							
						?>
					</ul>

					<?php   }  echo $OUTPUT->main_content(); ?>

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
			
			
					
		</div>



	</div>

	</div>
	

	
</body>
</html>
