<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 ?>

 <div class="wtdqs-metabox-sidebar">
     <ul class="wtdqs-metabox-tabs-menu">
        <!-- General Settings  -->
        <li>
            <a href="#" class="wtdqs-metabox-tabs-btn active wtdqs-flexbox wtdqs-gap-8" data-active="general-settings"> 
                <img clas="wtdqs-menu-icon" src="<?php echo WTDQS_QUICKSNAP_URL . '/assets/admin/icon/sliders-horizontal.svg';  ?>" alt="">
                
                <?php echo esc_html( __( 'General Settings', 'quicksnap' ) ); ?>
            </a>
        </li>
        <!-- General Settings  -->
 

        <!-- Custom CSS Settings  -->
        <li>
            <a href="#" class="wtdqs-metabox-tabs-btn wtdqs-flexbox wtdqs-gap-8" data-active="custom-css"> 
                <img clas="wtdqs-menu-icon" src="<?php echo WTDQS_QUICKSNAP_URL . '/assets/admin/icon/code.svg';  ?>" alt="">
                
                <?php echo esc_html( __( 'Custom CSS', 'quicksnap' ) ); ?>
            </a>
        </li>
        <!-- Custom CSS Settings  -->
  
  
 
     </ul>
 </div>