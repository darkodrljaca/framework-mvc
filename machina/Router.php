<?php

namespace app\machina;

/**
 * Description of Router
 *
 * @author darko
 */
class Router {
    
    public Request $request;
    
    protected array $routes = [];
    
    public function __construct(Request $request) {
        $this->request = $request;
    }

    
    public function fillRoutes($path, $callback) {
        
        $this->routes['get'][$path] = $callback;
        
    }
    
    public function getPathAndMethod() {
        
        $path = $this->request->getPath();
        
        $method = $this->request->getMethod();        
        
        // if route in index.php doesn't exist then return false:
        $callback = $this->routes[$method][$path] ?? false;                
        
        if($callback === false) {
            echo 'Not found';
            exit;
        }
        
        // execute function from index.php fillRoutes method, second parameter:
        echo call_user_func($callback);
        
    }
    
}
