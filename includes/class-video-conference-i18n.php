<?php

/**
 *
 * @since      1.0.3
 * @package    Video_Conference
 * @subpackage Video_Conference/includes
 * @author     Helmi <pm2monit@gmail.com>
 */
class Video_Conference_i18n {



	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'video-conference',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
