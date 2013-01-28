<?php
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

echo $OUTPUT->doctype(); ?>

<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $PAGE->title ?></title>
    <?php echo $OUTPUT->standard_head_html() ?>
</head>


<body class="<?php p($PAGE->bodyclasses); ?>">

<?php echo $OUTPUT->standard_top_of_body_html() ?>


<div id="<?php p($PAGE->bodyid); ?>" data-role="page" class="general">
	
	<!--  header -->
    <div id="page-header" data-role="header" position="fixed">
    
        <?php if ($PAGE->heading) { ?>
           
            <div class="headernav">    
                <a class="ui-btn-left" data-icon="home" href="<?php p($CFG->wwwroot) ?>" data-iconpos="notext" data-ajax="false"><?php p(get_string('home')); ?></a>
            </div>
            
            <div class="headerprofile"><?php
                echo $OUTPUT->login_info();
            
                echo $PAGE->headingmenu
            ?></div>

             <h1 class="headermain"><?php echo $PAGE->heading ?></h1>
        <?php } ?>
        
    </div>


<div id="page-body" data-role="content">
    <div id="region-main-box">
            <div id="region-main-wrap">
                <div id="region-main">
                    <div class="region-content">
                        <?php echo core_renderer::MAIN_CONTENT_TOKEN ?>
                    </div>
                </div>
            </div>
 
         </div>
    </div>
    
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