<?php

/**
 * Plugin Name: My Custom Widget
 * Plugin URI: https://example.com
 * Description: A custom widget for your WordPress site.
 * Version: 1.0
 * Author: Mehedi Hassan Shovo
 * Author URI: https://example.com
 * Text Domain: my-custom-widget
 */

 if(!defined('ABSPATH')) {
    exit;
 }

 add_action('widgets_init', 'mcw_register_widget');

 include_once plugin_dir_path(__FILE__) . 'My_Custom_Widget.php';
 function mcw_register_widget() {
    register_widget('My_Custom_Widget');
 }