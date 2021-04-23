<?php


namespace app\machina\form;


class TextareaField extends BaseField {
    
    
    
    public function renderInput(): string {
        
        return sprintf('<textarea name="%s" class="form-controll%s">%s</textarea>', 
                
                    $this->attribute,
                    $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                    $this->model->{$this->attribute},
                
                );
        
    }

}
