<?php

echo $OUTPUT->doctype(); ?>

<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>


<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=320.1" />

<title><?php echo $PAGE->title ?></title>

<?php echo $OUTPUT->standard_head_html() ?>

<meta name="apple-mobile-web-app-capable" content="yes">

</head>


<body class="<?php p($PAGE->bodyclasses); ?>">

	<div id="<?php p($PAGE->bodyid); ?>" class="<?php p($PAGE->pagetype); ?>"data-role="dialog" class="popup">

		<div id="page-header" data-theme="a">
	
		<a id="back-button" data-direction="reverse" data-transition="pop" class="icon-close mybtn ui-btn-left ui-link" data-rel="back" href="#"></a>
			
		</div>
		<div data-role="content">
				
			<?php  if(!$settings) echo core_renderer::MAIN_CONTENT_TOKEN; ?>					

		</div>	

		</div>


	

</body>
</html>
