<?php 

require_once('classes/all.php');
$do = new All($connect);
$datenow = date('Y-m-d', strtotime('now'));
$branch = $_POST['branch'];
$lets = "SELECT id, crbnumber FROM crbs WHERE branch = '$branch' AND datee = '$datenow' ORDER BY id DESC LIMIT 1";
$get = mysqli_query($connect, $lets);
// $getData = $_POST['fi'];
//$fetch = preg_split("/\,/", $getData);
$fetch = $_POST['fi'];


while($row = mysqli_fetch_array($get)){
    $ccrb = $row['crbnumber'];
}

if(isset($_POST['kgg'])){

$crb = $ccrb + 1;
$name = $fetch;
$phone = '';
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
    
    $do->newCRB($crb, $date, $time, $branch, $name, $phone, $cat, $kg, $quant, $tq, $amount, $k, $q, $t, $a, $b);


?>
