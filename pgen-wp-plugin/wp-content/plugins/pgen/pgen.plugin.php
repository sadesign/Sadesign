<?php
/*
Plugin Name: Password Generator
Plugin URI: http://sadesign.com.ua
Description: Password Generator shortcode
Version: 0.1.0.1
Author: Sergey N. Sytnic
Author URI: http://sadesign.com.ua
*/
define("PLUGIN_DIR",plugin_dir_path(__FILE__));
define("PLUGIN_URL",plugin_dir_url(__FILE__));

register_activation_hook(__FILE__,"pgen_activation_callback");

function pgen_activation_callback() {
    register_uninstall_hook(__FILE__,"pgen_uninstall_callback");
}

function pgen_uninstall_callback() {
    remove_shortcode("pgen");
}

function pgen_shortcode_register($atts, $content=null) {
    $result=file_get_contents(PLUGIN_DIR."/release.html");
    $result=str_replace("{PLUGIN_URL}",PLUGIN_URL,$result);
    return $result;
}

wp_enqueue_script("core",PLUGIN_URL."/js/core.js");
wp_enqueue_script("webtoolkit.base64",PLUGIN_URL."/js/webtoolkit.base64.js");
wp_enqueue_script("webtoolkit.md5",PLUGIN_URL."/js/webtoolkit.md5.js");
wp_enqueue_style("pgen-style",PLUGIN_URL."/css/release.css",false,"1.0.0","all");


add_shortcode("pgen","pgen_shortcode_register");
?>