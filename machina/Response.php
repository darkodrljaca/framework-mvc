<?php

namespace app\machina;

/**
 * Description of Response
 *
 * @author darko
 */
class Response {
    
    public function statusCode(int $code) {
        http_response_code($code);
    }
    
}
