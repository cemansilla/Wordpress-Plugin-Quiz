<?php
if(!defined('ABSPATH')) exit;

/*
Plugin Name:  Quiz Book
Plugin URI:
Description:  Plugin para añadir Cuestionarios administrables
Version:      1.0
Author:       Cesar Mansilla
Author URI:
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  quizbook
*/

/**
 * Incluyo funciones
 */
require_once(plugin_dir_path(__FILE__) . "includes/functions.php");

/**
 * Agrego post type de quizes
 */
require_once(plugin_dir_path(__FILE__) . "includes/posttypes.php");

/**
 * Regenera las URLs al activar el plugin
 */
register_activation_hook(__FILE__, 'quizbook_rewrite_flush');

/**
 * Agrego metaboxes al CPT de quizes
 */
require_once(plugin_dir_path(__FILE__) . "includes/metaboxes.php");

/**
 * Agrego roles
 */
require_once(plugin_dir_path(__FILE__) . "includes/roles.php");
register_activation_hook(__FILE__, 'quizbook_create_role');
register_deactivation_hook(__FILE__, 'quizbook_remove_role');

/**
 * Agrego capabilities
 */
register_activation_hook( __FILE__, 'quizbook_add_capabilities' );
register_deactivation_hook( __FILE__, 'quizbook_remove_capabilities' );

/**
 * Agrego shortcode
 */
require_once(plugin_dir_path(__FILE__) . "includes/shortcode.php");

/**
 * Agrego css y js
 */
require_once(plugin_dir_path(__FILE__) . "includes/scripts.php");

/**
 * Resultados del cuestionario
 */
require_once(plugin_dir_path(__FILE__) . "includes/resultados.php");