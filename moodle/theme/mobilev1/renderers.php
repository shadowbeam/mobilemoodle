<?php

class theme_mobilev1_renderer extends plugin_renderer_base {

    /**
     * Produces the settings tree
     *
     * @param settings_navigation $navigation
     * @return string
     */
    public function settings_tree(settings_navigation $navigation) {
        return $this->navigation_node($navigation, array('class' => 'settings', 'data-theme' => 'c'));

     
    }
    
        /**
         * Produces the navigation tree
         *
         * @param global_navigation $navigation
         * @return string
         */
        public function navigation_tree(global_navigation $navigation) {
            return $this->navigation_node($navigation, array('class' => 'nav', 'data-theme' => 'a'));
        }
    
        /**
         * Protected method to render a navigaiton node
         *
         * @param navigation_node $node
         * @param array $attrs
         * @return type
         */
        protected function navigation_node(navigation_node $node, $attrs = array()) {
            $items = $node->children;
            
            $theme = $attrs['data-theme'];
            
            // exit if empty, we don't want an empty ul element
            if ($items->count() == 0) {
                return '';
            }
    
            // array of nested li elements
            $lis = array();
            foreach ($items as $item) {
                if (!$item->display) {
                    continue;
                }
    
                $isbranch = ($item->children->count() > 0 || $item->nodetype == navigation_node::NODETYPE_BRANCH);
                $item->hideicon = true;
    
                $content = $this->output->render($item);
                $content .= $this->navigation_node($item, $attrs);
                
                
    			if($content != '' && $content != 'General'){
	                if ($isbranch && !(is_string($item->action) || empty($item->action))) {
	                    $content = html_writer::tag('li', $content, array('data-role' => 'list-divider', 'data-theme' => 'b', 'class' => (string)$item->key));
	                } else if($isbranch) {
	                    $content = html_writer::tag('li', $content, array('data-role' => 'list-divider', 'data-theme' => 'b'));
	                } else {
	                    $content = html_writer::tag('li', $content, array('data-theme' => $theme, 'class' => (string)$item->text));
	                }
	                $lis[] = $content;
	            }
            }
            if (!count($lis)) {
                return '';
            }
            return implode("\n", $lis);
        }
    
}




include_once($CFG->dirroot . '/blocks/navigation/renderer.php');

  
class theme_mobilev1_block_navigation_renderer extends block_navigation_renderer {


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

class theme_mobilev1_core_renderer extends core_renderer {
 
   
    
/**
     * Return the standard string that says whether you are logged in (and switched
     * roles/logged in as another user).
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
                $username = "<a href=\"$CFG->wwwroot/user/profile.php?id=$USER->id\">$fullname</a>";
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
            if (isguestuser()) {
              //  $loggedinas = $realuserinfo.get_string('loggedinasguest');
                if (!$loginpage && $withlinks) {
                    $loggedinas .= " <a href=\"$loginurl\">".get_string('login').'</a>';
                }
            } else if (is_role_switched($course->id)) { // Has switched roles
                $rolename = '';
                if ($role = $DB->get_record('role', array('id'=>$USER->access['rsw'][$context->path]))) {
                    $rolename = ': '.format_string($role->name);
                }
                $loggedinas = get_string('loggedinas', 'moodle', $username).$rolename;
                if ($withlinks) {
                    $loggedinas .= " (<a href=\"$CFG->wwwroot/course/view.php?id=$course->id&amp;switchrole=0&amp;sesskey=".sesskey()."\">".get_string('switchrolereturn').'</a>)';
                }
            } else {
            	
				$userpic = new user_picture($USER, array('size'=>25));
                $loggedinas =  $username;
                //TODO add a profile picture icon 
                 $loggedinas = '<div class="user-info ui-btn-right">' . $this->render($userpic) .$loggedinas.'</div>';
           
            }
        } else {
//            $loggedinas = get_string('loggedinnot', 'moodle');
            if (!$loginpage && $withlinks) {
                $loggedinas .= " <a data-role='button' class='ui-btn-right' data-inline='true' href=\"$loginurl\">".get_string('login').'</a>';
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
     * No controls
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
            $attributes['data-role'] = 'collapsible';
            
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
                $item->hideicon = false;
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
         * Generates Settings Button
         */
     
     public function settings_button() {
     
     	$urlsettings = new moodle_url($this->page->url, array('mobilev1_settings' => 'true'));
     	 $urlsettings->out();
     	 
     	return '<a data-role="button" data-theme="b" data-inline="false" href="' . $urlsettings->out(). '">Settings<i class="icon-cog"></i></a>';
         			
     			
     }
     
		
	 /**
     * Creates a link back to the upper page in the hierarchy
     *
     * @return string
     */
    public function back_button() {
 $items = $this->page->navbar->get_items();

        // Iterate the navarray and remove unneccessary items
        $itemcount = count($items);
	
        for ($i = 0; $i < $itemcount; $i++) {
            $item = $items[$i];
			
			$item->hideicon = true;
            if (!empty($item->action)) {
				$htmlblocks[] = $item;
            } 
        }
		
		$last = count($htmlblocks);
		
		if($last >1){
			$content = $htmlblocks[$last-2];
			return "<a id='back-button' data-direction='reverse' data-transition='slide'  class='icon-arrow-left mybtn ui-btn-left'  href='" . (string)$content->action  . "'></a>";
		}
		else
			return ''; 
		
		
		//return $content;
        
		
		/*
			if($itemcount > 1){
				$item = $items[$itemcount - 2];
				$navbarcontent =  $this->render($item);
			}
			else{
				$navbarcontent = $itemcount;
			}

		$navbarcontent .= join('', $htmlblocks);
        // XHTML
        return $navbarcontent;        
*/
    }
}

