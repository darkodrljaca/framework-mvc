<?php


namespace app\models;

use app\machina\Model;

/**
 * Description of RegisterModel
 *
 * @author darko
 */
class RegisterModel extends Model {
    
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $confirmPassword;
    
    public function register() {
        
        echo 'Creating new user';
        
    }
    
}
