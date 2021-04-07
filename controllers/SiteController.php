<?php

namespace app\controllers;

use app\machina\Application;
use app\machina\Controller;
use app\machina\Request;

/**
 * Description of SiteController
 *
 * @author darko
 */
class SiteController extends Controller {
    
    
    public function home() {
        $params = [
            'name' => 'TheCodeholic'
        ];
        return $this->render('home', $params);
    }
    
    public function contact() {
        return $this->render('contact');
    }
    
    public function about() {
        return $this->render('about-us');
    }
    
    public function handleContact(Request $request) {
        
        $body = $request->getBody(); 
        
        var_dump($body);
        exit;
        
        return "Handling submitted data";
    }
    
}
