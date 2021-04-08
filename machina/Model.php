<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\machina;

/**
 * Description of Model
 *
 * @author darko
 */
abstract class Model {
    
    public function loadData($data) {
        foreach ($data as $key=>$value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
        
        
    }
    
    public function validate() {
        
    }
    
}