<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


    // Get all post types including custom post types and pages.  with name and value.
    $post_types = get_post_types( array( 'public' => true ), 'names' );
    unset( $post_types['attachment'] );
    unset( $post_types['wtdqs-quicksnap'] );
 

    $post_type             = isset( $args['post_type'] ) ? $args['post_type'] : '';
    $maximum_items_display = isset( $args['maximum_items_display'] ) ? $args['maximum_items_display'] : '';
    $is_thumbnail          = isset( $args['is_thumbnail'] ) ? $args['is_thumbnail'] : '';
    $thumbnail_position    = isset( $args['thumbnail_position'] ) ? $args['thumbnail_position'] : '';
    $is_excerpt            = isset( $args['is_excerpt'] ) ? $args['is_excerpt'] : '';
 ?>
<!-- Get template args -->


<!-- General Settings -->
<div class="wtdqs-tabs-item active" id="general-settings"> 
    <div class="wtdqs-flexbox">
        
        <div class="wtdqs-metabox-field wtdqs-width-50">
            <div class="wtdqs-metabox-field-wrap">
                <label for="_wtdqs_quicksnap_otp[post_type]"><?php echo esc_html( __( 'Select Post Type', 'quicksnap' ) ); ?></label>
                <span><?php echo esc_html( __( 'Select Post Type', 'quicksnap' ) ); ?></span>
                <select name="_wtdqs_quicksnap_otp[post_type]" id="_wtdqs_quicksnap_otp[post_type]"> 
                    <?php
                    foreach ( $post_types as $value ) {
                        $selected = $post_type === $value ? 'selected' : '';
                        ?>
                        <option value="<?php echo esc_attr( $value ); ?>" <?php echo esc_attr( $selected ); ?> ><?php echo esc_html( $value ); ?></option>
                    <?php } ?>
                </select>
            </div>
            
        </div>

        <div class="wtdqs-metabox-field  wtdqs-width-50">
            <div class="wtdqs-metabox-field-wrap">
                <label for="_wtdqs_quicksnap_otp[maximum_items_display]"><?php echo esc_html( __( 'Maximum Items Search Result', 'quicksnap' ) ); ?></label>
                <span><?php echo esc_html( __( 'Type Maximum Items To Dysplay', 'quicksnap' ) ); ?></span>
                <input type="number" id="_wtdqs_quicksnap_otp[maximum_items_display]" value="<?php echo esc_html( $maximum_items_display ); ?>" name="_wtdqs_quicksnap_otp[maximum_items_display]">
            </div>
        
        </div>

        <div class="wtdqs-metabox-field  wtdqs-width-50">
            <div class="wtdqs-metabox-field-wrap">
                <label for="_wtdqs_quicksnap_otp[is_thumbnail]"><?php echo esc_html( __( 'Show Thumbnail', 'quicksnap' ) ); ?></label>
                <span><?php echo esc_html( __( 'Enable Thumbnail', 'quicksnap' ) ); ?></span>
                <input type="checkbox" <?php echo  $is_thumbnail == 1 ? 'checked' : '';  ?> id="_wtdqs_quicksnap_otp[is_thumbnail]"    name="_wtdqs_quicksnap_otp[is_thumbnail]" >
            </div>
            
        </div>
        <div class="wtdqs-metabox-field  wtdqs-width-50">
            <div class="wtdqs-metabox-field-wrap">
                <label for="_wtdqs_quicksnap_otp[thumbnail_position]"><?php echo esc_html( __( 'Thumbnail Position', 'quicksnap' ) ); ?></label>
                <span><?php echo esc_html( __( 'Select Thumbnail Position', 'quicksnap' ) ); ?></span>
                <select name="_wtdqs_quicksnap_otp[thumbnail_position]" id="_wtdqs_quicksnap_otp[thumbnail_position]">
                    <option <?php echo '0' === $thumbnail_position ? 'selected' : ''; ?> value="0"><?php echo esc_html( __( 'Select Option', 'quicksnap' ) ); ?></option>
                    <option <?php echo 'left' === $thumbnail_position ? 'selected' : ''; ?> value="left"><?php echo esc_html( __( 'Left', 'quicksnap' ) ); ?></option>
                    <option <?php echo 'right' === $thumbnail_position ? 'selected' : ''; ?>  value="right"><?php echo esc_html( __( 'Right', 'quicksnap' ) ); ?></option>
                    <option <?php echo 'top' === $thumbnail_position ? 'selected' : ''; ?>  value="top"><?php echo esc_html( __( 'Top', 'quicksnap' ) ); ?></option>
                    <option <?php echo 'bottom' === $thumbnail_position ? 'selected' : ''; ?>  value="bottom"><?php echo esc_html( __( 'Bottom', 'quicksnap' ) ); ?></option>
                </select>
            </div>
            
        </div>
        <div class="wtdqs-metabox-field  wtdqs-width-50">
            <div class="wtdqs-metabox-field-wrap">
                <label for="_wtdqs_quicksnap_otp[is_excerpt]"><?php echo esc_html( __( 'Show Excerpt', 'quicksnap' ) ); ?></label>
                <span><?php echo esc_html( __( 'Enable Excerpt', 'quicksnap' ) ); ?></span>
                <input type="checkbox"  <?php echo  $is_excerpt == 1 ? 'checked' : '';  ?> id="_wtdqs_quicksnap_otp[is_excerpt]"  name="_wtdqs_quicksnap_otp[is_excerpt]">
            </div>
            
        </div> 
        
    </div>
</div>
<!-- General Settings -->