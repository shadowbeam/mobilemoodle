<?php

$pagetype = $PAGE->pagetype;

echo $OUTPUT->doctype(); ?>

<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>


<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=320.1" />



<link rel="apple-touch-icon-precomposed" href="<?php echo $OUTPUT->pix_url('touch-icon-iphone', 'theme')?>" />

<!-- iPhone -->
<link href="<?php echo $OUTPUT->pix_url('apple-touch-startup-image-iphone', 'theme')?>" media="(device-width: 320px)" rel="apple-touch-startup-image">

<!-- iPhone (Retina) -->
<link href="<?php echo $OUTPUT->pix_url('apple-touch-startup-image-iphone-retina', 'theme')?>" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">


<title><?php echo $PAGE->title ?></title>
<?php echo $OUTPUT->standard_head_html() ?>

<meta name="apple-mobile-web-app-capable" content="yes">

</head>


<body class="<?php p($PAGE->bodyclasses); ?>">

	<?php $settings = optional_param('mobilev1_settings', false, PARAM_BOOL); ?>
	


	<div id="<?php p($PAGE->bodyid); ?>" class="<?php p($pagetype); ?>"data-role="page" class="general">


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
				
			
					

				<?php  if(!$settings) echo core_renderer::MAIN_CONTENT_TOKEN; ?>					

				</div>


			</div>
			
			<?php 
			global $USER;
			$logout = "$CFG->wwwroot/login/logout.php?sesskey=$USER->sesskey"; ?>
			

			

			

						
					
		</div>
	
		


	</div>

	</div>

	<div id="moodle-url" url="<?php echo($CFG->wwwroot) ?>"></div>
</body>
</html>
