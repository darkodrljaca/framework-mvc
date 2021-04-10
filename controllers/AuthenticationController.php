<?php


namespace app\controllers;
use app\machina\Controller;
use app\machina\Request;
use app\models\RegisterModel;

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
        
        $registerModel = new RegisterModel();         
        
        if($request->isPost()) {
                        
            $registerModel->loadData($request->getBody());                        
            
            if($registerModel->validate() && $registerModel->register()) {
                return 'Success';
            }
                       
            
            return $this->render('register', [
                'model' => $registerModel
            ]);
            
        }
        
        $this->setLayout('auth');
        return $this->render('register', [
                'model' => $registerModel
        ]);
        
    }
    
}
