<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $custom_css = isset( $args['custom_css'] ) ? $args['custom_css'] : '';
?>



<!-- Custom Css  -->
<div class="wtdqs-tabs-item" id="custom-css"> 
    <div class="wtdqs-metabox-field">
        <div class="wtdqs-metabox-field-wrap">
            <label for="_wtdqs_quicksnap_otp[custom_css]"><?php echo esc_html( __( 'Custom CSS', 'quicksnap' ) ); ?></label>
            <span><?php echo esc_html( __( 'Add Custom CSS', 'quicksnap' ) ); ?></span>
            <textarea name="_wtdqs_quicksnap_otp[custom_css]" id="wtdqs_quicksnap_otp_custom_css" cols="30" rows="10"><?php echo esc_html( isset( $custom_css ) ? $custom_css : '' ); ?></textarea>
        </div>
    </div>
</div>
<!-- Custom Css  -->
