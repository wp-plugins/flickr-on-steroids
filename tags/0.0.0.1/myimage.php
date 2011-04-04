<?php
/*
Plugin Name: Flickr on Steroids
Plugin URI: http://www.youtube.com/watch?v=RPqHqRmo-rs
Description: AJAX-powered Flickr gallery builder with a neat user interface. You can select the images you would like to include in a gallery which is embedded to your post after you publish it. Very flexible and easy to use!
Version: 0.0.0.1
Author: Alexey Smirnov
Author URI: http://alexeysmirnov.name/
*/

/*  Copyright 2011 Alexey Smirnov

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

  MyImage is derived from David M. Doolin's hRecipe plugin, with some 
  modification of the original code.
*/

global $myimage_plugin_url;
$myimage_plugin_url = WP_PLUGIN_URL.'/gbuilder';

if (!class_exists('myimage')) {
    require_once ('myimage.class.php');
}

if (class_exists('myimage')) {
    $myimage = new myimage();
}

if ( isset ($myimage)) {

    register_activation_hook( __FILE__ , array (&$myimage, 'myimage_activate'));
    register_deactivation_hook( __FILE__ , array (&$myimage, 'myimage_deactivate'));
    add_action('admin_footer', array ($myimage, 'myimage_plugin_footer'));
    $myimage->init();

   add_action('init', array ($myimage, 'myimage_plugin_init'));

}

?>
