<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Configuration for Moodle's base theme.
 *
 * This theme is special, and implements a minimalist theme with only
 * basic layout. It is intended as a base for other themes to build upon.
 * It is not recommend to actually choose this theme for production sites!
 *
 * DO NOT COPY THIS TO START NEW THEMES!
 * Start with another theme, like "standard".
 *
 * For full information about creating Moodle themes, see:
 *  http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   mobilemoodle
 * @copyright 2013 Allan Watson
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$THEME->name = 'mobilemoodle';

$THEME->parents = array('base');

$THEME->sheets = array(
    'pagelayout', 
	'jqrmstructure',
	'jqrmtheme',
    'login',
    'frontpage',
    'profile',
	'forums',
	'font',
	'course',
	'messages',
	'cal'
   
    );
    
    
    // Exclude parent sheets
    $THEME->parents_exclude_sheets = array(
        'base' => array(
            'pagelayout',
            'admin',
            'blocks',
            'calendar',
            'core',
            'filemanager',
            'course',
            'grade',
            'question',
            'dock',
            'message',
            'user',
            'editor',
       
        )
    );

	//disable dock
$THEME->enable_dock = false;

$THEME->rendererfactory = 'theme_overridden_renderer_factory';

$THEME->editor_sheets = array('editor');

$THEME->layouts = array(
    'base' => array(
        'file' => 'standard.php',
        'regions' => array(),
    ),
    'standard' => array(
        'file' => 'standard.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post',
    ),
    'course' => array(
        'file' => 'standard.php',
        'regions' => array('side-pre', 'side-post'),
    ),
    'coursecategory' => array(
        'file' => 'standard.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post',
    ),
    'incourse' => array(
        'file' => 'standard.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post',
    ),
    'frontpage' => array(
        'file' => 'standard.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post',
    ),
    'admin' => array(
        'file' => 'standard.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    'mydashboard' => array(
        'file' => 'standard.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post',
        'options' => array('langmenu'=>false),
    ),
    'mypublic' => array(
        'file' => 'standard.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-post',
    ),
    'login' => array(
        'file' => 'standard.php',
        'regions' => array(),
        'options' => array('langmenu'=>false),
    ),
    'popup' => array(
        'file' => 'popup.php',
        'regions' => array(),
        'options' => array('nofooter'=>false),
    ),
    'frametop' => array(
        'file' => 'standard.php',
        'regions' => array(),
        'options' => array('nofooter'=>false),
    ),
    'maintenance' => array(
        'file' => 'standard.php',
        'regions' => array(),
        'options' => array('nofooter'=>false, 'nonavbar'=>true),
    ),

    'report' => array(
        'file' => 'standard.php',
        'regions' => array()
	),
);

$THEME->csspostprocess = 'mytheme_csspostprocess';


// Add the required JavaScript to the page
$THEME->javascripts = array(
    'jquery',
	'mdrnzr',
	'mobilejs',
	'jquery.mobile-1.3.0.min',
	'help'
);
