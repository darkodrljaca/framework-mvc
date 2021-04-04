<?php

namespace app\machina;

/**
 * Description of Router
 *
 * @author darko
 */
class Router {
    
    public Request $request;
    public Response $response;
    
    protected array $routes = [];
    
    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
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
            $this->response->statusCode(404);
            return "Not found";            
        }                
        
        if(is_string($callback)) {
            return $this->renderView($callback);
        }
        
        // execute function from index.php fillRoutes method, second parameter:
        return call_user_func($callback);
        
    }
    
    public function renderView($view) {
        
        $layoutContent = $this->layout();
        $viewContent = $this->renderContent($view);
        return str_replace('{{ content }}', $viewContent, $layoutContent);        
        
    }
    
    protected function layout() {
        
        // output caching:
        ob_start();
        include_once Application::$root_directory."/views/layouts/main.php";
        return ob_get_clean();
    }
    
    protected function renderContent($view) {
        ob_start();
        include_once Application::$root_directory."/views/$view.php";
        return ob_get_clean();
    }
    
}
