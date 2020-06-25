<?php

  session_start();


  require_once ('classes/all.php');
  date_default_timezone_set("Africa/Lagos");
  $id = $_SESSION['id'];
  $username = $_SESSION['username'];
  $company = $_SESSION['CompanyName'];
  $branch = $_SESSION['Bname'];
  $branchCode = $_SESSION['Bcode'];
  $createStation = new All($connect);

  if(!isset($_SESSION['username'])){
    header('Location: portal.php');
  }

       $status = urldecode($_GET['details']);
      
      $date = date('Y-m-d', strtotime('now'));

  $opening = "SELECT BtankA, BtankB, BtankUse FROM gasStations WHERE Bcode = '$branchCode'";
  $openingstock = mysqli_query($connect, $opening);

      if(mysqli_num_rows($openingstock) > 0){

          while($row = mysqli_fetch_array($openingstock)){
              $tank = $row["BtankUse"];
              $tankA = $row["BtankA"];
              $tankB = $row["BtankB"];
          
          }

      }
      if($tank == 'Tank A'){
        $tank = $tank;
          $remaining = $tankA;

        $fish = "SELECT * FROM finalsales WHERE branch = '$branchCode' AND datee = '$date'";
        $star = mysqli_query($connect, $fish);
        if(mysqli_num_rows($star) < 0){
          $openTank = $tankA;
        }else{
          $openTank = $remaining;
        }
          
      }elseif($tank == 'Tank B'){
        $tank = $tank;
        $remaining = $tankB;

        $fish = "SELECT * FROM finalsales WHERE branch = '$branchCode'  AND datee = '$date'";
        $star = mysqli_query($connect, $fish);
        if(mysqli_num_rows($star) < 0){
          $openTank = $tankB;
        }else{
          $openTank = $remaining;
        }
      }

      //show stats on salespoint
      $stats = "SELECT SUM(kg) FROM finalsales WHERE branch = '$branchCode' AND tankUse = '$tank' AND category != 'Switchcontroler' ";
      $gostats = mysqli_query($connect, $stats);
      if($gostats){
        while($st = mysqli_fetch_array($gostats)){
          $allKgg = $st['SUM(kg)'];
        }
      }

  if(isset($_POST['salesCrb'])){

      $crb = $_POST['salesCrb'];
      $sql = "SELECT * FROM salespoint WHERE branch = '$branchCode' AND crbnumber = '$crb' ";
      $go = mysqli_query($connect, $sql);

      if(mysqli_num_rows($go) > 0){

          while($row = mysqli_fetch_array($go)){

              $crb = $row['crbnumber'];
              $phone = $row['phone'];
              $name = $row['customer'];
              $category = $row['category'];
              $kg = $row['kg'];
              $date = $row['datee'];
              $time = $row['timee'];
              $branch = $row['branch'];
              $quantity = $row['quantity'];
              $amount = $row['amount'];


           if (empty($phone)) {
              $phone = "Nil";
            }else{
              $phone = $phone;
            }


            if (empty($name)) {
              $name = "Customer";
            }else{
              $name = $name;
            }

          }

      }



       $sqll = "SELECT * FROM salespoint WHERE branch = '$branchCode' AND crbnumber = '$crb' ";
      $gash = mysqli_query($connect, $sqll);

      $sql2 = "SELECT kg, quantity, amount FROM salespoint WHERE branch = '$branchCode' AND crbnumber = '$crb' ";
      $go2 = mysqli_query($connect, $sql2);

      $train = "SELECT SUM(kg), SUM(quantity), SUM(amount), SUM(amount2) FROM salespoint WHERE crbnumber = $crb AND branch = '$branchCode'";
          $su = mysqli_query($connect, $train);

      $cus = "SELECT * FROM customers WHERE Cphone = '$phone' ";
      $cusgo = mysqli_query($connect, $cus);

       $z = "SELECT amount2 FROM salespoint WHERE crbnumber = '$crb' AND branch = '$branchCode' ORDER BY id DESC LIMIT 1 ";
       $k = mysqli_query($connect, $z);
                                 


      if(mysqli_num_rows($cusgo) > 0){
          while($ga = mysqli_fetch_array($cusgo)){
              $change = $ga['Cchange'];
          }
      }

  }

  if(isset($_POST['com'])){
  
      $branchCode = $_SESSION['Bcode'];
      //get values
      $phonee = $_POST['cphone'];
      $name = $_POST['namea'];
      $crb = $_POST['crb'];
      $reciept = $crb;
      $payment = $_POST['payment'];
      $money = $_POST['cashh'];
      $narrate = $_POST['narrative'];
      $paid = $_POST['paid'];
      
      
      
      $conny = "SELECT reciept FROM stepcomplete WHERE datee = '$date' AND branch = '$branchCode' AND reciept = '$crb' ";
      $canny = mysqli_query($connect, $conny);
      if(mysqli_num_rows($canny) > 0){
          
          $message = "Duplicate sales submition prevented. Please proceed to print reciept.";
          header("Location: salespoint.php?msg=true&type=error&details=". urlencode($message) );
          
      }else{
          
          $squee = "SELECT SUM(amount), SUM(amount2) FROM salespoint WHERE crbnumber = '$crb' AND branch = '$branchCode' ";
          $squ = mysqli_query($connect, $squee);
          $rt = mysqli_fetch_array($squ);
          $t1 = $rt['SUM(amount)'];
          $t2 = $rt['SUM(amount2)'];
          
          
          
          
          if($t1 != $t2){
              // means the customer's previous change was debited
              
              
              
              //get current tank
              $stock = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode, gasStations.BtankUse FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND gasStations.Bcode = '$branchCode'";
              $lastock = mysqli_query($connect, $stock);
              
              if(mysqli_num_rows($lastock) > 0){
                  while($row = mysqli_fetch_array($lastock)){
                      $tank = $row['BtankUse'];
                  }
                  if($tank == 'Tank A'){
                      $tank = 'Tank A';
                  }elseif($tank == 'Tank B'){
                      $tank = 'Tank B';
                      
                  }
                  
                  
                  //get details from sales point
                  $sales = "SELECT * FROM salespoint WHERE crbnumber = '$crb' AND branch = '$branchCode' ";
                  $runsales = mysqli_query($connect, $sales);
                  
                  
                  $zz = "SELECT * FROM customers WHERE Cphone = '$phonee' ";
                  $zzgo = mysqli_query($connect, $zz);
                  while($rrr = mysqli_fetch_array($zzgo)){
                      $prevchange = $rrr['Cchange'];
                      
                  }
                  
                  $trr = "SELECT SUM(amount) FROM salespoint WHERE crbnumber = '$crb' AND branch = '$branchCode' ";
                  $suu = mysqli_query($connect, $trr);
                  
                  if($suu){
                      
                      while($gagaa = mysqli_fetch_array($suu)){
                          
                          $famount = $gagaa['SUM(amount)'];
                          
                      }
                  }
                  
                  if(mysqli_num_rows($runsales) > 0){
                      while($run = mysqli_fetch_array($runsales)){
                          $date = $run['datee'];
                          $time = $run['timee'];
                          $customer = $run['customer'];
                          $phone = $run['phone'];
                          $kg = $run['kg'];
                          $quantity = $run['quantity'];
                          $amount = $run['amount'];
                          $kgValue = $kg * $quantity;
                          $category = $run['category'];
                          
                          
                          
                          $cus = "SELECT * FROM customers WHERE Cphone = '$phone' ";
                          $cusgo = mysqli_query($connect, $cus);
                          
                          
                          if($narrate == "Failed - ATM Declined"){
                              $status = "Failed - ATM Declined";
                          }elseif($narrate == "Failed - Transfer Failed"){
                              $status = "Failed - Transfer Failed";
                          }elseif($narrate == "Failed - Cylinder Error"){
                              $status = "Failed - Cylinder Error";
                          }elseif($narrate == "Successful"){
                              $status = "Successful ";
                              $changee = $paid - $money;
                              
                          }
                          
                          if (empty($phone)) {
                              $phone = "Nil";
                          }else{
                              $phone = $phone;
                          }
                          
                          
                          if (empty($customer)) {
                              $customer = "Customer";
                          }else{
                              $customer = $customer;
                          }
                          
                          
                          //populate completeSales table
                          $make = "INSERT INTO stepcomplete (branch, reciept, datee, timee, customer, phone, payment, cash, kg, quantity, allKg, amount, narrative, changee, prvchange)
                          VALUES ('$branchCode', '$reciept', '$date', '$time', '$customer', '$phone', '$payment', '$amount', '$kg', '$quantity','$kgValue' , '$amount', '$narrate', '$changee', '$prevchange')";
                          
                          $runthis = mysqli_query($connect, $make);
                      }
                      
                      $gas = "SELECT SUM(allKg), SUM(amount), SUM(quantity) FROM stepcomplete WHERE reciept = '$crb' AND branch = '$branchCode'  ";
                      $give = mysqli_query($connect, $gas);
                      if($give){
                          while ($row = mysqli_fetch_array($give)) {
                              $kggg = $row['SUM(allKg)'];
                              $ammm = $row['SUM(amount)'];
                              $qqqq = $row['SUM(quantity)'];
                          }
                      }
                      
                      // display the tank information
                      
                      $fla = "SELECT * FROM gasStations WHERE Bcode = '$branchCode' ";
                      $gama = mysqli_query($connect, $fla);
                      
                      if(mysqli_num_rows($gama) > 0){
                          
                          while($row = mysqli_fetch_array($gama)){
                              $tank = $row["BtankUse"];
                              $tankA = $row["BtankA"];
                              $tankB = $row["BtankB"];
                              
                          }
                      }
                      if($tank == 'Tank A'){
                          $remaining = $tankA - $kggg;
                          $gabble = "UPDATE gasStations SET BtankA = '$remaining' WHERE Bcode = '$branchCode' ";
                          $gogabble = mysqli_query($connect, $gabble);
                          
                      }elseif($tank == 'Tank B'){
                          $remaining = $tankB - $kggg;
                          $gabble = "UPDATE gasStations SET BtankB = '$remaining' WHERE Bcode = '$branchCode' ";
                          $gogabble = mysqli_query($connect, $gabble);
                          
                      }
                      
                      //get the change debited
                      $gf = "SELECT amount2 FROM salespoint WHERE crbnumber = '$crb' AND branch = '$branchCode' ORDER BY id DESC LIMIT 1 ";
                      $f = mysqli_query($connect, $gf);
                      $g = mysqli_fetch_array($f);
                      $splash = $g['amount2'];
                      
                      //           if (empty($phone)) {
                      //              $phone = "Nil";
                      //            }else{
                      //              $phone = $phone;
                      //            }
                      //
                      //
                      //            if (empty($customer)) {
                      //              $customer = "Customer";
                      //            }else{
                      //              $customer = $customer;
                      //            }
                      
                      
                      
                      $changeD = $famount - $splash;
                      $finalamount = $famount - $changeD;
                      
                      //populate finalsales table
                      $finalsales = " INSERT INTO stepfinal (branch, reciept, datee, timee, customer,category, phone, payment, cash, kg, quantity, amount, salesStatus, changee,changeD, finalTotal, tankUse, opening, balancee, closing)
                      VALUES('$branchCode', '$reciept', '$date', '$time', '$customer', '$category', '$phone', '$payment', '$ammm', '$kggg','$qqqq','$ammm', '$status', '$changee', '$changeD', '$finalamount', '$tank','$openTank', '$remaining', '$remaining')";
                      $gofinal = mysqli_query($connect, $finalsales);
                      
                      //update customer record
                      $g =  "SELECT * FROM customers WHERE Cphone = '$phone' ";
                      $rol = mysqli_query($connect, $g);
                      if($rol){
                          while ($rr = mysqli_fetch_array($rol)) {
                              $bought = $rr['CpurchaseCount'];
                              $cha = $rr['Cchange'];
                          }
                          
                          $credit = "UPDATE customers SET CpurchaseCount = $bought + 1 WHERE Cphone = '$phone' ";
                          $doCredit = mysqli_query($connect, $credit);
                          
                      }
                      
                      
                      
                      
                      $message = "Completing transaction... please print reciept.";
                      header("Location: salespoint.php?msg=true&type=error&details=". urlencode($message) );
                      //            //Send sms
                      //            $owneremail="creativenigeriablueprint@gmail.com";
                      //            $subacct="GAS";
                      //            $subacctpwd="Omamuli";
                      //            $sendto=$phone;
                      //            $sender="Aicogas";
                      //            $message="Thank you for your patronage : Kg Bought / Amount ".$kggg." KG/ ".$ammm." NGN : Change: ".$comChange." NGN. Thank You, Please Come Again.";
                      /* create the required URL */
                      /* destination number */
                      /* sender id */
                      /* message to be sent */
                      //            $url = "http://www.smslive247.com/http/index.aspx?"
                      //            ."cmd=sendmsg"
                      //            ."&owneremail=" . UrlEncode($owneremail)
                      //            ."&subacct=" . UrlEncode($subacct)
                      //            ."&subacctpwd=" . UrlEncode($subacctpwd)
                      //            ."&message=" . UrlEncode($message)
                      //            ."&sender=" .UrlEncode($sender)
                      //            ."&sendto=". UrlEncode($sendto);
                      
                      /* call the URL */
                      //            if ($f = @fopen($url, "r"))
                      //            {
                      //                  $answer = fgets($f, 255);
                      //                          if (substr($answer, 0, 1) == "+")
                      //                          {
                      //                                echo "SMS to $dnr was successful.";
                      //                    } else {
                      //                      echo "an error has occurred: [$answer].";
                      //                    }
                      //          }else {
                      //
                      //                  echo "Error: URL could not be opened.";
                      //          }
                  }
                  
              }
              
              
              
              
          }else{
              
              // means the customer's previous change was not debited
              
              
              
              //get current tank
              $stock = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode, gasStations.BtankUse FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND gasStations.Bcode = '$branchCode'";
              $lastock = mysqli_query($connect, $stock);
              
              if(mysqli_num_rows($lastock) > 0){
                  while($row = mysqli_fetch_array($lastock)){
                      $tank = $row['BtankUse'];
                  }
                  if($tank == 'Tank A'){
                      $tank = 'Tank A';
                  }elseif($tank == 'Tank B'){
                      $tank = 'Tank B';
                      
                  }
                  
                  
                  //get details from sales point
                  $sales = "SELECT * FROM salespoint WHERE crbnumber = '$crb' AND branch = '$branchCode' ";
                  $runsales = mysqli_query($connect, $sales);
                  
                  
                  $zz = "SELECT * FROM customers WHERE Cphone = '$phonee' ";
                  $zzgo = mysqli_query($connect, $zz);
                  while($rrr = mysqli_fetch_array($zzgo)){
                      $prevchange = $rrr['Cchange'];
                      
                  }
                  
                  $trr = "SELECT SUM(amount) FROM salespoint WHERE crbnumber = '$crb' AND branch = '$branchCode' ";
                  $suu = mysqli_query($connect, $trr);
                  
                  if($suu){
                      
                      while($gagaa = mysqli_fetch_array($suu)){
                          
                          $famount = $gagaa['SUM(amount)'];
                          
                      }
                  }
                  
                  if(mysqli_num_rows($runsales) > 0){
                      while($run = mysqli_fetch_array($runsales)){
                          $date = $run['datee'];
                          $time = $run['timee'];
                          $customer = $run['customer'];
                          $phone = $run['phone'];
                          $kg = $run['kg'];
                          $quantity = $run['quantity'];
                          $amount = $run['amount'];
                          $kgValue = $kg * $quantity;
                          $category = $run['category'];
                          
                          
                          
                          $cus = "SELECT * FROM customers WHERE Cphone = '$phone' ";
                          $cusgo = mysqli_query($connect, $cus);
                          
                          
                          if($narrate == "Failed - ATM Declined"){
                              $status = "Failed - ATM Declined";
                          }elseif($narrate == "Failed - Transfer Failed"){
                              $status = "Failed - Transfer Failed";
                          }elseif($narrate == "Failed - Cylinder Error"){
                              $status = "Failed - Cylinder Error";
                          }elseif($narrate == "Successful"){
                              $status = "Successful ";
                              $changee = $paid - $famount;
                              
                          }
                          
                          if (empty($prevchange)) {
                              $prevchange = 0;
                              
                          }else{
                              $prevchange = $prevchange;
                          }
                          //
                          //
                          //            if (empty($customer)) {
                          //              $customer = "Customer";
                          //                echo "Customer has no name";
                          //            }else{
                          //              $customer = $customer;
                          //            }
                          
                          
                          
                          
                          //populate completeSales table
                          $make = "INSERT INTO stepcomplete (branch, reciept, datee, timee, customer, phone, payment, cash, kg, quantity, allKg, amount, narrative, changee, prvchange)
                          VALUES ('$branchCode', '$reciept', '$date', '$time', '$customer', '$phone', '$payment', '$amount', '$kg', '$quantity','$kgValue' , '$amount', '$narrate', '$changee', '$prevchange')";
                          
                          $runthis = mysqli_query($connect, $make);
                      }
                      
                      $gas = "SELECT SUM(allKg), SUM(amount), SUM(quantity) FROM stepcomplete WHERE reciept = '$crb' AND branch = '$branchCode'  ";
                      $give = mysqli_query($connect, $gas);
                      if($give){
                          while ($row = mysqli_fetch_array($give)) {
                              $kggg = $row['SUM(allKg)'];
                              $ammm = $row['SUM(amount)'];
                              $qqqq = $row['SUM(quantity)'];
                          }
                      }
                      
                      // display the tank information
                      
                      $fla = "SELECT * FROM gasStations WHERE Bcode = '$branchCode' ";
                      $gama = mysqli_query($connect, $fla);
                      
                      if(mysqli_num_rows($gama) > 0){
                          
                          while($row = mysqli_fetch_array($gama)){
                              $tank = $row["BtankUse"];
                              $tankA = $row["BtankA"];
                              $tankB = $row["BtankB"];
                              
                          }
                      }
                      if($tank == 'Tank A'){
                          $remaining = $tankA - $kggg;
                          $gabble = "UPDATE gasStations SET BtankA = '$remaining' WHERE Bcode = '$branchCode' ";
                          $gogabble = mysqli_query($connect, $gabble);
                          
                      }elseif($tank == 'Tank B'){
                          $remaining = $tankB - $kggg;
                          $gabble = "UPDATE gasStations SET BtankB = '$remaining' WHERE Bcode = '$branchCode' ";
                          $gogabble = mysqli_query($connect, $gabble);
                          
                      }
                      
                      $finalamount = $famount;
                      
                      if (empty($phone)) {
                          $phone = "Nil";
                      }else{
                          $phone = $phone;
                      }
                      
                      
                      if (empty($customer)) {
                          $customer = "Customer";
                      }else{
                          $customer = $customer;
                      }
                      $changeD = 0;
                      
                      if (empty($changee)) {
                          $changee = 0;
                          
                      }else{
                          $changee = $changee;
                      }
                      
                      //populate finalsales table
                      $finalsales = " INSERT INTO stepfinal (branch, reciept, datee, timee, customer,category, phone, payment, cash, kg, quantity, amount, salesStatus, changee,changeD, finalTotal, tankUse, opening, balancee, closing)
                      VALUES('$branchCode', '$reciept', '$date', '$time', '$customer', '$category', '$phone', '$payment', '$ammm', '$kggg','$qqqq','$ammm', '$status', '$changee', '$changeD', '$finalamount', '$tank','$openTank', '$remaining', '$remaining')";
                      $gofinal = mysqli_query($connect, $finalsales);
                      
                      //update customer record
                      $g =  "SELECT * FROM customers WHERE Cphone = '$phone' ";
                      $rol = mysqli_query($connect, $g);
                      if($rol){
                          while ($rr = mysqli_fetch_array($rol)) {
                              $bought = $rr['CpurchaseCount'];
                              $cha = $rr['Cchange'];
                          }
                          
                          $credit = "UPDATE customers SET CpurchaseCount = $bought + 1 WHERE Cphone = '$phone' ";
                          $doCredit = mysqli_query($connect, $credit);
                          
                      }
                      
                      
                      
                      
                      $message = "Completing transaction... please print reciept.";
                      header("Location: salespoint.php?msg=true&type=error&details=". urlencode($message) );
                      //            //Send sms
                      //            $owneremail="creativenigeriablueprint@gmail.com";
                      //            $subacct="GAS";
                      //            $subacctpwd="Omamuli";
                      //            $sendto=$phone;
                      //            $sender="Aicogas";
                      //            $message="Thank you for your patronage : Kg Bought / Amount ".$kggg." KG/ ".$ammm." NGN : Change: ".$comChange." NGN. Thank You, Please Come Again.";
                      /* create the required URL */
                      /* destination number */
                      /* sender id */
                      /* message to be sent */
                      //            $url = "http://www.smslive247.com/http/index.aspx?"
                      //            ."cmd=sendmsg"
                      //            ."&owneremail=" . UrlEncode($owneremail)
                      //            ."&subacct=" . UrlEncode($subacct)
                      //            ."&subacctpwd=" . UrlEncode($subacctpwd)
                      //            ."&message=" . UrlEncode($message)
                      //            ."&sender=" .UrlEncode($sender)
                      //            ."&sendto=". UrlEncode($sendto);
                      
                      /* call the URL */
                      //            if ($f = @fopen($url, "r"))
                      //            {
                      //                  $answer = fgets($f, 255);
                      //                          if (substr($answer, 0, 1) == "+")
                      //                          {
                      //                                echo "SMS to $dnr was successful.";
                      //                    } else {
                      //                      echo "an error has occurred: [$answer].";
                      //                    }
                      //          }else {
                      //
                      //                  echo "Error: URL could not be opened.";
                      //          }
                  }
                  
              }
              
              
              
              
              
          }
          
      }

}
     
      

  if(isset($_POST['bad'])){
  
    $branchCode = $_SESSION['Bcode'];
    //get values
    $phonee = $_POST['cphone'];
    $crb = $_POST['crb'];
    $reciept = $crb;
    $payment = $_POST['payment'];
    $cash = $_POST['cash'];
    $pos = $_POST['pos'];
    $transfer = $_POST['transfer'];
    $narrate = $_POST['narrative'];
    $change = $_POST['change'];

  
    $catch = "SELECT * FROM Crbs WHERE crbnumber ='$crb' AND branch = '$branchCode' ";
    $catchme = mysqli_query($connect, $catch);
    if(mysqli_num_rows($catchme) > 0){
        while($cx = mysqli_fetch_array($catchme)){
          $date = $cx['datee'];
          $time = $cx['timee'];
          $customer = $cx['customer'];
          $phone = $cx['phone'];
        }
    }

    $trr = "SELECT SUM(kg), SUM(quantity), SUM(amount) FROM salespoint WHERE crbnumber = $crb AND branch = '$branchCode' ";
    $suu = mysqli_query($connect, $trr);

    if($suu){

      while($gagaa = mysqli_fetch_array($suu)){

          $famount = $gagaa['SUM(amount)'];
          $tkg = $gagaa['SUM(kg)'];
          $tqu = $gagaa['SUM(quantity)'];
      }
    }



    $cage = "INSERT INTO badCrbs (branch, crbnumber, datee, timee, customer, phone, kg, quantity, amount, narrative) 
    VALUES ('$branchCode', '$crb', '$date', '$time', '$customer', '$phone', '$tkg', '$tqu', '$famount', '$narrate')";
    $cageher = mysqli_query($connect, $cage);

    $dash = "UPDATE crbs SET kg = 0, quantity = 0, amount = 0, amount2 = 0, tquant = 0 WHERE crbnumber = '$crb' AND branch = '$branchCode' ";
    $dashgo = mysqli_query($connect, $dash);

    $rock = "DELETE FROM salespoint WHERE crbnumber = '$crb' AND branch = '$branchCode'";
    $flash = mysqli_query($connect, $rock);

    if($flash){
        $message = "Transaction canceled successfully.";
        header("Location: salespoint.php?msg=true&type=error&details=". urlencode($message) );
    }else{
        $message = "Error canceling transaction";
        header("Location: salespoint.php?msg=true&type=error&details=". urlencode($message) );
    }

  }

  if(isset($_POST['debit'])){
   
    $changedebit = $_POST['debit'];
    $crb = $_POST['ccrb'];

    $r = "SELECT * FROM salespoint WHERE crbnumber = '$crb' AND branch = '$branchCode' ";
    $ra = mysqli_query($connect, $r);
    $f = mysqli_fetch_array($ra);

    $phone = $f['phone']; 
    

    $ramp = "SELECT SUM(amount2) FROM salespoint WHERE crbnumber = '$crb' AND branch = '$branchCode' ";
    $ramgo = mysqli_query($connect, $ramp);
    $fl = mysqli_fetch_array($ramgo);

    $cat = $fl['SUM(amount2)']; 


    $newAmount = $cat - $changedebit;

    $up = "UPDATE salespoint SET amount2 = '$newAmount' WHERE crbnumber = '$crb' AND branch = '$branchCode' ";
    $upgo = mysqli_query($connect, $up);


    $sha = "SELECT Cchange FROM customers WHERE Cphone = '$phone' ";
    $s = mysqli_query($connect, $sha);
    $ss = mysqli_fetch_array($s);

    $get = $ss['Cchange'];

    $newChange = $changedebit - $get;


    $cha = "UPDATE customers SET Cchange = '$newChange' ";
    $c = mysqli_query($connect, $cha);

   


  }

  if (isset($_POST['keep'])){

    $phone = $_POST['phone'];
    $crb = $_POST['keep'];

     $sha = "SELECT Cchange FROM customers WHERE Cphone = '$phone' ";
    $s = mysqli_query($connect, $sha);
    $ss = mysqli_fetch_array($s);

    $get = $ss['Cchange'];

    $sa = "SELECT changee FROM stepfinal WHERE reciept = '$crb' AND branch = '$branchCode' ";
    $s = mysqli_query($connect, $sa);
    $ta = mysqli_fetch_array($s);

    $ch = $ta['changee'];

       $newChange = $ch + $get;

    $cha = "UPDATE customers SET Cchange = '$newChange' ";
    $c = mysqli_query($connect, $cha);

    $usf = "UPDATE stepfinal SET changee = '$newChange' ";
    $us = mysqli_query($connect, $usf);

    $uc = "UPDATE stepcomplete SET changee = '$newChange' ";
    $usc = mysqli_query($connect, $uc);



  }

                  

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Aicogas</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>

    <script src="my.js"></script>

<style>

@media print {
    body , h1, h2, h3, h4, h5, h6,td,small{
        
        margin-top:0px;
        padding-top:0px;
        margin-bottom:0px;
        padding-bottom:0px;
       
 
    color: black; font-size:1.2em;
    }
    
    body#crbprint{
    
    
}
#crbprint {

    
}

}

</style>

    <script>
    
    function printContent(el){

      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
      
    }

                    $(document).keypress(
                     function(event){
                     if (event.which == '13') {
                     event.preventDefault();
                     }
                     });

    var selected_option = $("#goff option:selected").text();
   
    if(selected_option == "Transaction successful - Keep change"){
        $('#cancel').attr('disabled', true);
    }

//if ($('#go').attr('selected', true)) $('#cancel').prop('disabled', true);
//elseif ($('#gogo').attr('selected', true)) $('#cancel').prop('disabled', true);
//elseif ($('#no').attr('selected', true)) $('#complete').prop('disabled', true);
//elseif ($('#nono').attr('selected', true)) $('#complete').prop('disabled', true);
//elseif ($('#nonono').attr('selected', true)) $('#complete').prop('disabled', true);


    
    </script>
                      


  </head>

  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
          

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

              <div class=" d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome <?php 
                  echo  "<b class='text-primary'>".$username."</b>"; 
                  echo " | Today's Date: ";  
                  echo date('l jS F (Y-m-d)', strtotime('now')); 
                  echo " | Your Home Company: <b class='text-success'>".$company."</b>";
                  echo " | Your Branch Location:  <b class='text-success'>".$branch."</b>";
                  
                  ?></span>
                  <form action="logout.php">
                  <button class="btn btn-outline-danger">Logout</button>
                  </form>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                
                </div>
              </li>

            </ul>

          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
    
          <div class="container">
              <h1  align="center">Almarence International Company Limited</h1>
<div>



<?php
    $date = date('Y-m-d', strtotime('now'));
    //check switch log
    $sw = "SELECT * FROM switchLog WHERE datee = '$date' AND branch = '$branchCode' ORDER BY id DESC LIMIT 1";
    $swt = mysqli_query($connect, $sw);
    
    if (mysqli_num_rows($swt) > 0){
        
        $staks = "SELECT * FROM finalsales";
        $stkk = mysqli_query($connect, $staks);
        $row = mysqli_fetch_array($stkk);
        $statement = $row['category'];
        $tankkk = $row['tankUse'];
        
        
        $gt = "SELECT * FROM gasStations WHERE BtankUse = '$tank'";
        $gg = mysqli_query($connect, $gt);
        $gow = mysqli_fetch_array($gg);
        $tUse = $gow['BtankUse'];
        $tannkA = $row['BtankA'];
        $tannkB = $row['BtankB'];
        
        if($tUse == 'Tank A'){
            
            if(isset($_POST['val'])){
                $date = $ddaattee;
            }else{
                $date = $date;
            }
            
            $tank = 'Tank B';
            $gf = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
            $ggf = mysqli_query($connect, $gf);
            $tow = mysqli_fetch_array($ggf);
            $bstock = $tow['balancee'];
            $opening = $tow['opening'];
            
            
            $gff = "SELECT * FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$date' ORDER BY id DESC LIMIT 1";
            $ggff = mysqli_query($connect, $gff);
            $towf = mysqli_fetch_array($ggff);
            $bstockf = $towf['balancee'];
            
            $gffz = "SELECT SUM(kg) FROM finalsales WHERE  branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
            $ggffz = mysqli_query($connect, $gffz);
            $towfz = mysqli_fetch_array($ggffz);
            $soldk = $towfz['SUM(kg)'];
            
            $gffza = "SELECT SUM(kg) FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
            $ggffza = mysqli_query($connect, $gffza);
            $towfza = mysqli_fetch_array($ggffza);
            $soldka = $towfza['SUM(kg)'];
            
            $gffa = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND category = 'Switchcontroler' AND datee = '$date' ORDER BY timee DESC LIMIT 1";
            $ggffa = mysqli_query($connect, $gffa);
            $towfa = mysqli_fetch_array($ggffa);
            $bop = $towfa['opening'];

             $did = "SELECT * FROM switchLog WHERE datee = '$date' AND branch = '$branchCode' ";

                    $it = mysqli_query($connect, $did);
                    $happen = mysqli_num_rows($it);

                    if ($happen > 0) {
            
                        if ($happen < 2) {
                            $gffx = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id ASC LIMIT 1";
                            $ggffx = mysqli_query($connect, $gffx);
                            $towfx = mysqli_fetch_array($ggffx);
                            $openingfx = $towfx['opening'];
                        }else{
                            $gffx = "SELECT * FROM finalsales WHERE tankUse = 'Tank B' AND branch = '$branchCode' AND datee = '$date' AND category = 'Switchcontroler' ORDER BY timee DESC LIMIT 1";
                            $ggffx = mysqli_query($connect, $gffx);
                            $towfx = mysqli_fetch_array($ggffx);
                            $openingfx = $towfx['opening'];
                        }
                    }else{

                       $gffx = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id ASC LIMIT 1";
            $ggffx = mysqli_query($connect, $gffx);
            $towfx = mysqli_fetch_array($ggffx);
            $openingfx = $towfx['opening'];
                    }

           
            
            $sc = "SELECT * FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' AND category != 'Switchcontroler' ";
            $ss = mysqli_query($connect, $sc);
            $fcc = mysqli_num_rows($ss);
            
            $loadno = "SELECT * FROM stockHistory WHERE Bcode = '$branchCode' ORDER BY id DESC LIMIT 1";
            $loadup = mysqli_query($connect, $loadno);
            $las = mysqli_fetch_array($loadup);
            $nowtank = $las['loadNumber'];
            
            
            
            echo "
            
            <h6 class='text-danger' align='center'><b>Previous Tank: ".$tank." | Opening Stock : ".$openingfx." Kg | Balance Stock : ".$bstock." Kg </b></h6>
            
            
            ";
            echo "
            
            <h6 class='text-info' align='center'><b>Load No: ".$nowtank." | Current Tank: ".$tUse." | Opening Stock : ".$bop."  Kg | Balance Stock : ".$bstockf." Kg | Sold : ".$soldk." Kg | Sales Count : ".number_format($fcc)."</b></h6>
            
            
            ";
        }elseif($tUse == 'Tank B'){
            
            if(isset($_POST['val'])){
                $date = $ddaattee;
            }else{
                $date = $date;
            }
            
            $tank = 'Tank A';
            $gf = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1" ;
            $ggf = mysqli_query($connect, $gf);
            $tow = mysqli_fetch_array($ggf);
            $bstock = $tow['balancee'];
            $opening = $tow['opening'];
            
            
            $gff = "SELECT * FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$date' ORDER BY id DESC LIMIT 1";
            $ggff = mysqli_query($connect, $gff);
            $towf = mysqli_fetch_array($ggff);
            $bstockf = $towf['balancee'];
            
            $gffz = "SELECT SUM(kg) FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
            $ggffz = mysqli_query($connect, $gffz);
            $towfz = mysqli_fetch_array($ggffz);
            $soldk = $towfz['SUM(kg)'];
            
            $gffza = "SELECT SUM(kg) FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
            $ggffza = mysqli_query($connect, $gffza);
            $towfza = mysqli_fetch_array($ggffza);
            $soldka = $towfza['SUM(kg)'];
            
            $gffa = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND category = 'Switchcontroler' AND datee = '$date' ORDER BY timee DESC LIMIT 1";
            $ggffa = mysqli_query($connect, $gffa);
            $towfa = mysqli_fetch_array($ggffa);
            $bop = $towfa['opening'];
            
             $did = "SELECT * FROM switchLog WHERE datee = '$date' AND branch = '$branchCode' ";

                    $it = mysqli_query($connect, $did);
                    $happen = mysqli_num_rows($it);

                    if ($happen > 0) {

            
                        if ($happen < 2) {
                            $gffx = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id ASC LIMIT 1";
                            $ggffx = mysqli_query($connect, $gffx);
                            $towfx = mysqli_fetch_array($ggffx);
                            $openingfx = $towfx['opening'];
                        }else{
                            $gffx = "SELECT * FROM finalsales WHERE tankUse = 'Tank B' AND branch = '$branchCode' AND datee = '$date' AND category = 'Switchcontroler' ORDER BY timee DESC LIMIT 1";
                            $ggffx = mysqli_query($connect, $gffx);
                            $towfx = mysqli_fetch_array($ggffx);
                            $openingfx = $towfx['opening'];
                        }

                    }else{

                       $gffx = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id ASC LIMIT 1";
            $ggffx = mysqli_query($connect, $gffx);
            $towfx = mysqli_fetch_array($ggffx);
            $openingfx = $towfx['opening'];
                    }

            
            $sc = "SELECT * FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' AND category != 'Switchcontroler' ";
            $ss = mysqli_query($connect, $sc);
            $fcc = mysqli_num_rows($ss);
            
            $loadno = "SELECT * FROM stockHistory WHERE Bcode = '$branchCode' ORDER BY id DESC LIMIT 1";
            $loadup = mysqli_query($connect, $loadno);
            $las = mysqli_fetch_array($loadup);
            $nowtank = $las['loadNumber'];
            
            
            echo "
            
            <h6 class='text-danger' align='center'><b>Previous Tank: ".$tank." | Opening Stock : ".$openingfx." Kg | Balance Stock : ".$bstock." Kg</b></h6>
            
            
            ";
            echo "
            
            <h6 class='text-info' align='center'><b>Load No: ".$nowtank." | Current Tank: ".$tUse." | Opening Stock : ".$bop." Kg | Balance Stock : ".$bstockf." Kg | Sold : ".$soldk." Kg | Sales Count : ".number_format($fcc)."</b></h6>
            
            
            ";
        }
    }else{
        
        $gt = "SELECT * FROM gasStations WHERE BtankUse = '$tank'";
        $gg = mysqli_query($connect, $gt);
        $gow = mysqli_fetch_array($gg);
        $tUse = $gow['BtankUse'];
        
        if(isset($_POST['val'])){
            $date = $ddaattee;
        }else{
            $date = $date;
        }
        
        $gf = "SELECT * FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$date' ORDER BY id DESC LIMIT 1";
        
        $ggf = mysqli_query($connect, $gf);
        $tow = mysqli_fetch_array($ggf);
        $bstock = $tow['balancee'];
        
        $gffz = "SELECT SUM(kg) FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$date' ORDER BY id DESC LIMIT 1";
        $ggffz = mysqli_query($connect, $gffz);
        $towfz = mysqli_fetch_array($ggffz);
        $soldk = $towfz['SUM(kg)'];
        
        $ku = "SELECT * FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$date' ORDER BY id ASC LIMIT 1";
        $uu = mysqli_query($connect, $ku);
        $samp = mysqli_fetch_array($uu);
        $opening = $samp['opening'];
        
        $sc = "SELECT * FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' AND category != 'Switchcontroler' ";
        $ss = mysqli_query($connect, $sc);
        $fcc = mysqli_num_rows($ss);
        
        
        $loadno = "SELECT * FROM stockHistory WHERE Bcode = '$branchCode' ORDER BY id DESC LIMIT 1";
        $loadup = mysqli_query($connect, $loadno);
        $las = mysqli_fetch_array($loadup);
        $nowtank = $las['loadNumber'];
        
        echo "
        
        <h6 class='text-info' align='center'><b>Load No: ".$nowtank." | Current Tank: ".$tUse." | Opening Stock : ".$opening." Kg | Balance Stock : ".$bstock." Kg | Sold : ".$soldk." Kg | Sales Count : ".number_format($fcc)."</b></h6>
        
        
        ";
        
        
        
    }
    
    
    ?>

</div>

              <div align="center">
              <button class="btn btn-outline-info" data-toggle="modal" data-target="#report" >My report for today</button>
                        <h5 class="text-danger" align='center'><?php echo $status ?> </h5>
              </div>
          </div>


        
  <hr>
            <!-- Page Heading -->
            <div class="container">
            
                  <div class="row">

                        <div class="col col-lg-1">

                          <div>
                              <small>CRBS</small>
                          </div>
                              <div style="width:auto; height:auto; overflow-y:scroll;">
                              <hr>
                              <?php $createStation->pullCRBs(); ?>
                              </div>
                        </div>

                        <div class="col col-lg-7">

                          <div class="card shadow">

                            <div class="card-body">


                            <form action="  " method="POST">
                          <div id="">
                                <input class="form-control" type="text" name="cphone" value="<?php echo $phone ?>" style="visibility:hidden">
                                <input class="form-control" type="text" name="namea" value="<?php echo $name ?>" style="visibility:hidden">
                                
                                <input type="number" class="form-control" name="crb" value="<?php echo $crb ?>" readonly placeholder="<?php echo $crb ?>">
                                <br>
                                <h6>Customer Name: <b class="text-info"><?php echo $name; ?></b> <span> | Phone Number: <b class="text-info"><?php echo $phone ?></b></span> </h6>
                                
                                <h6>Category: <b class="text-danger"><?php echo $category ?></b></h6>

                                <hr>
                                            <?php 

                                        if($go2){

                                          echo "<div class='container'>";

                                            echo "<div class='row'>";

                                            while($row = mysqli_fetch_array($go2)){

                                                $crb = $row['crbnumber'];
                                                $phone = $row['phone'];
                                                $name = $row['customer'];
                                                $category = $row['category'];
                                                $kg = $row['kg'];
                                                $date = $row['datee'];
                                                $time = $row['timee'];
                                                $branch = $row['branch'];
                                                $quantity = $row['quantity'];
                                                $amount = $row['amount'];

                                                echo "

                                                  

                                                  <div class='col-12 col-sm-4'>


                                                    <h6>Cylinder Size: <b class='text-info'>".$kg." Kg </b></h6>
                                                    <h6>Quantity: <b class='text-info'>".$quantity." Units</b></h6>
                                                    <h6>Amount: <b class='text-info' >".number_format($amount)." NGN</b></h6>
                                                    <hr>
                                          

                                                  </div>


                                                


                                                ";

                                                

                                            }
                                            echo "</div>";
                                            echo "</div>";

                                        }else{

                                        }
                                        if($su){

                                                while($gaga = mysqli_fetch_array($su)){

                                                    $amama = $gaga['SUM(amount)'];
                                                    $amama2 = $gaga['SUM(amount2)'];

                                                    echo "
                                                        <h6 align='center'><b class='text-info'>Purchase amount: ".number_format($amama)." NGN </b></h6>
                                                        <hr>
                                                    ";


                                                }
                                            }else{

                                            }

                              
                                            ?>
                <div class="container">
                
              
                      <div class="row">
                                
                                    <div class="col-12 col-lg-6">
                                          <h6 class="col-sm-12 btn" name="change" value="<?php echo $change  ?>"><b>Previous change: <br> <?php echo $change  ?> NGN</b> </h6>
                                    
                                  </div>

                                  <?php 
                                                if($gash){

                                                  while ($drag = mysqli_fetch_array($gash)) {
                                                    $crb2 = $drag['crbnumber'];
                                                    
                                                  }



                                                   echo "


                                    <div class='col-12 col-lg-6'>
                                      
                                           <form action=' ' method='POST'>

                                                <div>
                                                    <small><b>Did the customer have a previous change that you have just given out to him or her?</b></small>
                                                    
                                                    <button class='col-12 col-lg-12 btn btn-primary' name='debit' value='".$change."'>Yes, update customer's change</button>
                                                    <input type='text' name='ccrb' value='".$crb2."' style='visibility:hidden' />
                                                </div>
                                            
                                              </form>
                                    
                                  </div>

                                            " ;

                                                

                                                }
                                                
                                      
                                   ?>

                        </div>

                </div>

                <hr>
                                <div class="form-group">
                                <small>New Amount Due</small>
                                 <?php 

                                     if($amama != $amama2){
                                   $rack = mysqli_fetch_array($k);
                                  $load = $rack['amount2'];
                                 }else{
                                    $load = $amama2;
                                 }

                                    echo "
                           <input type='number' class='col-sm-12 btn btn-success'  name='cashh' value='".$load."' readonly />
                                    ";

                                ?>
                                 <div class="col-12 col-lg-12">
                                        <small>Amount paid</small>
                                        <input class="form-control" type="number" name="paid" placeholder="Amount paid ?">
                                    </div>
                                    <br>
                                <small>Select payment option</small>
                                                            <select class="form-control" name="payment">
                                                            <option selected value="Cash">Cash</option>
                                                            <option value="POS">POS</option>
                                                            <option value="Transfer">Credit</option>
                                                            </select>
                                  </div>

                                  <div class="container">
                                    
                                                    <div class="form-group">
                                                            <small>Transaction narrative</small>
                                                          <select id='goff' class="form-control" name="narrative">
                                                          <option selected value="Successful">Transaction successful</option>
                                                          <option   value="Failed - ATM Declined">ATM Declined</option>
                                                          <option  value="Failed - Transfer Failed">Transfer Failed</option>
                                                          <option  value="Failed - Cylinder Error">Uncorresponding Cylinder</option>
                                                          </select>
                                                  </div>

                                  
                                  
                                  </div>


                                  <div class="container">
                                  
                                  <div class="row">

                                      <div class="col col-sm-6">
                                          <button id="cancel" class="form-control btn btn-danger" type="submit" name="bad" >Decline sales</button>
                                      </div>

                                      <div class="col col-sm-6">
                                          <button id="complete" class="form-control btn btn-success" type="submit" name="com">Complete sales</button>
                                      </div>

                                      </div>
                                      </form>
                                  </div>


                                  </div>

                            </div>




                          </div>

                          

                      </div>

                     
                <div class="col col-md-4">

                    <div class="card shadow">
                    
                        <div class="card-body">

<div id='crbprint'>

<?php
    
    echo "<h4 align='center'><b>".$company."</b></h4>";
    echo "<hr>";
    
    $sql = "SELECT company.CompanyName, gasStations.Bname, gasStations.Baddress, gasStations.Bcode FROM company, gasStations WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $result = mysqli_query($connect , $sql);
    
    while($row = mysqli_fetch_array($result)){
        $com = $row['CompanyName'];
        $code = $row['Baddress'];
        $name = $row['Bname'];
        
        echo "<small ><h5 align='center'><b>".$name." <br> ".$code. "</b></h5></small>";
        echo "<hr>";
    }
    
    
    $sql = "SELECT * FROM stepcomplete WHERE branch = '$branchCode' ORDER BY id DESC LIMIT 1";
    $go = mysqli_query($connect , $sql);


         


     
    if(mysqli_num_rows($go) > 0){
        while($row = mysqli_fetch_array($go)){
            $cname = $row['customer'];
            $phone = $row['phone'];
            $datee = $row['datee'];
            $ti = $row['timee'];
            $rec = $row['reciept'];
            $change = $row['changee'];
            $payment = $row['payment'];
            $prevchange = $row['prvchange'];
            
        }

        $sll = "SELECT * FROM stepfinal WHERE branch = '$branchCode' AND reciept = '$rec' ";
                                    $gas = mysqli_query($connect, $sll);
        
        echo "<small><h5><b>Customer's Name: ".$cname."</b></h5></small>";
        echo "<small><h5><b>Customer's Phone: ".$phone."</b></h5></small>";
        echo "<small><h5><b>Sales Attendant: ".$username."</b></h5></small>";
         echo "<small><h5><b>Date: ".$datee."</b></h5></small>";
        echo "<small><h5><b>Time: ".$ti."</b></h5></small>";
        echo "<hr>";
        echo "<small><h2><b>Reciept No: ".$rec."</b></h2></small>";
        
        
    }
    
    $sql2 = "SELECT * FROM stepcomplete WHERE branch = '$branchCode' AND reciept = '$rec'";
    $go2 = mysqli_query($connect , $sql2);
    
    echo "
    
    <table class='table' border='6'>
    <thead>
    <tr>
    <th scope='col'><small><h5><b>Cylinder Type</b></h5></small></th>
    <th scope='col'><small><h5><b>Qty</b></h5></small></th>
    <th scope='col'><small><h5><b>Total Kg</b></h5></small></th>
    <th scope='col'><small><h5><b>Payable</b></h5></small></th>
    
    </tr>
    </thead>
    <tbody>
    
    ";
    
    if($go2){
        
        while($row = mysqli_fetch_array($go2)){
            $phone = $row['phone'];
            $name = $row['customer'];
            $category = $row['category'];
            $kg = $row['kg'];
            $akg = $row['allKg'];
            $date = $row['datee'];
            $time = $row['timee'];
            $branch = $row['branch'];
            $quantity = $row['quantity'];
            $amount = $row['amount'];
            
            echo "<tr>";
            echo "<th scope='row'><h5><small><h5><b>".$kg." Kg</b></h5></small></th>";
            echo "<th scope='row'><h5><small><h5><b>".$quantity."</b></h5></small></th>";
            echo "<th scope='row'><h5><small><h5><b>".$akg." Kg</b></h5></small></th>";
            echo "<th scope='row'><h5><small><h5><b>".number_format($amount)." NGN</b></h5></small></th>";
            
            echo "</tr>";
            
        }
        $sql3 = "SELECT SUM(allKg), SUM(quantity), SUM(amount) FROM stepcomplete WHERE branch = '$branchCode' AND reciept = '$rec'";
        $go3 = mysqli_query($connect , $sql3);
           $ro = mysqli_fetch_array($go3);
            
            $kg = $ro['SUM(allKg)'];
            
            $quantity = $ro['SUM(quantity)'];
            $amount = $ro['SUM(amount)'];
            echo "<tr class='bg-primary text-white'>";
            echo "<th scope='row' colspan='4'><h5 align='left'><small><b>Total</b></h5></small></th>";
            echo "</tr>";
            
            echo "<tr class='bg-primary text-white'>";
        echo "<th scope='row'><h5><small><h5><b>&nbsp;</b></h5></small></th>";
            echo "<th scope='row'><h5><small><h5><b>".$quantity."</b></h5></small></th>";
            echo "<th scope='row'><h5><small><h5><b>".$kg." Kg</b></h5></small></th>";
            echo "<th scope='row'><h5><small><h5><b>".number_format($amount)." NGN</b></h5></small></th>";
            
            echo "</tr>";
            
        
    }else{
        
    }
    echo "
    </tbody>
    </table>
    <hr>
    ";
    
    $train = "SELECT * FROM stepfinal WHERE reciept = $rec AND branch = '$branchCode' ";
    $su = mysqli_query($connect, $train);
    
    if($su){
        
        while($gaga = mysqli_fetch_array($su)){
            $amchange = $gaga['changee'];
            $ampayment = $gaga['payment'];
            $amm = $gaga['amount'];
            $amm2 = $gaga['finalTotal'];
            $phone = $gaga['phone'];
            $changeD = $gaga['changeD'];
            $finalAmount = $gaga['finalTotal'];
            
        }
        $deduct = $amm - $finalAmount;
        if($amchange != 0){
            $finalAmount = $amm - $amchange;
        }
        
        $gax = "SELECT * FROM customers WHERE Cphone = '$phone' AND branch = '$branchCode'";
        $rax = mysqli_query($connect, $gax);
        $rain = mysqli_fetch_array($rax);
        $customerId = $rain['Cid'];

           $rat = "SELECT Cchange FROM customers WHERE Cid = '$customerId' AND branch = '$branchCode' ";
    $at = mysqli_query($connect, $rat);
    $a = mysqli_fetch_array($at);
    $change = $a['Cchange'];
        
        echo "
        <small align='left'><h5><b>Total Payable: ".number_format($amm2)." NGN </b></h5></small>
        <small align='left'><h5><b>Sale Change: ".number_format($amchange)." NGN </b></h5></small>
        <small align='left'><h5><b>Held Change: ".number_format($change)." NGN </b></h5></small>
        <small align='left'><h5><b>Change Debited: ".number_format($changeD)." NGN </b></h5></small>
        <small align='left'><h5><b>Method of Payment: ".$ampayment."</b></h5></small>
        <hr>
        ";
    }else{
        
    }


    
    // $fish = "SELECT * FROM salespoint WHERE
    
    
    
    echo   "<div>";
    echo  "<small><h5 align='center'><b>".$company."<br> Thanks for your patronage. Please come again.<br> Visit Us: Monday to Saturday 7:30 a.m to 6 p.m</b></h5></small>";
    echo "</div>";
    echo   "<hr>";
    echo "</div>";

    
    
    
    
    ?>



<div class='row'>
<div class='col col-md-12'>
<form action='filter.php' method='POST' id='tosales'>
<button class='col btn btn-success' type='submit' name='filter' onclick='printContent("crbprint"); document.getElementById("tosales").submit();' >Print Reciept</button>
<?php echo  "<input type='number' name='reciept' value='".$rec."' style='visibility: hidden' readonly>" ?>
</form>
</div>

                        </div>

                        
                        </div>
                </div>    
                 <?php 
                                  
                                                if($gas){

                                                  while ($d = mysqli_fetch_array($gas)) {
                                                    $phone = $d['phone'];
                                                    $crb = $d['reciept'];
                                                    
                                                  }
                                                 
                                                  echo "


                                                  <div class='bg-danger text-white p-2 rounded shadow mt-2'>
                                               <form action=' ' method='POST'>

                                                <div>
                                                    <small><b>if customer has a profile, ask if you should keep the change for future purchase</b></small>
                                                  
                                                      <button class='col-12 col-lg-12 btn btn-primary' name='keep' value='".$crb."'>Keep change</button>
                                                      <input type='text' name='phone' value='".$phone."' style='visibility:hidden'>
                                                </div>
                                                  
                                              </form>
                                          </div>



                                                  ";

                             }

                                          ?>
  
              </div>

                  </div>
    
            </div>
          
          
                  
      
            
              

      <div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <div class="top text-success">
                
                                  <h5 align='center'><?php echo $username ?>'s Report </h5>
                                <h6 align="center"> <?php echo date('l jS F (Y-m-d)', strtotime('now')); ?></h6>
                              </div>
                              <div style="padding: 8px;">
                              <div class="contaier">
                  <h6 align='center'>Report By Categories</h6>
                    <div class="row">
                        <div class='col-12 col-lg-3 '>
                            <div class="bg-warning p-1 rounded shadow">
                                <h6 align="center" class="text-white">Other</h6>
                        <?php 
                        $dt = date('Y-m-d', strtotime('now'));
                        
                            $Others = "SELECT DISTINCT(reciept) FROM finalsales WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Others' AND amount != 0 ";
                            $goOther = mysqli_query($connect, $Others);
                            
                             
                            if($goOther){
                                $oth = mysqli_num_rows($goOther);

                                $k = "SELECT SUM(kg) FROM finalsales  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Others' AND amount != 0 ";
                                $kk = mysqli_query($connect, $k);
                                $kr = mysqli_fetch_array($kk);
                                $alkg = $kr['SUM(kg)'];

                                 $ka = "SELECT SUM(amount) FROM finalsales  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Others' AND amount != 0 ";
                                $kka = mysqli_query($connect, $ka);
                                $kra = mysqli_fetch_array($kka);
                                $alkga = $kra['SUM(amount)'];

                                echo "<b class='text-white'> Sales count</b><br>";
                                echo "<b class='text-white'>".number_format($oth)." </b><br>";
                                echo "<hr>";
                                echo "<b class='text-white'>Total Kg </b><br>";
                                echo "<b class='text-white'> ".$alkg." Kg</b><br>";
                                echo "<hr>";
                                echo "<b class='text-white'> Amount</b><br>";
                                echo "<b class='text-white'> ".number_format($alkga)."</b>";
                                echo "<hr>";
                            }
                
                        
                        ?>
                    </div>
                        </div>
                        <div class='col-12 col-lg-3 '>
                            <div class="bg-success p-1 rounded shadow">
                                 <h6 align="center" class="text-white">Dealer</h6>
                        <?php 
                        $dt = date('Y-m-d', strtotime('now'));
                        
                             $Others = "SELECT DISTINCT(reciept) FROM finalsales WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Dealer' AND amount != 0 ";
                            $goOther = mysqli_query($connect, $Others);
                            
                             
                            if($goOther){
                                $oth = mysqli_num_rows($goOther);

                                $k = "SELECT SUM(kg) FROM finalsales  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Dealer' AND amount != 0 ";
                                $kk = mysqli_query($connect, $k);
                                $kr = mysqli_fetch_array($kk);
                                $alkg = $kr['SUM(kg)'];

                                 $ka = "SELECT SUM(amount) FROM finalsales  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Dealer' AND amount != 0 ";
                                $kka = mysqli_query($connect, $ka);
                                $kra = mysqli_fetch_array($kka);
                                $alkga = $kra['SUM(amount)'];

                               echo "<b class='text-white'> Sales count</b><br>";
                                echo "<b class='text-white'>".number_format($oth)." </b><br>";
                                echo "<hr>";
                                echo "<b class='text-white'>Total Kg </b><br>";
                                echo "<b class='text-white'> ".$alkg." Kg</b><br>";
                                echo "<hr>";
                                echo "<b class='text-white'> Amount</b><br>";
                                echo "<b class='text-white'> ".number_format($alkga)."</b>";
                                echo "<hr>";
                            }
                          
                       
                        
                        ?>
                    </div>
                        </div>
                        <div class='col-12 col-lg-3 '>
                            <div class="bg-primary p-1 rounded shadow">

                                <h6 align="center" class="text-white">Eatery</h6>
                        <?php 
                        $dt = date('Y-m-d', strtotime('now'));
                        
                            $Others = "SELECT DISTINCT(reciept) FROM finalsales WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Eatery' AND amount != 0 ";
                            $goOther = mysqli_query($connect, $Others);
                            
                            if($goOther){
                                $oth = mysqli_num_rows($goOther);

                                $k = "SELECT SUM(kg) FROM finalsales  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Eatery' AND amount != 0 ";
                                $kk = mysqli_query($connect, $k);
                                $kr = mysqli_fetch_array($kk);
                                $alkg = $kr['SUM(kg)'];

                                 $ka = "SELECT SUM(amount) FROM finalsales  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Eatery' AND amount != 0 ";
                                $kka = mysqli_query($connect, $ka);
                                $kra = mysqli_fetch_array($kka);
                                $alkga = $kra['SUM(amount)'];

                               echo "<b class='text-white'> Sales count</b><br>";
                                echo "<b class='text-white'>".number_format($oth)." </b><br>";
                                echo "<hr>";
                                echo "<b class='text-white'>Total Kg </b><br>";
                                echo "<b class='text-white'> ".$alkg." Kg</b><br>";
                                echo "<hr>";
                                echo "<b class='text-white'> Amount</b><br>";
                                echo "<b class='text-white'> ".number_format($alkga)."</b>";
                                echo "<hr>";
                            }
                                
                        
                        
                        
                        ?>
                    </div>
                        </div>
                        <div class='col-12 col-lg-3 '>

                            <div class="bg-info p-1 rounded shadow" >

                                <h6 align="center" class="text-white">Domestic</h6>
                        <?php 
                        $dt = date('Y-m-d', strtotime('now'));
                        
                            $Others = "SELECT DISTINCT(reciept) FROM finalsales WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Domestic' AND amount != 0 ";
                            $goOther = mysqli_query($connect, $Others);
                            
                            if($goOther){
                                $oth = mysqli_num_rows($goOther);

                                $k = "SELECT SUM(kg) FROM finalsales  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Domestic' AND amount != 0 ";
                                $kk = mysqli_query($connect, $k);
                                $kr = mysqli_fetch_array($kk);
                                $alkg = $kr['SUM(kg)'];

                                 $ka = "SELECT SUM(amount) FROM finalsales  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Domestic' AND amount != 0 ";
                                $kka = mysqli_query($connect, $ka);
                                $kra = mysqli_fetch_array($kka);
                                $alkga = $kra['SUM(amount)'];

                                echo "<b class='text-white'> Sales count</b><br>";
                                echo "<b class='text-white'>".number_format($oth)." </b><br>";
                                echo "<hr>";
                                echo "<b class='text-white'>Total Kg </b><br>";
                                echo "<b class='text-white'> ".$alkg." Kg</b><br>";
                                echo "<hr>";
                                echo "<b class='text-white'> Amount</b><br>";
                                echo "<b class='text-white'> ".number_format($alkga)."</b>";
                                echo "<hr>";
                            }
                        
                        ?>
                                
                            </div>
                        
                        </div>

                    
                    </div>
                    </div>
                       <hr>
                        <h5>Total Stats:</h5> <?php 
                        $dt = date('Y-m-d', strtotime('now'));
                        
                            $Others = "SELECT DISTINCT(reciept) FROM finalsales WHERE datee = '$dt' AND branch = '$branchCode' AND amount != 0 ";
                            $goOther = mysqli_query($connect, $Others);
                            
                            if($goOther){
                                $oth = mysqli_num_rows($goOther);

                                $k = "SELECT SUM(kg) FROM finalsales  WHERE datee = '$dt' AND branch = '$branchCode' AND amount != 0 ";
                                $kk = mysqli_query($connect, $k);
                                $kr = mysqli_fetch_array($kk);
                                $alkg = $kr['SUM(kg)'];

                                 $ka = "SELECT SUM(amount) FROM finalsales  WHERE datee = '$dt' AND branch = '$branchCode' AND amount != 0 ";
                                $kka = mysqli_query($connect, $ka);
                                $kra = mysqli_fetch_array($kka);
                                $alkga = $kra['SUM(amount)'];

                                echo "<b class=''> Sales count</b><br>";
                                echo "<b class=''>".number_format($oth)." Sales today</b><br>";
                                echo "<hr>";
                                echo "<b class=''>Total Kg </b><br>";
                                echo "<b class=''> ".$alkg." Kg</b><br>";
                                echo "<hr>";
                                echo "<b class=''> Amount</b><br>";
                                echo "<b class=''> ".number_format($alkga)." NGN</b>";
                                echo "<hr>";
                            }
                        
                     ?>

                
                        
          
                              </div>
                              </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>

      
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Aicogas 2020</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="my.js"></script>

  </body>

  </html>
