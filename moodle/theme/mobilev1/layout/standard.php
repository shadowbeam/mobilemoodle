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
	    $(document).bind("mobileinit", function() {
	      $.mobile.touchOverflowEnabled = true;
	    });
    </script>
    
</head>


<body class="<?php p($PAGE->bodyclasses); ?>">

<?php echo $OUTPUT->standard_top_of_body_html() ?>


<div id="<?php p($PAGE->bodyid); ?>" data-role="page" class="general">

<div data-role="panel" id="panel-wrapper" data-position="left" data-display="reveal">

<?php echo "<a href=\"$CFG->wwwroot/login/logout.php?sesskey=".sesskey()."\">".get_string('logout').'</a>';
 ?>

<?php if ($hassidepre OR (right_to_left() AND $hassidepost)) { ?>
                <div id="region-pre" class="block-region">
                    <div class="region-content">
                            <?php
                        if (!right_to_left()) {
                            echo $OUTPUT->blocks_for_region('side-pre');
                        } elseif ($hassidepost) {
                            echo $OUTPUT->blocks_for_region('side-post');
                    } ?>

                    </div>
                </div>
                <?php } ?>

                <?php if ($hassidepost OR (right_to_left() AND $hassidepre)) { ?>
                <div id="region-post" class="block-region">
                    <div class="region-content">
                           <?php
                       if (!right_to_left()) {
                           echo $OUTPUT->blocks_for_region('side-post');
                       } elseif ($hassidepre) {
                           echo $OUTPUT->blocks_for_region('side-pre');
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
            <div id="region-main-wrap">
                <div id="region-main">
                    <div class="region-content">
                    
                        <?php 
                        
                        
                        
                        echo core_renderer::MAIN_CONTENT_TOKEN ?>
                        
                    </div>
                </div>
            </div>
 
         </div>
    </div>
    
                      

</div>

<?php if (empty($PAGE->layout_options['nofooter'])) { ?>
    <div id="page-footer" class="clearfix">
        <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p>
        <?php
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        ?>
    </div>
    <?php } ?>
</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>