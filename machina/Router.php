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

    
    public function get($path, $callback) {
        
        $this->routes['get'][$path] = $callback;
        
    }
    
    public function post($path, $callback) {
        
        $this->routes['post'][$path] = $callback;
        
    }
    
    public function getPathAndMethod() {
        
        $path = $this->request->getPath();
        
        $method = $this->request->getMethod();        
        
        // if route in index.php doesn't exist then return false:
        $callback = $this->routes[$method][$path] ?? false;        
        
        if($callback === false) {
            $this->response->statusCode(404);
            return $this->renderView("not-found");            
        }                
        
        if(is_string($callback)) {
            return $this->renderView($callback);
        }                
        
        if(is_array($callback)) {
            $callback[0] = new $callback[0]();
        }                
        
        
        
        // execute function from index.php get or post method, second parameter:
        return call_user_func($callback, $this->request);
        
    }
    
    public function renderView($view, $params = []) {
        
        $layoutContent = $this->layoutContent();
        $viewContent = $this->viewContent($view, $params);
        return str_replace('{{ content }}', $viewContent, $layoutContent);        
        
    }
    
    public function renderContent($viewContent) {
        
        $layoutContent = $this->layoutContent();        
        return str_replace('{{ content }}', $viewContent, $layoutContent);        
        
    }
    
    protected function layoutContent() {
        
        // output caching:
        ob_start();
        include_once Application::$root_directory."/views/layouts/main.php";
        return ob_get_clean();
    }
    
    protected function viewContent($view, $params) {                

        foreach ($params as $key => $value) {
            $$key = $value;
        }                
        
        ob_start();
        include_once Application::$root_directory."/views/$view.php";
        return ob_get_clean();
    }
    
}
