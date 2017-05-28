<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$user_id = get_current_user_id();
$prefix = 'user_';
$single = true;

?>
<div class="row">
    <div class="col-md-12">
        
        <div class="page-header">
            <h2 class="username text-left">Progress of Appointment</h2>
        </div>
        <?php 
                
       $prefix = 'booked_user_';
      
           
                    
                   $post_id = get_the_ID();
                   $apptitle = get_the_title();
                   $permalink = get_the_permalink();
                   $author_id = get_the_author_meta('ID');
                   $appdob = get_post_meta($post_id,$prefix.'dobdate',true);
                   $mobilenumber = get_post_meta($post_id,$prefix.'mobilenumber',true);
                   $address = get_post_meta($post_id,$prefix.'address',true);
                   $passport = get_post_meta($post_id,$prefix.'passport',true);
                   $tazkira = get_post_meta($post_id,$prefix.'tazkira',true);
                   $residencecard = get_post_meta($post_id,$prefix.'residencecard',true);
                   $otherdocuments = get_post_meta($post_id,$prefix.'otherdocuments',true);
                   $processing = get_post_meta($post_id,$prefix.'processing',true);
                   $finish = get_post_meta($post_id,$prefix.'finish',true);
                   $delivery = get_post_meta($post_id,$prefix.'delivery',true);
                   $receivedate = get_the_date('l, F j, Y',get_the_ID());
                   $timeslots = get_post_meta($post_id,'bookings_time_slots',true);
                  
              
           
        $exp_date = str_replace('/', '-', $appdob);
        $dobdate = date("m/d/Y", strtotime($exp_date));
               
        ?>
       
            
                            
                        <div class="progress">
                          <div class="progress-bar "  role="progressbar"
                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:25%">
                            <?php _e('Recieve','istcoder-bookings'); ?><br><?php _e(' Recieveed on ','istcoder-bookings'); ?><?php echo $receivedate; ?>
                          </div>
                          <div class="progress-bar <?php if(!empty($processing)){ $processing = date("m/d/Y", $processing); ?> progress-bar-warning <?php if(!empty($finish)) { echo 'processing';} }  ?>" role="progressbar" style="width:25%">
                            <?php _e('Processing','istcoder-bookings'); ?> <br><?php echo $processing; ?>
                          </div>
                          <div class="progress-bar <?php if(!empty($finish)){ $finish = date("m/d/Y", $finish); ?> progress-bar-warning <?php if(!empty($delivery)){ echo 'processing'; } } ?>" role="progressbar" style="width:25%">
                            <?php _e('Finish','istcoder-bookings'); ?> <br><?php echo $finish; ?>
                          </div>
                           <div class="progress-bar <?php if(!empty($delivery)){ $delivery = date("m/d/Y", $delivery); ?> progress-bar-warning progress-bar-last <?php } ?>" role="progressbar" style="width:25%">
                            <?php _e('Delivery','istcoder-bookings'); ?><br><?php echo $delivery; ?> 
                          </div>
                        </div>
            </div>
            
       
        
    </div>
</div>
