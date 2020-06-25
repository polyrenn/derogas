    <?php

    require_once('classes/all.php');

    $create = new All($connect);
    $date = $_POST['date'];
    $cid = rand(111111, 999999);
    $name = mysqli_real_escape_string($connect, $_POST['cname']);
    $phone = mysqli_real_escape_string($connect, $_POST['cphone']);
    $branch = $_POST['branch'];
    $change = 0;
    $changeStats = "none";
    $purchase = 0;
    $ratings = 0;

    $create->newCustomer($date, $cid, $branch, $name, $phone, $change, $changeStats, $purchase, $ratings);

    ?>