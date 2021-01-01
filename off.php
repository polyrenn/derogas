<?php

session_start();

$connect = mysqli_connect('localhost', 'root', 'YES', 'dero');
if($connect->connect_error) {
    echo "Connection failed";
}else {
    echo "Connected successfully";
}
$servername = "3.132.12.249";
$username = "root";
$password = "derogas";
$dbname = "dero2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    echo "Connection failed";
}else {
  echo "Connected successfully";

}


$date = date('Y-m-d', strtotime('now'));
$branchCode = $_SESSION['Bcode'];

// Check if Offline Already Uploaded 


//Get Offline Crbs

$crbs = "SELECT * FROM crbs WHERE datee = '$date' AND branch = '$branchCode' ";
$gocrbs = mysqli_query($connect, $crbs);
while($gapc = mysqli_fetch_array($gocrbs)) {
    $crbnumber = $gapc['crbnumber'];
    $datee = $gapc['datee'];
    $timee = $gapc['timee'];
    $branch = $gapc['branch'];
    $cus = $gapc['customer'];
    $phone = $gapc['phone'];
    $cat = $gapc['category'];
    $kg = $gapc['kg'];
    $quantity = $gapc['quantity'];
    $tquant = $gapc['tquant'];
    $amount = $gapc['amount'];
    $amount2 = $gapc['amount2'];

    $sql = "INSERT INTO crbs (crbnumber, datee, timee, branch, customer, phone, category, kg, quantity, tquant,
    amount, amount2)
    VALUES ('$crbnumber', '$datee', '$timee', '$branch', '$cus', '$phone', 'Offline-$cat', '$kg', '$quantity',
    '$tquant', '$amount', '$amount2')";

    if (mysqli_query($conn, $sql)) {
    echo "New record created successfully<br>";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
}


//Get Offline CompleteSales
$completesales = "SELECT * FROM completeSales WHERE datee = '$date' AND branch = '$branchCode' ";
$gocomplete = mysqli_query($connect, $completesales);

while($gap = mysqli_fetch_array($gocomplete)){
    $branch = $gap['branch'];
    $reciept = $gap['reciept'];
    $date = $gap['datee'];
    $time = $gap['timee'];
    $customer = $gap['customer'];
    $phone = $gap['phone'];
    $payment = $gap['payment'];
    $cash = $gap['cash'];
    $kg = $gap['kg'];
    $quantity = $gap['quantity'];
    $allKg = $gap['allKg'];
    $amount = $gap['amount'];
    $narrate = $gap['narrative'];
    $changee = $gap['changee'];
    $prvchange = $gap['prvchange'];
    
    $sql = "INSERT INTO completeSales (branch, reciept, datee, timee, customer, phone, payment, cash, kg, quantity, allKg, amount, narrative, changee, prvchange) 
    VALUES ('$branch', '$reciept', '$date', '$time', '$customer', '$phone', '$payment', '$cash', '$kg', '$quantity', '$allKg', '$amount', '$narrate', '$changee', '$prvchange')";


      if (mysqli_query($conn, $sql)) {
        echo "New record created successfully<br>";
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
}


//Get Offline FinalSales
$finalsales = "SELECT * FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' ";
$gofinal = mysqli_query($connect, $finalsales);



        
while($gapf = mysqli_fetch_array($gofinal)) { 

        $prv = "SELECT opening, balancee, closing, tankUse FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' ORDER BY id DESC LIMIT 1 ";
        $goprv =  mysqli_query($conn, $prv);
        $row = mysqli_fetch_array($goprv);
        $open = $row['opening'];
        $bal = $row['balancee'];
        $close = $row['closing'];
        $tuse = $row['tankUse'];
        
        $branchCode = $gapf['branch'];
        $reciept = $gapf['reciept'];
        $date = $gapf['datee'];
        $time = $gapf['timee'];
        $customer = $gapf['customer'];
        $category = $gapf['category'];
        $phone = $gapf['phone'];
        $payment = $gapf['payment'];
        $amm = $gapf['cash'];
        $kggg = $gapf['kg'];
        $q = $gapf['quantity'];
        $ammm = $gapf['amount'];
        $status = $gapf['salesStatus'];
        $changee = $gapf['changee'];
        $changeD = $gapf['changeD'];
        $finalamount = $gapf['finalTotal'];
        $tank = $gapf['tankUse'];
        $openTank = $bal;
        $remain = $bal - $kggg;
        $remained = $close - $kggg;

        

       

        $sql = "INSERT INTO finalsales (branch, reciept, datee, timee, customer,category, phone, payment, cash, kg, quantity, amount, salesStatus, changee,changeD, finalTotal, tankUse, opening, balancee, closing)
        VALUES ('$branchCode', '$reciept', '$date', '$time', '$customer', 'Offline-$category', '$phone', '$payment', '$amm', '$kggg','$q','$ammm', '$status', '$changee', '$changeD', '$finalamount', '$tuse','$openTank', '$remain', '$remained')";

        //update customer record
        $g =  "SELECT * FROM customers WHERE Cphone = '$phone' AND branch = '$branchCode' ";
        $rol = mysqli_query($conn, $g);
        if($rol){
            while ($rr = mysqli_fetch_array($rol)) {
                $bought = $rr['CpurchaseCount'];
                $cha = $rr['Cchange'];
            }
            
            $credit = "UPDATE customers SET CpurchaseCount = $bought + 1 WHERE Cphone = '$phone' ";
            $doCredit = mysqli_query($conn, $credit);
            
        }

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully<br>";
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        

}

// Select Sum Kg from Offline Sales
$gffz = "SELECT SUM(kg) FROM finalsales WHERE  branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
$ggffz = mysqli_query($connect, $gffz);
$towfz = mysqli_fetch_array($ggffz);
$kggg = $towfz['SUM(kg)'];
echo $kggg;


$fla = "SELECT * FROM gasStations WHERE Bcode = '$branchCode' ";
$gama = mysqli_query($conn, $fla);
                      
if(mysqli_num_rows($gama) > 0){
                          
    while($row = mysqli_fetch_array($gama)){
        $tank = $row["BtankUse"];
        $tankA = $row["BtankA"];
        $tankB = $row["BtankB"];
                              
    }
}

echo $branchCode;

if($tank == 'Tank A'){ 
 $remaining = $tankA - $kggg;
 $gabble = "UPDATE gasStations SET BtankA = '$remaining' WHERE Bcode = '$branchCode' ";
 $gogabble = mysqli_query($conn, $gabble);
                          
}elseif($tank == 'Tank B') {
 $remaining = $tankB - $kggg;
 $gabble = "UPDATE gasStations SET BtankB = '$remaining' WHERE Bcode = '$branchCode' ";
 $gogabble = mysqli_query($conn, $gabble);
                          
}



mysqli_close($conn);
$message = "Uploaded succesfully.";
header("Location: crbHome.php?msg=true&type=error&details=". urlencode($message) );
?>
