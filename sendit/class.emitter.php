<?php

class Emitter {

    public static function Packet($id, $msg, $interval) {
        (int) $interval;
        global $token;
        echo "id: $id" . PHP_EOL;
        echo "data: $msg" . PHP_EOL;
        echo PHP_EOL;
        ob_flush();
        flush();
        sleep($interval);
    }

    public static function PacketConstructor($data) {


        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header("Connection: keep-alive");


        if (isset($_GET['token'])) {
            $counter = 1;
            while (true) {
              

                $token = $_GET['token'];




                $serverTime = time();
                $df = [];
                $df['lat'] = '+40.689060';
                $df['long'] = '-74.044636';
                $df['timestamp'] = time();

                $df['parcel_id'] = $token;

               // sendMsg($serverTime, json_encode($df));
                self::Packet($token, json_encode($data), 2);
            }
        }
    }

}

Emitter::PacketConstructor($data);