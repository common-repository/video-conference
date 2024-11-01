<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Video conference
 * Plugin URI:        https://mbtsolution.com/
 * Description:       Plugin video conference free on jitsi meet brand.
 * Version:           1.0.3
 * Author:            Helmi
 * Author URI:        https://webflazz.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       video-conference
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'VIDEO_CONFERENCE_VERSION', '1.0.3' );
define( 'VICON_URL', plugin_dir_url(__FILE__) );
define( 'VICON_PATH', plugin_dir_path(__FILE__) );


function activate_video_conference() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-video-conference-activator.php';
	Video_Conference_Activator::activate();
}


function deactivate_video_conference() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-video-conference-deactivator.php';
	Video_Conference_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_video_conference' );
register_deactivation_hook( __FILE__, 'deactivate_video_conference' );


require plugin_dir_path( __FILE__ ) . 'includes/class-video-conference.php';

function run_video_conference() {

	$plugin = new Video_Conference();
	$plugin->run();

}
run_video_conference();
