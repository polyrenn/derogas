    <?php

    require_once ("classes/all.php");
    $go = new All($connect);

    $no = $_POST['salesCrb'];



    $go->getsalescrb($no);



    ?>