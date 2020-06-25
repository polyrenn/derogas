<?php

Class Akkadian {

    public static $message = [];

    public static function name($data) {
        
        if (!preg_match('/^[a-zA-Z ]*$/', trim(htmlspecialchars($data)))  || empty($data) ) {
            self::$message['name'] = 'Name can only contain letters and white spaces';
        } else {
            return;
        }
    }
    
    public static function emailcheck($data){
        return (!preg_match( "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $data)) 
        ? self::$message['email'] = 'Invalid email address' : TRUE; 
        
    }
    

}
