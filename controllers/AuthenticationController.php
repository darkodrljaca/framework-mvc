<?php


namespace app\controllers;
use app\machina\Controller;
use app\machina\Request;

/**
 * Description of AuthenticationController
 *
 * @author darko
 */
class AuthenticationController extends Controller {
    
    public function login() {
        
        $this->setLayout('auth');
        
        return $this->render('login');
        
    }
    
    public function register(Request $request) {
        
        if($request->isPost()) {
            return 'Handle submitted data';
        }
        
        $this->setLayout('auth');
        return $this->render('register');
        
    }
    
}
