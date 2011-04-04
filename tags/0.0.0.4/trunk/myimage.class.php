<?php
include dirname( __FILE__ ).'/plugin_base.php';

class myimage extends PluginBase1 {

    function init() {
        $this->register_plugin('myimage', __FILE__);
    }

    function myimage_activate() {
        $this->register_plugin('myimage', __FILE__);
    }

    function myimage_deactivate() {
    }

    function myimage_plugin_init() {
        global $myimage_plugin_url;

        if (get_user_option('rich_editing') == 'true') {
            // Include hooks for TinyMCE plugin
            add_filter('mce_external_plugins', array($this, 'myimage_plugin_mce_external_plugins'));
            add_filter('mce_buttons_3', array($this,'myimage_plugin_mce_buttons'));
        }

        wp_register_script('myimage-mylib', $myimage_plugin_url.'/gallery.js');
        wp_enqueue_script('myimage-mylib');

        wp_register_style('myimage-css', $myimage_plugin_url.'/popup.css');
        wp_enqueue_style('myimage-css');
    }

    function myimage_plugin_footer() {
        include ('myimage_format.php');
    }

    function myimage_plugin_mce_external_plugins($plugins) {

        global $myimage_plugin_url;
        $plugins['fib_plugin'] = $myimage_plugin_url.'/editor_plugin.js';
        return $plugins;
    }


    function myimage_plugin_mce_buttons($buttons) {

        array_push($buttons, 'fib_button');
        return $buttons;
    }
}

?>
