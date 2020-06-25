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
    $new = $createStation->getCustomer($phone);
        
        $status = urldecode($_GET['details']);

    if(!isset($_SESSION['username'])){
        header('Location: portal.php');
    }
        
        
        
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
            
            $fish = "SELECT * FROM finalsales WHERE branch = '$branchCode'";
            $star = mysqli_query($connect, $fish);
            if(mysqli_num_rows($star) < 0){
                $openTank = $tankA;
            }else{
                $openTank = $remaining;
            }
            
        }elseif($tank == 'Tank B'){
            $tank = $tank;
            $remaining = $tankB;
            
            $fish = "SELECT * FROM finalsales WHERE branch = '$branchCode'";
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

        
        
        
        
        
        

                    
    if(isset($_POST['submitsss'])){
        $phone = $_POST['cphone'];
    }

    if(isset($_POST['delete'])){
        $branchCode = $_SESSION['Bcode'];
    $crbN = "SELECT crbnumber FROM crbstep WHERE branch = '$branchCode' ORDER BY id DESC LIMIT 1";
    $rogue = mysqli_query($connect, $crbN);

            while($ggg = mysqli_fetch_array($rogue)){
                $crbNUn = $ggg['crbnumber'];
            }

            $can = "DELETE FROM crbstep WHERE branch = '$branchCode' AND crbnumber = '$crbNUn'";
            $runit = mysqli_query($connect, $can);

            if($runit){
                $message = "Transaction cancelled succesfully.";
                header("Location: crbHome.php?msg=true&type=error&details=". urlencode($message) );
            }else{
                $message = "Could not cancel transaction, try again.";
                header("Location: crbHome.php?msg=true&type=error&details=". urlencode($message) );
            }
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
 
    color: black; 
    font-size:1.2em;
        
    }
}

    .tt-query, /* UPDATE: newer versions use tt-input instead of tt-query */
    .tt-hint {
        width: 396px;
        height: 30px;
        padding: 8px 12px;
        font-size: 24px;
        line-height: 30px;
        border: 2px solid #ccc;
        border-radius: 8px;
        outline: none;
    }

    .tt-query { /* UPDATE: newer versions use tt-input instead of tt-query */
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }

    .tt-hint {
        color: #999;
    }

    .tt-menu { /* UPDATE: newer versions use tt-menu instead of tt-dropdown-menu */
        width: 422px;
        margin-top: 12px;
        padding: 8px 0;
        background-color: #fff;
        border: 1px solid #ccc;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        box-shadow: 0 5px 10px rgba(0,0,0,.2);
    }

    .tt-suggestion {
        padding: 3px 20px;
        font-size: 18px;
        line-height: 24px;
    }

    .tt-suggestion.tt-is-under-cursor { /* UPDATE: newer versions use .tt-suggestion.tt-cursor */
        color: #fff;
        background-color: #0097cf;

    }

    .tt-suggestion p {
        margin: 0;
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
                    $datee = date('l jS F (Y-m-d)', strtotime('now')); 
                    echo $datee;
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
            <div class="container-fluid">

            <div class="container">
                <h1  align="center">Almarence International Company Limited</h1>

            </div>

            <div class="container">
                <div class="col btn-group">
                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#cusReg">Register New Customer</button>

                <button class="btn btn-outline-info" data-toggle="modal" data-target="#report">My report for today</button>
                <button class="btn btn-outline-danger" > <a href="crbHome2.php" style="text-decoration: none; ">Upload Offline sales</a> </button>
                </div>
                    <h5 class="text-primary mt-2" align="center"><?php echo $status ?></h5>

            </div>




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
            
            <h6 class='text-danger' align='center'><b>Previous Tank: ".$tank." | Opening Stock : ".$openingfx." Kg | Balance Stock : ".$bstock." Kg  </b></h6>
            
            
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
            
            <h6 class='text-danger' align='center'><b>Previous Tank: ".$tank." | Opening Stock : ".$openingfx." Kg | Balance Stock : ".$bstock." Kg </b></h6>
            
            
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








                <!-- Page Heading -->
                <div class="row">
                <div class="col-lg-12">

                <div class="mb-4">
                    
                    <div class="card-body">
                    <!-- <h5 align="center">Full name: <b class='text-success'><?php $new = $createStation->getCustomer($phone); echo $new['name']; ?></b> | Phone: <b class='text-success'><?php $new = $createStation->getCustomer($phone); echo $new['phone']; ?></b> | Change Accrued: <b class='text-success'><?php $new = $createStation->getCustomer($phone); echo $new['change']; ?></b> | Purchase counter: <b class='text-success'><?php $new = $createStation->getCustomer($phone); echo $new['purchase']; ?></b> </h5> -->

<div class="row">

<div class="col col-lg-8">

<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active bg-info text-white" id="domestic-tab" data-toggle="tab" href="#domestic" role="tab" aria-controls="domestic" aria-selected="false">Domestic</a>
</li>
<li class="nav-item">
<a class="nav-link bg-success text-white" id="home-tab" data-toggle="tab" href="#dealer" role="tab" aria-controls="home" aria-selected="true">Dealer</a>
</li>
<li class="nav-item">
<a class="nav-link bg-primary text-white" id="profile-tab" data-toggle="tab" href="#eatery" role="tab" aria-controls="profile" aria-selected="false">Eatery</a>
</li>
<li class="nav-item">
<a class="nav-link bg-warning text-white" id="others-tab" data-toggle="tab" href="#others" role="tab" aria-controls="others" aria-selected="false">Others</a>
</li>

</ul>
<div class="tab-content" id="myTabContent">



<div class="tab-pane fade show active" id="domestic" role="tabpanel" aria-labelledby="profile-tab">

<form action="crb.php" method="POST" >

<div class="col form-group">
<input class="form-control mb-1 mt-1 search" type="text" name="fi" placeholder="search by phone, name or id">
</div>
<h5 class='text-danger' align="center">Domestic category</h5>
<table class='table table-striped table-dark'>
<thead>
<tr>
<th scope='col'>Cylinder Sizes</th>
<th scope='col'><h5 align="center">Cylinder Price</h5></th>
<th scope='col'><h5 align="center">Purchase Quantity</h5></th>
<th scope='col'><h5 align="center">Total Kg</h5></th>
<th scope='col'><h5 align="center">Amount</h5></th>
</tr>
</thead>
<tbody>


<?php $createStation->domesticPrice();  ?>

</tbody>
</table>

<button type="submit" name="crb" class=" col btn btn-outline-success" data-toggle="modal" data-target="#crb" >Veify CRB</button>

<div class="container mt-2">
<div class="row">
<div class=" col-md-2 form-group" style="visibility:hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="Domestic" name="category" readonly>
</div>

<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $branchCode ?>" name="branch" readonly>
</div>

<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo date('Y-m-d', strtotime('now')); ?>" name="date" readonly>
</div>

<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo date("h:i:s a"); ?>" name="time" readonly>
</div>

</div>
</div>

</form>

</div>

<div class="tab-pane fade" id="dealer" role="tabpanel" aria-labelledby="home-tab">


<form action="crb.php" method="POST" id="crbForm">


<div class="container">

<div class="col-lg-12 form-group">
<input class=" form-control mb-1 mt-1 search" type="text" name="fi" placeholder="search by phone, name or id">
</div>

</div>
<h5 class='text-danger' align="center">Dealer category</h5>
<table class='table table-striped table-dark'>
<thead>
<tr>
<th scope='col'>Cylinder Sizes</th>
<th scope='col'><h5 align="center">Cylinder Price</h5></th>
<th scope='col'><h5 align="center">Purchase Quantity</h5></th>
<th scope='col'><h5 align="center">Total Kg</h5></th>
<th scope='col'><h5 align="center">Amount</h5></th>
</tr>
</thead>
<tbody>


<?php $createStation->dealerPrice();  ?>



</tbody>
</table>

<button type="submit" name="crbD" class=" col btn btn-outline-success" data-toggle="modal" data-target="#crb" >Verify CRB</button>

<div class="container mt-2">
<div class="row">
<div class=" col-md-2 form-group" style="visibility:hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="Dealer" name="category" readonly>
</div>

<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $branchCode ?>" name="branch" readonly>
</div>

<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo date('Y-m-d', strtotime('now')); ?>" name="date" readonly>
</div>

<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo date("h:i:s a"); ?>" name="time" readonly>
</div>

</div>
</div>

</form>



</div>

<div class="tab-pane fade" id="eatery" role="tabpanel" aria-labelledby="profile-tab">


<form action="crb.php" method="POST" >

<div class="col form-group">
<input class="form-control mb-1 mt-1 search" type="text" name="fi" placeholder="search by phone, name or id">
</div>

<h5 class='text-danger' align="center">Eatery category</h5>
<table class='table table-striped table-dark'>
<thead>
<tr>
<th scope='col'>Cylinder Sizes</th>
<th scope='col'><h5 align="center">Cylinder Price</h5></th>
<th scope='col'><h5 align="center">Purchase Quantity</h5></th>
<th scope='col'><h5 align="center">Total Kg</h5></th>
<th scope='col'><h5 align="center">Amount</h5></th>
</tr>
</thead>
<tbody>


<?php $createStation->eateryPrice();  ?>

</tbody>
</table>

<button type="submit" name="crb" class=" col btn btn-outline-success" data-toggle="modal" data-target="#crb" >Verify CRB</button>

<div class="container mt-2">
<div class="row">
<div class=" col-md-2 form-group" style="visibility:hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="Eatery" name="category" readonly>
</div>



<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $branchCode ?>" name="branch" readonly>
</div>

<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo date('Y-m-d', strtotime('now')); ?>" name="date" readonly>
</div>

<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo date("h:i:s a"); ?>" name="time" readonly>
</div>

</div>
</div>

</form>

</div>



<div class="tab-pane fade" id="others" role="tabpanel" aria-labelledby="profile-tab">

<form action="crb.php" method="POST" >

<div class="col form-group">
<input class="form-control mb-1 mt-1 search" type="text" name="fi" placeholder="search by phone, name or id">
</div>
<h5 class='text-danger' align="center">Others category</h5>
<table class='table table-striped table-dark'>
<thead>
<tr>
<th scope='col'>Cylinder Sizes</th>
<th scope='col'><h5 align="center">Cylinder Price</h5></th>
<th scope='col'><h5 align="center">Purchase Quantity</h5></th>
<th scope='col'><h5 align="center">Total Kg</h5></th>
<th scope='col'><h5 align="center">Amount</h5></th>
</tr>
</thead>
<tbody>


<?php $createStation->othersPrice();  ?>

</tbody>
</table>

<button type="submit" name="crb" class=" col btn btn-outline-success" data-toggle="modal" data-target="#crb" >Verify CRB</button>

<div class="container mt-2">
<div class="row">
<div class=" col-md-2 form-group" style="visibility:hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="Others" name="category" readonly>
</div>


<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $branchCode ?>" name="branch" readonly>
</div>

<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo date('Y-m-d', strtotime('now')); ?>" name="date" readonly>
</div>

<div class="col-md-2 form-group" style="visibility: hidden">
<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo date("h:i:s a"); ?>" name="time" readonly>
</div>

</div>
</div>

</form>

</div>

</div>
</div>
                        
                    

                        <div class="col col-lg-4">
                                <div class="p-1 col">
                                <h5 align="center">CRB# : <span class="text-info"><b><?php $createStation -> nextCrb(); ?></b></span> </h5>
                                </div>
                    <div class="card shadow">
                    
                    <div class="card-body">

        <div id="crbprint">

                                    <table class='table' border='2' >
                            <thead>
                            <tr>
                            <th scope='col'><h5><b>Size</b></h5></th>
                            <th scope='col'><h5><b>Qty</b></h5></th>
                            <th scope='col'><h5><b>Total Size</b></h5></th>
                            <th scope='col'><h5><b>Amount</b></h5></th>
                            </tr>
                            </thead>
                            <tbody>



                                <?php $createStation->getCRB(); ?>

                                </tbody>
                                    </table>

                                    <hr>
                                    <div>
                                    <h4 align="center"><b>Please proceed to cash point</b></h4>
                                    </div>
                                    <hr>

                                    </div>

                                    <div class='row'>

                                    <div class="col col-md-6">
                                    <form action=" " method="POST">
                                    <button class='col btn btn-danger' type="submit" name="delete">Cancel</button>
                                    </form>
                                    </div>


                                    <div class="col col-md-6">
                                    <form action="sales.php" method="POST" id="tosales">
                                    <button class='col btn btn-success' type="submit" name="tosales" onclick='printContent("crbprint"); document.getElementById("tosales").submit();' >Send to cashpoint</button>
                                    <input type="number" name="branch" value="<?php echo $branchCode  ?>" style="visibility:hidden">
                                    </form>
                                    </div>



                                    </div>
                

                    

                    </div>
                    </div>
                        
                        </div>
                    
                    </div>

                    
                        </div>
                    </div>
                </div>  

            <!-- Start new gas plant modal -->

            <div class="modal fade" id="cusReg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <div class="top text-success">
                                    
                                </div>
            
                                <div style="padding: 8px;">
            
                                    
                                <form action="customerReg.php" method="POST" enctype="multipart/form-data">
                                            <br>
                    
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer Name" name="cname">
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" maxlength="11" placeholder="Customer Phone Number" max="11" name="cphone">
                                                    <small class="text-success">Phone number needed to create customer's loyalty reward profile</small>
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo date('l jS F (Y-m-d)', strtotime('now')); ?>" name="date" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $branchCode ?>" name="branch" readonly>
                                                </div>
                                                
                                                <button type="submit" name="submit" class="btn btn-outline-primary">Create Customer Profile</button>
                                        </form>
                                    
                                </div>
                                </div>
                    <div class="modal-footer">
                    </div>
                </div>
                </div>
            </div>



            <div class="modal fade" id="cusSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <div class="top text-success">
                                    
                                </div>
            
                                <div style="padding: 8px;">
            
                                    
                                <form action=" " method="POST" >
                                        
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Customer's phone number" name="cphone">
                                    </div>
                                    </div>

                                    <button type="submit" name="submitsss" class="form-control col-lg-2 btn btn-success">Search</button>

                                    </form>
                                    
                                </div>
                                </div>
                    <div class="modal-footer">
                    </div>
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
                        
                            $Others = "SELECT DISTINCT(crbnumber) FROM crbs WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Others' AND amount != 0 ";
                            $goOther = mysqli_query($connect, $Others);
                            
                             
                            if($goOther){
                                $oth = mysqli_num_rows($goOther);

                                $k = "SELECT SUM(tquant) FROM crbs  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Others' AND amount != 0 ";
                                $kk = mysqli_query($connect, $k);
                                $kr = mysqli_fetch_array($kk);
                                $alkg = $kr['SUM(tquant)'];

                                 $ka = "SELECT SUM(amount) FROM crbs  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Others' AND amount != 0 ";
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
                        
                             $Others = "SELECT DISTINCT(crbnumber) FROM crbs WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Dealer' AND amount != 0 ";
                            $goOther = mysqli_query($connect, $Others);
                            
                             
                            if($goOther){
                                $oth = mysqli_num_rows($goOther);

                                $k = "SELECT SUM(tquant) FROM crbs  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Dealer' AND amount != 0 ";
                                $kk = mysqli_query($connect, $k);
                                $kr = mysqli_fetch_array($kk);
                                $alkg = $kr['SUM(tquant)'];

                                 $ka = "SELECT SUM(amount) FROM crbs  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Dealer' AND amount != 0 ";
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
                        
                            $Others = "SELECT DISTINCT(crbnumber) FROM crbs WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Eatery' AND amount != 0 ";
                            $goOther = mysqli_query($connect, $Others);
                            
                            if($goOther){
                                $oth = mysqli_num_rows($goOther);

                                $k = "SELECT SUM(tquant) FROM crbs  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Eatery' AND amount != 0 ";
                                $kk = mysqli_query($connect, $k);
                                $kr = mysqli_fetch_array($kk);
                                $alkg = $kr['SUM(tquant)'];

                                 $ka = "SELECT SUM(amount) FROM crbs  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Eatery' AND amount != 0 ";
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
                        
                            $Others = "SELECT DISTINCT(crbnumber) FROM crbs WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Domestic' AND amount != 0 ";
                            $goOther = mysqli_query($connect, $Others);
                            
                            if($goOther){
                                $oth = mysqli_num_rows($goOther);

                                $k = "SELECT SUM(tquant) FROM crbs  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Domestic' AND amount != 0 ";
                                $kk = mysqli_query($connect, $k);
                                $kr = mysqli_fetch_array($kk);
                                $alkg = $kr['SUM(tquant)'];

                                 $ka = "SELECT SUM(amount) FROM crbs  WHERE datee = '$dt' AND branch = '$branchCode' AND category = 'Domestic' AND amount != 0 ";
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
                        
                            $Others = "SELECT DISTINCT(crbnumber) FROM crbs WHERE datee = '$dt' AND branch = '$branchCode' AND amount != 0 ";
                            $goOther = mysqli_query($connect, $Others);
                            
                            if($goOther){
                                $oth = mysqli_num_rows($goOther);

                                $k = "SELECT SUM(tquant) FROM crbs  WHERE datee = '$dt' AND branch = '$branchCode' AND amount != 0 ";
                                $kk = mysqli_query($connect, $k);
                                $kr = mysqli_fetch_array($kk);
                                $alkg = $kr['SUM(tquant)'];

                                 $ka = "SELECT SUM(amount) FROM crbs  WHERE datee = '$dt' AND branch = '$branchCode' AND amount != 0 ";
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

                       <!--  <table class='table table-striped table-light' >
                        <thead>
                        <tr> 
                        <th scope='col'>CRB#</th>
                        <th scope='col'>Category</th>
                        <th scope='col'>Kg</th>
                    
                        <th scope='col'>Amount</th>
                        </tr>
                        </thead> 
                        <tbody>
            
                        <?php $createStation->crbReport(); ?>

                        </tbody>
                            </table> -->

                    
                            
            
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
    
        <script>
    
    /*!
    * typeahead.js 0.11.1
    * https://github.com/twitter/typeahead.js
    * Copyright 2013-2015 Twitter, Inc. and other contributors; Licensed MIT
    */

    (function(root, factory) {
        if (typeof define === "function" && define.amd) {
            define("typeahead.js", [ "jquery" ], function(a0) {
                return factory(a0);
            });
        } else if (typeof exports === "object") {
            module.exports = factory(require("jquery"));
        } else {
            factory(jQuery);
        }
    })(this, function($) {
        var _ = function() {
            "use strict";
            return {
                isMsie: function() {
                    return /(msie|trident)/i.test(navigator.userAgent) ? navigator.userAgent.match(/(msie |rv:)(\d+(.\d+)?)/i)[2] : false;
                },
                isBlankString: function(str) {
                    return !str || /^\s*$/.test(str);
                },
                escapeRegExChars: function(str) {
                    return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
                },
                isString: function(obj) {
                    return typeof obj === "string";
                },
                isNumber: function(obj) {
                    return typeof obj === "number";
                },
                isArray: $.isArray,
                isFunction: $.isFunction,
                isObject: $.isPlainObject,
                isUndefined: function(obj) {
                    return typeof obj === "undefined";
                },
                isElement: function(obj) {
                    return !!(obj && obj.nodeType === 1);
                },
                isJQuery: function(obj) {
                    return obj instanceof $;
                },
                toStr: function toStr(s) {
                    return _.isUndefined(s) || s === null ? "" : s + "";
                },
                bind: $.proxy,
                each: function(collection, cb) {
                    $.each(collection, reverseArgs);
                    function reverseArgs(index, value) {
                        return cb(value, index);
                    }
                },
                map: $.map,
                filter: $.grep,
                every: function(obj, test) {
                    var result = true;
                    if (!obj) {
                        return result;
                    }
                    $.each(obj, function(key, val) {
                        if (!(result = test.call(null, val, key, obj))) {
                            return false;
                        }
                    });
                    return !!result;
                },
                some: function(obj, test) {
                    var result = false;
                    if (!obj) {
                        return result;
                    }
                    $.each(obj, function(key, val) {
                        if (result = test.call(null, val, key, obj)) {
                            return false;
                        }
                    });
                    return !!result;
                },
                mixin: $.extend,
                identity: function(x) {
                    return x;
                },
                clone: function(obj) {
                    return $.extend(true, {}, obj);
                },
                getIdGenerator: function() {
                    var counter = 0;
                    return function() {
                        return counter++;
                    };
                },
                templatify: function templatify(obj) {
                    return $.isFunction(obj) ? obj : template;
                    function template() {
                        return String(obj);
                    }
                },
                defer: function(fn) {
                    setTimeout(fn, 0);
                },
                debounce: function(func, wait, immediate) {
                    var timeout, result;
                    return function() {
                        var context = this, args = arguments, later, callNow;
                        later = function() {
                            timeout = null;
                            if (!immediate) {
                                result = func.apply(context, args);
                            }
                        };
                        callNow = immediate && !timeout;
                        clearTimeout(timeout);
                        timeout = setTimeout(later, wait);
                        if (callNow) {
                            result = func.apply(context, args);
                        }
                        return result;
                    };
                },
                throttle: function(func, wait) {
                    var context, args, timeout, result, previous, later;
                    previous = 0;
                    later = function() {
                        previous = new Date();
                        timeout = null;
                        result = func.apply(context, args);
                    };
                    return function() {
                        var now = new Date(), remaining = wait - (now - previous);
                        context = this;
                        args = arguments;
                        if (remaining <= 0) {
                            clearTimeout(timeout);
                            timeout = null;
                            previous = now;
                            result = func.apply(context, args);
                        } else if (!timeout) {
                            timeout = setTimeout(later, remaining);
                        }
                        return result;
                    };
                },
                stringify: function(val) {
                    return _.isString(val) ? val : JSON.stringify(val);
                },
                noop: function() {}
            };
        }();
        var WWW = function() {
            "use strict";
            var defaultClassNames = {
                wrapper: "twitter-typeahead",
                input: "tt-input",
                hint: "tt-hint",
                menu: "tt-menu",
                dataset: "tt-dataset",
                suggestion: "tt-suggestion",
                selectable: "tt-selectable",
                empty: "tt-empty",
                open: "tt-open",
                cursor: "tt-cursor",
                highlight: "tt-highlight"
            };
            return build;
            function build(o) {
                var www, classes;
                classes = _.mixin({}, defaultClassNames, o);
                www = {
                    css: buildCss(),
                    classes: classes,
                    html: buildHtml(classes),
                    selectors: buildSelectors(classes)
                };
                return {
                    css: www.css,
                    html: www.html,
                    classes: www.classes,
                    selectors: www.selectors,
                    mixin: function(o) {
                        _.mixin(o, www);
                    }
                };
            }
            function buildHtml(c) {
                return {
                    wrapper: '<span class="' + c.wrapper + '"></span>',
                    menu: '<div class="' + c.menu + '"></div>'
                };
            }
            function buildSelectors(classes) {
                var selectors = {};
                _.each(classes, function(v, k) {
                    selectors[k] = "." + v;
                });
                return selectors;
            }
            function buildCss() {
                var css = {
                    wrapper: {
                        position: "relative",
                        display: "inline-block"
                    },
                    hint: {
                        position: "absolute",
                        top: "0",
                        left: "0",
                        borderColor: "transparent",
                        boxShadow: "none",
                        opacity: "1"
                    },
                    input: {
                        position: "relative",
                        verticalAlign: "top",
                        backgroundColor: "transparent"
                    },
                    inputWithNoHint: {
                        position: "relative",
                        verticalAlign: "top"
                    },
                    menu: {
                        position: "absolute",
                        top: "100%",
                        left: "0",
                        zIndex: "100",
                        display: "none"
                    },
                    ltr: {
                        left: "0",
                        right: "auto"
                    },
                    rtl: {
                        left: "auto",
                        right: " 0"
                    }
                };
                if (_.isMsie()) {
                    _.mixin(css.input, {
                        backgroundImage: "url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7)"
                    });
                }
                return css;
            }
        }();
        var EventBus = function() {
            "use strict";
            var namespace, deprecationMap;
            namespace = "typeahead:";
            deprecationMap = {
                render: "rendered",
                cursorchange: "cursorchanged",
                select: "selected",
                autocomplete: "autocompleted"
            };
            function EventBus(o) {
                if (!o || !o.el) {
                    $.error("EventBus initialized without el");
                }
                this.$el = $(o.el);
            }
            _.mixin(EventBus.prototype, {
                _trigger: function(type, args) {
                    var $e;
                    $e = $.Event(namespace + type);
                    (args = args || []).unshift($e);
                    this.$el.trigger.apply(this.$el, args);
                    return $e;
                },
                before: function(type) {
                    var args, $e;
                    args = [].slice.call(arguments, 1);
                    $e = this._trigger("before" + type, args);
                    return $e.isDefaultPrevented();
                },
                trigger: function(type) {
                    var deprecatedType;
                    this._trigger(type, [].slice.call(arguments, 1));
                    if (deprecatedType = deprecationMap[type]) {
                        this._trigger(deprecatedType, [].slice.call(arguments, 1));
                    }
                }
            });
            return EventBus;
        }();
        var EventEmitter = function() {
            "use strict";
            var splitter = /\s+/, nextTick = getNextTick();
            return {
                onSync: onSync,
                onAsync: onAsync,
                off: off,
                trigger: trigger
            };
            function on(method, types, cb, context) {
                var type;
                if (!cb) {
                    return this;
                }
                types = types.split(splitter);
                cb = context ? bindContext(cb, context) : cb;
                this._callbacks = this._callbacks || {};
                while (type = types.shift()) {
                    this._callbacks[type] = this._callbacks[type] || {
                        sync: [],
                        async: []
                    };
                    this._callbacks[type][method].push(cb);
                }
                return this;
            }
            function onAsync(types, cb, context) {
                return on.call(this, "async", types, cb, context);
            }
            function onSync(types, cb, context) {
                return on.call(this, "sync", types, cb, context);
            }
            function off(types) {
                var type;
                if (!this._callbacks) {
                    return this;
                }
                types = types.split(splitter);
                while (type = types.shift()) {
                    delete this._callbacks[type];
                }
                return this;
            }
            function trigger(types) {
                var type, callbacks, args, syncFlush, asyncFlush;
                if (!this._callbacks) {
                    return this;
                }
                types = types.split(splitter);
                args = [].slice.call(arguments, 1);
                while ((type = types.shift()) && (callbacks = this._callbacks[type])) {
                    syncFlush = getFlush(callbacks.sync, this, [ type ].concat(args));
                    asyncFlush = getFlush(callbacks.async, this, [ type ].concat(args));
                    syncFlush() && nextTick(asyncFlush);
                }
                return this;
            }
            function getFlush(callbacks, context, args) {
                return flush;
                function flush() {
                    var cancelled;
                    for (var i = 0, len = callbacks.length; !cancelled && i < len; i += 1) {
                        cancelled = callbacks[i].apply(context, args) === false;
                    }
                    return !cancelled;
                }
            }
            function getNextTick() {
                var nextTickFn;
                if (window.setImmediate) {
                    nextTickFn = function nextTickSetImmediate(fn) {
                        setImmediate(function() {
                            fn();
                        });
                    };
                } else {
                    nextTickFn = function nextTickSetTimeout(fn) {
                        setTimeout(function() {
                            fn();
                        }, 0);
                    };
                }
                return nextTickFn;
            }
            function bindContext(fn, context) {
                return fn.bind ? fn.bind(context) : function() {
                    fn.apply(context, [].slice.call(arguments, 0));
                };
            }
        }();
        var highlight = function(doc) {
            "use strict";
            var defaults = {
                node: null,
                pattern: null,
                tagName: "strong",
                className: null,
                wordsOnly: false,
                caseSensitive: false
            };
            return function hightlight(o) {
                var regex;
                o = _.mixin({}, defaults, o);
                if (!o.node || !o.pattern) {
                    return;
                }
                o.pattern = _.isArray(o.pattern) ? o.pattern : [ o.pattern ];
                regex = getRegex(o.pattern, o.caseSensitive, o.wordsOnly);
                traverse(o.node, hightlightTextNode);
                function hightlightTextNode(textNode) {
                    var match, patternNode, wrapperNode;
                    if (match = regex.exec(textNode.data)) {
                        wrapperNode = doc.createElement(o.tagName);
                        o.className && (wrapperNode.className = o.className);
                        patternNode = textNode.splitText(match.index);
                        patternNode.splitText(match[0].length);
                        wrapperNode.appendChild(patternNode.cloneNode(true));
                        textNode.parentNode.replaceChild(wrapperNode, patternNode);
                    }
                    return !!match;
                }
                function traverse(el, hightlightTextNode) {
                    var childNode, TEXT_NODE_TYPE = 3;
                    for (var i = 0; i < el.childNodes.length; i++) {
                        childNode = el.childNodes[i];
                        if (childNode.nodeType === TEXT_NODE_TYPE) {
                            i += hightlightTextNode(childNode) ? 1 : 0;
                        } else {
                            traverse(childNode, hightlightTextNode);
                        }
                    }
                }
            };
            function getRegex(patterns, caseSensitive, wordsOnly) {
                var escapedPatterns = [], regexStr;
                for (var i = 0, len = patterns.length; i < len; i++) {
                    escapedPatterns.push(_.escapeRegExChars(patterns[i]));
                }
                regexStr = wordsOnly ? "\\b(" + escapedPatterns.join("|") + ")\\b" : "(" + escapedPatterns.join("|") + ")";
                return caseSensitive ? new RegExp(regexStr) : new RegExp(regexStr, "i");
            }
        }(window.document);
        var Input = function() {
            "use strict";
            var specialKeyCodeMap;
            specialKeyCodeMap = {
                9: "tab",
                27: "esc",
                37: "left",
                39: "right",
                13: "enter",
                38: "up",
                40: "down"
            };
            function Input(o, www) {
                o = o || {};
                if (!o.input) {
                    $.error("input is missing");
                }
                www.mixin(this);
                this.$hint = $(o.hint);
                this.$input = $(o.input);
                this.query = this.$input.val();
                this.queryWhenFocused = this.hasFocus() ? this.query : null;
                this.$overflowHelper = buildOverflowHelper(this.$input);
                this._checkLanguageDirection();
                if (this.$hint.length === 0) {
                    this.setHint = this.getHint = this.clearHint = this.clearHintIfInvalid = _.noop;
                }
            }
            Input.normalizeQuery = function(str) {
                return _.toStr(str).replace(/^\s*/g, "").replace(/\s{2,}/g, " ");
            };
            _.mixin(Input.prototype, EventEmitter, {
                _onBlur: function onBlur() {
                    this.resetInputValue();
                    this.trigger("blurred");
                },
                _onFocus: function onFocus() {
                    this.queryWhenFocused = this.query;
                    this.trigger("focused");
                },
                _onKeydown: function onKeydown($e) {
                    var keyName = specialKeyCodeMap[$e.which || $e.keyCode];
                    this._managePreventDefault(keyName, $e);
                    if (keyName && this._shouldTrigger(keyName, $e)) {
                        this.trigger(keyName + "Keyed", $e);
                    }
                },
                _onInput: function onInput() {
                    this._setQuery(this.getInputValue());
                    this.clearHintIfInvalid();
                    this._checkLanguageDirection();
                },
                _managePreventDefault: function managePreventDefault(keyName, $e) {
                    var preventDefault;
                    switch (keyName) {
                    case "up":
                    case "down":
                        preventDefault = !withModifier($e);
                        break;

                    default:
                        preventDefault = false;
                    }
                    preventDefault && $e.preventDefault();
                },
                _shouldTrigger: function shouldTrigger(keyName, $e) {
                    var trigger;
                    switch (keyName) {
                    case "tab":
                        trigger = !withModifier($e);
                        break;

                    default:
                        trigger = true;
                    }
                    return trigger;
                },
                _checkLanguageDirection: function checkLanguageDirection() {
                    var dir = (this.$input.css("direction") || "ltr").toLowerCase();
                    if (this.dir !== dir) {
                        this.dir = dir;
                        this.$hint.attr("dir", dir);
                        this.trigger("langDirChanged", dir);
                    }
                },
                _setQuery: function setQuery(val, silent) {
                    var areEquivalent, hasDifferentWhitespace;
                    areEquivalent = areQueriesEquivalent(val, this.query);
                    hasDifferentWhitespace = areEquivalent ? this.query.length !== val.length : false;
                    this.query = val;
                    if (!silent && !areEquivalent) {
                        this.trigger("queryChanged", this.query);
                    } else if (!silent && hasDifferentWhitespace) {
                        this.trigger("whitespaceChanged", this.query);
                    }
                },
                bind: function() {
                    var that = this, onBlur, onFocus, onKeydown, onInput;
                    onBlur = _.bind(this._onBlur, this);
                    onFocus = _.bind(this._onFocus, this);
                    onKeydown = _.bind(this._onKeydown, this);
                    onInput = _.bind(this._onInput, this);
                    this.$input.on("blur.tt", onBlur).on("focus.tt", onFocus).on("keydown.tt", onKeydown);
                    if (!_.isMsie() || _.isMsie() > 9) {
                        this.$input.on("input.tt", onInput);
                    } else {
                        this.$input.on("keydown.tt keypress.tt cut.tt paste.tt", function($e) {
                            if (specialKeyCodeMap[$e.which || $e.keyCode]) {
                                return;
                            }
                            _.defer(_.bind(that._onInput, that, $e));
                        });
                    }
                    return this;
                },
                focus: function focus() {
                    this.$input.focus();
                },
                blur: function blur() {
                    this.$input.blur();
                },
                getLangDir: function getLangDir() {
                    return this.dir;
                },
                getQuery: function getQuery() {
                    return this.query || "";
                },
                setQuery: function setQuery(val, silent) {
                    this.setInputValue(val);
                    this._setQuery(val, silent);
                },
                hasQueryChangedSinceLastFocus: function hasQueryChangedSinceLastFocus() {
                    return this.query !== this.queryWhenFocused;
                },
                getInputValue: function getInputValue() {
                    return this.$input.val();
                },
                setInputValue: function setInputValue(value) {
                    this.$input.val(value);
                    this.clearHintIfInvalid();
                    this._checkLanguageDirection();
                },
                resetInputValue: function resetInputValue() {
                    this.setInputValue(this.query);
                },
                getHint: function getHint() {
                    return this.$hint.val();
                },
                setHint: function setHint(value) {
                    this.$hint.val(value);
                },
                clearHint: function clearHint() {
                    this.setHint("");
                },
                clearHintIfInvalid: function clearHintIfInvalid() {
                    var val, hint, valIsPrefixOfHint, isValid;
                    val = this.getInputValue();
                    hint = this.getHint();
                    valIsPrefixOfHint = val !== hint && hint.indexOf(val) === 0;
                    isValid = val !== "" && valIsPrefixOfHint && !this.hasOverflow();
                    !isValid && this.clearHint();
                },
                hasFocus: function hasFocus() {
                    return this.$input.is(":focus");
                },
                hasOverflow: function hasOverflow() {
                    var constraint = this.$input.width() - 2;
                    this.$overflowHelper.text(this.getInputValue());
                    return this.$overflowHelper.width() >= constraint;
                },
                isCursorAtEnd: function() {
                    var valueLength, selectionStart, range;
                    valueLength = this.$input.val().length;
                    selectionStart = this.$input[0].selectionStart;
                    if (_.isNumber(selectionStart)) {
                        return selectionStart === valueLength;
                    } else if (document.selection) {
                        range = document.selection.createRange();
                        range.moveStart("character", -valueLength);
                        return valueLength === range.text.length;
                    }
                    return true;
                },
                destroy: function destroy() {
                    this.$hint.off(".tt");
                    this.$input.off(".tt");
                    this.$overflowHelper.remove();
                    this.$hint = this.$input = this.$overflowHelper = $("<div>");
                }
            });
            return Input;
            function buildOverflowHelper($input) {
                return $('<pre aria-hidden="true"></pre>').css({
                    position: "absolute",
                    visibility: "hidden",
                    whiteSpace: "pre",
                    fontFamily: $input.css("font-family"),
                    fontSize: $input.css("font-size"),
                    fontStyle: $input.css("font-style"),
                    fontVariant: $input.css("font-variant"),
                    fontWeight: $input.css("font-weight"),
                    wordSpacing: $input.css("word-spacing"),
                    letterSpacing: $input.css("letter-spacing"),
                    textIndent: $input.css("text-indent"),
                    textRendering: $input.css("text-rendering"),
                    textTransform: $input.css("text-transform")
                }).insertAfter($input);
            }
            function areQueriesEquivalent(a, b) {
                return Input.normalizeQuery(a) === Input.normalizeQuery(b);
            }
            function withModifier($e) {
                return $e.altKey || $e.ctrlKey || $e.metaKey || $e.shiftKey;
            }
        }();
        var Dataset = function() {
            "use strict";
            var keys, nameGenerator;
            keys = {
                val: "tt-selectable-display",
                obj: "tt-selectable-object"
            };
            nameGenerator = _.getIdGenerator();
            function Dataset(o, www) {
                o = o || {};
                o.templates = o.templates || {};
                o.templates.notFound = o.templates.notFound || o.templates.empty;
                if (!o.source) {
                    $.error("missing source");
                }
                if (!o.node) {
                    $.error("missing node");
                }
                if (o.name && !isValidName(o.name)) {
                    $.error("invalid dataset name: " + o.name);
                }
                www.mixin(this);
                this.highlight = !!o.highlight;
                this.name = o.name || nameGenerator();
                this.limit = o.limit || 5;
                this.displayFn = getDisplayFn(o.display || o.displayKey);
                this.templates = getTemplates(o.templates, this.displayFn);
                this.source = o.source.__ttAdapter ? o.source.__ttAdapter() : o.source;
                this.async = _.isUndefined(o.async) ? this.source.length > 2 : !!o.async;
                this._resetLastSuggestion();
                this.$el = $(o.node).addClass(this.classes.dataset).addClass(this.classes.dataset + "-" + this.name);
            }
            Dataset.extractData = function extractData(el) {
                var $el = $(el);
                if ($el.data(keys.obj)) {
                    return {
                        val: $el.data(keys.val) || "",
                        obj: $el.data(keys.obj) || null
                    };
                }
                return null;
            };
            _.mixin(Dataset.prototype, EventEmitter, {
                _overwrite: function overwrite(query, suggestions) {
                    suggestions = suggestions || [];
                    if (suggestions.length) {
                        this._renderSuggestions(query, suggestions);
                    } else if (this.async && this.templates.pending) {
                        this._renderPending(query);
                    } else if (!this.async && this.templates.notFound) {
                        this._renderNotFound(query);
                    } else {
                        this._empty();
                    }
                    this.trigger("rendered", this.name, suggestions, false);
                },
                _append: function append(query, suggestions) {
                    suggestions = suggestions || [];
                    if (suggestions.length && this.$lastSuggestion.length) {
                        this._appendSuggestions(query, suggestions);
                    } else if (suggestions.length) {
                        this._renderSuggestions(query, suggestions);
                    } else if (!this.$lastSuggestion.length && this.templates.notFound) {
                        this._renderNotFound(query);
                    }
                    this.trigger("rendered", this.name, suggestions, true);
                },
                _renderSuggestions: function renderSuggestions(query, suggestions) {
                    var $fragment;
                    $fragment = this._getSuggestionsFragment(query, suggestions);
                    this.$lastSuggestion = $fragment.children().last();
                    this.$el.html($fragment).prepend(this._getHeader(query, suggestions)).append(this._getFooter(query, suggestions));
                },
                _appendSuggestions: function appendSuggestions(query, suggestions) {
                    var $fragment, $lastSuggestion;
                    $fragment = this._getSuggestionsFragment(query, suggestions);
                    $lastSuggestion = $fragment.children().last();
                    this.$lastSuggestion.after($fragment);
                    this.$lastSuggestion = $lastSuggestion;
                },
                _renderPending: function renderPending(query) {
                    var template = this.templates.pending;
                    this._resetLastSuggestion();
                    template && this.$el.html(template({
                        query: query,
                        dataset: this.name
                    }));
                },
                _renderNotFound: function renderNotFound(query) {
                    var template = this.templates.notFound;
                    this._resetLastSuggestion();
                    template && this.$el.html(template({
                        query: query,
                        dataset: this.name
                    }));
                },
                _empty: function empty() {
                    this.$el.empty();
                    this._resetLastSuggestion();
                },
                _getSuggestionsFragment: function getSuggestionsFragment(query, suggestions) {
                    var that = this, fragment;
                    fragment = document.createDocumentFragment();
                    _.each(suggestions, function getSuggestionNode(suggestion) {
                        var $el, context;
                        context = that._injectQuery(query, suggestion);
                        $el = $(that.templates.suggestion(context)).data(keys.obj, suggestion).data(keys.val, that.displayFn(suggestion)).addClass(that.classes.suggestion + " " + that.classes.selectable);
                        fragment.appendChild($el[0]);
                    });
                    this.highlight && highlight({
                        className: this.classes.highlight,
                        node: fragment,
                        pattern: query
                    });
                    return $(fragment);
                },
                _getFooter: function getFooter(query, suggestions) {
                    return this.templates.footer ? this.templates.footer({
                        query: query,
                        suggestions: suggestions,
                        dataset: this.name
                    }) : null;
                },
                _getHeader: function getHeader(query, suggestions) {
                    return this.templates.header ? this.templates.header({
                        query: query,
                        suggestions: suggestions,
                        dataset: this.name
                    }) : null;
                },
                _resetLastSuggestion: function resetLastSuggestion() {
                    this.$lastSuggestion = $();
                },
                _injectQuery: function injectQuery(query, obj) {
                    return _.isObject(obj) ? _.mixin({
                        _query: query
                    }, obj) : obj;
                },
                update: function update(query) {
                    var that = this, canceled = false, syncCalled = false, rendered = 0;
                    this.cancel();
                    this.cancel = function cancel() {
                        canceled = true;
                        that.cancel = $.noop;
                        that.async && that.trigger("asyncCanceled", query);
                    };
                    this.source(query, sync, async);
                    !syncCalled && sync([]);
                    function sync(suggestions) {
                        if (syncCalled) {
                            return;
                        }
                        syncCalled = true;
                        suggestions = (suggestions || []).slice(0, that.limit);
                        rendered = suggestions.length;
                        that._overwrite(query, suggestions);
                        if (rendered < that.limit && that.async) {
                            that.trigger("asyncRequested", query);
                        }
                    }
                    function async(suggestions) {
                        suggestions = suggestions || [];
                        if (!canceled && rendered < that.limit) {
                            that.cancel = $.noop;
                            rendered += suggestions.length;
                            that._append(query, suggestions.slice(0, that.limit - rendered));
                            that.async && that.trigger("asyncReceived", query);
                        }
                    }
                },
                cancel: $.noop,
                clear: function clear() {
                    this._empty();
                    this.cancel();
                    this.trigger("cleared");
                },
                isEmpty: function isEmpty() {
                    return this.$el.is(":empty");
                },
                destroy: function destroy() {
                    this.$el = $("<div>");
                }
            });
            return Dataset;
            function getDisplayFn(display) {
                display = display || _.stringify;
                return _.isFunction(display) ? display : displayFn;
                function displayFn(obj) {
                    return obj[display];
                }
            }
            function getTemplates(templates, displayFn) {
                return {
                    notFound: templates.notFound && _.templatify(templates.notFound),
                    pending: templates.pending && _.templatify(templates.pending),
                    header: templates.header && _.templatify(templates.header),
                    footer: templates.footer && _.templatify(templates.footer),
                    suggestion: templates.suggestion || suggestionTemplate
                };
                function suggestionTemplate(context) {
                    return $("<div>").text(displayFn(context));
                }
            }
            function isValidName(str) {
                return /^[_a-zA-Z0-9-]+$/.test(str);
            }
        }();
        var Menu = function() {
            "use strict";
            function Menu(o, www) {
                var that = this;
                o = o || {};
                if (!o.node) {
                    $.error("node is required");
                }
                www.mixin(this);
                this.$node = $(o.node);
                this.query = null;
                this.datasets = _.map(o.datasets, initializeDataset);
                function initializeDataset(oDataset) {
                    var node = that.$node.find(oDataset.node).first();
                    oDataset.node = node.length ? node : $("<div>").appendTo(that.$node);
                    return new Dataset(oDataset, www);
                }
            }
            _.mixin(Menu.prototype, EventEmitter, {
                _onSelectableClick: function onSelectableClick($e) {
                    this.trigger("selectableClicked", $($e.currentTarget));
                },
                _onRendered: function onRendered(type, dataset, suggestions, async) {
                    this.$node.toggleClass(this.classes.empty, this._allDatasetsEmpty());
                    this.trigger("datasetRendered", dataset, suggestions, async);
                },
                _onCleared: function onCleared() {
                    this.$node.toggleClass(this.classes.empty, this._allDatasetsEmpty());
                    this.trigger("datasetCleared");
                },
                _propagate: function propagate() {
                    this.trigger.apply(this, arguments);
                },
                _allDatasetsEmpty: function allDatasetsEmpty() {
                    return _.every(this.datasets, isDatasetEmpty);
                    function isDatasetEmpty(dataset) {
                        return dataset.isEmpty();
                    }
                },
                _getSelectables: function getSelectables() {
                    return this.$node.find(this.selectors.selectable);
                },
                _removeCursor: function _removeCursor() {
                    var $selectable = this.getActiveSelectable();
                    $selectable && $selectable.removeClass(this.classes.cursor);
                },
                _ensureVisible: function ensureVisible($el) {
                    var elTop, elBottom, nodeScrollTop, nodeHeight;
                    elTop = $el.position().top;
                    elBottom = elTop + $el.outerHeight(true);
                    nodeScrollTop = this.$node.scrollTop();
                    nodeHeight = this.$node.height() + parseInt(this.$node.css("paddingTop"), 10) + parseInt(this.$node.css("paddingBottom"), 10);
                    if (elTop < 0) {
                        this.$node.scrollTop(nodeScrollTop + elTop);
                    } else if (nodeHeight < elBottom) {
                        this.$node.scrollTop(nodeScrollTop + (elBottom - nodeHeight));
                    }
                },
                bind: function() {
                    var that = this, onSelectableClick;
                    onSelectableClick = _.bind(this._onSelectableClick, this);
                    this.$node.on("click.tt", this.selectors.selectable, onSelectableClick);
                    _.each(this.datasets, function(dataset) {
                        dataset.onSync("asyncRequested", that._propagate, that).onSync("asyncCanceled", that._propagate, that).onSync("asyncReceived", that._propagate, that).onSync("rendered", that._onRendered, that).onSync("cleared", that._onCleared, that);
                    });
                    return this;
                },
                isOpen: function isOpen() {
                    return this.$node.hasClass(this.classes.open);
                },
                open: function open() {
                    this.$node.addClass(this.classes.open);
                },
                close: function close() {
                    this.$node.removeClass(this.classes.open);
                    this._removeCursor();
                },
                setLanguageDirection: function setLanguageDirection(dir) {
                    this.$node.attr("dir", dir);
                },
                selectableRelativeToCursor: function selectableRelativeToCursor(delta) {
                    var $selectables, $oldCursor, oldIndex, newIndex;
                    $oldCursor = this.getActiveSelectable();
                    $selectables = this._getSelectables();
                    oldIndex = $oldCursor ? $selectables.index($oldCursor) : -1;
                    newIndex = oldIndex + delta;
                    newIndex = (newIndex + 1) % ($selectables.length + 1) - 1;
                    newIndex = newIndex < -1 ? $selectables.length - 1 : newIndex;
                    return newIndex === -1 ? null : $selectables.eq(newIndex);
                },
                setCursor: function setCursor($selectable) {
                    this._removeCursor();
                    if ($selectable = $selectable && $selectable.first()) {
                        $selectable.addClass(this.classes.cursor);
                        this._ensureVisible($selectable);
                    }
                },
                getSelectableData: function getSelectableData($el) {
                    return $el && $el.length ? Dataset.extractData($el) : null;
                },
                getActiveSelectable: function getActiveSelectable() {
                    var $selectable = this._getSelectables().filter(this.selectors.cursor).first();
                    return $selectable.length ? $selectable : null;
                },
                getTopSelectable: function getTopSelectable() {
                    var $selectable = this._getSelectables().first();
                    return $selectable.length ? $selectable : null;
                },
                update: function update(query) {
                    var isValidUpdate = query !== this.query;
                    if (isValidUpdate) {
                        this.query = query;
                        _.each(this.datasets, updateDataset);
                    }
                    return isValidUpdate;
                    function updateDataset(dataset) {
                        dataset.update(query);
                    }
                },
                empty: function empty() {
                    _.each(this.datasets, clearDataset);
                    this.query = null;
                    this.$node.addClass(this.classes.empty);
                    function clearDataset(dataset) {
                        dataset.clear();
                    }
                },
                destroy: function destroy() {
                    this.$node.off(".tt");
                    this.$node = $("<div>");
                    _.each(this.datasets, destroyDataset);
                    function destroyDataset(dataset) {
                        dataset.destroy();
                    }
                }
            });
            return Menu;
        }();
        var DefaultMenu = function() {
            "use strict";
            var s = Menu.prototype;
            function DefaultMenu() {
                Menu.apply(this, [].slice.call(arguments, 0));
            }
            _.mixin(DefaultMenu.prototype, Menu.prototype, {
                open: function open() {
                    !this._allDatasetsEmpty() && this._show();
                    return s.open.apply(this, [].slice.call(arguments, 0));
                },
                close: function close() {
                    this._hide();
                    return s.close.apply(this, [].slice.call(arguments, 0));
                },
                _onRendered: function onRendered() {
                    if (this._allDatasetsEmpty()) {
                        this._hide();
                    } else {
                        this.isOpen() && this._show();
                    }
                    return s._onRendered.apply(this, [].slice.call(arguments, 0));
                },
                _onCleared: function onCleared() {
                    if (this._allDatasetsEmpty()) {
                        this._hide();
                    } else {
                        this.isOpen() && this._show();
                    }
                    return s._onCleared.apply(this, [].slice.call(arguments, 0));
                },
                setLanguageDirection: function setLanguageDirection(dir) {
                    this.$node.css(dir === "ltr" ? this.css.ltr : this.css.rtl);
                    return s.setLanguageDirection.apply(this, [].slice.call(arguments, 0));
                },
                _hide: function hide() {
                    this.$node.hide();
                },
                _show: function show() {
                    this.$node.css("display", "block");
                }
            });
            return DefaultMenu;
        }();
        var Typeahead = function() {
            "use strict";
            function Typeahead(o, www) {
                var onFocused, onBlurred, onEnterKeyed, onTabKeyed, onEscKeyed, onUpKeyed, onDownKeyed, onLeftKeyed, onRightKeyed, onQueryChanged, onWhitespaceChanged;
                o = o || {};
                if (!o.input) {
                    $.error("missing input");
                }
                if (!o.menu) {
                    $.error("missing menu");
                }
                if (!o.eventBus) {
                    $.error("missing event bus");
                }
                www.mixin(this);
                this.eventBus = o.eventBus;
                this.minLength = _.isNumber(o.minLength) ? o.minLength : 1;
                this.input = o.input;
                this.menu = o.menu;
                this.enabled = true;
                this.active = false;
                this.input.hasFocus() && this.activate();
                this.dir = this.input.getLangDir();
                this._hacks();
                this.menu.bind().onSync("selectableClicked", this._onSelectableClicked, this).onSync("asyncRequested", this._onAsyncRequested, this).onSync("asyncCanceled", this._onAsyncCanceled, this).onSync("asyncReceived", this._onAsyncReceived, this).onSync("datasetRendered", this._onDatasetRendered, this).onSync("datasetCleared", this._onDatasetCleared, this);
                onFocused = c(this, "activate", "open", "_onFocused");
                onBlurred = c(this, "deactivate", "_onBlurred");
                onEnterKeyed = c(this, "isActive", "isOpen", "_onEnterKeyed");
                onTabKeyed = c(this, "isActive", "isOpen", "_onTabKeyed");
                onEscKeyed = c(this, "isActive", "_onEscKeyed");
                onUpKeyed = c(this, "isActive", "open", "_onUpKeyed");
                onDownKeyed = c(this, "isActive", "open", "_onDownKeyed");
                onLeftKeyed = c(this, "isActive", "isOpen", "_onLeftKeyed");
                onRightKeyed = c(this, "isActive", "isOpen", "_onRightKeyed");
                onQueryChanged = c(this, "_openIfActive", "_onQueryChanged");
                onWhitespaceChanged = c(this, "_openIfActive", "_onWhitespaceChanged");
                this.input.bind().onSync("focused", onFocused, this).onSync("blurred", onBlurred, this).onSync("enterKeyed", onEnterKeyed, this).onSync("tabKeyed", onTabKeyed, this).onSync("escKeyed", onEscKeyed, this).onSync("upKeyed", onUpKeyed, this).onSync("downKeyed", onDownKeyed, this).onSync("leftKeyed", onLeftKeyed, this).onSync("rightKeyed", onRightKeyed, this).onSync("queryChanged", onQueryChanged, this).onSync("whitespaceChanged", onWhitespaceChanged, this).onSync("langDirChanged", this._onLangDirChanged, this);
            }
            _.mixin(Typeahead.prototype, {
                _hacks: function hacks() {
                    var $input, $menu;
                    $input = this.input.$input || $("<div>");
                    $menu = this.menu.$node || $("<div>");
                    $input.on("blur.tt", function($e) {
                        var active, isActive, hasActive;
                        active = document.activeElement;
                        isActive = $menu.is(active);
                        hasActive = $menu.has(active).length > 0;
                        if (_.isMsie() && (isActive || hasActive)) {
                            $e.preventDefault();
                            $e.stopImmediatePropagation();
                            _.defer(function() {
                                $input.focus();
                            });
                        }
                    });
                    $menu.on("mousedown.tt", function($e) {
                        $e.preventDefault();
                    });
                },
                _onSelectableClicked: function onSelectableClicked(type, $el) {
                    this.select($el);
                },
                _onDatasetCleared: function onDatasetCleared() {
                    this._updateHint();
                },
                _onDatasetRendered: function onDatasetRendered(type, dataset, suggestions, async) {
                    this._updateHint();
                    this.eventBus.trigger("render", suggestions, async, dataset);
                },
                _onAsyncRequested: function onAsyncRequested(type, dataset, query) {
                    this.eventBus.trigger("asyncrequest", query, dataset);
                },
                _onAsyncCanceled: function onAsyncCanceled(type, dataset, query) {
                    this.eventBus.trigger("asynccancel", query, dataset);
                },
                _onAsyncReceived: function onAsyncReceived(type, dataset, query) {
                    this.eventBus.trigger("asyncreceive", query, dataset);
                },
                _onFocused: function onFocused() {
                    this._minLengthMet() && this.menu.update(this.input.getQuery());
                },
                _onBlurred: function onBlurred() {
                    if (this.input.hasQueryChangedSinceLastFocus()) {
                        this.eventBus.trigger("change", this.input.getQuery());
                    }
                },
                _onEnterKeyed: function onEnterKeyed(type, $e) {
                    var $selectable;
                    if ($selectable = this.menu.getActiveSelectable()) {
                        this.select($selectable) && $e.preventDefault();
                    }
                },
                _onTabKeyed: function onTabKeyed(type, $e) {
                    var $selectable;
                    if ($selectable = this.menu.getActiveSelectable()) {
                        this.select($selectable) && $e.preventDefault();
                    } else if ($selectable = this.menu.getTopSelectable()) {
                        this.autocomplete($selectable) && $e.preventDefault();
                    }
                },
                _onEscKeyed: function onEscKeyed() {
                    this.close();
                },
                _onUpKeyed: function onUpKeyed() {
                    this.moveCursor(-1);
                },
                _onDownKeyed: function onDownKeyed() {
                    this.moveCursor(+1);
                },
                _onLeftKeyed: function onLeftKeyed() {
                    if (this.dir === "rtl" && this.input.isCursorAtEnd()) {
                        this.autocomplete(this.menu.getTopSelectable());
                    }
                },
                _onRightKeyed: function onRightKeyed() {
                    if (this.dir === "ltr" && this.input.isCursorAtEnd()) {
                        this.autocomplete(this.menu.getTopSelectable());
                    }
                },
                _onQueryChanged: function onQueryChanged(e, query) {
                    this._minLengthMet(query) ? this.menu.update(query) : this.menu.empty();
                },
                _onWhitespaceChanged: function onWhitespaceChanged() {
                    this._updateHint();
                },
                _onLangDirChanged: function onLangDirChanged(e, dir) {
                    if (this.dir !== dir) {
                        this.dir = dir;
                        this.menu.setLanguageDirection(dir);
                    }
                },
                _openIfActive: function openIfActive() {
                    this.isActive() && this.open();
                },
                _minLengthMet: function minLengthMet(query) {
                    query = _.isString(query) ? query : this.input.getQuery() || "";
                    return query.length >= this.minLength;
                },
                _updateHint: function updateHint() {
                    var $selectable, data, val, query, escapedQuery, frontMatchRegEx, match;
                    $selectable = this.menu.getTopSelectable();
                    data = this.menu.getSelectableData($selectable);
                    val = this.input.getInputValue();
                    if (data && !_.isBlankString(val) && !this.input.hasOverflow()) {
                        query = Input.normalizeQuery(val);
                        escapedQuery = _.escapeRegExChars(query);
                        frontMatchRegEx = new RegExp("^(?:" + escapedQuery + ")(.+$)", "i");
                        match = frontMatchRegEx.exec(data.val);
                        match && this.input.setHint(val + match[1]);
                    } else {
                        this.input.clearHint();
                    }
                },
                isEnabled: function isEnabled() {
                    return this.enabled;
                },
                enable: function enable() {
                    this.enabled = true;
                },
                disable: function disable() {
                    this.enabled = false;
                },
                isActive: function isActive() {
                    return this.active;
                },
                activate: function activate() {
                    if (this.isActive()) {
                        return true;
                    } else if (!this.isEnabled() || this.eventBus.before("active")) {
                        return false;
                    } else {
                        this.active = true;
                        this.eventBus.trigger("active");
                        return true;
                    }
                },
                deactivate: function deactivate() {
                    if (!this.isActive()) {
                        return true;
                    } else if (this.eventBus.before("idle")) {
                        return false;
                    } else {
                        this.active = false;
                        this.close();
                        this.eventBus.trigger("idle");
                        return true;
                    }
                },
                isOpen: function isOpen() {
                    return this.menu.isOpen();
                },
                open: function open() {
                    if (!this.isOpen() && !this.eventBus.before("open")) {
                        this.menu.open();
                        this._updateHint();
                        this.eventBus.trigger("open");
                    }
                    return this.isOpen();
                },
                close: function close() {
                    if (this.isOpen() && !this.eventBus.before("close")) {
                        this.menu.close();
                        this.input.clearHint();
                        this.input.resetInputValue();
                        this.eventBus.trigger("close");
                    }
                    return !this.isOpen();
                },
                setVal: function setVal(val) {
                    this.input.setQuery(_.toStr(val));
                },
                getVal: function getVal() {
                    return this.input.getQuery();
                },
                select: function select($selectable) {
                    var data = this.menu.getSelectableData($selectable);
                    if (data && !this.eventBus.before("select", data.obj)) {
                        this.input.setQuery(data.val, true);
                        this.eventBus.trigger("select", data.obj);
                        this.close();
                        return true;
                    }
                    return false;
                },
                autocomplete: function autocomplete($selectable) {
                    var query, data, isValid;
                    query = this.input.getQuery();
                    data = this.menu.getSelectableData($selectable);
                    isValid = data && query !== data.val;
                    if (isValid && !this.eventBus.before("autocomplete", data.obj)) {
                        this.input.setQuery(data.val);
                        this.eventBus.trigger("autocomplete", data.obj);
                        return true;
                    }
                    return false;
                },
                moveCursor: function moveCursor(delta) {
                    var query, $candidate, data, payload, cancelMove;
                    query = this.input.getQuery();
                    $candidate = this.menu.selectableRelativeToCursor(delta);
                    data = this.menu.getSelectableData($candidate);
                    payload = data ? data.obj : null;
                    cancelMove = this._minLengthMet() && this.menu.update(query);
                    if (!cancelMove && !this.eventBus.before("cursorchange", payload)) {
                        this.menu.setCursor($candidate);
                        if (data) {
                            this.input.setInputValue(data.val);
                        } else {
                            this.input.resetInputValue();
                            this._updateHint();
                        }
                        this.eventBus.trigger("cursorchange", payload);
                        return true;
                    }
                    return false;
                },
                destroy: function destroy() {
                    this.input.destroy();
                    this.menu.destroy();
                }
            });
            return Typeahead;
            function c(ctx) {
                var methods = [].slice.call(arguments, 1);
                return function() {
                    var args = [].slice.call(arguments);
                    _.each(methods, function(method) {
                        return ctx[method].apply(ctx, args);
                    });
                };
            }
        }();
        (function() {
            "use strict";
            var old, keys, methods;
            old = $.fn.typeahead;
            keys = {
                www: "tt-www",
                attrs: "tt-attrs",
                typeahead: "tt-typeahead"
            };
            methods = {
                initialize: function initialize(o, datasets) {
                    var www;
                    datasets = _.isArray(datasets) ? datasets : [].slice.call(arguments, 1);
                    o = o || {};
                    www = WWW(o.classNames);
                    return this.each(attach);
                    function attach() {
                        var $input, $wrapper, $hint, $menu, defaultHint, defaultMenu, eventBus, input, menu, typeahead, MenuConstructor;
                        _.each(datasets, function(d) {
                            d.highlight = !!o.highlight;
                        });
                        $input = $(this);
                        $wrapper = $(www.html.wrapper);
                        $hint = $elOrNull(o.hint);
                        $menu = $elOrNull(o.menu);
                        defaultHint = o.hint !== false && !$hint;
                        defaultMenu = o.menu !== false && !$menu;
                        defaultHint && ($hint = buildHintFromInput($input, www));
                        defaultMenu && ($menu = $(www.html.menu).css(www.css.menu));
                        $hint && $hint.val("");
                        $input = prepInput($input, www);
                        if (defaultHint || defaultMenu) {
                            $wrapper.css(www.css.wrapper);
                            $input.css(defaultHint ? www.css.input : www.css.inputWithNoHint);
                            $input.wrap($wrapper).parent().prepend(defaultHint ? $hint : null).append(defaultMenu ? $menu : null);
                        }
                        MenuConstructor = defaultMenu ? DefaultMenu : Menu;
                        eventBus = new EventBus({
                            el: $input
                        });
                        input = new Input({
                            hint: $hint,
                            input: $input
                        }, www);
                        menu = new MenuConstructor({
                            node: $menu,
                            datasets: datasets
                        }, www);
                        typeahead = new Typeahead({
                            input: input,
                            menu: menu,
                            eventBus: eventBus,
                            minLength: o.minLength
                        }, www);
                        $input.data(keys.www, www);
                        $input.data(keys.typeahead, typeahead);
                    }
                },
                isEnabled: function isEnabled() {
                    var enabled;
                    ttEach(this.first(), function(t) {
                        enabled = t.isEnabled();
                    });
                    return enabled;
                },
                enable: function enable() {
                    ttEach(this, function(t) {
                        t.enable();
                    });
                    return this;
                },
                disable: function disable() {
                    ttEach(this, function(t) {
                        t.disable();
                    });
                    return this;
                },
                isActive: function isActive() {
                    var active;
                    ttEach(this.first(), function(t) {
                        active = t.isActive();
                    });
                    return active;
                },
                activate: function activate() {
                    ttEach(this, function(t) {
                        t.activate();
                    });
                    return this;
                },
                deactivate: function deactivate() {
                    ttEach(this, function(t) {
                        t.deactivate();
                    });
                    return this;
                },
                isOpen: function isOpen() {
                    var open;
                    ttEach(this.first(), function(t) {
                        open = t.isOpen();
                    });
                    return open;
                },
                open: function open() {
                    ttEach(this, function(t) {
                        t.open();
                    });
                    return this;
                },
                close: function close() {
                    ttEach(this, function(t) {
                        t.close();
                    });
                    return this;
                },
                select: function select(el) {
                    var success = false, $el = $(el);
                    ttEach(this.first(), function(t) {
                        success = t.select($el);
                    });
                    return success;
                },
                autocomplete: function autocomplete(el) {
                    var success = false, $el = $(el);
                    ttEach(this.first(), function(t) {
                        success = t.autocomplete($el);
                    });
                    return success;
                },
                moveCursor: function moveCursoe(delta) {
                    var success = false;
                    ttEach(this.first(), function(t) {
                        success = t.moveCursor(delta);
                    });
                    return success;
                },
                val: function val(newVal) {
                    var query;
                    if (!arguments.length) {
                        ttEach(this.first(), function(t) {
                            query = t.getVal();
                        });
                        return query;
                    } else {
                        ttEach(this, function(t) {
                            t.setVal(newVal);
                        });
                        return this;
                    }
                },
                destroy: function destroy() {
                    ttEach(this, function(typeahead, $input) {
                        revert($input);
                        typeahead.destroy();
                    });
                    return this;
                }
            };
            $.fn.typeahead = function(method) {
                if (methods[method]) {
                    return methods[method].apply(this, [].slice.call(arguments, 1));
                } else {
                    return methods.initialize.apply(this, arguments);
                }
            };
            $.fn.typeahead.noConflict = function noConflict() {
                $.fn.typeahead = old;
                return this;
            };
            function ttEach($els, fn) {
                $els.each(function() {
                    var $input = $(this), typeahead;
                    (typeahead = $input.data(keys.typeahead)) && fn(typeahead, $input);
                });
            }
            function buildHintFromInput($input, www) {
                return $input.clone().addClass(www.classes.hint).removeData().css(www.css.hint).css(getBackgroundStyles($input)).prop("readonly", true).removeAttr("id name placeholder required").attr({
                    autocomplete: "off",
                    spellcheck: "false",
                    tabindex: -1
                });
            }
            function prepInput($input, www) {
                $input.data(keys.attrs, {
                    dir: $input.attr("dir"),
                    autocomplete: $input.attr("autocomplete"),
                    spellcheck: $input.attr("spellcheck"),
                    style: $input.attr("style")
                });
                $input.addClass(www.classes.input).attr({
                    autocomplete: "off",
                    spellcheck: false
                });
                try {
                    !$input.attr("dir") && $input.attr("dir", "auto");
                } catch (e) {}
                return $input;
            }
            function getBackgroundStyles($el) {
                return {
                    backgroundAttachment: $el.css("background-attachment"),
                    backgroundClip: $el.css("background-clip"),
                    backgroundColor: $el.css("background-color"),
                    backgroundImage: $el.css("background-image"),
                    backgroundOrigin: $el.css("background-origin"),
                    backgroundPosition: $el.css("background-position"),
                    backgroundRepeat: $el.css("background-repeat"),
                    backgroundSize: $el.css("background-size")
                };
            }
            function revert($input) {
                var www, $wrapper;
                www = $input.data(keys.www);
                $wrapper = $input.parent().filter(www.selectors.wrapper);
                _.each($input.data(keys.attrs), function(val, key) {
                    _.isUndefined(val) ? $input.removeAttr(key) : $input.attr(key, val);
                });
                $input.removeData(keys.typeahead).removeData(keys.www).removeData(keys.attr).removeClass(www.classes.input);
                if ($wrapper.length) {
                    $input.detach().insertAfter($wrapper);
                    $wrapper.remove();
                }
            }
            function $elOrNull(obj) {
                var isValid, $el;
                isValid = _.isJQuery(obj) || _.isElement(obj);
                $el = isValid ? $(obj).first() : [];
                return $el.length ? $el : null;
            }
        })();
    });

    var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
        if (substrRegex.test(str)) {
            matches.push(str);
        }
        });

        cb(matches);
    };
    };

    var states = <?= $createStation->getCustomerDetails(); ?>;

    $('.search').typeahead({
    hint: false,
    highlight: true,
    minLength: 1
    },
    {
    name: 'states',
    source: substringMatcher(states)
    });


    </script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        
        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>



    </body>


    </html>
