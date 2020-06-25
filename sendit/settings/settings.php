<?php
class Airplay{
    public static function header() {
          return header("Content-type: application/json");
        
    }
    
    
    //token genrator
    public static function token($length = 32) {
    // Create random token
    $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz012345678930_';

    $max = strlen($string) - 1;

    $token = '';

    for ($i = 0; $i < $length; $i++) {
        $token .= $string[mt_rand(0, $max)];
    }

    return $token;
}
}

