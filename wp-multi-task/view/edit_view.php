<?php 
  
function viewandedit_doc(){
   if (!is_user_logged_in()) {
      $url = home_url('/login');
        echo '<script>window.location.href = "'.$url.'"; </script>';
    }
     $post_id = get_query_var( 'page', 1 );
    ?>
<div class="viewpost">
    <form id="viewpost-form" action="" method="post" enctype="multipart/form-data">
		<h2>View and Edit Post</h2>
                <?php $pluginname = plugin_basename('documents'); ?>
                <p class="status"><img src="<?php echo plugins_url( $pluginname.'/assets/images/ajax-loader.gif',dirname('')) ?>"</p>
		<h3 class="pst"><?php echo get_the_title($post_id); ?></h3> 
                <a class="back btn btn-primary pull-right" href="<?php echo home_url('/post-manager'); ?>" onclick="goBack();">Back</a>
                <a class="save" href="#">Save</a>
                <input type="hidden" value="<?php echo $post_id; ?>" name="post_id" id="post_id" />
		<div class="clearfix"></div>
	    <div class="form-group">
			<label>Posting or paused</label>
			<select name="post_status" class="form-control required">
              <option value="" >Select</option>
              <?php $variable = get_post_meta($post_id, 'ducument_status__ducument_status_', true ); ?>
              <option value="Posting" <?php echo ($variable === 'Posting' ) ? 'selected' : '' ?>>Posting</option>
	      <option value="Paused" <?php echo ($variable === 'Paused' ) ? 'selected' : '' ?>>Paused</option>
            </select>
		</div>
		<div class="form-group">
			<label><?php _e('City','istcoder-documents'); ?></label>
		<?php 
                    $catargs = array('orderby' => 'term_id', 'order' => 'ASC', 'parent' => 0);
                    $area = wp_get_object_terms($post_id, 'doccity',$catargs);
                    $parentid = $area[0]->term_id;
                    $args = array(
                   'show_option_all'    => __('Select City','istcoder-documents'),
                   'show_option_none'   => __('','istcoder-documents'),
                   'option_none_value'  => '-1',
                   'orderby'            => 'ID',
                   'order'              => 'ASC',
                   'show_count'         => 0,
                   'hide_empty'         => 0,
                   'child_of'           => 0,
                   'exclude'            => '',
                   'include'            => '',
                   'echo'               => 1,
                   'selected'           => $parentid,
                   'hierarchical'       => 0,
                   'name'               => 'catcity',
                   'id'                 => 'catcity',
                   'class'              => 'form-control',
                   'depth'              => 1,
                   'tab_index'          => 0,
                   'parent'             => 0,
                   'taxonomy'           => 'doccity',
                   'hide_if_empty'      => false,
                   'value_field'	=> 'term_id',
                   ); 
              wp_dropdown_categories($args); ?>
            
		</div>
		<div class="form-group">
			<label><?php _e('Type','istcoder-documents'); ?></label>
			<?php 
                      $doccategory = wp_get_object_terms($post_id, 'doccategory', $catargs);
                      $catparentid = $doccategory[0]->term_id;
                      $catid= 0;
                    $args = array(
                   'show_option_all'    => __('Select Type','istcoder-documents'),
                   'show_option_none'   => __('','istcoder-documents'),
                   'option_none_value'  => '-1',
                   'orderby'            => 'ID',
                   'order'              => 'ASC',
                   'show_count'         => 0,
                   'hide_empty'         => 0,
                   'child_of'           => 0,
                   'exclude'            => '',
                   'include'            => '',
                   'echo'               => 1,
                   'selected'           => $catparentid,
                   'hierarchical'       => 0,
                   'name'               => 'doccategory',
                   'id'                 => 'doccategory',
                   'class'              => 'form-control',
                   'depth'              => 1,
                   'tab_index'          => 0,
                   'parent'             => 0,
                   'taxonomy'           => 'doccategory',
                   'hide_if_empty'      => false,
                   'value_field'	=> 'term_id',
                   ); 
                 wp_dropdown_categories($args);
                    ?>
		</div>
		<div class="form-group">
			<label><?php _e('Category','istcoder-documents'); ?></label>
                       <div class="type-cat">
                            <select class="form-control required" id="typecategory" name="typecategory">
                            <option value=""><?php _e('Select Category','istcoder-documents'); ?></option>
                            <?php
                            $doccategory = get_the_terms($post_id, 'doccategory' );
                            foreach($doccategory as $doccat): 
                                 if($doccat->parent!=0){
                                     $catid = $doccat->term_id;
                                ?>
                                <option value="<?php echo $doccat->term_id; ?>" <?php if($doccat->term_id){ echo 'selected="selected"'; } ?>><?php echo $doccat->name; ?></option>
                                <?php 
                                 }
                            endforeach;
                            ?>
                            </select>
                        </div>            
		</div>
		<div class="form-group">
			<label><?php _e('Nearest Area','istcoder-documents'); ?></label>
                        <div class="nearestarea">
                            <select class="form-control required" name="nearest_area">
                            <option value=""><?php _e('Select Nearest Area','istcoder-documents'); ?></option>
                            <?php  
                            $area = get_the_terms( $post_id, 'doccity' );
                             foreach($area as $cat){
                                 if($cat->parent!=0){
                                     ?>
                            <option value="<?php echo $cat->term_id; ?>" <?php if($cat->term_id){ echo 'selected="selected"'; }?> ><?php echo $cat->name; ?></option>
                                     <?php 
                                 }
                             }   
                            
                            ?>
                            </select>
                        </div>
			
		</div>
                <div class="form-group">
		   <label><?php _e('Email Preference','istcoder-documents'); ?></label>
			
                        <label for="clemail" class="">
                          <input type="radio" value="CL mail relay (recommended)" id="clemail" <?php  if(get_post_meta($post_id,'ducument_status_email_preference', true )=='CL mail relay (recommended)'){ echo 'checked="checked"'; } ?> name='clemail'>CL mail relay (recommended)
                        </label>
                        <label for="noemail">
                          <input type="radio" value="no replies to this email" id="noemail" <?php if(get_post_meta($post_id,'ducument_status_email_preference', true )=='no replies to this email'){ echo 'checked="checked"'; } ?>  name='clemail'>no replies to this email
                        </label>
                     
		</div>
                
                <div class="form-group">
			<label>
                         <input type="checkbox" name='contactbyphone' value="users-can-contact-me-by-phone" <?php if(get_post_meta($post_id,'ducument_status_users_can_contact_me_by_phone', true )=='users-can-contact-me-by-phone'){ echo 'checked="checked"'; } ?>> users can contact me by phone
                        </label>
		</div>
                
                <div class="form-group">
			<label>
                         <input type="checkbox" name='contactbytext' value="users-can-contact-me-by-text" <?php if(get_post_meta($post_id,'ducument_status_users_can_contact_me_by_text', true )=='users-can-contact-me-by-text'){ echo 'checked="checked"'; } ?>> users can contact me by text
                        </label>
		</div>
                
                <div class="form-group">
			<label>Phone number</label>
                        <input type="text" value="<?php $phonenumber = get_post_meta($post_id,'ducument_status_phone_number', true ); if($phonenumber){ echo $phonenumber; } ?>" class="form-control" name="phonenumber" id="phonenumber">
		</div>
                
                <div class="form-group">
			<label>Phone extension</label>
			<input type="text" value="<?php $phoneextension = get_post_meta($post_id,'ducument_status_phone_extension', true ); if($phoneextension){ echo $phoneextension; } ?>" class="form-control" name="phoneextension" id="phoneextension">
		</div>
                
		<div class="form-group">
			<label>Contact Name</label>
			<input type="text" value="<?php $ducument_status_contact_name = get_post_meta($post_id,'ducument_status_contact_name', true ); if($ducument_status_contact_name){ echo $ducument_status_contact_name; } ?>" class="form-control" name="contactname" id="contactname">
		</div>
		<!--<div class="form-group">
			<label>Contact Info </label>
			<input type="text" class="form-control">
		</div>
		-->
		<div class="form-group">
			<label>Title</label>
			<input type="text" name="title" id="title" value="<?php echo get_the_title($post_id); ?>" class="form-control">
		</div>
                <div class="form-group">
			<label>Specific Location</label>
			<input type="text" value="<?php $ducument_status_specific_location = get_post_meta($post_id,'ducument_status_specific_location', true ); if($ducument_status_specific_location){ echo $ducument_status_specific_location; } ?>" class="form-control" name="specificlocation" id="specificlocation">
		</div>
                <div class="form-group">
			<label>Post Code</label>
			<input type="text" value="<?php $ducument_status_post_code = get_post_meta($post_id,'ducument_status_post_code', true ); if($ducument_status_post_code){ echo $ducument_status_post_code; } ?>" class="form-control" name="postcode" id="postcode">
		</div>
		<div class="form-group">
			<label>Posting Body</label>
			<textarea rows="9" class="form-control" name="postingbody" id="postingbody"><?php echo get_post_field('post_content', $post_id); ?></textarea>
		</div>
                <div class="necessary-fields">
                    <?php echo necessary_default_fields_by_cat($catid,$post_id); ?>
                </div>
		
		<div class="form-group">
			<label>Image Upload(up to 24)</label>
			<div class="row uploads">
                            <?php  $args = array(
                                        'post_parent'    => $post_id,
                                        'post_type'      => 'attachment',
                                        'numberposts'    => -1, // show all
                                        'post_status'    => 'any',
                                        'post_mime_type' => 'image',
                                        'orderby'        => 'ID',
                                        'order'           => 'ASC'
                                   );

                            $images = get_posts($args);
                            if($images) { ?>
                            <?php foreach($images as $image) { ?>
                            <div class="col-sm-3" data-attachid="<?php echo $image->ID; ?>"><img src="<?php echo wp_get_attachment_url($image->ID); ?>" ><i class="icon-remove-sign"></i></div>
                            <?php } ?>
                            <?php } ?>
			  
			</div>			
		</div>
		<div class="form-group filegrp">
			<input type="file" name="image_upload" id="image_upload" class="browse_btn">
                        
		</div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                     <a class="save pull-left" href="#">Save</a><input type="button" name="sub_upload_btn" value="Submit" class="sub_upload_btn pull-right">
                      </div>
                    </div>
                </dvi>
	 
	 </div>
</form>
  
<?php
  
}
?>