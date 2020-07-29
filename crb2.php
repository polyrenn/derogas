    <?php 

    require_once('classes/all.php');
    $do = new All($connect);

    $branch = $_POST['branch'];
    $lets = "SELECT id, crbnumber FROM crbs WHERE branch = '$branch' AND datee = '$datenow' AND category NOT REGEXP '^Offline' ORDER BY id DESC LIMIT 1";
    $get = mysqli_query($connect, $lets);
    $getData = $_POST['fi'];
    $fetch = preg_split("/\,/", $getData);
    
  
    while($row = mysqli_fetch_array($get)){
        $ccrb = $row['crbnumber'];
    }

    if(isset($_POST['kgg'])){

    $crb = $ccrb + 1;
    $name = $fetch[1];
    $phone = $fetch[0];
    $cat = $_POST['category'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $kg = $_POST['kgg'];
    $k = implode("", $kg);
    $quant = $_POST['qu'];
    $q = implode("", $quant);
    $tq = $_POST['tq'];
    $t = implode("", $tq);
    $amount = $_POST['am'];
    $a = implode("", $amount);

    }
        
        $do->newCRBB($crb, $date, $time, $branch, $name, $phone, $cat, $kg, $quant, $tq, $amount, $k, $q, $t, $a, $b);


    ?>
