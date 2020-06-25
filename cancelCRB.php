    <?php

    require_once ('classes/all.php');
    $cat = new All($connect);

    $branchCode = $_SESSION['Bcode'];
    echo $branchCode;
    $crbN = "SELECT crbnumber FROM crbs WHERE branch = '$branchCode' ORDER BY id DESC LIMIT 1";
    $rogue = mysqli_query($connect, $crbN);

            while($ggg = mysqli_fetch_array($rogue)){
                $crbNUn = $ggg['crbnumber'];
            }

            $conn = $crbNUn;

            echo $conn;
            

    // $cat -> delete($conn);

    ?>