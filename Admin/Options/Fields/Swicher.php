<?php 
namespace WTDQS_Quicksnap\Admin\Options\Fields;
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
class Swicher extends Fields {
 
    public $metabox_name = '';
    public $fields = array();
    public $value = array();
    /**
     *  Constructor.
     */
    public function __construct($metabox_name, $fields = array(), $value = array()) { 
        parent::__construct( $metabox_name, $fields, $value  );

    } 

    public function render() {
        echo $this->metabox_name;
        echo '<br>';
        print_r($this->fields);
        echo '<br>';
        echo $this->value;
        echo '<br>';
        echo '<br>';
    }

    
 
}

