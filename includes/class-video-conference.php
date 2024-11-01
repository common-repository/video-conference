<?php

/**
 *
 * @since      1.0.3
 * @package    Video_Conference
 * @subpackage Video_Conference/includes
 * @author     Helmi <pm2monit@gmail.com>
 */

class Video_Conference {

	protected $loader;
	protected $plugin_name;

	protected $version;

	public function __construct() {
		if ( defined( 'VIDEO_CONFERENCE_VERSION' ) ) {
			$this->version = VIDEO_CONFERENCE_VERSION;
		} else {
			$this->version = '1.0.2';
		}
		$this->plugin_name = 'video-conference';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependencies() {


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-video-conference-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-video-conference-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-video-conference-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-video-conference-public.php';

		$this->loader = new Video_Conference_Loader();

	}

	private function set_locale() {

		$plugin_i18n = new Video_Conference_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$plugin_admin = new Video_Conference_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_admin, 'vicon_post_type' );

	}

	private function define_public_hooks() {
		$plugin_public = new Video_Conference_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// $this->loader->add_filter('single_template', $plugin_public, 'jitsi_page');
		add_shortcode('jitsi-meet', array($plugin_public, 'vicon_join_public'));
		$this->loader->add_action('init', $plugin_public, 'post_from_public');
    $this->loader->add_filter('single_template', $plugin_public, 'single_post_template');
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

	public function jitsi_shortcode() {
		$message = 'Hello world!';
		return $message;
	}




}
