    <?php

    require_once('classes/all.php');
    session_start();
    session_destroy();
    header("Location: portal.php");

    ?>