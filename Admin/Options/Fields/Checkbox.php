<?php 
namespace WTDQS_Quicksnap\Admin\Options\Fields;
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
 
class Checkbox extends Fields {
 
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
        
        ?>
        <div class="wtdqs-single-fields-wrapper wtdqs-fields-<?php echo esc_attr($type); ?>"
        style="width: calc(<?php echo esc_attr($width); ?> - 16px);"
        >
            <div class="wtdqs-single-fields-inner wtdqs-single-fields-<?php echo esc_attr($name); ?>">
               
                <?php 
                    echo !empty($label) ? '<h4 for="'.esc_attr($name).'">'.esc_html($label).'</h4>' : '';
                    echo !empty($sub_label) ? '<p>'.esc_html($sub_label).'</p>' : '';    
                ?>  
                <input type="checkbox" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" value="1" <?php checked( $this->value, 1 ); ?> />
                <?php 
                    echo !empty($description) ? '<p>'.esc_html($description).'</p>' : '';    
                ?>  
            </div>
        </div>
        <?php
    }

    
 
}

