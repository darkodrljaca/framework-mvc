<?php

namespace app\machina\form;

use app\machina\Model;
use app\machina\form\InputField;

/**
 * Description of Form
 *
 * @author darko
 */
class Form {
    
    public static function begin($action, $method) {        
        echo sprintf('<form action="%s" method="%s">', $action, $method);        
        return new Form();
    }
    
    public static function end() {
        echo '</form>';
    }
    
    public function field(Model $model, $attribute) {
        return new InputField($model, $attribute);
    }
    
    
    
}
