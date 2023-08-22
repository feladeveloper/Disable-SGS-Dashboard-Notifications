<?php
/**
 * Plugin Name: Disable Dashboard Notifications
 * Plugin URI: https://saltinstein.com/
 * Description: Disables various dashboard notifications in WordPress.
 * Version: 1.0.0
 * Author:  SGS Team
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Disables various dashboard notifications.
 * 
 * This function removes actions that generate notifications
 * in the admin dashboard for a cleaner interface.
 *
 * @since 1.0.0
 * @author Mzer Michael Terungwa <mzermichael4@gmail.com>
 */
function disable_dashboard_notifications() {
    // Remove core update notifications for plugins, themes, and WordPress itself
    remove_all_actions( 'admin_notices' );
    remove_all_actions( 'all_admin_notices' );
}

add_action( 'admin_print_scripts', 'disable_dashboard_notifications' );

/**
 * Removes core, plugin, and theme update notifications.
 *
 * This function modifies the site transients related to core, plugin, 
 * and theme updates to effectively prevent update notifications.
 * 
 * @since 1.0.0
 * @global string $wp_version The WordPress version string.
 * 
 * @return object Modified array with 'last_checked' and 'version_checked' keys.
 */
function remove_core_updates(){
    global $wp_version;
    return (object) array(
        'last_checked' => time(),
        'version_checked' => $wp_version,
    );
}

add_filter('pre_site_transient_update_core', 'remove_core_updates');
add_filter('pre_site_transient_update_plugins', 'remove_core_updates');
add_filter('pre_site_transient_update_themes', 'remove_core_updates');

