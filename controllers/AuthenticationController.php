<?php


namespace app\controllers;
use app\machina\Controller;
use app\machina\Request;
use app\models\User;

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
        
        $user = new User();         
        
        if($request->isPost()) {
                        
            $user->loadData($request->getBody());                        
            
            if($user->validate() && $user->save()) {
                return 'Success';
            }
                       
            
            return $this->render('register', [
                'model' => $user
            ]);
            
        }
        
        $this->setLayout('auth');
        return $this->render('register', [
                'model' => $user
        ]);
        
    }
    
}
