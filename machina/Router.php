<?php

namespace app\machina;

use app\machina\exception\NotFoundException;
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
        
        $method = $this->request->method();        
        
        // if route in index.php doesn't exist then return false:
        $callback = $this->routes[$method][$path] ?? false;        
        
        if($callback === false) {            
            throw new NotFoundException();
        }                
        
        if(is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }                
        
        if(is_array($callback)) {
            /** @var \app\machina\Controller $controller  */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;                       
            
            foreach($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
            
        }                
        
        // execute function from index.php get or post method, second parameter:
        return call_user_func($callback, $this->request, $this->response);
        
    }        
    
    
}
