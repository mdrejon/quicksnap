<?php 
 
namespace WTDQS_Quicksnap\Admin\Options\Fields;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Fields {
    public $metabox_name = '';
    public $fields = array();
    public $value = array();

    public function __construct($metabox_name, $fields = array(), $value = array()) { 
        $this->fields = $fields;
        $this->metabox_name = $metabox_name;
        $this->value = $value;  
    } 

    // Set Metabox Fields dynamically
    public static function set_fields($metabox_name, $fields, $value) {
        $field_type = isset($fields['type']) ? $fields['type'] : 'default';
        $class_name = __NAMESPACE__ . '\\' . ucfirst($field_type) ; 

        if (class_exists($class_name)) {
            return new $class_name($metabox_name, $fields, $value);
        }

        // Fallback to the base Fields class if specific field class doesn't exist
        return new self($metabox_name, $fields, $value);
    }
}