<?php



 /*
  * theme_THEMENAME_core_renderer	
  * core_renderer : This is the renderer that we are overriding.
  *
  */
  

  include_once($CFG->dirroot . '/course/renderer.php');

class theme_mobilev1_core_course_renderer extends core_course_renderer {
/*
    public function course_category_tree(array $structure) {

        echo 'It works!';

    }
	

	
	public function course_info_box(stdClass $course){
		echo 'It works!';
	}
*/
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
            if ($withlinks) {
                $realuserinfo = " [<a href=\"$CFG->wwwroot/course/loginas.php?id=$course->id&amp;sesskey=".sesskey()."\">$fullname</a>] ";
            } else {
                $realuserinfo = " [$fullname] ";
            }
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
            	
				$userpic = new user_picture($USER);
            	
                $loggedinas =  $username;
                //TODO add a profile picture icon
           
            }
        } else {
//            $loggedinas = get_string('loggedinnot', 'moodle');
            if (!$loginpage && $withlinks) {
                $loggedinas .= " <a data-role='button' data-inline='true' href=\"$loginurl\">".get_string('login').'</a>';
            }
        }

        $loggedinas = '<div class="logininfo ui-btn-right">'.$loggedinas.'</div>';

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
     * 
     */
    public function block_controls($controls) {
            return '';

    }
    
    
      public function block(block_contents $bc, $region) {
            $bc = clone($bc); // Avoid messing up the object passed in.
            
            $bc->collapsible = block_contents::NOT_HIDEABLE;
            
            //$skiptitle = strip_tags($bc->title);
//            if ($bc->blockinstanceid && !empty($skiptitle)) {
//                $bc->attributes['aria-labelledby'] = 'instance-'.$bc->blockinstanceid.'-header';
//            } else if (!empty($bc->arialabel)) {
//                $bc->attributes['aria-label'] = $bc->arialabel;
//            }
//            if ($bc->collapsible == block_contents::HIDDEN) {
//                $bc->add_class('hidden');
//            }
//            if (!empty($bc->controls)) {
//                $bc->add_class('block_with_controls');
//            }
    
//    
//            if (empty($skiptitle)) {
//                $output = '';
//                $skipdest = '';
//            } else {
//                $output = html_writer::tag('a', get_string('skipa', 'access', $skiptitle), array('href' => '#sb-' . $bc->skipid, 'class' => 'skip-block'));
//                $skipdest = html_writer::tag('span', '', array('id' => 'sb-' . $bc->skipid, 'class' => 'skip-block-to'));
//            }

    
            $output .= html_writer::start_tag('div', $bc->attributes);
		
            $output .= $this->block_header($bc);
			
            $output .= $this->block_content($bc);
    
            $output .= html_writer::end_tag('div');
    
            $output .= $this->block_annotation($bc);
    
  //          $output .= $skipdest;
    
            $this->init_block_hider_js($bc);
            return $output;
        }
    
	
	
 
}

