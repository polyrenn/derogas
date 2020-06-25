<?php
require_once 'lib/airplay.php';
require_once 'settings/settings.php';
require BASE_PATH . 'vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);
if(!empty($data)){
//    $gis = DB::insert('errand', [
//        'userid' =>$data['userid'],
//        'pid' => $data['pid'],
//        'data' => $data['data'],
//        'timestamp' => time()
//    ]);
    
   echo time(); 
    
}

