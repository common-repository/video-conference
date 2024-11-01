<?php

/**
 *
 * @package    Video_Conference
 * @subpackage Video_Conference/admin
 * @author     Helmi <pm2monit@gmail.com>
 */
class Video_Conference_Admin {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/video-conference-admin.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/video-conference-admin.js', array( 'jquery' ), $this->version, false );
	}

	// Register Custom Post Type
	public function vicon_post_type() {

		$labels = array(
			'name'                  => _x( 'Video Conference', 'Post Type General Name', 'video_conference' ),
			'singular_name'         => _x( 'Video Conference', 'Post Type Singular Name', 'video_conference' ),
			'menu_name'             => __( 'Vicon', 'video_conference' ),
			'name_admin_bar'        => __( 'Video Conference', 'video_conference' ),
			'archives'              => __( 'Meeting Archives', 'video_conference' ),
			'attributes'            => __( 'Meeting Attributes', 'video_conference' ),
			'parent_item_colon'     => __( 'Parent Meeting:', 'video_conference' ),
			'all_items'             => __( 'All Meetings', 'video_conference' ),
			'add_new_item'          => __( 'Add New MeetingID', 'video_conference' ),
			'add_new'               => __( 'Add New MeetingID', 'video_conference' ),
			'new_item'              => __( 'New MeetingID', 'video_conference' ),
			'edit_item'             => __( 'Edit MeetingID', 'video_conference' ),
			'update_item'           => __( 'Update MeetingId', 'video_conference' ),
			'view_item'             => __( 'View MeetingID', 'video_conference' ),
			'view_items'            => __( 'View MeetingIDs', 'video_conference' ),
			'search_items'          => __( 'Search MeetingID', 'video_conference' ),
			'not_found'             => __( 'Not found', 'video_conference' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'video_conference' ),
			'featured_image'        => __( 'Featured Image', 'video_conference' ),
			'set_featured_image'    => __( 'Set featured image', 'video_conference' ),
			'remove_featured_image' => __( 'Remove featured image', 'video_conference' ),
			'use_featured_image'    => __( 'Use as featured image', 'video_conference' ),
			'insert_into_item'      => __( 'Insert into MeetingID', 'video_conference' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'video_conference' ),
			'items_list'            => __( 'MeetingIDs list', 'video_conference' ),
			'items_list_navigation' => __( 'MeetingIDs list navigation', 'video_conference' ),
			'filter_items_list'     => __( 'Filter MeetingIDs list', 'video_conference' ),
		);
		$args = array(
			'label'                 => __( 'Video Conference', 'video_conference' ),
			'description'           => __( 'Video Conferece Plugin With Jitsi', 'video_conference' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'excerpt'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-video-alt2',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive' 			    => false,
			'exclude_from_search'   => true,
			'capability_type'       => 'page',
			'show_in_rest'          => false,
		);
		register_post_type( 'vicon', $args );

	}


}
