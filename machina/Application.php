<?php

/*
 * darkodrljaca@gmail.com
 */

namespace app\machina;

use app\machina\Controller;

/**
 * @author darko
 */
class Application {
    
    public Router $router;
    public Request $request;
    public static string $root_directory;
    public Response $response;
    public static Application $app;
    public Controller $controller;
    
    public function __construct($root_path) {
        
        self::$root_directory = $root_path;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);        
                
    }
    
    
    public function getController() {
        return $this->controller;
    }
    
    public function setController(Controller $controller) {
        $this->controller = $controller;
    }
    
    public function run() {
        
       echo $this->router->getPathAndMethod();
        
    }
    
    
}
