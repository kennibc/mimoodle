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
 * mimoodle theme with the underlying Bootstrap theme.
 *
 * @package    theme
 * @subpackage mimoodle
 * @author     Julian (@moodleman) Ridden
 * @author     Based on code originally written by G J Barnard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
 class theme_mimoodle_core_renderer extends theme_bootstrapbase_core_renderer {
		
    protected function render_custom_menu(custom_menu $menu) {
    	/*
    	* This code replaces adds the current enrolled
    	* courses to the custommenu.
    	*/
    
    	$hasdisplaymycourses = (empty($this->page->theme->settings->displaymycourses)) ? false : $this->page->theme->settings->displaymycourses;
        if (isloggedin() && !isguestuser() && $hasdisplaymycourses) {
        	$mycoursetitle = $this->page->theme->settings->mycoursetitle;
            if ($mycoursetitle == 'module') {
				$branchtitle = get_string('mymodules', 'theme_mimoodle');
			} else if ($mycoursetitle == 'unit') {
				$branchtitle = get_string('myunits', 'theme_mimoodle');
			} else if ($mycoursetitle == 'class') {
				$branchtitle = get_string('myclasses', 'theme_mimoodle');
			} else {
				$branchtitle = get_string('mycourses', 'theme_mimoodle');
			}
			$branchlabel = '<i class="fa fa-briefcase"></i>'.$branchtitle;
            $branchurl   = new moodle_url('/my/index.php');
            $branchsort  = 10000;
 
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
 			if ($courses = enrol_get_my_courses(NULL, 'fullname ASC')) {
 				foreach ($courses as $course) {
 					if ($course->visible){
 						$branch->add(format_string($course->fullname), new moodle_url('/course/view.php?id='.$course->id), format_string($course->shortname));
 					}
 				}
 			} else {
                $noenrolments = get_string('noenrolments', 'theme_mimoodle');
 				$branch->add('<em>'.$noenrolments.'</em>', new moodle_url('/'), $noenrolments);
 			}
            
        }
        
        /*
    	* This code replaces adds the My Dashboard
    	* functionality to the custommenu.
    	*/
        $hasdisplaymydashboard = (empty($this->page->theme->settings->displaymydashboard)) ? false : $this->page->theme->settings->displaymydashboard;
        if (isloggedin() && !isguestuser() && $hasdisplaymydashboard) {
            $branchlabel = '<i class="fa fa-dashboard"></i>'.get_string('mydashboard', 'theme_mimoodle');
            $branchurl   = new moodle_url('/my/index.php');
            $branchtitle = get_string('mydashboard', 'theme_mimoodle');
            $branchsort  = 10000;
 
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);
 			$branch->add(get_string('profile').'</em>',new moodle_url('/user/profile.php'),get_string('profile'));
 			$branch->add(get_string('pluginname', 'block_calendar_month').'</em>',new moodle_url('/calendar/view.php'),get_string('pluginname', 'block_calendar_month'));
 			$branch->add(get_string('pluginname', 'block_messages').'</em>',new moodle_url('/message/index.php'),get_string('pluginname', 'block_messages'));
 			$branch->add(get_string('badges').'</em>',new moodle_url('/badges/mybadges.php'),get_string('badges'));
 			$branch->add(get_string('privatefiles', 'block_private_files').'</em>',new moodle_url('/user/files.php'),get_string('privatefiles', 'block_private_files'));
 			$branch->add(get_string('logout').'</em>',new moodle_url('/login/logout.php'),get_string('logout'));    
        }

        return parent::render_custom_menu($menu);
	}
}
