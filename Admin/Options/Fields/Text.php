<?php 
namespace WTDQS_Quicksnap\Admin\Options\Fields;
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
 
class Text extends Fields {
 
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
        $type = isset($this->fields['type']) ? $this->fields['type'] : 'text';
        $name = isset($this->fields['name']) ? $this->fields['name'] : '';
        $label = isset($this->fields['label']) ? $this->fields['label'] : '';
        $sub_label = isset($this->fields['sub_label']) ? $this->fields['sub_label'] : '';
        $description = isset($this->fields['description']) ? $this->fields['description'] : ''; 
        $width = isset($this->fields['width']) ? $this->fields['width'] : '100%';
        $input_type = isset($this->fields['input_type']) ? $this->fields['input_type'] : 'text';
 
        
        ?>
        <div class="wtdqs-single-fields-wrapper wtdqs-fields-<?php echo esc_attr($type); ?>"
        style="width: calc(<?php echo esc_attr($width); ?> - 16px);"
        >
            <div class="wtdqs-single-fields-inner wtdqs-single-fields-<?php echo esc_attr($name); ?>">
               
                <?php 
                    echo !empty($label) ? '<label for="'.esc_attr($name).'">'.esc_html($label).'</label>' : '';
                    echo !empty($sub_label) ? '<p>'.esc_html($sub_label).'</p>' : '';    
                ?> 
                <input type="<?php echo esc_attr($input_type); ?>" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($this->value); ?>" />
                 
                <?php 
                    echo !empty($description) ? '<p>'.esc_html($description).'</p>' : '';    
                ?>  
            </div>
        </div>
        <?php
    }

    
 
}

