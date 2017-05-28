<?php 
// created document post type
function plugindocuments_setup_post_types()
{
    $labels = array(
		'name'               => _x( 'Documents', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Document', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Documents', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Document', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Document', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Document', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Document', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Document', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Documents', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Documents', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Documents:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No documents found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No documents found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'document' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail')
	);

	register_post_type( 'document', $args );
}
add_action( 'init', 'plugindocuments_setup_post_types' );

// Add new taxonomy, make it hierarchical (like categories) for documents 
function documents_taxonomies() {
	
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Categories', 'textdomain' ),
		'all_items'         => __( 'All Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Category', 'textdomain' ),
		'update_item'       => __( 'Update Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Category', 'textdomain' ),
		'new_item_name'     => __( 'New Category Name', 'textdomain' ),
		'menu_name'         => __( 'Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'doccategory' ),
	);

	register_taxonomy( 'doccategory', array( 'document' ), $args );
        
        $labels = array(
		'name'              => _x( 'Cities', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'City', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Cities', 'textdomain' ),
		'all_items'         => __( 'All Cities', 'textdomain' ),
		'parent_item'       => __( 'Parent City', 'textdomain' ),
		'parent_item_colon' => __( 'Parent City:', 'textdomain' ),
		'edit_item'         => __( 'Edit City', 'textdomain' ),
		'update_item'       => __( 'Update City', 'textdomain' ),
		'add_new_item'      => __( 'Add New City', 'textdomain' ),
		'new_item_name'     => __( 'New City Name', 'textdomain' ),
		'menu_name'         => __( 'City', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'doccity' ),
	);

	register_taxonomy( 'doccity', array( 'document' ), $args );
}
add_action( 'init', 'documents_taxonomies', 0 );

/**
 * Posting or Paused metaboxes 
 * 
 
 */

function ducument_status_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function ducument_status_add_meta_box() {
	add_meta_box(
		'ducument_status-ducument-status',
		__( 'Ducument Status', 'ducument_status' ),
		'ducument_status_html',
		'document',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'ducument_status_add_meta_box' );

function ducument_status_html( $post) {
	wp_nonce_field( '_ducument_status_nonce', 'ducument_status_nonce' ); ?>
        <p>
		<label for="ducument_status__ducument_status_"><?php _e( 'Ducument Status ', 'ducument_status_' ); ?></label><br>
		<select name="ducument_status__ducument_status_" id="ducument_status__ducument_status_">
			<option <?php echo (ducument_status_get_meta( 'ducument_status__ducument_status_' ) === 'Posting' ) ? 'selected' : '' ?>>Posting</option>
			<option <?php echo (ducument_status_get_meta( 'ducument_status__ducument_status_' ) === 'Paused' ) ? 'selected' : '' ?>>Paused</option>
		</select>
	</p>
	<p>

		<input type="radio" name="ducument_status_email_preference" id="ducument_status_email_preference_0" value="CL mail relay (recommended)" <?php echo ( ducument_status_get_meta( 'ducument_status_email_preference' ) === 'CL mail relay (recommended)' ) ? 'checked' : ''; ?>>
<label for="ducument_status_email_preference_0">CL mail relay (recommended)</label><br>

		<input type="radio" name="ducument_status_email_preference" id="ducument_status_email_preference_1" value="no replies to this email" <?php echo ( ducument_status_get_meta( 'ducument_status_email_preference' ) === 'no replies to this email' ) ? 'checked' : ''; ?>>
<label for="ducument_status_email_preference_1">no replies to this email</label><br>
	</p>	<p>

		<input type="checkbox" name="ducument_status_users_can_contact_me_by_phone" id="ducument_status_users_can_contact_me_by_phone" value="users-can-contact-me-by-phone" <?php echo ( ducument_status_get_meta( 'ducument_status_users_can_contact_me_by_phone' ) === 'users-can-contact-me-by-phone' ) ? 'checked' : ''; ?>>
		<label for="ducument_status_users_can_contact_me_by_phone"><?php _e( 'users can contact me by phone', 'ducument_status' ); ?></label>	</p>	<p>

		<input type="checkbox" name="ducument_status_users_can_contact_me_by_text" id="ducument_status_users_can_contact_me_by_text" value="users-can-contact-me-by-text" <?php echo ( ducument_status_get_meta( 'ducument_status_users_can_contact_me_by_text' ) === 'users-can-contact-me-by-text' ) ? 'checked' : ''; ?>>
		<label for="ducument_status_users_can_contact_me_by_text"><?php _e( 'users can contact me by text', 'ducument_status' ); ?></label>	</p>	<p>
		<label for="ducument_status_phone_number"><?php _e( 'Phone number', 'ducument_status' ); ?></label><br>
		<input type="text" name="ducument_status_phone_number" id="ducument_status_phone_number" value="<?php echo ducument_status_get_meta( 'ducument_status_phone_number' ); ?>">
	</p>	<p>
		<label for="ducument_status_phone_extension"><?php _e( 'Phone extension', 'ducument_status' ); ?></label><br>
		<input type="text" name="ducument_status_phone_extension" id="ducument_status_phone_extension" value="<?php echo ducument_status_get_meta( 'ducument_status_phone_extension' ); ?>">
	</p>	<p>
		<label for="ducument_status_contact_name"><?php _e( 'Contact Name', 'ducument_status' ); ?></label><br>
		<input type="text" name="ducument_status_contact_name" id="ducument_status_contact_name" value="<?php echo ducument_status_get_meta( 'ducument_status_contact_name' ); ?>">
	</p>	<p>
		<label for="ducument_status_specific_location"><?php _e( 'Specific Location', 'ducument_status' ); ?></label><br>
		<input type="text" name="ducument_status_specific_location" id="ducument_status_specific_location" value="<?php echo ducument_status_get_meta( 'ducument_status_specific_location' ); ?>">
	</p>	<p>
		<label for="ducument_status_post_code"><?php _e( 'Post Code', 'ducument_status' ); ?></label><br>
		<input type="text" name="ducument_status_post_code" id="ducument_status_post_code" value="<?php echo ducument_status_get_meta( 'ducument_status_post_code' ); ?>">
	</p>
        <!-- Category Meta field value --> 
        <p>
		<label for="ducument_status_post_code"><?php _e( 'Square Feet', 'ducument_status' ); ?></label><br>
		<input type="text" name="square_feet" id="square_feet" value="<?php echo ducument_status_get_meta( 'square_feet' ); ?>">
	</p>
        <p>
		<label for="rent"><?php _e( 'Rent', 'ducument_status' ); ?></label><br>
		<input type="text" name="rent" id="rent" value="<?php echo ducument_status_get_meta( 'rent' ); ?>">
	</p>
        <p>
		<label for="calendar"><?php _e( 'Calendar', 'ducument_status' ); ?></label><br>
		<input type="text" name="calendar" id="calendar" value="<?php echo ducument_status_get_meta( 'calendar' ); ?>">
	</p>
        <p>
		<label for="private_room"><?php _e( 'Private Room', 'ducument_status' ); ?></label><br>
		<input type="text" name="private_room" id="private_room" value="<?php echo ducument_status_get_meta( 'private_room' ); ?>">
	</p>
        <p>
		<label for="manufacturer"><?php _e( 'Make / Manufacturer', 'ducument_status' ); ?></label><br>
		<input type="text" name="manufacturer" id="manufacturer" value="<?php echo ducument_status_get_meta( 'manufacturer' ); ?>">
	</p>
        <p>
		<label for="propulsion"><?php _e( 'Propulsion', 'ducument_status' ); ?></label><br>
		<input type="text" name="propulsion" id="propulsion" value="<?php echo ducument_status_get_meta( 'propulsion' ); ?>">
	</p>
        <p>
		<label for="size_dimensions"><?php _e( 'Size / Dimensions', 'ducument_status' ); ?></label><br>
		<input type="text" name="size_dimensions" id="size_dimensions" value="<?php echo ducument_status_get_meta( 'size_dimensions' ); ?>">
	</p>
        <p>
		<label for="fuel"><?php _e( 'Fuel', 'ducument_status' ); ?></label><br>
		<input type="text" name="fuel" id="fuel" value="<?php echo ducument_status_get_meta( 'fuel' ); ?>">
	</p>
        <p>
		<label for="transmission"><?php _e( 'Transmission', 'ducument_status' ); ?></label><br>
		<input type="text" name="transmission" id="transmission" value="<?php echo ducument_status_get_meta( 'transmission' ); ?>">
	</p>
        <p>
		<label for="licenced"><?php _e( 'Licenced?', 'ducument_status' ); ?></label><br>
		<input type="text" name="licenced" id="licenced" value="<?php echo ducument_status_get_meta( 'licenced' ); ?>">
	</p>
        <?php
}

function ducument_status_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['ducument_status_nonce'] ) || ! wp_verify_nonce( $_POST['ducument_status_nonce'], '_ducument_status_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['ducument_status_email_preference'] ) )
		update_post_meta( $post_id, 'ducument_status_email_preference', esc_attr( $_POST['ducument_status_email_preference'] ) );
	if ( isset( $_POST['ducument_status_users_can_contact_me_by_phone'] ) )
		update_post_meta( $post_id, 'ducument_status_users_can_contact_me_by_phone', esc_attr( $_POST['ducument_status_users_can_contact_me_by_phone'] ) );
	else
		update_post_meta( $post_id, 'ducument_status_users_can_contact_me_by_phone', null );
	if ( isset( $_POST['ducument_status_users_can_contact_me_by_phone'] ) )
		update_post_meta( $post_id, 'ducument_status_users_can_contact_me_by_text', esc_attr( $_POST['ducument_status_users_can_contact_me_by_text'] ) );
	else
		update_post_meta( $post_id, 'ducument_status_users_can_contact_me_by_text', null );
	if ( isset( $_POST['ducument_status_phone_number'] ) )
		update_post_meta( $post_id, 'ducument_status_phone_number', esc_attr( $_POST['ducument_status_phone_number'] ) );
	if ( isset( $_POST['ducument_status_phone_extension'] ) )
		update_post_meta( $post_id, 'ducument_status_phone_extension', esc_attr( $_POST['ducument_status_phone_extension'] ) );
	if ( isset( $_POST['ducument_status_contact_name'] ) )
		update_post_meta( $post_id, 'ducument_status_contact_name', esc_attr( $_POST['ducument_status_contact_name'] ) );
	if ( isset( $_POST['ducument_status_specific_location'] ) )
		update_post_meta( $post_id, 'ducument_status_specific_location', esc_attr( $_POST['ducument_status_specific_location'] ) );
	if ( isset( $_POST['ducument_status_post_code'] ) )
		update_post_meta( $post_id, 'ducument_status_post_code', esc_attr( $_POST['ducument_status_post_code'] ) );
        if ( isset( $_POST['ducument_status__ducument_status_'] ) )
		update_post_meta( $post_id, 'ducument_status__ducument_status_', esc_attr( $_POST['ducument_status__ducument_status_'] ) );

        
}
add_action( 'save_post', 'ducument_status_save' );

/*
	Usage: ducument_status_get_meta( 'ducument_status_email_preference' )
	Usage: ducument_status_get_meta( 'ducument_status_users_can_contact_me_by_phone' )
	Usage: ducument_status_get_meta( 'ducument_status_users_can_contact_me_by_text' )
	Usage: ducument_status_get_meta( 'ducument_status_phone_number' )
	Usage: ducument_status_get_meta( 'ducument_status_phone_extension' )
	Usage: ducument_status_get_meta( 'ducument_status_contact_name' )
	Usage: ducument_status_get_meta( 'ducument_status_specific_location' )
	Usage: ducument_status_get_meta( 'ducument_status_post_code' )
*/
