<?php
/**
 * @wordpress-plugin
 * Plugin Name:       BetterBook
 * Description:       BetterBook is an online booking platform that enables you to take online bookings for events, classes and appointments from your WordPress website.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.1
 * Author:            BetterBook (Pty) Ltd.
 * Author URI:        https://www.betterbook.io/
 * Text Domain:       betterbook
 */

defined( 'ABSPATH' ) or die( 'Direct script access disallowed.' );

define( 'BETTERBOOK_SHORTCODE', 'betterbook_widget' );
define( 'BETTERBOOK_APIKEY_OPTION', 'betterbook_apikey' );
define( 'BETTERBOOK_APIKEY_NONCE', 'betterbook_apikey_nonce' );

define( 'BETTERBOOK_WIDGET_PATH', 'https://static.betterbook.io' );
define( 'BETTERBOOK_ASSET_MANIFEST', BETTERBOOK_WIDGET_PATH . '/asset-manifest.json' );
define( 'BETTERBOOK_INCLUDES', plugin_dir_path( __FILE__ ) . '/includes' );


require_once( BETTERBOOK_INCLUDES . '/enqueue.php' );
require_once( BETTERBOOK_INCLUDES . '/shortcode.php' );

function betterbook_admin() {
  include('admin/betterbook_admin.php');
}

function betterbook_admin_actions() {
  add_options_page("BetterBook", "BetterBook", 'administrator', "BetterBook", "betterbook_admin");
}
function betterbook_admin_settings_link($links) {
  $settings_link = '<a href="options-general.php?page=BetterBook">' . __( 'Settings' ) . '</a>';
  array_unshift( $links, $settings_link );
  return $links;
}

add_action('admin_menu', 'betterbook_admin_actions');

$plugin = plugin_basename( __FILE__ );
add_filter("plugin_action_links_$plugin", 'betterbook_admin_settings_link' );
