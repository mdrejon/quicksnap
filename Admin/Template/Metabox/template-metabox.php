<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Template for the Metabox.
 */

// Get the post meta value.
$data = isset( $args['_wtdqs_quicksnap_otp'] ) ? $args['_wtdqs_quicksnap_otp'] : '';


// Nonce Field.
wp_nonce_field( 'wtdqs_quicksnap', 'wtdqs_quicksnap_nonce' );

?>
<div class="wtdqs-metabox-option wtdqs-flexbox"> 
	<?php 
		// include a template file wordpress standard way. usinge load template function.
		load_template( WTDQS_QUICKSNAP_PATH . 'Admin/Template/Metabox/sidebar.php', true, $data ); 

	?>

	<div class="wtdqs-metabox-content">
		<div class="wtdqs-metabox-content-wrap">
		
			<!-- Load  General settings Template-->
			 <?php 
			 	load_template( WTDQS_QUICKSNAP_PATH . 'Admin/Template/Metabox/general-settings.php', true, $data ); 
			 ?>
			<!-- Load  General settings Template-->

			<!-- Load  Custom CSS Template-->
			 <?php 
			 	load_template( WTDQS_QUICKSNAP_PATH . 'Admin/Template/Metabox/custom-css.php', true, $data ); 
			 ?>
			<!-- Load  Custom CSS Template-->

			 


			
		</div>
	</div>

</div>
