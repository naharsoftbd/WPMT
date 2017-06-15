<?php 
/**
 * Page installer
 *
 * @since 0.1
 */
include WPMT_ROOT.'/include/admin/settings.php';
class WPMT_Admin_Installer {
	  /**
     * Add neccessary actions and filters
     *
     * @return void
     */
    function __construct() {
        add_action( 'init', array($this, 'register_post_type') );
	}
	
function register_post_type() {
        $capability = wpmt_admin_role();

        register_post_type( 'wpmt_messages', array(
            'label'           => __( 'Messages', 'wpmt' ),
            'public'          => false,
            'show_ui'         => true,
            'show_in_menu'    => 'wpmt-admin-opt', //false,
            'capability_type' => 'post',
            'hierarchical'    => true,
            'query_var'       => false,
            'supports'        => array('title'),
            'capabilities' => array(
                'publish_posts'       => $capability,
                'edit_posts'          => $capability,
                'edit_others_posts'   => $capability,
                'delete_posts'        => $capability,
                'delete_others_posts' => $capability,
                'read_private_posts'  => $capability,
                'edit_post'           => $capability,
                'delete_post'         => $capability,
                'read_post'           => $capability,
            ),
            'labels' => array(
                'name'               => __( 'Messages', 'wpmt' ),
                'singular_name'      => __( 'Message', 'wpmt' ),
                'menu_name'          => __( 'Messages', 'wpmt' ),
                'add_new'            => __( 'Add Message', 'wpmt' ),
                'add_new_item'       => __( 'Add New Message', 'wpmt' ),
                'edit'               => __( 'Edit', 'wpmt' ),
                'edit_item'          => __( 'Edit Message', 'wpmt' ),
                'new_item'           => __( 'New Message', 'wpmt' ),
                'view'               => __( 'View Message', 'wpmt' ),
                'view_item'          => __( 'View Message', 'wpmt' ),
                'search_items'       => __( 'Search Message', 'wpmt' ),
                'not_found'          => __( 'No Message Found', 'wpmt' ),
                'not_found_in_trash' => __( 'No Form Found in Trash', 'wpmt' ),
                'parent'             => __( 'Parent Form', 'wpmt' ),
            ),
        ) );

        register_post_type( 'wpmt_profile', array(
            'label'           => __( 'Registraton Forms', 'wpmt' ),
            'public'          => false,
            'show_ui'         => true,
            'show_in_menu'    => false,
            'capability_type' => 'post',
            'hierarchical'    => false,
            'query_var'       => false,
            'supports'        => array('title'),
            'capabilities' => array(
                'publish_posts'       => $capability,
                'edit_posts'          => $capability,
                'edit_others_posts'   => $capability,
                'delete_posts'        => $capability,
                'delete_others_posts' => $capability,
                'read_private_posts'  => $capability,
                'edit_post'           => $capability,
                'delete_post'         => $capability,
                'read_post'           => $capability,
            ),
            'labels' => array(
                'name'               => __( 'Forms', 'wpmt' ),
                'singular_name'      => __( 'Form', 'wpmt' ),
                'menu_name'          => __( 'Registration Forms', 'wpmt' ),
                'add_new'            => __( 'Add Form', 'wpmt' ),
                'add_new_item'       => __( 'Add New Form', 'wpmt' ),
                'edit'               => __( 'Edit', 'wpmt' ),
                'edit_item'          => __( 'Edit Form', 'wpmt' ),
                'new_item'           => __( 'New Form', 'wpmt' ),
                'view'               => __( 'View Form', 'wpmt' ),
                'view_item'          => __( 'View Form', 'wpmt' ),
                'search_items'       => __( 'Search Form', 'wpmt' ),
                'not_found'          => __( 'No Form Found', 'wpmt' ),
                'not_found_in_trash' => __( 'No Form Found in Trash', 'wpmt' ),
                'parent'             => __( 'Parent Form', 'wpmt' ),
            ),
        ) );

        register_post_type( 'wpmt_input', array(
            'public'          => false,
            'show_ui'         => false,
            'show_in_menu'    => false,
        ) );
    }
}
