<?php

namespace app\machina;

/**
 * Description of Request
 *
 * @author darko
 */
class Request {
    
    public function getPath() {
        
        $haystack = $_SERVER['REQUEST_URI'] ?? '/'; // ["REQUEST_URI"]=> string(11) "/users?id=1"
        $position = strpos($haystack, '?');
        if($position === false) {
            return $haystack;
        }
        return substr($haystack, 0, $position);        
    }
    
    public function method() {
        
        return strtolower($_SERVER['REQUEST_METHOD']);
        
    }
    
    public function isGet() {
        
        return $this->method() === 'get';
        
    }
    
    public function isPost() {
        
        return $this->method() === 'post';
        
    }
    
    public function getBody() {
        
        $body = [];
        
        if($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        
        if($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        
        return $body;
        
    }
    
}
