  <?php

  session_start();
  $seconds_to_cache = 3;
  $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
  header("Expires: $ts");
  header("Pragma: cache");
  header("Cache-Control: max-age=$seconds_to_cache");
    

  require_once ('classes/all.php');
  $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $company = $_SESSION['CompanyName'];
    $designation = $_SESSION["designation"];
    $branch = $_SESSION['Bname'];
    $branchCode = $_SESSION['Bcode'];
    $companyCode = $_SESSION['CompanyCode'];
  $createStation = new All($connect);
      
      if(!isset($_SESSION['username'])){
          header('Location: portal.php');
      }
      
      if($designation == 'Supervisor' ){
          $color = "bg-gradient-success";
          $link = "superV.php";


          if(isset($_POST['date'])){
            $company = $_SESSION['CompanyName'];
    $date = $_POST['date'];
    //get sales analysis for opening sales
      $loc = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company'  ";
    $loca = mysqli_query($connect, $loc);

    //get sales analysis for closing sales
    $locc = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $lo = mysqli_query($connect, $locc);

    //total invoice
    $in = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $tin = mysqli_query($connect, $in);
    
    //sum kg
    $sa = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $sac = mysqli_query($connect, $sa);

    //pos
    $ga = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $gam = mysqli_query($connect, $ga);

    //all pos
    $pp = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $pa = mysqli_query($connect, $pp);

    //transfer
    $fat = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $fatboy = mysqli_query($connect, $fat);

    //sum transfer
    $transf = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $trra = mysqli_query($connect, $transf);

    //cash
    $cashh = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $cashhh = mysqli_query($connect, $cashh);

    //all cash
    $allca = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $allcash = mysqli_query($connect, $allca);

    //all total
    $at = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $atl = mysqli_query($connect, $at);

    //sum all
    $summ = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $summa = mysqli_query($connect, $summ);

    //tank
    $ta = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $tak = mysqli_query($connect, $ta);

    //remain
    $jac = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $jack = mysqli_query($connect, $jac);

    //bal
    $bal = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $bala = mysqli_query($connect, $bal);

    //clo
    $fgh = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $fft = mysqli_query($connect, $fgh);
  }else{
    $date = date('Y-m-d', strtotime('now'));

    $company = $_SESSION['CompanyName'];

    //get sales analysis for opening sales
    $loc = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company'  ";
    $loca = mysqli_query($connect, $loc);

    //get sales analysis for closing sales
    $locc = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $lo = mysqli_query($connect, $locc);

    //total invoice
    $in = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $tin = mysqli_query($connect, $in);
    
    //sum kg
    $sa = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $sac = mysqli_query($connect, $sa);

    //pos
    $ga = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $gam = mysqli_query($connect, $ga);

    //all pos
    $pp = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $pa = mysqli_query($connect, $pp);

    //transfer
    $fat = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $fatboy = mysqli_query($connect, $fat);

    //sum transfer
    $transf = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $trra = mysqli_query($connect, $transf);

    //cash
    $cashh = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $cashhh = mysqli_query($connect, $cashh);

    //all cash
    $allca = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $allcash = mysqli_query($connect, $allca);

    //all total
    $at = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $atl = mysqli_query($connect, $at);

    //sum all
    $summ = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $summa = mysqli_query($connect, $summ);

    //tank
    $ta = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $tak = mysqli_query($connect, $ta);

    //remain
    $jac = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $jack = mysqli_query($connect, $jac);

    //bal
    $bal = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $bala = mysqli_query($connect, $bal);

    //clo
    $fgh = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company' ";
    $fft = mysqli_query($connect, $fgh);
  }

      }else{
          $color = "bg-gradient-primary";
          $link = "adminPage.php";


          if(isset($_POST['date'])){
    $date = $_POST['date'];
    //get sales analysis for opening sales
      $loc = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' ";
    $loca = mysqli_query($connect, $loc);

    //get sales analysis for closing sales
    $locc = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $lo = mysqli_query($connect, $locc);

    //total invoice
    $in = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $tin = mysqli_query($connect, $in);
    
    //sum kg
    $sa = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $sac = mysqli_query($connect, $sa);

    //pos
    $ga = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $gam = mysqli_query($connect, $ga);

    //all pos
    $pp = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $pa = mysqli_query($connect, $pp);

    //transfer
    $fat = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $fatboy = mysqli_query($connect, $fat);

    //sum transfer
    $transf = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $trra = mysqli_query($connect, $transf);

    //cash
    $cashh = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $cashhh = mysqli_query($connect, $cashh);

    //all cash
    $allca = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $allcash = mysqli_query($connect, $allca);

    //all total
    $at = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $atl = mysqli_query($connect, $at);

    //sum all
    $summ = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $summa = mysqli_query($connect, $summ);

    //tank
    $ta = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $tak = mysqli_query($connect, $ta);

    //remain
    $jac = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $jack = mysqli_query($connect, $jac);

    //bal
    $bal = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $bala = mysqli_query($connect, $bal);

    //clo
    $fgh = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $fft = mysqli_query($connect, $fgh);
  }else{
    $date = date('Y-m-d', strtotime('now'));

    //get sales analysis for opening sales
    $loc = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' ";
    $loca = mysqli_query($connect, $loc);

    //get sales analysis for closing sales
    $locc = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $lo = mysqli_query($connect, $locc);

    //total invoice
    $in = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $tin = mysqli_query($connect, $in);
    
    //sum kg
    $sa = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $sac = mysqli_query($connect, $sa);

    //pos
    $ga = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $gam = mysqli_query($connect, $ga);

    //all pos
    $pp = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $pa = mysqli_query($connect, $pp);

    //transfer
    $fat = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $fatboy = mysqli_query($connect, $fat);

    //sum transfer
    $transf = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $trra = mysqli_query($connect, $transf);

    //cash
    $cashh = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $cashhh = mysqli_query($connect, $cashh);

    //all cash
    $allca = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $allcash = mysqli_query($connect, $allca);

    //all total
    $at = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $atl = mysqli_query($connect, $at);

    //sum all
    $summ = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $summa = mysqli_query($connect, $summ);

    //tank
    $ta = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $tak = mysqli_query($connect, $ta);

    //remain
    $jac = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $jack = mysqli_query($connect, $jac);

    //bal
    $bal = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $bala = mysqli_query($connect, $bal);

    //clo
    $fgh = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
    $fft = mysqli_query($connect, $fgh);
  }
      }

    //  print_r($_GET);
   // print_r($_POST);
  

  ?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Derogas</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link rel="stylesheet" href="css/salesanalysis.css">
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<style>

#table{
white-space: nowrap;
position: relative;
overflow-x: scroll;
overflow-y: hidden;
-webkit-overflow-scrolling: touch;
}

</style>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<?php echo "<ul class='navbar-nav ".$color." sidebar sidebar-dark accordion d-none' id='accordionSidebar'>" ?>

<!-- Sidebar - Brand -->
<?php echo "<a class='sidebar-brand d-flex align-items-center justify-content-center' href='.$link.'> "?>
<div class="sidebar-brand-icon rotate-n-15">
</div>
<div class="sidebar-brand-text mx-3">Derogas Admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
<?php echo "<a class='nav-link' href='".$link."'>
    <i class='fas fa-fw fa-tachometer-alt'></i>
    <span>Admin Home</span></a>" ?>
</li>

<!-- Heading -->
<div class="sidebar-heading"><b>Sales</b>
</div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="salesanalysis.php" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span><b>Daily Sales Summary</b></span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="salesanalysis.php"><b>All Branches</b></a>
              <!-- <h6 class="collapse-header">Select Branch</h6> -->
              <!-- <a class="collapse-item" href="buttons.html">Buttons</a>
              <a class="collapse-item" href="cards.html">Cards</a> -->
            </div>
          </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="stockanalysis.php" data-toggle="collapse" data-target="#colThree" aria-expanded="true" aria-controls="colThree">
              <i class="fas fa-fw fa-cog"></i>
              <span><b>Daily Stock Summary</b></span>
            </a>
            <div id="colThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="stockanalysis.php"><b>All Branches</b></a>
                <!-- <h6 class="collapse-header">All Branches</h6> -->
                <!-- <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a> -->
              </div>
            </div>
          </li>
            <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="badCrbs.php" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span><b>Declined Sales</b></span>
          </a>
          <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="badCrbs.php"><b>Declined Sales</b></a>
              <!-- <h6 class="collapse-header">Select Branch</h6> -->
              <!-- <a class="collapse-item" href="buttons.html">Buttons</a>
              <a class="collapse-item" href="cards.html">Cards</a> -->
            </div>
          </div>
        </li>


        <li class="nav-item">
                  <a class="nav-link" href="crblog.php">
                      <i class="fas fa-fw fa-cog"></i>
                    <span><b>Crb Log</b></span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          <b>Stock</b>
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="allStock.php" data-toggle="collapse" data-target="#colfour" aria-expanded="true" aria-controls="colfour">
              <i class="fas fa-fw fa-cog"></i>
              <span><b>Manage Stock</b></span>
            </a>
            <div id="colfour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="allStock.php"><b>View Stock Records</b></a>
                <a class="collapse-item" href="updateStock.php"><b>Add New Stock</b></a>
                <a class="collapse-item" href="updateS.php"><b>Update Stock</b></a>
              </div>
            </div>
          </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="switch.php" data-toggle="collapse" data-target="#colsix" aria-expanded="true" aria-controls="colsix">
              <i class="fas fa-fw fa-cog"></i>
              <span><b>Switch Tank</b></span>
            </a>
            <div id="colsix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"><b>Select Branch</b></h6>
                <a id="switch" class="collapse-item" href="switch.php"><b>Switch Tank In Use</b></a>
              </div>
            </div>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="addnewprice.php" data-toggle="collapse" data-target="#colseven" aria-expanded="true" aria-controls="colseven">
                <i class="fas fa-fw fa-cog"></i>
                <span><b>Price List</b> </span>
              </a>
              <div id="colseven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="addnewprice.php"><b>Add New Price / Kg</b></a>
                  <a class="collapse-item" href="updateprice.php"><b>Update Price</b></a>
                  <a class="collapse-item active" href="managePrice.php"><b>View Price By Location</b></a>
                </div>
              </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="Loyalty.php" data-toggle="collapse" data-target="#coleight" aria-expanded="true" aria-controls="coleight">
                  <i class="fas fa-fw fa-cog"></i>
                  <span><b>Loyalty Gift Tool</b> </span>
                </a>
                <div id="coleight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="Loyalty.php"><b>Loyalty Watch</b></a>
                  
                  </div>
                </div>
              </li>

              <li class="nav-item">
                  <a class="nav-link" href="staffs.php">
                      <i class="fas fa-fw fa-cog"></i>
                    <span><b>Manage Accounts</b></span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-fw fa-cog"></i>
                      <span><b>LogOut</b></span></a>
                  </li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

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
</a>
<!-- Dropdown - User Information -->
<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

<div class="dropdown-divider"></div>
<a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
Logout
</a>
</div>
</li>

</ul>

</nav>
<!-- End of Topbar -->
          <!-- Begin Page Content -->
          <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800" align='center'><b>Sales Analysis For <span class="text-danger"> <?php echo $date ?></span></b></h1>

            </div>
            <h5 align='center'><a href='<?php echo $link ?>'><b> Click to return to home page </b></a></h5>
            <div class="container-fluid">
                <div class="container-fluid mb-2">
                    <script>
                        function ff() {
                            document.getElementById('pull-records').submit();
                        }
                        </script>
                <form id="pull-records" action="salesanalysis.php?date=" method="POST">
                <div style="justify-content: center" class="row">
                <?php 
                    if(isset($_POST['date'])) {
                        echo "<input onchange='ff()' type='date' value='$date' name='date' class='form-control col-sm-5 mr-1 mb-2' placeholder='Select date to view'>";
                    }else{
                        echo "<input type='date' onchange='ff()' name='date' class='form-control col-sm-5 mr-1 mb-2' placeholder='Select date to view'>";
                    }
                
                ?>
               
              
               <!-- <button name="submit" type="submit" class="col btn btn-outline-success">Pull Records</button> -->
                </div>
                  
                  </form>
                </div>

<div id='table' class='container-fluid'>

            <table class='table' border="2" >
                      <thead>
                      <tr> 
                      <th scope='col'>&nbsp;</th>
                      <?php $createStation->locationsTableHead(); ?>
                      <th scope='col'>Summation</th>
                      </tr>
                      </thead> 
                      <tbody>

<tr>
<td>Opening Sales</td>
<?php
    
    if($loca){
        
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
            
        }
        
        while($row = mysqli_fetch_array($loca)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
         
            
            $open = "SELECT * FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC";
            $openn = mysqli_query($connect, $open);
            if(mysqli_num_rows($openn) > 0){
                while($op = mysqli_fetch_array($openn)){
                    $invoice = $op['reciept'];
                    $time = $op['timee'];
                    $customer = $op['customer'];
                    $kkkg = $op['kg'];
                    $money = $op['finalTotal'];
                    $change = $op['changee'];
                    $changeD = $op['changeD'];
                }
                
            echo " <td>Invoice#: ".$invoice."<br>Time: ".$time."<br> Customer: ".$customer."<br> Total Kg: ".$kkkg." Kg <br> Amount: ".number_format($money)." NGN <br> Change: ".$change." NGN <br> Change Debited: ".$changeD." </td>";
            }else{
                echo "<td>&nbsp;</td>";
            }
        }
    }
    
    ?>
<td>&nbsp;</td>
</tr>

<tr>
<td>Closing Sales</td>
<?php
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d', strtotime('now'));
    }
    if($lo){
        
        while($row = mysqli_fetch_array($lo)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
            
            $close = "SELECT * FROM finalsales WHERE branch = '$branchCode'  AND datee = '$date' AND category != 'Switchcontroler'  ORDER BY id ASC";
            $closn = mysqli_query($connect, $close);
            if(mysqli_num_rows($closn) > 0){
                while($op = mysqli_fetch_array($closn)){
                    $invoice = $op['reciept'];
                    $time = $op['timee'];
                    $customer = $op['customer'];
                    $kkkg = $op['kg'];
                    $money = $op['finalTotal'];
                    $changeD = $op['changeD'];
                    $changee = $op['changee'];
                }
                
                echo " <td>Invoice#: ".$invoice."<br>Time: ".$time."<br> Customer: ".$customer."<br> Total Kg: ".$kkkg." Kg
                <br> Amount: ".number_format($money)." NGN <br> Change: ".$changee." NGN <br> Change Debited: ".$changeD."
                </td>";
            }else{
                echo "<td>&nbsp;</td>";
            }
        }
    }
    
    ?>
<td>&nbsp;</td>
</tr>

<tr>
<td>Total Invoice</td>
<?php
    
    
    
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d', strtotime('now'));
    }
    
    if($tin){
        while($row = mysqli_fetch_array($tin)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
            
            $otin = "SELECT * FROM finalsales WHERE branch = '$branchCode' AND datee ='$date' AND category != 'Switch'";
            $otinn = mysqli_query($connect, $otin);
            if(mysqli_num_rows($otinn) > 0){
                $totalIn = mysqli_num_rows($otinn);
                echo " <td>".$totalIn."</td>";
            }else{
                echo "<td>&nbsp;</td>";
            }
            
        }
    }
    
    ?>
<?php
    if ($designation == 'Supervisor'){
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        
        $t = "SELECT * FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' AND category != 'Switch'";
        $tt = mysqli_query($connect, $t);
        if(mysqli_num_rows($tt) > 0){
            $totalIn = mysqli_num_rows($tt);
            
            echo " <td>".$totalIn."</td>";
        }
        echo "<td>&nbsp;</td>";
    }else{
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        
        $t = "SELECT * FROM finalsales WHERE datee = '$date' AND category != 'Switch'";
        $tt = mysqli_query($connect, $t);
        if(mysqli_num_rows($tt) > 0){
            $totalIn = mysqli_num_rows($tt);
            
            echo " <td>".$totalIn."</td>";
        }
    }

    ?>

</tr>

<tr>
<td>Total KG Sold</td>
<?php
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d', strtotime('now'));
    }
    if($sac){
        while($row = mysqli_fetch_array($sac)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
            
            $ca = "SELECT SUM(kg) FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' ";
            $can = mysqli_query($connect, $ca);
            if(mysqli_num_rows($can) > 0){
                while($k = mysqli_fetch_array($can)){
                    
                    $totalKg = $k['SUM(kg)'];
                    echo " <td>".$totalKg." Kg</td>";
                    
                }
            }
        }
    }
    
    ?>
<?php
    if ($designation == 'Supervisor'){
        
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        
        
        $ken = "SELECT SUM(kg) FROM finalsales WHERE datee = '$date' AND branch = '$branchCode'  ";
        $kenn = mysqli_query($connect, $ken);
        if(mysqli_num_rows($kenn) > 0){
            while($k = mysqli_fetch_array($kenn)){
                
                $totalKg = $k['SUM(kg)'];
                
            }
            echo " <td>".$totalKg." Kg</td>";
        }
      
    }else{
        
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        
        
        $ken = "SELECT SUM(kg) FROM finalsales WHERE datee = '$date'  ";
        $kenn = mysqli_query($connect, $ken);
        if(mysqli_num_rows($kenn) > 0){
            while($k = mysqli_fetch_array($kenn)){
                
                $totalKg = $k['SUM(kg)'];
                
            }
            echo " <td>".$totalKg." Kg</td>";
        }
            
    }
   
    
    
    ?>
</tr>

<tr>
<td>Total Cash</td>
<?php
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d', strtotime('now'));
    }
    if($cashhh){
        while($row = mysqli_fetch_array($cashhh)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
            
            $csa = "SELECT SUM(cash) FROM finalsales WHERE branch = '$branchCode'  AND payment = 'Cash' AND datee = '$date' ";
            $csat = mysqli_query($connect, $csa);
            if(mysqli_num_rows($csat) > 0){
                while($k = mysqli_fetch_array($csat)){
                    
                    $totalcash = $k['SUM(cash)'];
                    echo " <td>".number_format($totalcash)." NGN</td>";
                    
                }
            }
        }
    }
    
    ?>
<?php
    if($designation == 'Supervisor'){
        
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        if($allcash){
            while($row = mysqli_fetch_array($allcash)){
                $branch = $row['Bname'];
                $company = $row['CompanyName'];
                $branchCode = $row['Bcode'];
                
                $fs = "SELECT SUM(cash) FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' AND payment = 'Cash' ";
                $fss = mysqli_query($connect, $fs);
                if(mysqli_num_rows($fss) > 0){
                    while($k = mysqli_fetch_array($fss)){
                        
                        $totalcash = $k['SUM(cash)'];
                        
                    }
                }
            }
            
            echo " <td>".number_format($totalcash)." NGN</td>";
        }
        
        
    }else{
        
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        if($allcash){
            while($row = mysqli_fetch_array($allcash)){
                $branch = $row['Bname'];
                $company = $row['CompanyName'];
                $branchCode = $row['Bcode'];
                
                $fs = "SELECT SUM(cash) FROM finalsales WHERE datee = '$date' AND payment = 'Cash' ";
                $fss = mysqli_query($connect, $fs);
                if(mysqli_num_rows($fss) > 0){
                    while($k = mysqli_fetch_array($fss)){
                        
                        $totalcash = $k['SUM(cash)'];
                        
                    }
                }
            }
            
            echo " <td>".number_format($totalcash)." NGN</td>";
        }
        
        
    }
    
    ?>
</tr>

<tr>
<td>Total POS</td>
<?php
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d', strtotime('now'));
    }
    if($gam){
        while($row = mysqli_fetch_array($gam)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
            
            $pos = "SELECT SUM(cash) FROM finalsales WHERE branch = '$branchCode'  AND datee = '$date'  AND payment = 'POS'  ";
            $gopos = mysqli_query($connect, $pos);
            if(mysqli_num_rows($gopos) > 0){
                while($k = mysqli_fetch_array($gopos)){
                    
                    $totalcash = $k['SUM(cash)'];
                    echo " <td>".number_format($totalcash)." NGN</td>";
                    
                }
            }
        }
    }
    
    ?>
<?php
    
    if($designation == 'Supervisor'){
        
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        if($pa){
            while($row = mysqli_fetch_array($pa)){
                $branch = $row['Bname'];
                $company = $row['CompanyName'];
                $branchCode = $row['Bcode'];
                
                $allpos = "SELECT SUM(cash) FROM finalsales WHERE datee = '$date' AND branch = '$branchCode'   AND payment = 'POS' ";
                $goallpos = mysqli_query($connect, $allpos);
                if(mysqli_num_rows($goallpos) > 0){
                    while($k = mysqli_fetch_array($goallpos)){
                        
                        $totalcash = $k['SUM(cash)'];
                        
                    }
                }
            }
            
            echo " <td>".number_format($totalcash)." NGN</td>";
        }
        
    }else{
        
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        if($pa){
            while($row = mysqli_fetch_array($pa)){
                $branch = $row['Bname'];
                $company = $row['CompanyName'];
                $branchCode = $row['Bcode'];
                
                $allpos = "SELECT SUM(cash) FROM finalsales WHERE datee = '$date'   AND payment = 'POS' ";
                $goallpos = mysqli_query($connect, $allpos);
                if(mysqli_num_rows($goallpos) > 0){
                    while($k = mysqli_fetch_array($goallpos)){
                        
                        $totalcash = $k['SUM(cash)'];
                        
                    }
                }
            }
            
            echo " <td>".number_format($totalcash)." NGN</td>";
        }
        
    }
   
    
    ?>
</tr>

<tr>
<td>Total Credit</td>
<?php
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d', strtotime('now'));
    }
    if($fatboy){
        while($row = mysqli_fetch_array($fatboy)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
            
            $fatt = "SELECT SUM(cash) FROM finalsales WHERE branch = '$branchCode'  AND payment = 'Transfer' AND datee = '$date' ";
            $gofatt = mysqli_query($connect, $fatt);
            if(mysqli_num_rows($gofatt) > 0){
                while($k = mysqli_fetch_array($gofatt)){
                    
                    $totalcash = $k['SUM(cash)'];
                    echo " <td>".number_format($totalcash)." NGN</td>";
                    
                }
            }
        }
    }
    
    ?>
<?php
    if($designation == 'Supervisor'){
        
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        if($trra){
            while($row = mysqli_fetch_array($trra)){
                $branch = $row['Bname'];
                $company = $row['CompanyName'];
                $branchCode = $row['Bcode'];
                
                $ft = "SELECT SUM(cash) FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' AND payment = 'Transfer'";
                $goft = mysqli_query($connect, $ft);
                if(mysqli_num_rows($goft) > 0){
                    while($k = mysqli_fetch_array($goft)){
                        
                        $totalcash = $k['SUM(cash)'];
                        
                    }
                }
            }
            
            echo " <td>".number_format($totalcash)." NGN</td>";
        }
        
    }else{
        
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        if($trra){
            while($row = mysqli_fetch_array($trra)){
                $branch = $row['Bname'];
                $company = $row['CompanyName'];
                $branchCode = $row['Bcode'];
                
                $ft = "SELECT SUM(cash) FROM finalsales WHERE datee = '$date' AND payment = 'Transfer'";
                $goft = mysqli_query($connect, $ft);
                if(mysqli_num_rows($goft) > 0){
                    while($k = mysqli_fetch_array($goft)){
                        
                        $totalcash = $k['SUM(cash)'];
                        
                    }
                }
            }
            
            echo " <td>".number_format($totalcash)." NGN</td>";
        }
        
    }
   
    
    ?>
</tr>



<tr class="bg-info">
<td class="text-white">Total Amount</td>
<?php
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d', strtotime('now'));
    }
    if($atl){
        while($row = mysqli_fetch_array($atl)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
            
            $aa = "SELECT SUM(cash), SUM(changeD) FROM finalsales WHERE branch = '$branchCode' AND datee = '$date'";
            $aat = mysqli_query($connect, $aa);
            if(mysqli_num_rows($aat) > 0){
                while($k = mysqli_fetch_array($aat)){
                    
                    $totalcash = $k['SUM(cash)'];
                    $totalchangee = $k['SUM(changeD)'];
                    $general = $totalcash - $totalchangee;
                    echo " <td class='text-white'>".number_format($general)." NGN <br><span class='text-white'>Less Change : <b>".$totalchangee." NGN </b></span></td>";
                    
                }
            }
        }
    }
    
    ?>
<?php
    if($designation == 'Supervisor'){
        
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        if($summa){
            while($row = mysqli_fetch_array($summa)){
                $branch = $row['Bname'];
                $company = $row['CompanyName'];
                $branchCode = $row['Bcode'];
                
                $summma = "SELECT SUM(cash), SUM(changeD) FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' ";
                $suma = mysqli_query($connect, $summma);
                if(mysqli_num_rows($suma) > 0){
                    while($k = mysqli_fetch_array($suma)){
                        $totalcash = $k['SUM(cash)'];
                        $totalchangee = $k['SUM(changeD)'];
                        $general = $totalcash - $totalchangee;
                        
                    }
                }
            }
            
            echo " <td class='text-white'>".number_format($general)." NGN <br> <span class='text-white'> Less Change : <b>".$totalchangee." NGN </b></span></td>";
        }
        
    }else{
        
        if(isset($_POST['date'])){
            $date = $_POST['date'];
        }else{
            $date = date('Y-m-d', strtotime('now'));
        }
        if($summa){
            while($row = mysqli_fetch_array($summa)){
                $branch = $row['Bname'];
                $company = $row['CompanyName'];
                $branchCode = $row['Bcode'];
                
                $summma = "SELECT SUM(cash), SUM(changeD) FROM finalsales WHERE datee = '$date'";
                $suma = mysqli_query($connect, $summma);
                if(mysqli_num_rows($suma) > 0){
                    while($k = mysqli_fetch_array($suma)){
                        $totalcash = $k['SUM(cash)'];
                        $totalchangee = $k['SUM(changeD)'];
                        $general = $totalcash - $totalchangee;
                        
                    }
                }
            }
            
            echo " <td class='text-white'>".number_format($general)." NGN <br> <span class='text-white'> Less Change : <b>".$totalchangee." NGN </b></span></td>";
        }
        
    }
    
    
    ?>
</tr>



<tr>
<td colspan="7" align="center" class="text-danger"><b>Tank Analysis</b></th>
</tr>
<tr>
<td>&nbsp;</td>
<?php
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d', strtotime('now'));
    }
    if($tak){
        while($row = mysqli_fetch_array($tak)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
            
            $zz = "SELECT tankUse FROM finalsales WHERE branch ='$branchCode' AND datee = '$date' ORDER BY id DESC LIMIT 1";
            $zzt = mysqli_query($connect, $zz);
            if(mysqli_num_rows($zzt) > 0){
                while($k = mysqli_fetch_array($zzt)){
                    
                    $tank = $k['tankUse'];
                    echo " <td>Tank In Use: ".$tank."</td>";
                    
                }
            }else{
                echo "<td>&nbsp;</td>";
            }
        }
        
        
    }
    
    ?>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<?php
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d', strtotime('now'));
    }
    if($jack){
        while($row = mysqli_fetch_array($jack)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
            
            $ja = "SELECT opening FROM finalsales WHERE branch ='$branchCode' AND datee = '$date' ORDER BY id ASC LIMIT 1";
            $jacc = mysqli_query($connect, $ja);
            if(mysqli_num_rows($jacc) > 0){
                while($k = mysqli_fetch_array($jacc)){
                    
                    $stock = $k['opening'];
                    echo " <td>Opening Stock: ".$stock." Kg</td>";
                    
                }
            }else{
                echo "<td>&nbsp;</td>";
            }
        }
        
        
    }
    
    ?>
<td>&nbsp;</td>
</tr>

<tr>
<td>&nbsp;</td>
<?php
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d', strtotime('now'));
    }
    if($bala){
        while($row = mysqli_fetch_array($bala)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
            
            $blk = "SELECT balancee FROM finalsales WHERE branch ='$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
            $blck = mysqli_query($connect, $blk);
            if(mysqli_num_rows($blck) > 0){
                while($k = mysqli_fetch_array($blck)){
                    
                    $balance = $k['balancee'];
                    echo " <td>Balance Stock: ".$balance." Kg</td>";
                    
                }
            }else{
                echo "<td>&nbsp;</td>";
            }
        }
        
        
    }
    
    ?>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>

<?php
    if(isset($_POST['date'])){
        $date = $_POST['date'];
    }else{
        $date = date('Y-m-d', strtotime('now'));
    }
    if($fft){
        while($row = mysqli_fetch_array($fft)){
            $branch = $row['Bname'];
            $company = $row['CompanyName'];
            $branchCode = $row['Bcode'];
            
            $cav = "SELECT closing FROM finalsales WHERE branch ='$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
            $cave = mysqli_query($connect, $cav);
            if(mysqli_num_rows($cave) > 0){
                while($k = mysqli_fetch_array($cave)){
                    
                    $close = $k['closing'];
                    echo " <td>Closing Stock: ".$close." Kg</td>";
                    
                }
            }else{
                echo "<td>&nbsp;</td>";
            }
        }
        
        
    }
    
    
    ?>
<td>&nbsp;</td>
</tr>





                      </tbody>
                          </table>
            </div>
</div>



            <div class="modal fade" id="closing" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
            <?php $createStation->recieptClose(); ?>
                            
                </div>
              </div>
            </div>
          </div>
        
      

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Derogas 2020</span>
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

    <script type='text/javascript'>


  $('#switch').click(function() {
  alert('You need to update your stock before proceeding to switch tanks. If you have done this, you can proceed, if not, please do that before coming back here. switching tanks without updating stock will result in catastrophic sales records. Many thanks.');
});
  
</script>


    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

  </body>

  </html>
