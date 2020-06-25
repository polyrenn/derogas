    <?php

    require_once('classes/all.php');

    $lets = new All($connect);

    $name = mysqli_real_escape_string($connect, $_POST['cname']);
    $comCode = rand(111111, 999999);

    $lets->createCompany($name, $comCode);

    ?>