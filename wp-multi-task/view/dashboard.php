<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$user_id = get_current_user_id();
$prefix = 'user_';
$single = true;
if(is_user_logged_in()){
?>
<div class="row">
    <div class="col-md-12">
        
        <div class="page-header">
            <h2 class="username text-left"><?php echo get_user_meta($user_id, 'first_name', $single );  ?></h2>
        </div>
        <?php 
        $args = array(
            'post_type' => 'booked',
            'author' => $user_id,
            'post_status'  => array('draft','publish'),
           );
       
       $the_query = new WP_Query($args);
        
       $prefix = 'user_';
                   $author_id = $user_id;
                   $appdob = get_user_meta($author_id,$prefix.'dobdate',true);
                   $mobilenumber = get_user_meta($author_id,$prefix.'mobilenumber',true);
                   $address = get_user_meta($author_id,$prefix.'address',true);
                   $passport = get_user_meta($author_id,$prefix.'passport',true);
                   $tazkira = get_user_meta($author_id,$prefix.'tazkira',true);
                   $residencecard = get_user_meta($author_id,$prefix.'residencecard',true);
                   $otherdocuments = get_user_meta($author_id,$prefix.'otherdocuments',true);
                  
                    $exp_date = str_replace('/', '-', $appdob);
                    $dobdate = date("m/d/Y", strtotime($exp_date));
                    $where = get_posts_by_author_sql( 'booked' );
                    global $wpdb;
                   $query = "SELECT ID FROM $wpdb->posts $where AND post_author ='$author_id'";                  
                   $results = $wpdb->get_results($query);
                   
          
        ?>
        
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">My Details</a></li>
            <li><a data-toggle="tab" href="#menu1">My Appointment</a></li>
            <li><a  href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
        </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              
              <ul class="userinfo">
                    <?php /* ?><li><h2><?php _e('Appointment :'); ?><a href="<?php echo $permalink; //$permalink = str_replace("booked", "appointment", $permalink);  ?>"><?php echo $apptitle; ?></a></h2> </li><?php */ ?>
                    <li><h4><?php _e('Date Of Borith (dob) :'); echo $appdob; ?></h4></li>
                    <li><h4><?php _e('Appointment Date and Time :'); 
                    $s = ''; 
                    foreach($results as $result){
                            if ($s) $s .= '| ';
                            $timeslots = get_post_meta($result->ID,'bookings_time_slots',true);
                            $s .= date("m/d/Y",strtotime($timeslots[0] ["title"][0]))." \r\n ";
                            $s .= date("g:i a",strtotime($timeslots[0] ["apptime"][0]))." \r\n ";
                   } echo $s; ?></h4></li>
                    <li><h4><?php _e('Mobile Number :'); echo $mobilenumber; ?></h4></li>
                    <li><h4><?php _e('Address :'); echo $address; ?></h4></li>
                    <li><h4><?php _e('Passport # :'); echo $passport;  ?></h4></li>
                    <li><h4><?php _e('Tazkira :'); echo $tazkira; ?></h4></li>
                    <li><h4><?php _e('Residencecard :'); echo $residencecard; ?></h4></li>
                    <li><h4><?php _e('Otherdocuments :'); echo $otherdocuments; ?></h4></li>
                </ul>
            </div>
            <div id="menu1" class="tab-pane fade">
                <ul>
                <?php 
        $args = array(
            'post_type' => 'booked',
            'author' => $user_id,
            'post_status'  => array('draft','publish'),
           );
       
       $the_query = new WP_Query($args);
        
       $prefix = 'booked_user_';
       
           if($the_query->have_posts()):
               while($the_query->have_posts()):
                    $the_query->the_post();
                    $post_id = get_the_ID();
                   $apptitle = get_the_title();
                   $permalink = get_the_permalink();
                   $author_id = $user_id;
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
                   $processdate = get_post_meta($post_id,'processdate',true);
                   $finishdate = get_post_meta($post_id,'finishdate',true);
                   $deliverydate = get_post_meta($post_id,'deliverydate',true);
                    $exp_date = str_replace('/', '-', $appdob);
                    $dobdate = date("m/d/Y", strtotime($exp_date));
					$timeslots1 = get_post_meta(get_the_id(),'bookings_timeslot1',true);
					$timeslots2 = get_post_meta(get_the_id(),'bookings_timeslot2',true);
					
                    ?>
                    <li><?php the_title(); ?></li>
                    <li><a href="<?php the_permalink(); ?>">See Details </a></li>
                    <li>
                         <h3>Progress of Appointment </h3>
                        <div class="progress">
                          <div class="progress-bar "  role="progressbar"
                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:25%">
                            <?php _e('Recieve','istcoder-bookings'); ?><br><?php //_e(' Recieveed on ','istcoder-bookings'); ?><?php   //echo  date('m/d/Y',strtotime($timeslots[0]['title'][0])); echo '  '.$timeslots1[0] .' to '.$timeslots2[0]; ?>
                          </div>
                          <div class="progress-bar <?php if(!empty($processing)){ $processing = date("m/d/Y", $processdate); ?> progress-bar-warning <?php if(!empty($finish)) { echo 'processing';} }  ?>" role="progressbar" style="width:25%">
                            <?php _e('Processing','istcoder-bookings'); ?> <br><?php /*if(!empty($processdate)) { echo  date('m/d/Y',strtotime($processdate)); echo '  '.$timeslots1[0] .' to '.$timeslots2[0]; }*/ ?>
                          </div>
                          <div class="progress-bar <?php if(!empty($finish)){ $finish = date("m/d/Y", $finish); ?> progress-bar-warning <?php if(!empty($delivery)){ echo 'processing'; } } ?>" role="progressbar" style="width:25%">
                            <?php _e('Finish','istcoder-bookings'); ?> <br><?php /*if(!empty($finishdate)) { echo date('m/d/Y',strtotime($finishdate)); echo '  '.$timeslots1[0] .' to '.$timeslots2[0]; }*/ ?>
                          </div>
                           <div class="progress-bar <?php if(!empty($delivery)){ $delivery = date("m/d/Y", $delivery); ?> progress-bar-warning progress-bar-last <?php } ?>" role="progressbar" style="width:25%">
                            <?php _e('Delivery','istcoder-bookings'); ?><br><?php /*if(!empty($deliverydate)) { echo date('m/d/Y',strtotime($deliverydate)); echo '  '.$timeslots1[0] .' to '.$timeslots2[0]; }*/ ?> 
                          </div>
                        </div>
                        
                    </li>
                    <?php 
            endwhile;
           endif;
           ?>
            </ul>
             
            </div>
            
          </div>
        
    </div>
</div>
<?php }else{ 
    $url = home_url('/login');
        echo '<script>window.location.href = "'.$url.'"; </script>';
 } ?>