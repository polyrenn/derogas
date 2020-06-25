    <?php

    require_once('classes/all.php');

    $create = new All($connect);

    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $password = mysqli_real_escape_string($connect, $_POST['pass']);

    $create->loginAll($phone, $password);
    ?>