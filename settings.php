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
// GNU General Public License for mimoodle details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme mimoodle temp.
 *
 * Each setting that is defined in the parent theme Clean should be
 * defined here too, and use the exact same config name. The reason
 * is that theme_mimoodle does not define any layout files to re-use the
 * ones from theme_clean. But as those layout files use the function
 * {@link theme_clean_get_html_for_temp} that belong to Clean,
 * we have to make sure it works as expected by having the same temp
 * in our theme.
 *
 * @see        theme_clean_get_html_for_temp
 * @package    theme_mimoodle
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$settings = null;

defined('MOODLE_INTERNAL') || die;


	$ADMIN->add('themes', new admin_category('theme_mimoodle', 'Michigan Moodle'));

	// "geneictemp" settingpage
    $temp = new admin_settingpage('theme_mimoodle_generic',  get_string('geneicsettings', 'theme_mimoodle'));
	// Font Selector.
    $name = 'theme_mimoodle/fontselect';
    $title = get_string('fontselect' , 'theme_mimoodle');
    $description = get_string('fontselectdesc', 'theme_mimoodle');
    $default = '1';
    $choices = array(
    	'1'=>'Oswald & PT Sans', 
    	'2'=>'Lobster & Cabin', 
    	'3'=>'Raleway & Goudy', 
    	'4'=>'Allerta & Crimson Text', 
    	'5'=>'Arvo & PT Sans',
    	'6'=>'Dancing Script & Josefin Sans',
    	'7'=>'Allan & Cardo',
    	'8'=>'Molengo & Lekton',
    	'9'=>'Droid Serif & Droid Sans',
    	'10'=>'Corbin & Nobile',
    	'11'=>'Ubuntu & Vollkorn',
    	'12'=>'Bree Serif & Open Sans', 
    	'13'=>'Bevan & Pontano Sans', 
    	'14'=>'Abril Fatface & Average', 
    	'15'=>'Playfair Display and Muli', 
    	'16'=>'Sansita One & Kameron',
    	'17'=>'Istok Web & Lora',
    	'18'=>'Pacifico & Arimo',
    	'19'=>'Nixie One & Ledger',
    	'20'=>'Cantata One & Imprima',
    	'21'=>'Rancho & Gudea',
    	'22'=>'DISABLE Google Fonts');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Invert Navbar to dark background.
    $name = 'theme_mimoodle/invert';
    $title = get_string('invert', 'theme_mimoodle');
    $description = get_string('invertdesc', 'theme_mimoodle');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Logo file setting.
    $name = 'theme_mimoodle/logo';
    $title = get_string('logo','theme_mimoodle');
    $description = get_string('logodesc', 'theme_mimoodle');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Custom CSS file.
    $name = 'theme_mimoodle/customcss';
    $title = get_string('customcss', 'theme_mimoodle');
    $description = get_string('customcssdesc', 'theme_mimoodle');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Footnote setting.
    $name = 'theme_mimoodle/footnote';
    $title = get_string('footnote', 'theme_mimoodle');
    $description = get_string('footnotedesc', 'theme_mimoodle');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $ADMIN->add('theme_mimoodle', $temp);

    $temp = new admin_settingpage('theme_mimoodle_themecolors',  get_string('themecolorsettings', 'theme_mimoodle'));

 // @textColor setting.
    $name = 'theme_mimoodle/textcolor';
    $title = get_string('textcolor', 'theme_mimoodle');
    $description = get_string('textcolor_desc', 'theme_mimoodle');
    $default = '#3d3d3d';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, null, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // @linkColor setting.
    $name = 'theme_mimoodle/linkcolor';
    $title = get_string('linkcolor', 'theme_mimoodle');
    $description = get_string('linkcolor_desc', 'theme_mimoodle');
    $default = '#415FFB';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, null, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
	 // Main content background color.
    $name = 'theme_mimoodle/contentbackground';
    $title = get_string('contentbackground', 'theme_mimoodle');
    $description = get_string('contentbackground_desc', 'theme_mimoodle');
    $default = '#FFFFFF';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, null, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Secondary background color.
    $name = 'theme_mimoodle/secondarybackground';
    $title = get_string('secondarybackground', 'theme_mimoodle');
    $description = get_string('secondarybackground_desc', 'theme_mimoodle');
    $default = '#CAD9E8';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, null, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    // @bodyBackground setting.
    $name = 'theme_mimoodle/bodybackground';
    $title = get_string('bodybackground', 'theme_mimoodle');
    $description = get_string('bodybackground_desc', 'theme_mimoodle');
    $default = '#FFFBFF';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default, null, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Background image setting.
    $name = 'theme_mimoodle/backgroundimage';
    $title = get_string('backgroundimage', 'theme_mimoodle');
    $description = get_string('backgroundimage_desc', 'theme_mimoodle');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'backgroundimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Background repeat setting.
    $name = 'theme_mimoodle/backgroundrepeat';
    $title = get_string('backgroundrepeat', 'theme_mimoodle');
    $description = get_string('backgroundrepeat_desc', 'theme_mimoodle');;
    $default = 'repeat-x';
    $choices = array(
        '0' => get_string('default'),
        'repeat' => get_string('backgroundrepeatrepeat', 'theme_mimoodle'),
        'repeat-x' => get_string('backgroundrepeatrepeatx', 'theme_mimoodle'),
        'repeat-y' => get_string('backgroundrepeatrepeaty', 'theme_mimoodle'),
        'no-repeat' => get_string('backgroundrepeatnorepeat', 'theme_mimoodle'),
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Background position setting.
    $name = 'theme_mimoodle/backgroundposition';
    $title = get_string('backgroundposition', 'theme_mimoodle');
    $description = get_string('backgroundposition_desc', 'theme_mimoodle');
    $default = 'left_bottom';
    $choices = array(
        '0' => get_string('default'),
        'left_top' => get_string('backgroundpositionlefttop', 'theme_mimoodle'),
        'left_center' => get_string('backgroundpositionleftcenter', 'theme_mimoodle'),
        'left_bottom' => get_string('backgroundpositionleftbottom', 'theme_mimoodle'),
        'right_top' => get_string('backgroundpositionrighttop', 'theme_mimoodle'),
        'right_center' => get_string('backgroundpositionrightcenter', 'theme_mimoodle'),
        'right_bottom' => get_string('backgroundpositionrightbottom', 'theme_mimoodle'),
        'center_top' => get_string('backgroundpositioncentertop', 'theme_mimoodle'),
        'center_center' => get_string('backgroundpositioncentercenter', 'theme_mimoodle'),
        'center_bottom' => get_string('backgroundpositioncenterbottom', 'theme_mimoodle'),
    );
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Background fixed setting.
    $name = 'theme_mimoodle/backgroundfixed';
    $title = get_string('backgroundfixed', 'theme_mimoodle');
    $description = get_string('backgroundfixed_desc', 'theme_mimoodle');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $ADMIN->add('theme_mimoodle', $temp);

    /* Custom Menu temp */
    $temp = new admin_settingpage('theme_mimoodle_custommenu', get_string('custommenuheading', 'theme_mimoodle'));

    // Toggle courses display in custommenu.
    $name = 'theme_mimoodle/displaymycourses';
    $title = get_string('displaymycourses', 'theme_mimoodle');
    $description = get_string('displaymycoursesdesc', 'theme_mimoodle');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Set terminology for dropdown course list
	$name = 'theme_mimoodle/mycoursetitle';
	$title = get_string('mycoursetitle','theme_mimoodle');
	$description = get_string('mycoursetitledesc', 'theme_mimoodle');
	$default = 'course';
	$choices = array(
		'course' => get_string('mycourses', 'theme_mimoodle'),
		'unit' => get_string('myunits', 'theme_mimoodle'),
		'class' => get_string('myclasses', 'theme_mimoodle'),
		'module' => get_string('mymodules', 'theme_mimoodle')
	);
	$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$temp->add($setting);

    // Toggle dashboard display in custommenu.
    $name = 'theme_mimoodle/displaymydashboard';
    $title = get_string('displaymydashboard', 'theme_mimoodle');
    $description = get_string('displaymydashboarddesc', 'theme_mimoodle');
    $default = true;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default, true, false);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

$ADMIN->add('theme_mimoodle', $temp);
