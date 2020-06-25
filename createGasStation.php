    <?php

    require_once('classes/all.php');

    $create = new All($connect);

    $company = $_POST['company'];
    $bname = mysqli_real_escape_string($connect, $_POST['bname']);
    $bcode = mysqli_real_escape_string($connect, rand(111111, 999999));
    $loadNumber = mysqli_real_escape_string($connect, $_POST['load']);
    $baddress = mysqli_real_escape_string($connect, $_POST['badd']);
    $loadType = $_POST['offload'];
    $destination = $_POST['tank'];
    $btankA = mysqli_real_escape_string($connect, $_POST['tankA']);
    $btankB = mysqli_real_escape_string($connect, $_POST['tankB']);
    $total = $btankA + $btankB;
    $bpurchasePrice = mysqli_real_escape_string($connect, $_POST['stockPrice']);
    $btankUse = mysqli_real_escape_string($connect, $_POST['tankInUse']);
    $date = $_POST['date'];

    $create->createGasStation($company, $bname, $bcode, $loadNumber, $baddress, $loadType, $destination,  $btankA, $btankB, $total, $bpurchasePrice, $btankUse, $date);



    ?>