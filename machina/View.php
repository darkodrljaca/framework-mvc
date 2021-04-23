<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\machina;

/**
 * Description of View
 *
 * @author darko
 */
class View {
    
    public string $title = '';
    
    public function renderView($view, $params = []) {
        
        $viewContent = $this->viewContent($view, $params);
        $layoutContent = $this->layoutContent();        
        return str_replace('{{ content }}', $viewContent, $layoutContent);        
        
    }
    
    public function renderContent($viewContent) {
        
        $layoutContent = $this->layoutContent();        
        return str_replace('{{ content }}', $viewContent, $layoutContent);        
        
    }
    
    protected function layoutContent() {
        
        
        $layout = Application::$app->layout;
        if(Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }                
        
        // output caching:
        ob_start();
        include_once Application::$root_directory."/views/layouts/$layout.php";
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
