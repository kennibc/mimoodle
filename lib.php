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
 * Theme mimoodle lib.
 *
 * @package    theme_mimoodle
 * @copyright  2014 Frédéric Massart
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Extra LESS code to inject.
 *
 * This will generate some LESS code from the settings used by the user. We cannot use
 * the {@link theme_mimoodle_less_variables()} here because we need to create selectors or
 * alter existing ones.
 *
 * @param theme_config $theme The theme config object.
 * @return string Raw LESS code.
 */
function theme_mimoodle_extra_less($theme) {
    $content = '';
    $imageurl = $theme->setting_file_url('backgroundimage', 'backgroundimage');
    // Sets the background image, and its settings.
    if (!empty($imageurl)) {
        $content .= 'body { ';
        $content .= "background-image: url('$imageurl');";
        if (!empty($theme->settings->backgroundfixed)) {
            $content .= 'background-attachment: fixed;';
        }
        if (!empty($theme->settings->backgroundposition)) {
            $content .= 'background-position: ' . str_replace('_', ' ', $theme->settings->backgroundposition) . ';';
        }
        if (!empty($theme->settings->backgroundrepeat)) {
            $content .= 'background-repeat: ' . $theme->settings->backgroundrepeat . ';';
        }
        $content .= ' }';
    }
    // If there the user wants a background for the content, we need to make it look consistent,
    // therefore we need to round its borders, and adapt the border colour.  
    //This also sets the page-content css to make the background color the same as the main content.
    if (!empty($theme->settings->contentbackground)) {
        $content .= '
            #region-main {
                .well;
                background-color: ' . $theme->settings->contentbackground . ';
                border-color: darken(' . $theme->settings->contentbackground . ', 7%);
		border-radius: 7px; }';
    }
    return $content;
}

/**
 * Returns variables for LESS.
 *
 * We will inject some LESS variables from the settings that the user has defined
 * for the theme. No need to write some custom LESS for this.
 *
 * @param theme_config $theme The theme config object.
 * @return array of LESS variables without the @.
 */
function theme_mimoodle_less_variables($theme) {
    $variables = array();
    if (!empty($theme->settings->bodybackground)) {
        $variables['bodyBackground'] = $theme->settings->bodybackground;
    }
    if (!empty($theme->settings->textcolor)) {
        $variables['textColor'] = $theme->settings->textcolor;
    }
    if (!empty($theme->settings->linkcolor)) {
        $variables['linkColor'] = $theme->settings->linkcolor;
    }
    if (!empty($theme->settings->secondarybackground)) {
        $variables['wellBackground'] = $theme->settings->secondarybackground;
    }
    return $variables;
}

/**
 * Parses CSS before it is cached.
 *
 * This function can make alterations and replace patterns within the CSS.
 *
 * @param string $css The CSS
 * @param theme_config $theme The theme config object.
 * @return string The parsed CSS The parsed CSS.
 */
function theme_mimoodle_process_css($css, $theme) {

    // Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = theme_mimoodle_set_logo($css, $logo);

// Set the Fonts.
    if ($theme->settings->fontselect ==1) {
        $headingfont = 'Oswald';
        $bodyfont = 'PT Sans';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==2) {
        $headingfont = 'Lobster';
        $bodyfont = 'Cabin';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==3) {
        $headingfont = 'Raelway';
        $bodyfont = 'Goudy Bookletter 1911';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==4) {
        $headingfont = 'Allerta';
        $bodyfont = 'Crimson Text';
        $bodysize = '14px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==5) {
        $headingfont = 'Arvo';
        $bodyfont = 'PT Sans';
        $bodysize = '14px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==6) {
        $headingfont = 'Dancing Script';
        $bodyfont = 'Josefin Sans';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==7) {
        $headingfont = 'Allan';
        $bodyfont = 'Cardo';
        $bodysize = '14px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==8) {
        $headingfont = 'Molengo';
        $bodyfont = 'Lekton';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==9) {
        $headingfont = 'Droid Serif';
        $bodyfont = 'Droid Sans';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==10) {
        $headingfont = 'Corben';
        $bodyfont = 'Nobile';
        $bodysize = '12px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==11) {
        $headingfont = 'Ubuntu';
        $bodyfont = 'Vollkorn';
        $bodysize = '14px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==12) {
        $headingfont = 'Bree Serif';
        $bodyfont = 'Open Sans';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==13) {
        $headingfont = 'Bevan';
        $bodyfont = 'Pontano Sans';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==14) {
        $headingfont = 'Abril Fatface';
        $bodyfont = 'Average';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==15) {
        $headingfont = 'Playfair Display';
        $bodyfont = 'Multi';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==16) {
        $headingfont = 'Sansita one';
        $bodyfont = 'Kameron';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==17) {
        $headingfont = 'Istok Web';
        $bodyfont = 'Lora';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==18) {
        $headingfont = 'Pacifico';
        $bodyfont = 'Arimo';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==19) {
        $headingfont = 'Nixie One';
        $bodyfont = 'Ledger';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==20) {
        $headingfont = 'Cantata One';
        $bodyfont = 'Imprima';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==21) {
        $headingfont = 'Rancho';
        $bodyfont = 'Gudea';
        $bodysize = '13px';
        $bodyweight = '400';
    } else if ($theme->settings->fontselect ==22) {
        $headingfont = 'Helvetica';
        $bodyfont = 'Georgia';
        $bodysize = '17px';
        $bodyweight = '400';
    }
    
    $css = theme_mimoodle_set_headingfont($css, $headingfont);
    $css = theme_mimoodle_set_bodyfont($css, $bodyfont);
    $css = theme_mimoodle_set_bodysize($css, $bodysize);
    $css = theme_mimoodle_set_bodyweight($css, $bodyweight);

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_mimoodle_set_customcss($css, $customcss);

    return $css;
}

function theme_mimoodle_set_headingfont($css, $headingfont) {
    $tag = '[[setting:headingfont]]';
    $replacement = $headingfont;
    if (is_null($replacement)) {
        $replacement = 'Georgia';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_mimoodle_set_bodyfont($css, $bodyfont) {
    $tag = '[[setting:bodyfont]]';
    $replacement = $bodyfont;
    if (is_null($replacement)) {
        $replacement = 'Arial';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_mimoodle_set_bodysize($css, $bodysize) {
    $tag = '[[setting:bodysize]]';
    $replacement = $bodysize;
    if (is_null($replacement)) {
        $replacement = '13';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function theme_mimoodle_set_bodyweight($css, $bodyweight) {
    $tag = '[[setting:bodyweight]]';
    $replacement = $bodyweight;
    if (is_null($replacement)) {
        $replacement = '400';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}



/**
 * Adds the logo to CSS.
 *
 * @param string $css The CSS.
 * @param string $logo The URL of the logo.
 * @return string The parsed CSS
 */
function theme_mimoodle_set_logo($css, $logo) {
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_mimoodle_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM && ($filearea === 'logo' || $filearea === 'backgroundimage')) {
        $theme = theme_config::load('mimoodle');
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_mimoodle_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function theme_mimoodle_page_init(moodle_page $page) {
    $page->requires->jquery();
$page->requires->jquery_plugin('tab', 'theme_mimoodle');
$page->requires->jquery_plugin('modal', 'theme_mimoodle');
$page->requires->jquery_plugin('tooltip', 'theme_mimoodle');
$page->requires->jquery_plugin('transition', 'theme_mimoodle');
$page->requires->jquery_plugin('collapse', 'theme_mimoodle');
$page->requires->jquery_plugin('modernizr', 'theme_mimoodle');
}
