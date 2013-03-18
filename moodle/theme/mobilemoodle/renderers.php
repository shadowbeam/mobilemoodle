<?php

class theme_mobilemoodle_renderer extends plugin_renderer_base {
	


    /**
     * Produces the settings tree
     * Based upon blocks/settings/renderer.php
     * 
     * @param settings_navigation $navigation
     * @return string
     */
    public function settings_tree(settings_navigation $navigation) {
        return $this->navigation_node($navigation, array('class' => 'settings', 'data-theme' => 'c'), true);
    }
    
	/**
	 * Produces the navigation tree
	 * Based upon blocks/navigation/renderer.php
	 * 
	 * @param global_navigation $navigation
	 * @return string
	 */
	public function navigation_tree(global_navigation $navigation) {
		return $this->navigation_node($navigation, array('class' => 'nav', 'data-theme' => 'a'));
	}
    
	/**
	 * Protected method to render a navigaiton node
	 * Adapted from lib/outputrenderers.php
	 *	 
	 * @param navigation_node $node
	 * @param array $attrs
	 * @param bool for settings
	 * @return type
	 */
	protected function navigation_node(navigation_node $node, $attrs = array(), $settings = false) {
		$items = $node->children;
		
		$theme = $attrs['data-theme'];
		
		// exit if empty, we don't want an empty ul element
		if ($items->count() == 0) {
			return '';
		}

		// array of nested li elements
		$lis = array();
		foreach ($items as $item) {
		
			if (!$item->display) 
				continue;
			
			$key = (string)$item->text;
			
			/* Don't display these items in the navig. */
			if($key == 'Current course' || $key == 'My home' || $key == 'My private files')
				continue;
			

			$isbranch = ($item->children->count() > 0 || $item->nodetype == navigation_node::NODETYPE_BRANCH);
			$item->hideicon = true;


			$content = $this->output->render($item);
			$content .= $this->navigation_node($item, $attrs, $settings);
		
			
			if($content != '' && $content != 'General' ){
			
					if ($isbranch ) {
						$content = html_writer::tag('li', $content, array('data-role' => 'list-divider', 'data-theme' => 'b', 'class' => $key));
					} 
					 else {
						$content = html_writer::tag('li', $content, array('data-theme' => $theme, 'class' => $key));
					}
				
				
				$lis[] = $content;
			}
		}
		if (!count($lis)) {
			return '';
		}
		
		if(!$settings)
			$lis = array_reverse($lis); //reverse the array this ordering makes better sense.
		
		return implode("\n", $lis);
	}

}




include_once($CFG->dirroot . '/blocks/navigation/renderer.php');
  
class theme_mobilemoodle_block_navigation_renderer extends block_navigation_renderer {

	/**
	 * Produces the navigation tree
	 * 
	 * @param global_navigation $navigation
	 * @return string
	 */
	public function navigation_tree(global_navigation $navigation, $expansionlimit, array $options = array()) {
		$navigation->add_class('navigation_node');
		$content = $this->navigation_node(array($navigation), array('class'=>'block_tree list'), $expansionlimit, $options);
		
		
		if (isset($navigation->id) && !is_numeric($navigation->id) && !empty($content)) {
			$content = $this->output->box($content, 'block_tree_box', $navigation->id);
		}
		/* return a listview */
		return "<ul data-role='listview'>" . $content . "</ul>";
	}

	/**
	 * Produces a navigation node for the navigation tree
	 *
	 * @param array $items
	 * @param array $attrs
	 * @param int $expansionlimit
	 * @param array $options
	 * @param int $depth
	 * @return string
	 */
	protected function navigation_node($items, $attrs=array(), $expansionlimit=null, array $options = array(), $depth=1) {


		// exit if empty, we don't want an empty ul element
		if (count($items)==0) {
			return '';
		}

		// array of nested li elements
		$lis = array();
		foreach ($items as $item) {
			if (!$item->display && !$item->contains_active_node()) {
				continue;
			}
			
			
			$content = $this->render_navigation_node($item);
			$title = $item->get_title();
	   
			
			
			if($item->has_children()){
				//  $liattrs['data-role'] ='list-divider';
				  $liattrs['data-theme'] ='b';
				  $content .=  	$this->navigation_node($item->children, array(), $expansionlimit, $options, $depth+1);
			}

		 //   $content = html_writer::tag('p', $content, $divattr);
				 
			if (!empty($item->preceedwithhr) && $item->preceedwithhr===true) {
				$content = html_writer::empty_tag('hr') . $content;
			}
			$content = html_writer::tag('li', $content, $liattrs);
			$lis[] = $content;
		}

			if (count($lis)) {
				return implode("\n", $lis);
			} else {
				return '';
			}
	}
    
	/**
	 * Renders a navigation node object.
	 *
	 * @param navigation_node $item The navigation node to render.
	 * @return string HTML fragment
	 */
	protected function render_navigation_node(navigation_node $item) {
		$content = $item->get_content();
		$title = $item->get_title();
		
//            if ($item->icon instanceof renderable && !$item->hideicon) {
//                $icon = $this->render($item->icon);
//                $content = $icon.$content; // use CSS for spacing of icons
//            }
//            
//            
//            if ($item->helpbutton !== null) {
//                $content = trim($item->helpbutton).html_writer::tag('span', $content, array('class'=>'clearhelpbutton', 'tabindex'=>'0'));
//            }
		
		
		if ($content === '') {
			return '';
		}
		
		if ($item->action instanceof action_link) {
			$link = $item->action;
			if ($item->hidden) {
				$link->add_class('dimmed');
			}
			
			if (!empty($content)) {
				// Providing there is content we will use that for the link content.
				$link->text = $content;
			}
			
			$content = $this->render($link);
		} else if ($item->action instanceof moodle_url) {
			$attributes = array();
			if ($title !== '') {
				$attributes['title'] = $title;
			}
			if ($item->hidden) {
				$attributes['class'] = 'dimmed_text';
			}
			$content = html_writer::link($item->action, $content, $attributes);

		} else if (is_string($item->action) || empty($item->action)) {
			$attributes = array('tabindex'=>'0'); //add tab support to span but still maintain character stream sequence.
			if ($title !== '') {
				$attributes['title'] = $title;
			}
			if ($item->hidden) {
				$attributes['class'] = 'dimmed_text';
			}
			$content = html_writer::tag('span', $content, $attributes);
		}
		return $content;
	}
    
}


class theme_mobilemoodle_core_renderer extends core_renderer {

    /**
     * Renders a single button widget.
     *
     * This will return HTML to display a form containing a single button.
     *
     * @param single_button $button
     * @return string HTML fragment
     */

	protected function render_single_button(single_button $button) {
        $attributes = array('type'     => 'submit',
                            'value'    => $button->label,
                            'disabled' => $button->disabled ? 'disabled' : null,
                            'title'    => $button->tooltip,
							'data-theme' => 'b', /* give a theme */
							'data-role' => 'button'); /* make it a button */
						
        if ($button->actions) {
            $id = html_writer::random_id('single_button');
            $attributes['id'] = $id;
            foreach ($button->actions as $action) {
                $this->add_action_handler($action, $id);
            }
        }

        // first the input element
        $output = html_writer::empty_tag('input', $attributes);

        // then hidden fields
        $params = $button->url->params();
        if ($button->method === 'post') {
            $params['sesskey'] = sesskey();
        }
        foreach ($params as $var => $val) {
            $output .= html_writer::empty_tag('input', array('type' => 'hidden', 'name' => $var, 'value' => $val));
        }

        // then div wrapper for xhtml strictness
        $output = html_writer::tag('div', $output);

        // now the form itself around it
        if ($button->method === 'get') {
            $url = $button->url->out_omit_querystring(true); // url without params, the anchor part allowed
        } else {
            $url = $button->url->out_omit_querystring();     // url without params, the anchor part not allowed
        }
        if ($url === '') {
            $url = '#'; // there has to be always some action
        }
        $attributes = array('method' => $button->method,
                            'action' => $url,
                            'id'     => $button->formid);
        $output = html_writer::tag('form', $output, $attributes);

        // and finally one more wrapper with class
        return html_writer::tag('div', $output, array('class' => $button->class));
    }

	/**
     * Internal implementation of user image rendering.
     * Overriden to output font icons for default user pictures
     * @param user_picture $userpicture
     * @return string
     */
    protected function render_user_picture(user_picture $userpicture) {
        global $CFG, $DB;

        $user = $userpicture->user;

        if ($userpicture->alttext) {
            if (!empty($user->imagealt)) {
                $alt = $user->imagealt;
            } else {
                $alt = get_string('pictureof', '', fullname($user));
            }
        } else {
            $alt = '';
        }

        if (empty($userpicture->size)) {
            $size = 35;
        } else if ($userpicture->size === true or $userpicture->size == 1) {
            $size = 100;
        } else {
            $size = $userpicture->size;
        }

        $class = $userpicture->class;

		/* if no picture, the default is a div which then gets caught by css to create icon*/
        if ($user->picture == 0) {
            $class .= ' defaultuserpic';     
            $output = html_writer::tag('div', null, array('class'=>$class));    
            
        }else{
	        $src = $userpicture->get_url($this->page, $this);
	
	        $attributes = array('src'=>$src, 'alt'=>$alt, 'title'=>$alt, 'class'=>$class, 'width'=>$size, 'height'=>$size);
	
	        // get the image html output fisrt
	        $output = html_writer::empty_tag('img', $attributes);
        }

        // then wrap it in link if needed
        if (!$userpicture->link) {
            return $output;
        }

        if (empty($userpicture->courseid)) {
            $courseid = $this->page->course->id;
        } else {
            $courseid = $userpicture->courseid;
        }

        if ($courseid == SITEID) {
            $url = new moodle_url('/user/profile.php', array('id' => $user->id));
        } else {
            $url = new moodle_url('/user/view.php', array('id' => $user->id, 'course' => $courseid));
        }

        $attributes = array('href'=>$url);
        if ($user->picture == 0) {
        	$attributes['style'] = 'text-decoration: none';
        }
        

        if ($userpicture->popup) {
            $id = html_writer::random_id('userpicture');
            $attributes['id'] = $id;
            $this->add_action_handler(new popup_action('click', $url), $id);
        }

        return html_writer::tag('a', $output, $attributes);
    }

 
    /**
     * Implementation of user image rendering.
     * Recreated to imageless version
     *
     * @param help_icon $helpicon A help icon instance
     * @return string HTML fragment
     */
    protected function render_help_icon(help_icon $helpicon) {
        global $CFG;

        // first get the help image icon
        //$src = $this->pix_url('help');

        $title = get_string($helpicon->identifier, $helpicon->component);

        if (empty($helpicon->linktext)) {
            $alt = get_string('helpprefix2', '', trim($title, ". \t"));
        } else {
            $alt = get_string('helpwiththis');
        }

       // $attributes = array('src'=>$src, 'alt'=>$alt, 'class'=>'ICONHELP');
      //  $output = html_writer::empty_tag('img', $attributes);
		$output = "?";
        // add the link text if given
        if (!empty($helpicon->linktext)) {
            // the spacing has to be done through CSS
            $output .= $helpicon->linktext;
        }

        // now create the link around it - we need https on loginhttps pages
        $url = new moodle_url($CFG->httpswwwroot.'/help.php', array('component' => $helpicon->component, 'identifier' => $helpicon->identifier, 'lang'=>current_language()));

        // note: this title is displayed only if JS is disabled, otherwise the link will have the new ajax tooltip
        $title = get_string('helpprefix2', '', trim($title, ". \t"));

        $attributes = array('href'=>$url, 'title'=>$title, 'class' => 'tooltip');
		
		$id = html_writer::random_id('helpicon');
       /* issue with 1.3 */
	   // $output = html_writer::tag('a', $output, array('class' => 'helpicon', 'id' => $id, 'rel' => 'notexternal', 'data-role'=> 'button', 'data-rel' => 'dialog', 'data-inline' => 'true', 'data-mini' => 'true', 'href'=>'https://devweb2012.cis.strath.ac.uk/~xvb09137/moodle/', 'title'=>$title));
	    $output = html_writer::tag('a', $output, array('class' => 'helpicon', 'id' => $id,  'data-role'=> 'button', 'data-inline' => 'true', 'data-transition'=>'pop', 'data-mini' => 'true', 'href'=>$url, 'title'=>$title));


        $this->page->requires->js_init_call('M.util.help_icon.setup');
        $this->page->requires->string_for_js('close', 'form');

        // and finally span
      //  return html_writer::tag('span', $output, array('class' => 'helplink', );
        return $output;
    }
 
 
  /**
   * Override the need to have body content
   * Commented out the if decision to throw error
   **/
    public function header() {
        global $USER, $CFG;

        if (session_is_loggedinas()) {
            $this->page->add_body_class('userloggedinas');
        }

        $this->page->set_state(moodle_page::STATE_PRINTING_HEADER);

        // Find the appropriate page layout file, based on $this->page->pagelayout.
        $layoutfile = $this->page->theme->layout_file($this->page->pagelayout);
        // Render the layout using the layout file.
        $rendered = $this->render_page_layout($layoutfile);

        // Slice the rendered output into header and footer.
        $cutpos = strpos($rendered, $this->unique_main_content_token);
        if ($cutpos === false) {
            $cutpos = strpos($rendered, self::MAIN_CONTENT_TOKEN);
            $token = self::MAIN_CONTENT_TOKEN;
        } else {
            $token = $this->unique_main_content_token;
        }

        if ($cutpos === false) {
            /*throw new coding_exception('page layout file ' . $layoutfile . ' does not contain the main content placeholder, please include "<?php echo $OUTPUT->main_content() ?>" in theme layout file.');*/
        }
        $header = substr($rendered, 0, $cutpos);
        $footer = substr($rendered, $cutpos + strlen($token));

        if (empty($this->contenttype)) {
            debugging('The page layout file did not call $OUTPUT->doctype()');
            $header = $this->doctype() . $header;
        }

        // If this theme version is below 2.4 release and this is a course view page
        if ((!isset($this->page->theme->settings->version) || $this->page->theme->settings->version < 2012101500) &&
                $this->page->pagelayout === 'course' && $this->page->url->compare(new moodle_url('/course/view.php'), URL_MATCH_BASE)) {
            // check if course content header/footer have not been output during render of theme layout
            $coursecontentheader = $this->course_content_header(true);
            $coursecontentfooter = $this->course_content_footer(true);
            if (!empty($coursecontentheader)) {
                // display debug message and add header and footer right above and below main content
                // Please note that course header and footer (to be displayed above and below the whole page)
                // are not displayed in this case at all.
                // Besides the content header and footer are not displayed on any other course page
                debugging('The current theme is not optimised for 2.4, the course-specific header and footer defined in course format will not be output', DEBUG_DEVELOPER);
                $header .= $coursecontentheader;
                $footer = $coursecontentfooter. $footer;
            }
        }

        send_headers($this->contenttype, $this->page->cacheable);

        $this->opencontainers->push('header/footer', $footer);
        $this->page->set_state(moodle_page::STATE_IN_BODY);

        return $header . $this->skip_link_target('maincontent');
    }

    
   
	/**
     * Return the standard string that says whether you are logged in (and switched
     * roles/logged in as another user). 
     * 
     * Added the profile picture and created a button 
     * 
     * @param bool $withlinks if false, then don't include any links in the HTML produced.
     * If not set, the default is the nologinlinks option from the theme config.php file,
     * and if that is not set, then links are included.
     * @return string HTML fragment.
     */
    public function login_info($withlinks = null) {
        global $USER, $CFG, $DB, $SESSION;

        if (during_initial_install()) {
            return '';
        }

        if (is_null($withlinks)) {
            $withlinks = empty($this->page->layout_options['nologinlinks']);
        }

        $loginpage = ((string)$this->page->url === get_login_url());
        
        $course = $this->page->course;
        
        if (session_is_loggedinas()) {
            $realuser = session_get_realuser();
            $fullname = fullname($realuser, true);
 
     
                $realuserinfo = " [$fullname] ";
            
        } else {
            $realuserinfo = '';
        }

        $loginurl = get_login_url();

        if (empty($course->id)) {
            // $course->id is not defined during installation
            return '';
        } else if (isloggedin()) {
            $context = context_course::instance($course->id);

            $fullname = fullname($USER, true);
            // Since Moodle 2.0 this link always goes to the public profile page (not the course profile page)
            if ($withlinks) {
                $username = "<a class='username' href=\"$CFG->wwwroot/user/profile.php?id=$USER->id\">$fullname</a>";
            } else {
                $username = $fullname;
            }
            if (is_mnet_remote_user($USER) and $idprovider = $DB->get_record('mnet_host', array('id'=>$USER->mnethostid))) {
                if ($withlinks) {
                    $username .= " from <a href=\"{$idprovider->wwwroot}\">{$idprovider->name}</a>";
                } else {
                    $username .= " from {$idprovider->name}";
                }
            } 

            	
				$userpic = new user_picture($USER, array('size'=>25));
                $loggedinas =  $username;

                 $loggedinas = '<div class="user-info ui-btn-right">' . $this->render($userpic) .$loggedinas.'</div>';
           
            
        } else {
//            $loggedinas = get_string('loggedinnot', 'moodle');
            if (!$loginpage && $withlinks) {
                $loggedinas .= " <a data-role='button' data-theme='b' class='ui-btn-right' data-inline='true' href=\"$loginurl\">".get_string('login').'</a>';
            }
        }      

        if (isset($SESSION->justloggedin)) {
            unset($SESSION->justloggedin);
            if (!empty($CFG->displayloginfailures)) {
                if (!isguestuser()) {
                    if ($count = count_login_failures($CFG->displayloginfailures, $USER->username, $USER->lastlogin)) {
                        $loggedinas .= '&nbsp;<div class="loginfailures">';
                        if (empty($count->accounts)) {
                            $loggedinas .= get_string('failedloginattempts', '', $count);
                        } else {
                            $loggedinas .= get_string('failedloginattemptsall', '', $count);
                        }
                        if (file_exists("$CFG->dirroot/report/log/index.php") and has_capability('report/log:view', context_system::instance())) {
                            $loggedinas .= ' (<a href="'.$CFG->wwwroot.'/report/log/index.php'.
                                                 '?chooselog=1&amp;id=1&amp;modid=site_errors">'.get_string('logs').'</a>)';
                        }
                        $loggedinas .= '</div>';
                    }
                }
            }
        }

        return $loggedinas;
    } 
    
    
    /**
     * No movement controls for blocks
     */
    public function block_controls($controls) {
            return '';
    }
    
    /**
     * Block Contents become collapsible
     */
    
      public function block(block_contents $bc, $region) {
		$bc = clone($bc); // Avoid messing up the object passed in.
		
		$attributes = $bc->attributes;
		if($attributes['class'] == 'block_course_overview  block')
			$attributes['data-role'] = $attributes['class'];
		else
			$attributes['data-role'] = 'collapsible';
		
		
		$attributes['data-content-theme'] = 'a';
		$attributes['data-theme'] = 'a';
		
		$bc->collapsible = block_contents::NOT_HIDEABLE;
			
		$output .= html_writer::start_tag('div', $attributes );
		
		$output.= "<h3>$bc->title</h3>";
	
		
		$output .= $this->block_content($bc);

		$output .= html_writer::end_tag('div');

		$output .= $this->block_annotation($bc);
	
		$this->init_block_hider_js($bc);
		return $output;
    }
               
    
	/*
	 * Return the navbar content so that it can be echoed out by the layout
	 * 
	 * Hide the image icons
	 * @return string XHTML navbar
	 */
	public function navbar() {
		$items = $this->page->navbar->get_items();

		$htmlblocks = array();
		// Iterate the navarray and display each node
		$itemcount = count($items);
		$separator = get_separator();
		for ($i=0;$i < $itemcount;$i++) {
			$item = $items[$i];
			$item->hideicon = false; //make sure image icons are hidden
			if ($i===0) {
				$content = html_writer::tag('li', $this->render($item));
			} else {
				$content = html_writer::tag('li', $separator.$this->render($item));
			}
			$htmlblocks[] = $content;
		}

		//accessibility: heading for navbar list  (MDL-20446)
		$navbarcontent = html_writer::tag('span', get_string('pagepath'), array('class'=>'accesshide'));
		$navbarcontent .= html_writer::tag('ul', join('', $htmlblocks), array('role'=>'navigation'));
		// XHTML
		return $navbarcontent;
	}
        
        
	/**
	* Creates a grade button for the current course
	* @author: Allan Watson 2013
	* @return string
	*/

	public function grades_link() {
		global $USER, $CFG;
		$context = $this->page->context;

		$coursecontext = $context->get_course_context();

		$categoryid = null;

		if ($coursecontext) { 
			$courseid = $coursecontext->instanceid;
		}
		$userid = $USER->id;

		$link = "$CFG->wwwroot/course/user.php?mode=grade&id=$courseid&user=$userid";

		return $link;

	} 
  
	  
	 /**
      * Creates a grading button for the current course
	 * @author: Allan Watson 2013
      * @return string
      */
      
      public function grader_button() {
      global $USER, $CFG;
   		$context = $this->page->context;
   		
      	$coursecontext = $context->get_course_context();
      	
      	$categoryid = null;
      	
      	if ($coursecontext) { 
      		$courseid = $coursecontext->instanceid;
      	}
		
      	$link = "$CFG->wwwroot/grade/report/grader/index.php?id=$courseid";
      	
      	return '<a id="grader-btn" data-role="button"  data-theme="c" data-inline="false" href="' . $link. '"><i class="icon-star left"></i>Marking</a>';
      
      } 
	  

  
        
	/**
	 * Generates Settings Button for menu
	 * @author: Allan Watson 2013
	 */
     
     public function settings_button() {
     
     	$urlsettings = new moodle_url($this->page->url, array('mobilemoodle_settings' => 'true'));
     	 
     	return '<a id="settings-btn" data-role="button"  data-theme="b" data-inline="false" href="' . $urlsettings->out(). '">Settings<i class="ui-icon-gear"></i></a>';
		
     }
     
     /**
	 * Generates Blocks Button for menu
	 */
     
     public function blocks_button() {
     
     	$url = new moodle_url($this->page->url, array('mobilemoodle_blocks' => 'true'));
     	 
     	return '<a id="settings-btn" data-role="button"  data-theme="b" data-inline="false" href="' . $url->out(). '">Blocks<i class="icon-grid"></i></a>';
     	
     }
	 
	 /**
	  * Create course settings button 
	  * @author: Allan Watson 2013
	  */
	   
	 public function course_settings_button() {
	 
		global $USER, $CFG;
   		$context = $this->page->context;
      	$coursecontext = $context->get_course_context();
      	$courseid = $coursecontext->instanceid;
      	
	
     	$urlsettings = "$CFG->wwwroot/course/edit.php?id=$courseid"; 
     	 
     	return '<a id="settings-btn" data-role="button" data-inline="false" data-theme="c" href="' . $urlsettings . '"><i class="left ui-icon-gear"></i>Course Settings</a>';
		
     }


	      
		
	 /**
     * Creates a link back to the upper page in the hierarchy
     *
     * @return string
     */
    public function back_button() {

		return "<a id='back-button' data-direction='reverse' data-rel='back' data-transition='slide'  class='icon-arrow-left mybtn ui-btn-left'  href='$CFG->httpswwwroot'></a>"; 
		
    }
	
	
	/**
	 * Renders the blocks for a block region in the page
	 *
	 * Removed move controls
	 * @param type $region
	 * @return string
	 */
	public function blocks_for_region($region) {
		$blockcontents = $this->page->blocks->get_content_for_region($region, $this);

		$output = '';
		foreach ($blockcontents as $bc) {
			if ($bc instanceof block_contents) {
				// We don't want to print navigation and settings blocks here.
				if ($bc->attributes['class'] != 'block_settings  block' && $bc->attributes['class'] != 'block_navigation  block') {
					$output .= $this->block($bc, $region);
				}
			}
			else {
				throw new coding_exception('Unexpected type of thing (' . get_class($bc) . ') found in list of block contents.');
			}
		}


		return $output;
	}
	
	
}

include_once($CFG->dirroot . '/blocks/course_overview/renderer.php');


/**
 * Course_overview block rendrer
 *
 * @copyright  2012 Adam Olley <adam.olley@netspot.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * 
 * @editted	   2013 Allan Watson
 */
class theme_mobilemoodle_block_course_overview_renderer extends block_course_overview_renderer {

    /**
     * Construct contents of course_overview block
     *
     * @param array $courses list of courses in sorted order
     * @param array $overviews list of course overviews
     * @return string html to be displayed in course_overview block
     */
    public function course_overview($courses, $overviews) {
        $html = '';
        $config = get_config('block_course_overview');

        $html .= html_writer::start_tag('div', array('id' => 'course_list'));
        $courseordernumber = 0;
        $maxcourses = count($courses);
        // Intialize string/icon etc if user is editing.
        $url = null;
        $moveicon = null;
        $moveup[] = null;
        $movedown[] = null;
		
		/*  user can't edit */

        foreach ($courses as $key => $course) {
					
            $html .= html_writer::start_tag('div', array('class' => 'coursebox', 'id'=> "course-{$course->id}", 'data-role'=> 'controlgroup'));
			
			
          //  $html .= html_writer::start_tag('div', array('class' => 'course_title'));
			
		/* removed ability to shift courses */

		
		$attributes = array('title' => s($course->fullname), 'data-role' => 'button', 'data-theme' => 'b', 'data-icon'=>'arrow-r', 'data-iconpos'=>'right');
            if ($course->id > 0) {
                $link = html_writer::link(new moodle_url('/course/view.php', array('id' => $course->id)), format_string($course->shortname, true, $course->id), $attributes); //becomes a button
                $html .= $link;
            } else {
                $html .= $this->output->heading(html_writer::link(
                    new moodle_url('/auth/mnet/jump.php', array('hostid' => $course->hostid, 'wantsurl' => '/course/view.php?id='.$course->remoteid)),
                    format_string($course->shortname, true), $attributes) . ' (' . format_string($course->hostname) . ')', 2, 'title');
            }
           // $html .= html_writer::end_tag('div');

            if (!empty($config->showchildren) && ($course->id > 0)) {
                // List children here.
                if ($children = block_course_overview_get_child_shortnames($course->id)) {
                    $html .= html_writer::tag('span', $children, array('class' => 'coursechildren'));
                }
            }

            if (isset($overviews[$course->id])) {
                $html .= $this->activity_display($course->id, $overviews[$course->id]);
            }

        $html .= html_writer::end_tag('div');
            $courseordernumber++;
        }
        $html .= html_writer::end_tag('div');

        return $html;
    }
	
	 /**
     * Coustuct activities overview for a course
     * No need for expanded overviews, keep blocks simple
	 * Added a font icon  
	 *
     * @param int $cid course id
     * @param array $overview overview of activities in course
     * @return string html of activities overview
	 * 
	 * @editted 2013 Allan Watson
     */
    protected function activity_display($cid, $overview) {
       // $output = html_writer::start_tag('div', array('class' => 'activity_info'));
        foreach (array_keys($overview) as $module) {
           // $output .= html_writer::start_tag('div', array('class' => 'activity_overview'));
            $url = new moodle_url("/mod/$module/index.php", array('id' => $cid));
            $modulename = get_string('modulename', $module);
			
		//	$linktext = $this->output->pix_icon('icon', $modulename, 'mod_'.$module, array('class'=>'iconlarge'));
			
			$linktext = "<i class='icon-spam left'></i>"; //replace image with info icon
			if (get_string_manager()->string_exists("activityoverview", $module)) {
                $linktext .= get_string("activityoverview", $module);
            } else {
                $linktext .= get_string("activityoverview", 'block_course_overview', $modulename);
            }
			
			
			
            $icontext = html_writer::link($url, $linktext, array('data-role' => 'button', 'class'=> 'wrap'));
			

            // Add collapsible region with overview text in it.
            //$output .= $this->collapsible_region($overview[$module], '', 'region_'.$cid.'_'.$module, $icontext, '', true);

			$output .= $icontext; //display the message you have notifications.
			
           // $output .= html_writer::end_tag('div');
        }
      //  $output .= html_writer::end_tag('div');
        return $output;
    }
	
	
}
	
	
include_once($CFG->dirroot . '/course/renderer.php');

class theme_mobilemoodle_core_course_renderer extends core_course_renderer {
	
	/* Remove the ability to add activities to courses*/
    public function course_modchooser($modules, $course) {
		return '';
	}
}
