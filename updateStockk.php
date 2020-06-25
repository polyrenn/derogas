    <?php

    require_once('classes/all.php');
    $create = new All($connect);

    $date = $_POST['date'];
    $code = $_POST['bcode'];
    $loadNumber = mysqli_real_escape_string($connect, $_POST['load']);
    $totalLoad = mysqli_real_escape_string($connect, $_POST['totalLoad']);
    $offloadType = mysqli_real_escape_string($connect, $_POST['offload']);
    $tank = mysqli_real_escape_string($connect, $_POST['tank']);
    $tankA = mysqli_real_escape_string($connect, $_POST['tankA']);
    $tankB = mysqli_real_escape_string($connect, $_POST['tankB']);
    $cost = mysqli_real_escape_string($connect, $_POST['cost']);


    $upTankA = $tankA;
    $upTankB = $tankB;
    $upTotal = $upTankA + $upTankB;

   

    $create->updateStock($date, $code, $loadNumber, $totalLoad, $offloadType, $tank, $tankA, $tankB, $cost, $upTankA, $upTankB, $upTotal);

    ?>