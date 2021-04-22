<?php

/*
 * darkodrljaca@gmail.com
 */

namespace app\machina;

use app\machina\Controller;
use app\machina\DbModel;

/**
 * @author darko
 */
class Application {
    
    public Router $router;
    public Request $request;
    public static string $root_directory;
    public string $layout = 'main';
    public string $userClass;
    public Response $response;
    public Session $session;
    public Database $db;
    public static Application $app;
    public ?Controller $controller = null;    
    // ? this might be null:
    public ?DbModel $user;
    
    public function __construct($root_path, array $config) {
        
        $this->userClass = $config['userClass'];
        self::$root_directory = $root_path;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);        
        
        $this->db = new Database($config['db']);
        
        
        $primaryValue = $this->session->get('user');
        if($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();        
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
        
                
    }
    
    
    public function getController() {
        return $this->controller;
    }
    
    public function setController(Controller $controller) {
        $this->controller = $controller;
    }
    
    public function run() {
        
        try {
            echo $this->router->getPathAndMethod();
        } catch (\Exception $ex) {
            $this->response->statusCode($ex->getCode());
            echo $this->router->renderView('_error', [
                'exception' => $ex
            ]);
        }
        
    }
    
    public function login(DbModel $user) {
        
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        // primary key property:
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        
        return true;
        
    }
    
    public function logout() {
        
        $this->user = null;
        $this->session->remove('user');
        
    }
    
    public static function isGuest() {
        
        return !self::$app->user;
        
    }
    
}
