<?php

// Add term page
function documents_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[custom_term_meta]"><?php _e( 'Necessary Fields', 'istcoder-documents' ); ?></label>
		<label for="square-feet"> <input id="square-feet" type="checkbox" name="term_meta[square-feet]" value="square-feet"/>Square Feet</label>
                <label for="rent"><input id="rent" type="checkbox" name="term_meta[rent]" value="rent"/>Rent</label>
                <label for="calendar"><input id="calendar" type="checkbox" name="term_meta[calendar]" value="calendar"/>Calendar</label>
                <label for="private-room"> <input id="private-room" type="checkbox" name="term_meta[private-room]" value="private-room" />Private Room</label>
                <label for="manufacturer"><input id="manufacturer" type="checkbox" name="term_meta[manufacturer]" value="manufacturer"/>Manufacturer</label>
                <label for="propulsion"><input id="propulsion" type="checkbox" name="term_meta[propulsion]" value="propulsion"/>Propulsion</label>
                <label for="size-dimensions"> <input id="size-dimensions" type="checkbox" name="term_meta[size-dimensions]" value="size-dimensions"/>Size / Dimensions</label>
                <label for="fuel"><input id="fuel" type="checkbox" name="term_meta[fuel]" value="fuel"/>Fuel</label>
                <label for="transmission"><input id="transmission" type="checkbox" name="term_meta[transmission]" value="transmission" />Transmission</label>
                <label for="licenced"><input id="licenced" type="checkbox" name="term_meta[licenced]" value="licenced"/>Licenced</label>
                            
		<p class="description"><?php _e( 'Enter a value for this field','pippin' ); ?></p>
	</div>
<?php
}
add_action( 'doccategory_add_form_fields', 'documents_taxonomy_add_new_meta_field', 10, 2 );

// Edit term page
function documents_taxonomy_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	 ?>
	<tr class="form-field">
          
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Necessary fields', 'istcoder-documents' ); ?></label></th>
		<td>
			<!--<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">-->
                    <label for="square-feet"> <input id="square-feet" type="checkbox" name="term_meta[square-feet]" value="square-feet" <?php if(get_term_meta($term->term_id,'square-feet', true)) { echo 'checked="checked"'; } ?>/>Square Feet</label>
                    <label for="rent"><input id="rent" type="checkbox" name="term_meta[rent]" value="rent" <?php if(get_term_meta($term->term_id,'rent', true)) { echo 'checked="checked"'; } ?>/>Rent</label>
                    <label for="calendar"><input id="calendar" type="checkbox" name="term_meta[calendar]" value="calendar" <?php if(get_term_meta($term->term_id,'calendar', true)) { echo 'checked="checked"'; } ?>/>Calendar</label>
                    
                    <p class="description"><?php _e( 'Please check fore more field','istcoder-documents' ); ?></p>
		</td>
                
	</tr>
        <tr class="form-field">
            <th scope="row" valign="top"></th>
            <td>
			<!--<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">-->
                    <label for="private-room"> <input id="private-room" type="checkbox" name="term_meta[private-room]" value="private-room" <?php if(get_term_meta($term->term_id,'private-room', true)) { echo 'checked="checked"'; } ?>/>Private Room</label>
                    <label for="manufacturer"><input id="manufacturer" type="checkbox" name="term_meta[manufacturer]" value="manufacturer" <?php if(get_term_meta($term->term_id,'manufacturer', true)) { echo 'checked="checked"'; } ?>/>Manufacturer</label>
                    <label for="propulsion"><input id="propulsion" type="checkbox" name="term_meta[propulsion]" value="propulsion" <?php if(get_term_meta($term->term_id,'propulsion', true)) { echo 'checked="checked"'; } ?>/>Propulsion</label>
                    
                    <p class="description"><?php _e( 'Please check fore more field','istcoder-documents' ); ?></p>
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"></th>
            <td>
			<!--<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">-->
                    <label for="size-dimensions"> <input id="size-dimensions" type="checkbox" name="term_meta[size-dimensions]" value="size-dimensions" <?php if(get_term_meta($term->term_id,'size-dimensions', true)) { echo 'checked="checked"'; } ?>/>Size / Dimensions</label>
                    <label for="fuel"><input id="fuel" type="checkbox" name="term_meta[fuel]" value="fuel" <?php if(get_term_meta($term->term_id,'fuel', true)) { echo 'checked="checked"'; } ?>/>Fuel</label>
                    <label for="transmission"><input id="transmission" type="checkbox" name="term_meta[transmission]" value="transmission" <?php if(get_term_meta($term->term_id,'transmission', true)) { echo 'checked="checked"'; } ?>/>Transmission</label>
                    <label for="licenced"><input id="licenced" type="checkbox" name="term_meta[licenced]" value="licenced" <?php if(get_term_meta($term->term_id,'licenced', true)) { echo 'checked="checked"'; } ?>/>Licenced</label>
                    
                    <p class="description"><?php _e( 'Please check fore more field','istcoder-documents' ); ?></p>
            </td>
        </tr>
<?php
}
add_action( 'doccategory_edit_form_fields', 'documents_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
    global $wpdb;
    $sql = $wpdb->get_results("select meta_key from $wpdb->termmeta where term_id='$term_id'");
    foreach($sql as $meta_key) {                               
        $wpdb->delete($wpdb->termmeta,array('meta_key' =>$meta_key->meta_key));                  
    }
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ($_POST['term_meta'][$key]) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
                                
                                update_term_meta($t_id, $term_meta[$key],$term_meta[$key]);
			}
		}
                
	}
}  
add_action( 'edited_doccategory', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_doccategory', 'save_taxonomy_custom_meta', 10, 2 );



function necessary_fields_by_cat(){
    $t_id = $_POST['catid'];
	$post_id = $_POST['post_id'];
    $square_feet = get_term_meta($t_id,'square-feet', true);
    $rent = get_term_meta($t_id,'rent', true);
    $fuel = get_term_meta($t_id,'fuel', true);
    $transmission = get_term_meta($t_id,'transmission', true);
    $licenced = get_term_meta($t_id,'licenced', true);
    $private_room = get_term_meta($t_id,'private-room', true);
    $manufacturer = get_term_meta($t_id,'manufacturer', true);
    $propulsion = get_term_meta($t_id,'propulsion', true);
    $size_dimensions = get_term_meta($t_id,'size-dimensions', true);
    $calendar = get_term_meta($t_id,'calendar', true);
        
    if(!empty($square_feet)){
        ?>
        <div class="form-group">
			<label><?php _e('Square Feet',''); ?></label>
			<input type="text" value="<?php $square_feet = get_post_meta($post_id,'square_feet', true ); if($square_feet){ echo $square_feet; } ?>" class="form-control" name="square_feet" id="square_feet">
        </div>
        <?php 
    }
    if(!empty($rent)){
        ?>
        <div class="form-group">
			<label><?php _e('Rent',''); ?></label>
			<input type="text" value="<?php $rent = get_post_meta($post_id,'rent', true ); if($rent){ echo $rent; } ?>" class="form-control" name="rent" id="rent">
        </div>
        <?php 
    }
    if(!empty($calendar)){
        ?>
        <div class="form-group">
			<label><?php _e('Calendar',''); ?></label>
			<input type="text" value="<?php $calendar = get_post_meta($post_id,'calendar', true ); if($calendar){ echo $calendar; } ?>" class="form-control" name="calendar" id="datepicker">
        </div>
        <?php 
    }
    if(!empty($private_room)){
        ?>
        <div class="form-group">
			<label><?php _e('Private Room',''); ?></label>
			 <select class="form-control required" name="private_room">
                            <option value="room-not-private" <?php $private_room = get_post_meta($post_id,'private_room', true ); if($private_room=='room-not-private'){ echo 'selected="selected"'; } ?>><?php _e('room not private','istcoder-documents'); ?></option>
                            <option value="private-room" <?php $private_room = get_post_meta($post_id,'private_room', true ); if($private_room=='private-room'){ echo 'selected="selected"'; } ?>><?php _e('private room','istcoder-documents'); ?></option>
                         </select>
        </div>
        <?php 
    }
    if(!empty($manufacturer)){
        ?>
        <div class="form-group">
			<label><?php _e('Make / Manufacturer',''); ?></label>
			<input type="text" value="<?php $manufacturer = get_post_meta($post_id,'manufacturer', true ); if($manufacturer){ echo $manufacturer; } ?>" class="form-control" name="manufacturer" id="manufacturer">
        </div>
        <?php 
    }
    if(!empty($propulsion)){
        ?>
        <div class="form-group">
			<label><?php _e('Propulsion',''); ?></label>
			 <select class="form-control required" name="propulsion">
                             <?php $propulsion = get_post_meta($post_id,'private_room', true ); ?>
                            <option value="sail" <?php if($propulsion=='sail'){ echo 'selected="selected"'; } ?>><?php _e('sail','istcoder-documents'); ?></option>
                            <option value="power" <?php if($propulsion=='power'){ echo 'selected="selected"'; } ?>><?php _e('power','istcoder-documents'); ?></option>
                            <option value="human" <?php if($propulsion=='human'){ echo 'selected="selected"'; } ?>><?php _e('human','istcoder-documents'); ?></option>
                         </select>
        </div>
        <?php 
    }
    if(!empty($size_dimensions)){
        ?>
        <div class="form-group">
			<label><?php _e('Size / Dimensions',''); ?></label>
			<input type="text" value="<?php $size_dimensions = get_post_meta($post_id,'size_dimensions', true ); if($size_dimensions){ echo $size_dimensions; } ?>" class="form-control" name="size_dimensions" id="size_dimensions">
        </div>
        <?php 
    }
    if(!empty($fuel)){
        ?>
        <div class="form-group">
			<label><?php _e('Fuel',''); ?></label>
			 <select class="form-control required" name="fuel">
                             <?php $fuel = get_post_meta($post_id,'fuel', true ); ?>
                            <option value="gas" <?php if($fuel=='gas'){ echo 'selected="selected"'; } ?>><?php _e('gas','istcoder-documents'); ?></option>
                            <option value="diesel" <?php if($fuel=='diesel'){ echo 'selected="selected"'; } ?>><?php _e('diesel','istcoder-documents'); ?></option>
                            <option value="hybrid" <?php if($fuel=='hybrid'){ echo 'selected="selected"'; } ?>><?php _e('hybrid','istcoder-documents'); ?></option>
                            <option value="electric" <?php if($fuel=='electric'){ echo 'selected="selected"'; } ?>><?php _e('electric','istcoder-documents'); ?></option>
                            <option value="other" <?php if($fuel=='other'){ echo 'selected="selected"'; } ?>><?php _e('other','istcoder-documents'); ?></option>
                         </select>
        </div>
        <?php 
    }
    if(!empty($transmission)){
        ?>
        <div class="form-group">
			<label><?php _e('Transmission',''); ?></label>
			 <select class="form-control required" name="transmission">
                             <?php $transmission = get_post_meta($post_id,'transmission', true ); ?>
                            <option value="manual" <?php if($transmission=='manual'){ echo 'selected="selected"'; } ?>><?php _e('manual','istcoder-documents'); ?></option>
                            <option value="automatic" <?php if($transmission=='automatic'){ echo 'selected="selected"'; } ?>><?php _e('automatic','istcoder-documents'); ?></option>
                            <option value="other" <?php if($transmission=='other'){ echo 'selected="selected"'; } ?>><?php _e('other','istcoder-documents'); ?></option>
                         </select>
        </div>
        <?php 
    }
    if(!empty($licenced)){
        ?>
        <div class="form-group">
			<label><?php _e('Licenced?',''); ?></label>
                        <?php $licenced = get_post_meta($post_id,'licenced', true ); ?>
			 <select class="form-control required" name="licenced">
                            <option value="unlicenced" <?php if($licenced=='unlicenced'){ echo 'selected="selected"'; } ?>><?php _e('unlicenced','istcoder-documents'); ?></option>
                            <option value="licenced" <?php if($licenced=='licenced'){ echo 'selected="selected"'; } ?>><?php _e('licenced','istcoder-documents'); ?></option>
                          </select>
        </div>
        <?php 
    }
    die();
    }
    
  function necessary_default_fields_by_cat($catid="",$post_id=""){
    $t_id = 0;
   if(!empty($catid)){
     $t_id = $catid;  
      }
    $square_feet = get_term_meta($t_id,'square-feet', true);
    $rent = get_term_meta($t_id,'rent', true);
    $fuel = get_term_meta($t_id,'fuel', true);
    $transmission = get_term_meta($t_id,'transmission', true);
    $licenced = get_term_meta($t_id,'licenced', true);
    $private_room = get_term_meta($t_id,'private-room', true);
    $manufacturer = get_term_meta($t_id,'manufacturer', true);
    $propulsion = get_term_meta($t_id,'propulsion', true);
    $size_dimensions = get_term_meta($t_id,'size-dimensions', true);
    $calendar = get_term_meta($t_id,'calendar', true);
        
    if(!empty($square_feet)){
        ?>
        <div class="form-group">
			<label><?php _e('Square Feet',''); ?></label>
			<input type="text" value="<?php $square_feet = get_post_meta($post_id,'square_feet', true ); if($square_feet){ echo $square_feet; } ?>" class="form-control" name="square_feet" id="square_feet">
        </div>
        <?php 
    }
    if(!empty($rent)){
        ?>
        <div class="form-group">
			<label><?php _e('Rent',''); ?></label>
			<input type="text" value="<?php $rent = get_post_meta($post_id,'rent', true ); if($rent){ echo $rent; } ?>" class="form-control" name="rent" id="rent">
        </div>
        <?php 
    }
    if(!empty($calendar)){
        ?>
        <div class="form-group">
			<label><?php _e('Calendar',''); ?></label>
			<input type="text" value="<?php $calendar = get_post_meta($post_id,'calendar', true ); if($calendar){ echo $calendar; } ?>" class="form-control" name="calendar" id="datepicker">
        </div>
        <?php 
    }
    if(!empty($private_room)){
        ?>
        <div class="form-group">
			<label><?php _e('Private Room',''); ?></label>
			 <select class="form-control required" name="private_room">
                            <option value="room-not-private" <?php $private_room = get_post_meta($post_id,'private_room', true ); if($private_room=='room-not-private'){ echo 'selected="selected"'; } ?>><?php _e('room not private','istcoder-documents'); ?></option>
                            <option value="private-room" <?php $private_room = get_post_meta($post_id,'private_room', true ); if($private_room=='private-room'){ echo 'selected="selected"'; } ?>><?php _e('private room','istcoder-documents'); ?></option>
                         </select>
        </div>
        <?php 
    }
    if(!empty($manufacturer)){
        ?>
        <div class="form-group">
			<label><?php _e('Make / Manufacturer',''); ?></label>
			<input type="text" value="<?php $manufacturer = get_post_meta($post_id,'manufacturer', true ); if($manufacturer){ echo $manufacturer; } ?>" class="form-control" name="manufacturer" id="manufacturer">
        </div>
        <?php 
    }
    if(!empty($propulsion)){
        ?>
        <div class="form-group">
			<label><?php _e('Propulsion',''); ?></label>
			 <select class="form-control required" name="propulsion">
                             <?php $propulsion = get_post_meta($post_id,'private_room', true ); ?>
                            <option value="sail" <?php if($propulsion=='sail'){ echo 'selected="selected"'; } ?>><?php _e('sail','istcoder-documents'); ?></option>
                            <option value="power" <?php if($propulsion=='power'){ echo 'selected="selected"'; } ?>><?php _e('power','istcoder-documents'); ?></option>
                            <option value="human" <?php if($propulsion=='human'){ echo 'selected="selected"'; } ?>><?php _e('human','istcoder-documents'); ?></option>
                         </select>
        </div>
        <?php 
    }
    if(!empty($size_dimensions)){
        ?>
        <div class="form-group">
			<label><?php _e('Size / Dimensions',''); ?></label>
			<input type="text" value="<?php $size_dimensions = get_post_meta($post_id,'size_dimensions', true ); if($size_dimensions){ echo $size_dimensions; } ?>" class="form-control" name="size_dimensions" id="size_dimensions">
        </div>
        <?php 
    }
    if(!empty($fuel)){
        ?>
        <div class="form-group">
			<label><?php _e('Fuel',''); ?></label>
			 <select class="form-control required" name="fuel">
                             <?php $fuel = get_post_meta($post_id,'fuel', true ); ?>
                            <option value="gas" <?php if($fuel=='gas'){ echo 'selected="selected"'; } ?>><?php _e('gas','istcoder-documents'); ?></option>
                            <option value="diesel" <?php if($fuel=='diesel'){ echo 'selected="selected"'; } ?>><?php _e('diesel','istcoder-documents'); ?></option>
                            <option value="hybrid" <?php if($fuel=='hybrid'){ echo 'selected="selected"'; } ?>><?php _e('hybrid','istcoder-documents'); ?></option>
                            <option value="electric" <?php if($fuel=='electric'){ echo 'selected="selected"'; } ?>><?php _e('electric','istcoder-documents'); ?></option>
                            <option value="other" <?php if($fuel=='other'){ echo 'selected="selected"'; } ?>><?php _e('other','istcoder-documents'); ?></option>
                         </select>
        </div>
        <?php 
    }
    if(!empty($transmission)){
        ?>
        <div class="form-group">
			<label><?php _e('Transmission',''); ?></label>
			 <select class="form-control required" name="transmission">
                             <?php $transmission = get_post_meta($post_id,'transmission', true ); ?>
                            <option value="manual" <?php if($transmission=='manual'){ echo 'selected="selected"'; } ?>><?php _e('manual','istcoder-documents'); ?></option>
                            <option value="automatic" <?php if($transmission=='automatic'){ echo 'selected="selected"'; } ?>><?php _e('automatic','istcoder-documents'); ?></option>
                            <option value="other" <?php if($transmission=='other'){ echo 'selected="selected"'; } ?>><?php _e('other','istcoder-documents'); ?></option>
                         </select>
        </div>
        <?php 
    }
    if(!empty($licenced)){
        ?>
        <div class="form-group">
			<label><?php _e('Licenced?',''); ?></label>
                        <?php $licenced = get_post_meta($post_id,'licenced', true ); ?>
			 <select class="form-control required" name="licenced">
                            <option value="unlicenced" <?php if($licenced=='unlicenced'){ echo 'selected="selected"'; } ?>><?php _e('unlicenced','istcoder-documents'); ?></option>
                            <option value="licenced" <?php if($licenced=='licenced'){ echo 'selected="selected"'; } ?>><?php _e('licenced','istcoder-documents'); ?></option>
                          </select>
        </div>
        <?php 
    }
    
    }