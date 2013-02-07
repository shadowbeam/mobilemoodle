<?php
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

echo $OUTPUT->doctype(); ?>

<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $PAGE->title ?></title>
    <?php echo $OUTPUT->standard_head_html() ?>
    
    <script>    
	    window.addEventListener("load",function() {
	      // Set a timeout...
	      setTimeout(function(){
	        // Hide the address bar!
	        window.scrollTo(0, 1);
	      }, 0);
	    });
	    
    </script>
    
    
    
</head>


<body class="<?php p($PAGE->bodyclasses); ?>">

<?php $settings = optional_param('mobilev1_settings', false, PARAM_BOOL); ?>

<!-- <?php echo $OUTPUT->standard_top_of_body_html() ?> //is this needed?-->


<div id="<?php p($PAGE->bodyid); ?>" data-role="page" class="general">

<!-- Panel -->
<div data-role="panel" id="panel-wrapper" data-position="left" data-display="reveal">



<!-- If Logged in -->
<?php
if (isloggedin()) { ?>

   <a data-role="button" data-transition="pop" href="<?php echo $CFG->wwwroot.'/login/logout.php'; ?>">
<?php echo get_string('logout'); ?></a>

   
	<?php if(!$settings){ ?>
	<?php $urlsettings = new moodle_url($PAGE->url, array('mobilev1_settings' => 'true'));?>
	
	<a data-role="button" href="<?php echo $urlsettings->out(); ?>">
	<?php p(get_string('settings')); ?></a>
	
   <?php }//ifsettings 
   }//ifflogged ?>


<!-- /If Logged in -->

<?php if ($hassidepre OR (right_to_left() AND $hassidepost)) { ?>
               
               
               
                <div id="region-pre" class="block-region">
                    <div class="region-content">
                            <?php
                        if (!right_to_left()) {
                            echo $OUTPUT->blocks_for_region('side-pre');
                        } elseif ($hassidepost) {
                       //     echo $OUTPUT->blocks_for_region('side-post');
                    } ?>

                    </div>
                </div>
                <?php } ?>

              

</div><!--panel-->
	
	<!--  header -->
    <div id="page-header" data-role="header" position="fixed">
    
        <?php if ($PAGE->heading) { ?>
           
            <div class="headernav">    
            <?php if ($hassidepre OR (right_to_left() AND $hassidepost)) { ?>
            
                <a class="ui-btn-left" data-role="button" href="#panel-wrapper" data-ajax="false">Menu</a>
                <?php } ?>
              <?php  echo $OUTPUT->login_info(); ?>
            </div>
            
            <div class="headerprofile"><?php
                echo $PAGE->headingmenu
            ?></div>
   
             <h1 class="headermain"><?php echo $PAGE->heading ?></h1>
        <?php } ?>
        
    </div>


<div id="page-body" data-role="content">


    <div  id="region-main-box">

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
    </div>
    
                      

</div>

</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>