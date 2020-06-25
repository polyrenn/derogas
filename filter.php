    <?php 

    require_once ("classes/all.php");
        
       
        $lee = $_POST['reciept'];
       
        
        //get all data from stepfinal
        $ga = "SELECT * FROM stepfinal WHERE reciept ='$lee' ";
        $fl = mysqli_query($connect, $ga);
        $row = mysqli_fetch_array($fl);
        
        $branchCode = $row['branch'];
        $reciept = $row['reciept'];
        $date = $row['datee'];
        $time = $row['timee'];
        $customer = $row['customer'];
        $category = $row['category'];
        $phone = $row['phone'];
        $payment = $row['payment'];
        $amm = $row['cash'];
        $kggg = $row['kg'];
        $q = $row['quantity'];
        $ammm = $row['amount'];
        $status = $row['salesStatus'];
        $changee = $row['changee'];
        $changeD = $row['changeD'];
        $finalamount = $row['finalTotal'];
        $tank = $row['tankUse'];
        $openTank = $row['opening'];
        $remain = $row['balancee'];
        $remained = $row['closing'];
        
        $finalsales = " INSERT INTO finalsales (branch, reciept, datee, timee, customer,category, phone, payment, cash, kg, quantity, amount, salesStatus, changee,changeD, finalTotal, tankUse, opening, balancee, closing)
        VALUES('$branchCode', '$reciept', '$date', '$time', '$customer', '$category', '$phone', '$payment', '$amm', '$kggg','$q','$ammm', '$status', '$changee', '$changeD', '$finalamount', '$tank','$openTank', '$remain', '$remained')";
        $rod = mysqli_query($connect, $finalsales);
        
        $squee = "SELECT * FROM stepcomplete WHERE reciept = '$lee' ";
        $gosqu = mysqli_query($connect, $squee);
        while($gap = mysqli_fetch_array($gosqu)){
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
            
            $gg = "INSERT INTO completeSales (branch, reciept, datee, timee, customer, phone, payment, cash, kg, quantity, allKg, amount, narrative, changee, prvchange) VALUES ('$branch', '$reciept', '$date', '$time', '$customer', '$phone', '$payment', '$cash', '$kg', '$quantity', '$allKg', '$amount', '$narrate', '$changee', '$prvchange')";
              $f = mysqli_query($connect, $gg);
        }
        
        
        $ro = "DELETE FROM stepcomplete WHERE reciept = '$lee'";
        $fla = mysqli_query($connect, $ro);
        
        $r = "DELETE FROM stepfinal WHERE reciept = '$lee' ";
        $flas = mysqli_query($connect, $r);
        
        
        
        $rock = "DELETE FROM salespoint WHERE crbnumber = '$lee'";
        $flash = mysqli_query($connect, $rock);
        
        $do = "INSERT INTO doneCrb SELECT * FROM salespoint WHERE crbnumber = '$lee'";
        $flas = mysqli_query($connect, $do);
        
        if($flash){
            $message = "Transaction completed succesfully, printing reciept...";
            header("Location: salespoint.php?msg=true&type=error&details=". urlencode($message) );
        }else{
            $message = "Error completing transaction and printing reciept, try again.";
            header("Location: salespoint.php?msg=true&type=error&details=". urlencode($message) );
        }


    ?>
