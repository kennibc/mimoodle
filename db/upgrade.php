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
 * Theme mimoodle upgrade.
 *
 * @package    theme_mimoodle
 * @copyright  2014 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Theme_mimoodle upgrade function.
 *
 * @param  int $oldversion The version we upgrade from.
 * @return bool
 */
function xmldb_theme_mimoodle_upgrade($oldversion) {
    global $CFG;

    if ($oldversion < 2014032400) {

        // Set the default background. If an image is already there then ignore.
        $fs = get_file_storage();
        $bg = $fs->get_area_files(context_system::instance()->id, 'theme_mimoodle', 'backgroundimage', 0);

        // Add default background image.
        if (empty($bg)) {
            $filerecord = new stdClass();
            $filerecord->component = 'theme_mimoodle';
            $filerecord->contextid = context_system::instance()->id;
            $filerecord->userid    = get_admin()->id;
            $filerecord->filearea  = 'backgroundimage';
            $filerecord->filepath  = '/';
            $filerecord->itemid    = 0;
            $filerecord->filename  = 'background.png';
            $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/mimoodle/pix/background.png');
        }

        upgrade_plugin_savepoint(true, 2014032400, 'theme', 'mimoodle');

    }

    if ($oldversion < 2014032401) {

        // Set the default settings as they might already be set.
        set_config('textcolor', '#3d3d3d', 'theme_mimoodle');
        set_config('linkcolor', '#415FFB', 'theme_mimoodle');
        set_config('backgroundrepeat', 'repeat-x', 'theme_mimoodle');
	set_config('backgroundposition', 'left_bottom', 'theme_mimoodle');
        set_config('contentbackground', '#FFFFFF', 'theme_mimoodle');
        set_config('secondarybackground', '#CAD9E8', 'theme_mimoodle');
	set_config('bodybackground', '#FFFBFF', 'theme_mimoodle');
        set_config('invert', 1, 'theme_mimoodle');
        set_config('backgroundimage', '/background.png', 'theme_mimoodle');

        upgrade_plugin_savepoint(true, 2014032401, 'theme', 'mimoodle');
    }

    // Moodle v2.7.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
