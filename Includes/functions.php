<?php 
// exit; // Exit if accessed directly

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wtdqs_print_r($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    return;
}