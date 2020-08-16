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
      $designation  = $_SESSION["designation"];
  $createStation = new All($connect);
  date_default_timezone_set("Africa/Lagos");
  if(!isset($_SESSION['username'])){
    header('Location: portal.php');
  }
      if($designation == 'Supervisor' ){
          $color = "bg-gradient-success";
          $link = "superV.php";
      }else{
          $color = "bg-gradient-primary";
          $link = "adminPage.php";
      }
   
  if(isset($_POST['val'])){
      $branchCode = $_POST['val'];
  }else{
      $branchCode = $_GET['branch'];
      
  }
  

  $getName = "SELECT company.CompanyName, gasStations.Bname,gasStations.BtankUse, gasStations.BtankA, gasStations.BtankB, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND gasStations.Bcode = '$branchCode' ";
  $get = mysqli_query($connect, $getName);

  if(mysqli_num_rows($get) > 0){
      while($row = mysqli_fetch_array($get)){
          $branch = $row['Bname'];
          $company = $row['CompanyName'];
          $tank = $row['BtankUse'];
          $tankA = $row['BtankA'];
          $tankB = $row['BtankB'];
      }
      if($tank == 'Tank A'){
        $tankAm = $tankA;
      }else{
        $tankAm = $tankB;
      }
  }


  if(isset($_POST['date'])){
      $ddaattee = $_POST['date'];
      $date = $_POST['date'];
      $branchCode = $_GET['branch'];
      $getName = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND gasStations.Bcode = '$branchCode' ";
  $get = mysqli_query($connect, $getName);

  if(mysqli_num_rows($get) > 0){
      while($row = mysqli_fetch_array($get)){
          $branch = $row['Bname'];
          $company = $row['CompanyName'];
      }
  }
      $final = "SELECT * FROM finalsales WHERE branch = '$branchCode' AND datee = '$date'";
      $gofinal = mysqli_query($connect, $final);

      $pos = "SELECT SUM(cash) FROM finalsales WHERE branch = '$branchCode'  AND datee = '$date'  AND payment = 'POS'  ";
      $gopos = mysqli_query($connect, $pos);
      while($ppos = mysqli_fetch_array($gopos)) {
        $finalpos = $ppos['SUM(cash)'];
      }

      $fs = "SELECT SUM(cash) FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND payment = 'Cash' ";
      $fss = mysqli_query($connect, $fs);
      
      while($k = mysqli_fetch_array($fss)){
          $totalcash = $k['SUM(cash)'];
                        
      }
    

      $clo = "SELECT * FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler'";
      $goclo = mysqli_query($connect, $clo);

      $cas = "SELECT  SUM(finalTotal), SUM(cash), SUM(kg), SUM(changeD) FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ";
      $casper = mysqli_query($connect, $cas);
      if($casper){
          while($gen = mysqli_fetch_array($casper)){
              $finaltt = $gen['SUM(finalTotal)'];
               $fcash = $gen['SUM(cash)'];
              $chaaa = $gen['SUM(changeD)'];
              $fkg = $gen['SUM(kg)'];
          }
           $chang = $fcash - $finaltt;

$Offline = "SELECT  SUM(finalTotal), SUM(cash), SUM(kg), SUM(changeD) FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND category LIKE '%Offline%' ";
              $off = mysqli_query($connect, $Offline);
              while ($ofa = mysqli_fetch_array($off)) {
                $offamount = $ofa['SUM(finalTotal)'];
                $offcash = $ofa['SUM(cash)'];
                $offKg = $ofa['SUM(kg)'];
              }
      }

      //get total cash

      $op = "SELECT * FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND tankUse = '$tank' ORDER BY id ASC LIMIT 1";
      $opf = mysqli_query($connect, $op);
      
  }else{
      $date = date('Y-m-d', strtotime('now'));
      $getName = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND gasStations.Bcode = '$branchCode' ";
      $get = mysqli_query($connect, $getName);
      
      if(mysqli_num_rows($get) > 0){
          while($row = mysqli_fetch_array($get)){
              $branch = $row['Bname'];
              $company = $row['CompanyName'];
          }
      }
      $final = "SELECT *  FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' ";
          $gofinal = mysqli_query($connect, $final);

          $clo = "SELECT * FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler'";
      $goclo = mysqli_query($connect, $clo);

          $cas = "SELECT  SUM(finalTotal), SUM(cash), SUM(kg), SUM(changeD) FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ";
          $casper = mysqli_query($connect, $cas);
          if($casper){
              while($gen = mysqli_fetch_array($casper)){
                  $finaltt = $gen['SUM(finalTotal)'];
                  $fcash = $gen['SUM(cash)'];
                  $chaaa = $gen['SUM(changeD)'];
                  $fkg = $gen['SUM(kg)'];
              }
              $overt = $fcash + $fpos + $ftrans;
              $chang = $fcash - $finaltt;

              $Offline = "SELECT  SUM(finalTotal), SUM(cash), SUM(kg), SUM(changeD) FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND category LIKE '%Offline%' ";
              $off = mysqli_query($connect, $Offline);
              while ($ofa = mysqli_fetch_array($off)) {
                $offamount = $ofa['SUM(finalTotal)'];
                $offcash = $ofa['SUM(cash)'];
                $offKg = $ofa['SUM(kg)'];
              }
          }

          $op = "SELECT * FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND tankUse = '$tank' ORDER BY id ASC LIMIT 1";
          $opf = mysqli_query($connect, $op);

  }
  //print_r($_GET);
  //print_r($_POST);


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
<div class="sidebar-brand-text mx-3">Aicogas Admin</div>
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

          <?php
                      

                      if($opf){

                          while($fin = mysqli_fetch_array($opf)){
                            
                              $opening = $fin['opening'];
                    
                          }
                      }

                      ?>

            <!-- Page Heading -->
            <div >

               <h3  align='center'>Sales Analysis For <span class="text-danger" ><?php echo $company ?> : <?php echo $branch ?> : <?php echo $date ?></span></h3>

<?php
    if(isset($_POST['date'])) {
      $date = $_POST['date'];
    }else{
      $date = date('Y-m-d', strtotime('now'));
    }
    
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
        
        $renn = "SELECT * FROM switchlog WHERE branch = '$branchCode' AND datee = '$date'";
        $renns = mysqli_query($connect, $renn);
        $rennrow = mysqli_fetch_array($renns);
        $action = $rennrow['actionn'];
        
        if($action == 'Tank A'){
            
            if(isset($_POST['date'])){
                $date = $ddaattee;
            }else{
                $date = $date;
            }
            
            $tank = 'Tank B';
            $gf = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND datee = '$date' AND branch = '$branchCode' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
            $ggf = mysqli_query($connect, $gf);
            $tow = mysqli_fetch_array($ggf);
            $bstock = $tow['balancee'];
            $opening = $tow['opening'];
            
            
            $gff = "SELECT * FROM finalsales WHERE tankUse = '$action' AND branch = '$branchCode' AND datee = '$date' ORDER BY id DESC LIMIT 1";
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
            
            <h6 class='text-danger' align='center'><b>Previous Tank: ".$tank." | Opening Stock : ".$openingfx." Kg | Balance Stock : ".$bstock." Kg | Sold : $soldka Kg</b></h6>
            
            
            ";
            echo "
            
            <h6 class='text-info' align='center'><b>Load No: ".$nowtank." | Current Tank: ".$action." | Opening Stock : ".$bop."  Kg | Balance Stock : ".$bstockf." Kg | Sold : ".$soldk." Kg | Sales Count : ".number_format($fcc)."</b></h6>
            
            
            ";
        }elseif($action == 'Tank B'){
            
            if(isset($_POST['date'])){
                $date = $ddaattee;
            }else{
                $date = $date;
            }
            
            $tank = 'Tank A';
            $gf = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND datee = '$date' AND branch = '$branchCode' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1" ;
            $ggf = mysqli_query($connect, $gf);
            $tow = mysqli_fetch_array($ggf);
            $bstock = $tow['balancee'];
            $opening = $tow['opening'];
            
            
            $gff = "SELECT * FROM finalsales WHERE tankUse = '$action' AND branch = '$branchCode' AND datee = '$date' ORDER BY id DESC LIMIT 1";
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
            
//echo "Here we are";
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
            
            <h6 class='text-danger' align='center'><b>Previous Tank: ".$tank." | Opening Stock : ".$openingfx." Kg | Balance Stock : ".$bstock." Kg | Sold : ".$soldka." Kg</b></h6>
            
            
            ";
            echo "
            
            <h6 class='text-info' align='center'><b>Load No: ".$nowtank." | Current Tank: ".$action." | Opening Stock : ".$bop." Kg | Balance Stock : ".$bstockf." Kg | Sold : ".$soldk." Kg | Sales Count : ".number_format($fcc)."</b></h6>
            
            
            ";
        }
    }else{
        //echo "alt";
        $gt = "SELECT * FROM gasStations WHERE BtankUse = '$tank'";
        $gg = mysqli_query($connect, $gt);
        $gow = mysqli_fetch_array($gg);
        $tUse = $gow['BtankUse'];
        if($_POST['date'] == '') {
          $altdate = date('Y-m-d', strtotime('now'));
        }else{
          $altdate = $_POST['date'];
        }
       
        //echo $altdate;
        if(isset($_POST['date'])){
            $date = $ddaattee;
        }else{
            $date = $date;
        }
        
        $gettank = "SELECT tankUse FROM finalsales WHERE branch = '$branchCode' AND datee = '$altdate' ORDER BY id DESC LIMIT 1";
        $gtquery = mysqli_query($connect, $gettank);
        $gtw = mysqli_fetch_array($gtquery);
        $tUse = $gtw['tankUse'];
        //echo $tUse;
        
        $gf = "SELECT * FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$altdate' ORDER BY id DESC LIMIT 1";
        
        $ggf = mysqli_query($connect, $gf);
        $tow = mysqli_fetch_array($ggf);
        $bstock = $tow['balancee'];
        
        $gffz = "SELECT SUM(kg) FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$altdate' ORDER BY id DESC LIMIT 1";
        $ggffz = mysqli_query($connect, $gffz);
        $towfz = mysqli_fetch_array($ggffz);
        $soldk = $towfz['SUM(kg)'];
        
        $ku = "SELECT * FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$altdate' ORDER BY id ASC LIMIT 1";
        $uu = mysqli_query($connect, $ku);
        $samp = mysqli_fetch_array($uu);
        $opening = $samp['opening'];
        
        $sc = "SELECT * FROM finalsales WHERE datee = '$altdate' AND branch = '$branchCode' AND category != 'Switchcontroler' ";
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

            <div class="container-fluid">

  <!-- <div class="container-fluid mb-1">

    <form action="  " method="POST">
        <div class="col-12 btn-group">
    
                <button type="submit" name="prev" value="<?php echo $branchCode; ?>" class="col btn btn-outline-info">Previous Day</button>
            
                <button type="submit" name="next" value="<?php echo date('Y-m-d', strtotime($date .'+1 day')) ?>" class="col btn btn-outline-success">Next Day</button>

        </div>
            
    </form>
  </div> -->
            
            <div class="container-fluid">
                <div class="container-fluid mb-2">
                <script>
                        function ff() {
                            document.getElementById('pull-records').submit();
                        }
                        </script>
                  <form id="pull-records" action="  " method="POST">
                      <div style="justify-content: center" class="row">
                      <?php
                      $datepost = $_POST['date']; 
                    if(isset($_POST['date'])) {
                        echo "<input type='date' value='$datepost' onchange='ff()' name='date' class='form-control col-sm-5 mr-1 mb-2' placeholder='Select date to view'>";
                    }else{
                        echo "<input type='date' onchange='ff()' name='date' class='form-control col-sm-5 mr-1 mb-2' placeholder='Select date to view'>";
                    }
                
                      ?>
                  
                          
                          
                  
                      </div>
            <h5 align='center' class='mt-2 mb-2 '><a class='text-danger' href='<?php echo $link ?>'><b> Goto Home Page</b></a></h5>
             <h5 align='center' class='mt-2 mb-2'><a href='salesanalysis.php'><b> Goto Sales Summary page </b></a></h5>
                          
                  </form>
                </div>
</div>
              
                <div id='table' class='container-fluid'>
                
            <table class='table' border="2">
                      <thead>
                      <tr>
                        <th scope='col' colspan="2">CRB</th>
                      <th scope='col' colspan="2">Reciept</th>
                      <th scope='col' colspan="2">Description</th>
                      <th scope='col'>Kg</th>
                      <th scope='col'>Amount</th>
                      <th scope='col'>Payment Method</th>
                      <th scope='col'>Tank</th>
                      
                  
                      <th scope='col'>Balance Stock</th>
                      <th scope='col'>Time</th>
                      
                      </tr>
                      </thead> 
                      <tbody>

                      <?php


                      if($gofinal){

                          while($fin = mysqli_fetch_array($gofinal)){
                              $id = $fin['id'];
                              $rrec = $fin['reciept'];
                              $amount = $fin['amount'];
                              $finalA = $fin['finalTotal'];
                              $paymentMeth = $fin['payment'];
                              $change = $fin['changee'];
                              $cdebit = $amount - $finalA;
                              $categ = $fin['category'];
                              $cash = $fin['cash'];
                              $pos = $fin['pos'];
                              $trans = $fin['transferr'];
                              $tkg = $fin['kg'];
                              $bstock = $fin['balancee'];
                              $opening = $fin['opening'];
                              $time = $fin['timee'];
                              $clo = $fin['closing'];
                              $tank = $fin['tankUse'];
                              $cn = $fin['customer'];
                              $cp = $fin['phone'];

                              if($goclo){
                                while($jara = mysqli_fetch_array($goclo)){
                                  $closing = $jara['closing'];
                                }
                              }
                              

                                  if($categ == 'Offline-Others'){

                                    echo "
                                    <tr style='background-color:#5c1529'>
                                      <td class='text-white' colspan='2'>".$rrec."</td>
                                   <td colspan='2' ><a class='text-white' href='reciept.php?reciept=".$rrec."&branch=".$branchCode."&CompanyName=".$company."''><b> $cn <br> $cp </b></a></td>
                                    ";
                                    ?><td colspan="2" class='text-white'>
                                    <?php 

                                        $arr = "SELECT finalsales.kg, finalsales.quantity, finalsales.category FROM finalsales WHERE finalsales.reciept = '$rrec' AND finalsales.branch = '$branchCode' AND datee = '$date' AND category LIKE '%Offline%'  ";
                                        $ar = mysqli_query($connect, $arr);


                                    while($a = mysqli_fetch_array($ar)){

                                      $k = $a['kg'];
                                      $q = $a['quantity'];
                                      $c = $a['category'];

                                      echo "".$q."  X ".$k." kg ".$c." <br> ";

                                    }

                                    ?></td colspan="2">
                                    <?php 
                                    echo "
                                    <td class='text-white'>".$tkg." Kg</td>
                                    <td class='text-white'>".number_format($cash)." NGN</td>
                                    <td class='text-white'>".$paymentMeth."</td>
                                    <td class='text-white'>".$tank."</td>
                                    <td class='text-white'>".$bstock." KG</td>
                                    <td class='text-white'>".$time."</td>
                                    </tr>
                                    ";
      
                                  }elseif($categ == 'Offline-Domestic'){
                                    echo "
                                    <tr style='background-color: #65694c'>
                                   <td colspan='2' class='text-white'>".$rrec."</td>
                                    <td colspan='2' ><a class='text-white' href='reciept.php?reciept=".$rrec."&branch=".$branchCode."&CompanyName=".$company."''><b> $cn <br> $cp </b></a></td>
                                    ";
                                    ?><td colspan="2" class='text-white'>
                                    <?php 

                                        $arr = "SELECT finalsales.kg, finalsales.quantity, finalsales.category FROM finalsales WHERE finalsales.reciept = '$rrec' AND finalsales.branch = '$branchCode' AND datee = '$date' AND category LIKE '%Offline%' ";
                                        $ar = mysqli_query($connect, $arr);


                                    while($a = mysqli_fetch_array($ar)){

                                      $k = $a['kg'];
                                      $q = $a['quantity'];
                                      $c = $a['category'];

                                      echo "".$q." X ".$k." kg  ".$c." <br> ";

                                    }

                                    ?></td>
                                    <?php 
                                    echo "
                                    <td class='text-white'>".$tkg." Kg</td>
                                    <td class='text-white'>".number_format($cash)." NGN</td>
                                    <td class='text-white'>".$paymentMeth."</td>
                                    <td class='text-white'>".$tank."</td>
                                    <td class='text-white'>".$bstock." KG</td>
                                    <td class='text-white'>".$time."</td>
                                    </tr>
                                    ";
                                  }elseif($categ == 'Offline-Eatery'){
                                     
                                    echo "
                                    <tr style='background-color:#152159'>
                                    <td class='text-white' colspan='2'>".$rrec."</td>
                                    <td colspan='2' class='text-white'><a class='text-white' href='reciept.php?reciept=".$rrec."&branch=".$branchCode."&CompanyName=".$company."''><b> $cn <br> $cp </b></a></td>
                                    ";
                                    ?><td colspan="2" class='text-white'>
                                    <?php 

                                        $arr = "SELECT finalsales.kg, finalsales.quantity, finalsales.category FROM finalsales WHERE finalsales.reciept = '$rrec' AND finalsales.branch = '$branchCode' AND datee = '$date' AND category LIKE '%Offline%' ";
                                        $ar = mysqli_query($connect, $arr);


                                    while($a = mysqli_fetch_array($ar)){

                                      $k = $a['kg'];
                                      $q = $a['quantity'];
                                      $c = $a['category'];

                                      echo "".$q." X ".$k." kg ".$c." <br> ";

                                    }

                                    ?></td colspan="2">
                                    <?php 
                                    echo "
                                    <td class='text-white'>".$tkg." Kg</td>
                                    <td class='text-white'>".number_format($cash)." NGN</td>
                                    <td class='text-white'>".$paymentMeth."</td>
                                    <td class='text-white'>".$tank."</td>
                                    <td class='text-white'>".$bstock." KG</td>
                                    <td class='text-white'>".$time."</td>
                                    </tr>
                                    ";
      
                                  }elseif($categ == 'Offline-Dealer'){
                                    echo "
                                    <tr style='background-color:#155924' >
                                  <td class='text-white' colspan='2'>".$rrec."</td>
                                   <td colspan='2' ><a class='text-white' href='reciept.php?reciept=".$rrec."&branch=".$branchCode."&CompanyName=".$company."''><b> $cn <br> $cp </b></a></td>
                                    ";
                                    ?><td colspan="2" class='text-white'>
                                    <?php 

                                        $arr = "SELECT finalsales.kg, finalsales.quantity, finalsales.category FROM finalsales WHERE finalsales.reciept = '$rrec' AND finalsales.branch = '$branchCode' AND datee = '$date' AND category LIKE '%Offline%' ";
                                        $ar = mysqli_query($connect, $arr);


                                    while($a = mysqli_fetch_array($ar)){

                                      $k = $a['kg'];
                                      $q = $a['quantity'];
                                      $c = $a['category'];

                                      echo "".$q." X ".$k." kg ".$c." <br> ";

                                    }

                                    ?></td colspan="2">
                                    <?php 
                                    echo "
                                    <td class='text-white'>".$tkg." Kg</td>
                                    <td class='text-white'>".number_format($cash)." NGN</td>
                                    <td class='text-white'>".$paymentMeth."</td>
                                    <td class='text-white'>".$tank."</td>
                                    <td class='text-white'>".$bstock." KG</td>
                                    <td class='text-white'>".$time."</td>
                                    </tr>
                                    ";
      

                                }elseif($categ == 'Others'){

                                    echo "
                                    <tr class='bg-danger'>
                                      <td class='text-white' colspan='2'>".$rrec."</td>
                                   <td colspan='2' class='text-white'><a href='reciept.php?reciept=".$rrec."&branch=".$branchCode."&CompanyName=".$company."''><b> $cn <br> $cp </b></a></td>
                                    ";
                                    ?><td colspan="2" class='text-white'>
                                    <?php 

                                        $arr = "SELECT finalsales.kg, finalsales.quantity, finalsales.category FROM finalsales WHERE finalsales.reciept = '$rrec' AND finalsales.branch = '$branchCode' AND datee = '$date' ";
                                        $ar = mysqli_query($connect, $arr);


                                    while($a = mysqli_fetch_array($ar)){

                                      $k = $a['kg'];
                                      $q = $a['quantity'];
                                      $c = $a['category'];

                                      echo "".$q."  X ".$k." kg ".$c." <br> ";

                                    }

                                    ?></td colspan="2">
                                    <?php 
                                    echo "
                                    <td class='text-white'>".$tkg." Kg</td>
                                    <td class='text-white'>".number_format($cash)." NGN</td>
                                    <td class='text-white'>".$paymentMeth."</td>
                                    <td class='text-white'>".$tank."</td>
                                    <td class='text-white'>".$bstock." KG</td>
                                    <td class='text-white'>".$time."</td>
                                    </tr>
                                    ";
      
                                  }elseif($categ == 'Domestic'){
                                    echo "
                                    <tr>
                                   <td colspan='2'>".$rrec."</td>
                                    <td colspan='2'><a href='reciept.php?reciept=".$rrec."&branch=".$branchCode."&CompanyName=".$company."''><b> $cn <br> $cp </b></a></td>
                                    ";
                                    ?><td colspan="2">
                                    <?php 

                                    $arr = "SELECT finalsales.kg, finalsales.quantity, finalsales.category FROM finalsales WHERE finalsales.reciept = '$rrec' AND finalsales.branch = '$branchCode' AND datee = '$date' ";
                                    $ar = mysqli_query($connect, $arr);

                                    while($a = mysqli_fetch_array($ar)){

                                      $k = $a['kg'];
                                      $q = $a['quantity'];
                                      $c = $a['category'];

                                      echo "".$q." X ".$k." kg  ".$c." <br> ";

                                    }

                                    ?></td colspan="2">
                                    <?php 
                                    echo "
                                    <td>".$tkg." Kg</td>
                                    <td>".number_format($cash)." NGN</td>
                                    <td>".$paymentMeth."</td>
                                    <td>".$tank."</td> 
                                    <td>".$bstock." KG</td>
                                    <td>".$time."</td>
                                    </tr>
                                    ";
                                  }elseif($categ == 'Eatery'){
                                     
                                    echo "
                                    <tr class='bg-primary'>
                                    <td class='text-white' colspan='2'>".$rrec."</td>
                                    <td colspan='2' class='text-white'><a class='text-white' href='reciept.php?reciept=".$rrec."&branch=".$branchCode."&CompanyName=".$company."''><b> $cn <br> $cp </b></a></td>
                                    ";
                                    ?><td colspan="2" class='text-white'>
                                    <?php 

                                        $arr = "SELECT finalsales.kg, finalsales.quantity, finalsales.category FROM finalsales WHERE finalsales.reciept = '$rrec' AND finalsales.branch = '$branchCode' AND datee = '$date' ";
                                        $ar = mysqli_query($connect, $arr);


                                    while($a = mysqli_fetch_array($ar)){

                                      $k = $a['kg'];
                                      $q = $a['quantity'];
                                      $c = $a['category'];

                                      echo "".$q." X ".$k." kg ".$c." <br> ";

                                    }

                                    ?></td colspan="2">
                                    <?php 
                                    echo "
                                    <td class='text-white'>".$tkg." Kg</td>
                                    <td class='text-white'>".number_format($cash)." NGN</td>
                                    <td class='text-white'>".$paymentMeth."</td>
                                    <td class='text-white'>".$tank."</td>  
                                    <td class='text-white'>".$bstock." KG</td>
                                    <td class='text-white'>".$time."</td>
                                    </tr>
                                    ";
      
                                  }elseif($categ == 'Dealer'){
                                    echo "
                                    <tr class='bg-success' >
                                  <td class='text-white' colspan='2'>".$rrec."</td>
                                   <td colspan='2' class='text-white'><a href='reciept.php?reciept=".$rrec."&branch=".$branchCode."&CompanyName=".$company."''><b> $cn <br> $cp </b></a></td>
                                    ";
                                    ?><td colspan="2" class='text-white'>
                                    <?php 

                                        $arr = "SELECT finalsales.kg, finalsales.quantity, finalsales.category FROM finalsales WHERE finalsales.reciept = '$rrec' AND finalsales.branch = '$branchCode' AND datee = '$date' ";
                                        $ar = mysqli_query($connect, $arr);


                                    while($a = mysqli_fetch_array($ar)){

                                      $k = $a['kg'];
                                      $q = $a['quantity'];
                                      $c = $a['category'];

                                      echo "".$q." X ".$k." kg ".$c." <br> ";

                                    }

                                    ?></td colspan="2">
                                    <?php 
                                    echo "
                                    <td class='text-white'>".$tkg." Kg</td>
                                    <td class='text-white'>".number_format($cash)." NGN</td>
                                    <td class='text-white'>".$paymentMeth."</td>
                                    <td class='text-white'>".$tank."</td>   
                                    <td class='text-white'>".$bstock." KG</td>
                                    <td class='text-white'>".$time."</td>
                                    </tr>
                                    ";
      

                                }elseif($categ == 'Switchcontroler'){
                                    if(isset($_POST['val'])){
                                        $date = $ddaattee;
                                    }else{
                                        $date = $date;
                                    }
                                  // $gt = "SELECT tankUse FROM finalsales WHERE datee = '$date' AND branch = '$branchCode'";
                                  // $rt = mysqli_query($connect, $gt);
                                  // while ( $fg = mysqli_fetch_array($rt) ) {
                                  //    $tankk = $fg['tankUse'];
                                  // }
                                  
                                 

                                  // if($tankk == "Tank A"){

                                  //   $kl = "SELECT SUM(amount), SUM(finalTotal), SUM(kg) FROM finalsales WHERE tankUse = '$tankk' AND datee = '$date' AND branch = '$branchCode'" ;

                                  //   $k = mysqli_query($connect, $kl);
                                  //   $gh = mysqli_fetch_array($k);
                                  //   $ka = $gh['SUM(amount)'];
                                  //   $kt = $gh['SUM(finalTotal)'];
                                  //     $kgs = $gh['SUM(kg)'];

                                  //     $oo = "SELECT SUM(amount), SUM(finalTotal), SUM(kg) FROM finalsales WHERE tankUse = '$tankk' AND datee = '$date' AND branch = '$branchCode'  AND category LIKE '%Offline%' ";
                                  //     $oogo = mysqli_query($connect, $oo);
                                  //       $oi = mysqli_fetch_array($oogo);
                                  //       $oAmi = $oi['SUM(amount)'];
                                  //       $oFai = $oi['SUM(finalTotal)'];
                                  //       $oKgi = $oi['SUM(kg)'];
                                      
                                
                                  // }elseif ($tankk == "Tank B") {

                                  //     $kl = "SELECT SUM(amount), SUM(finalTotal), SUM(kg) FROM finalsales WHERE tankUse = '$tankk' AND datee = '$date' AND branch = '$branchCode'";
                                  //   $k = mysqli_query($connect, $kl);
                                  //   $gh = mysqli_fetch_array($k);
                                  //   $ka = $gh['SUM(amount)'];
                                  //   $kt = $gh['SUM(finalTotal)'];
                                  //     $kgs = $gh['SUM(kg)'];

                                      $oo = "SELECT SUM(amount), SUM(finalTotal), SUM(kg) FROM finalsales WHERE tankUse = '$tankk' AND datee = '$date' AND branch = '$branchCode'  AND category LIKE '%Offline%' ";
                                      $oogo = mysqli_query($connect, $oo);
                                        $oi = mysqli_fetch_array($oogo);
                                        $oAmi = $oi['SUM(amount)'];
                                        $oFai = $oi['SUM(finalTotal)'];
                                        $oKgi = $oi['SUM(kg)'];
                                      
                                    
                                    
                                    
                                  // }

                                        $cross = "SELECT * FROM switchLog WHERE  datee = '$date' AND branch = '$branchCode'";
                                        $ggca = mysqli_query($connect, $cross);

                                        if(mysqli_num_rows($ggca) > 0){
                                          while($raw = mysqli_fetch_array($ggca)){

                                                // $da = $raw['datee'];
                                                // $ta = $raw['timee'];
                                                // $desc = $raw['actionn'];
          
                                          }
                                          //   $dz = "SELECT * FROM gasStations WHERE Bcode = '$branchCode'";
                                          //   $fz = mysqli_query($connect, $dz);
                                          //   $gz = mysqli_fetch_array($fz);
                                          //   $gU = $gz['BtankUse'];
                                            
                                        
                                            
                                          // $slate = "SELECT * FROM finalsales WHERE  datee = '$date' AND branch = '$branchCode' AND tankUse = '$gU' ORDER BY id ASC LIMIT 1";
                                          // $slt = mysqli_query($connect, $slate);
                                          // $sl = mysqli_fetch_array($slt);
                                          
                                          // $o = $sl['opening']; 

                                           echo "
                                             <td colspan='6'><b> Total of ".$tank." </b></a></td>
                                   
                                    <td colspan='2'><b>".number_format($amount)." NGN</b><br><b class='text-danger'>".number_format($oAmi)." NGN - Offline</b></td>
                                 
                                    <td><b>".number_format($finalA)." NGN</b><br><b class='text-danger'>".number_format($oFai)." NGN - Offline</b></td>
                                    <td><b>".$tkg." Kg</b><br><b class='text-danger'>".$oKgi." Kg - Offline</b></td>
                                    
                                    <td colspan='2' align='right'><b>".$time."</b></td>
                                    </tr>
                                    ";
                                          
                                                // $ploss = "SELECT * FROM finalsales WHERE tankUse = '$tankk' AND branch = '$branchCode'  AND datee = '$date' ORDER BY id DESC LIMIT 1";
                                                // $plos = mysqli_query($connect, $ploss);
                                                // $s = mysqli_fetch_array($plos);
                                                // $cl = $s['closing'];

                                        if ($tank == 'Tank A') {
                                          $tankk = "Tank B";
                                        }else{
                                          $tankk = "Tank A";
                                        }
                                                
                                         

                                          echo "
                                              <tr class='bg-info'>
                                              <td class='bg-danger text-white'>SWITCH ALERT</td>
                                            
                                              <td colspan='10' class='text-white' align='center'><b> Successful Tank Switch To : ".$tankk."</b><br><b class='text-danger'>Loss on previous ".$tank.": ".$clo." Kg </b><br> <b>New tank opening stock: ".number_format($opening)." Kg</b></td>
                                              
                                              <td class='text-white'>".$ta."</td>
                                              </tr>
                                              ";
                                        }
                                }
                                        
                        
                          }
                                        // $gta = "SELECT BtankUse FROM gasStations WHERE Bcode = '$branchCode'";
                                        // $rta = mysqli_query($connect, $gta);
                                        // $fga = mysqli_fetch_array($rta);
                                        // $tankka = $fga['BtankUse'];
                                        
//                                        echo $tankka;
//                                        
                                        $sand = "SELECT * FROM finalsales WHERE category = 'Switchcontroler' AND branch = '$branchCode' AND datee = '$date' ORDER BY timee DESC LIMIT 1";
                                        $road = mysqli_query($connect, $sand);
                                        $rave = mysqli_fetch_array($road);
                                        $loss = $rave['closing'];
                                        $id = $rave['id'];
                                        
//                                        echo $loss;
//                                        echo "<br>";
//                                        echo $id;
//
//
                                        
                                        $klz = "SELECT SUM(amount), SUM(finalTotal), SUM(kg) FROM finalsales WHERE tankUse = '$tank' AND datee = '$date' AND branch = '$branchCode'";
                                        $kz = mysqli_query($connect, $klz);
                                        $ghz = mysqli_fetch_array($kz);
                                        $kaz = $ghz['SUM(amount)'];
                                        $ktz = $ghz['SUM(finalTotal)'];
                                        $kgz = $ghz['SUM(kg)'];
                                        
                                        
                                        
            
                                        $off = "SELECT SUM(amount), SUM(finalTotal), SUM(kg) FROM finalsales WHERE tankUse = '$tank' AND datee = '$date' AND branch = '$branchCode' AND category LIKE '%Offline%' ";
                                        $offgo = mysqli_query($connect, $off);
                                        $o = mysqli_fetch_array($offgo);
                                        $oAm = $o['SUM(amount)'];
                                        $oFa = $o['SUM(finalTotal)'];
                                        $oKg = $o['SUM(kg)'];
                                        echo "
                                        
                                        <td colspan='6'><b> Total of ".$tank." </b></a></td>
                                        
                                        <td colspan='2'><b>".number_format($kaz)." NGN</b><br><b class='text-danger'>".number_format($oAm)." NGN - Offline</b></td>
                                        
                                        <td><b>".number_format($ktz)." NGN</b><br><b class='text-danger'>".number_format($oFa)." NGN - Offline</b></td>
                                        <td><b>".$kgz." Kg</b><br><b class='text-danger'>".$oKg." Kg - Offline</b></td>
                                        
                                        <td colspan='2' align='right'><b>".$time."</b></td>
                                        </tr>
                                        
                                        ";
                          echo "
                          <tr>
                          <td colspan='12' align='center'><span class='text-danger'><b>Day's Summary</b></td>
                          </tr>
                          ";

                          echo "
                          <tr>
                       
                          <td colspan='6'><b>SubTotal</b></td>
                          <td colspan='2'><b>".number_format($fcash)." NGN</b></td>
                                 
                          <td> <b>".number_format($finaltt)." NGN</b></td>
                          <td colspan='3'><b>".$fkg." Kg Sold Today</b></td>
                         
                    
                          </tr>
                          ";
                          echo "
                          <tr class='bg-danger'>
                       
                          <td colspan='6' class='text-white'><b>Offline Total</b></td>
                          <td colspan='2' class='text-white'><b>".number_format($offcash)." NGN</b></td>
                                 
                          <td class='text-white'> <b>".number_format($offamount)." NGN</b></td>
                          <td colspan='3' class='text-white'><b>".$offKg." Kg Sold Offline Today</b></td>
                         
                    
                          </tr>
                          ";

                          echo "
                          <tr>
                          
                          <td colspan='6'><b>Overall Total</b></td>
                          <td colspan='7'><b> ".number_format($finaltt)." NGN</b></td>
                          
                         
                          
                          </tr>
                          ";

                          echo "
                          <tr>
                         
                          <td colspan='6'><b>Total Cash</b></td>
                          <td colspan='7'><b> ".number_format($totalcash)." NGN</b></td>
                        
                          
                          </tr>
                          ";

                          echo "
                          <tr>
                         
                          <td colspan='6'><b>Total POS</b></td>
                          <td colspan='7'><b> ".number_format($finalpos)." NGN</b></td>
                        
                          
                          </tr>
                          ";

                                        echo "
                                        <tr>
                                        
                                        <td colspan='6'><b>Change Dispenced</b></td>
                                        <td colspan='7'><b> ".number_format($chang)." NGN</b></td>
                                        
                                        
                                        </tr>
                                        ";
                          echo "
                          <tr>
                         
                          <td colspan='6'><b>Closing Stock</b></td>
                          <td colspan='7'><b> ".$closing." Kg</b></td>
                         
                          </tr>
                          ";

                      }

                      ?>
                      </tbody>
                          </table>
                        
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
