<?php

require_once 'lib/airplay.php';
$data = json_decode(file_get_contents('php://input'), true);
$message = [];
if (!empty($data)) {
    // check if email has been use on another account
    if (DB::check('users', 'tel', trim($data['tel'])) > 0) {
        $message['error'] = true;
        $message['details'] = 'This phone number has been use on another account. If that is you just login';
        $message['status'] = 206;
        $message['timestamp'] = time();
        echo json_encode($message);
    } else {

        if (!empty($data['email'])) {
            $cv = DB::insert('users', [
                        'name' => trim(ucwords($data['name'])),
                        'tel' => trim($data['tel']),
                        'email' => trim($data['email']),
                        'password' => password_hash($data['password'], PASSWORD_BCRYPT)
            ]);
            if ($cv) {
                $message['success'] = true;
                $message['details'] = 'Your account has been created';
                $message['status'] = 201;
                $message['timestamp'] = time();
                echo json_encode($message);
            } else {

                $message['error'] = true;
                $message['details'] = ' Account could not be created. Invalid data submitted. Try again please';
                $message['status'] = 206;
                $message['timestamp'] = time();
            }
        }
    }
}

