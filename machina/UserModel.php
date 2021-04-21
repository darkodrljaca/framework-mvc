<?php

namespace app\machina;

use app\machina\DbModel;

/**
 * Description of UserModel
 *
 * @author darko
 */
abstract class UserModel extends DbModel{
    
    abstract public function getDisplayName(): string;
    
}
