<?php

require_once 'lib/airplay.php';
$data = json_decode(file_get_contents('php://input'), true);
$message = [];
if (!empty($data)) {
    // check if email has been use on another account
    if (DB::check('riders', 'tel', trim($data['tel'])) > 0) {
        $message['error'] = true;
        $message['details'] = 'This phone number has been use on another account. If that is you just login';
        $message['status'] = 206;
        $message['timestamp'] = time();
        echo json_encode($message);
    } else {

        if (!empty($data['tel'])) {
            $cv = DB::insert('riders', [
                        'name' => trim(ucwords($data['name'])),
                        'tel' => trim($data['tel']),
                        'email' => trim($data['email']),
                        'address' => DB::grinder($data['address']),
                'origin' => DB::grinder($data['gender']),
                'marital' => DB::grinder($data['marital']),
                'created_by' => DB::grinder($data['created_by'])
                
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

