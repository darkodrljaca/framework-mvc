<?php

namespace app\machina;

/**
 * Description of Controller
 *
 * @author darko
 */
class Controller {
    
    public function render($view, $params = []) {
        
        return Application::$app->router->renderView($view, $params);
        
    }
    
}
