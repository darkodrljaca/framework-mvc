<?php

namespace app\controllers;

use app\machina\Application;
use app\machina\Controller;
use app\machina\Request;
use app\machina\Response;
use app\models\ContactForm;

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
    
    public function contact(Request $request, Response $response) {
        $contact = new ContactForm();
        if($request->isPost()) {
            $contact->loadData($request->getBody());            
            if($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                return $response->redirect('/contact');
            }
        }        
        return $this->render('contact', [
            'model' => $contact
        ]);
    }
    
    public function about() {
        return $this->render('about-us');
    }        
    
}
