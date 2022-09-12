<?php
/**
 * Plugin Name: Recommender Widget
 * Plugin URI: https://www.shopeo.cn
 * Description: Recommender.
 * Author: Shopeo
 * Version: 0.0.1
 * Author URI: https://www.shopeo.cn
 * License: GPL2+
 * Text Domain: recommender-widget
 * Domain Path: /languages
 * Requires at least: 5.9
 * Requires PHP: 5.6
 */

require_once 'vendor/autoload.php';

use Shopeo\RecommenderWidget\RecommenderShortCode;
use Shopeo\RecommenderWidget\RecommenderThePostShortCode;

if (!defined('ABSPATH')) {
    exit();
}

if (!defined('RECOMMENDER_WIDGET_PLUGIN_FILE')) {
    define('RECOMMENDER_WIDGET_PLUGIN_FILE', __FILE__);
}

if (!defined('RECOMMENDER_WIDGET_PLUGIN_BASE')) {
    define('RECOMMENDER_WIDGET_PLUGIN_BASE', plugin_basename(RECOMMENDER_WIDGET_PLUGIN_FILE));
}

if (!defined('RECOMMENDER_WIDGET_PATH')) {
    define('RECOMMENDER_WIDGET_PATH', plugin_dir_path(RECOMMENDER_WIDGET_PLUGIN_FILE));
}

if (!function_exists('recommender_widget_activate')) {
    function recommender_widget_activate()
    {

    }
}

register_activation_hook(__FILE__, 'recommender_widget_activate');


if (!function_exists('recommender_widget_deactivate')) {
    function recommender_widget_deactivate()
    {

    }
}
register_deactivation_hook(__FILE__, 'recommender_widget_deactivate');

if (!function_exists('recommender_widget_load_textdomain')) {
    function recommender_widget_load_textdomain()
    {
        load_plugin_textdomain('recommender-widget', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
}

add_action('init', 'recommender_widget_load_textdomain');

$recommender_short_code = new RecommenderShortCode();
$recommender_the_post_short_code = new RecommenderThePostShortCode();

if (!function_exists('recommender_widget_scripts')) {
    function recommender_widget_scripts()
    {
        $plugin_data = get_plugin_data(__FILE__);
        $version = '1.0.0';
        if (is_array($plugin_data) && array_key_exists('Version', $plugin_data)) {
            $version = $plugin_data['Version'];
        }
        wp_enqueue_style('recommender-widget-plugin-style', plugin_dir_url(__FILE__) . '/assets/app.css', array(), $version);
        wp_enqueue_script('recommender-widget-plugin-script', plugin_dir_url(__FILE__) . '/assets/app.js', array('jquery'), $version);
    }
}
add_action('wp_enqueue_scripts', 'recommender_widget_scripts');