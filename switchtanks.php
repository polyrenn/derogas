    <?php

    require_once('classes/all.php');

    $go = new All($connect);

    $code = $_POST['bcode'];
    $value = $_POST['tanks'];

    $go->switchTanks($code, $value);

    ?>