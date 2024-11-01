<?php

/**
 *
 * @package    Video_Conference
 * @subpackage Video_Conference/public
 * @author     Helmi <pm2monit@gmail.com>
 */
class Video_Conference_Public {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/video-conference-public.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/video-conference-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/external_api.js', array( 'jquery' ), $this->version, true );
	}

	public function vicon_join_public() {
		ob_start();
		include_once VICON_PATH . 'public/partials/video-conference-public-display.php';
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}

	public function jitsi_page() {
		global $post;
		$page_template = '';
		if($post->post_type == 'vicon') {
			$page_template = VICON_PATH . 'public/partials/single-vicon.php';
		}

		return $page_template;
	}

  public function single_post_template() {
    if (is_singular('vicon')) {
      $template =  VICON_PATH . 'public/partials/single-vicon.php';
    }

    return $template;
  }

	public function post_from_public() {
		$dataGet = (!isset($_GET['meet-id'])) ? '': $_GET['meet-id'];
		if($dataGet == '') {
			echo '';
		} else {
			$postarr = array(
				'post_author' => '1',
				'post_title' => wp_strip_all_tags($dataGet),
				'post_category' => array('1'),
				'post_status' => 'public',
				'post_type' => 'vicon',
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_name' => '',
			);

			$post_id = wp_insert_post($postarr);

			echo '<script>window.location.href = "' .get_bloginfo( "url" ). '?post_type=vicon&p=' .$post_id. '";</script>';
			return;
		}
	}

}
