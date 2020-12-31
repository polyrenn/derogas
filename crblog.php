<?php

session_start();


require_once ('classes/all.php');
$id = $_SESSION['id'];
$username = $_SESSION['username'];
    $designation  = $_SESSION["designation"];
$createStation = new All($connect);
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



$branchCode = $_POST['branchCode'];

if(isset($_POST['previous'])){
  $branchCode = $_POST['code'];

  $date = $_POST['previous'];
  $dataa = date('Y-m-01');
   
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

}elseif(isset($_POST['next'])){
  $branchCode = $_POST['code'];
  $date = $_POST['next'];
  $dataa = date('Y-m-01');
  

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

}else{
  
$date = date('Y-m-d', strtotime('now')) ;
$dataa = date('Y-m-01');


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

<title>Derogas</title>

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
<?php echo "<ul class='navbar-nav ".$color." sidebar sidebar-dark accordion' id='accordionSidebar'>" ?>

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
        <a class="nav-link collapsed" href="salesanalysis.php">
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
          <a class="nav-link collapsed" href="stockanalysis.php">
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
        <a class="nav-link collapsed" href="badCrbs.php">
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
          <a class="nav-link collapsed" href="switch.php">
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
              <a class="nav-link collapsed" href="Loyalty.php">
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
            <style>
                .report-table {
                    margin-top: 2rem;
                }

                .branch-form {
                    margin-bottom: 1rem
                }
            </style>
            <script>
                function ff() {
                    var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("table").innerHTML = this.responseText;
                        }
                    };
                    let code = document.getElementById('opt').value;
                    let date = document.getElementById('date').value;
                    let getdate = "&date="
                    let get = code.concat(getdate, date);


                    xmlhttp.open("GET", "crbreport.php?bcode="  + get, true);
                    xmlhttp.send();
                }
            </script>
            <h3>Choose Branch</h3>
            <form class="branch-form col-sm-5" action="/action_page.php">
            <select  id="opt" onchange="ff()" class="form-control" name="bcode">
                      <option>Select Branch </option>
                      <?php  echo $createStation->getCompanyBranchCodeS();?>
                      </select>
            </form>

            <div class="date-form">
            <form class="col-sm-5" id="pull-records" action="  " method="POST">
                      <div>
                      <?php
                      $datepost = $_POST['date']; 
                    if(isset($_POST['date'])) {
                        echo "<input id='date' type='date' id='date' value='$datepost' onchange='ff()' name='date' class='form-control col-sm-5 mr-1 mb-2' placeholder='Select date to view'>";
                    }else{
                        echo "<input id='date' type='date' id='date' onchange='ff()' name='date' class='form-control col-sm-5 mr-1 mb-2' placeholder='Select date to view'>";
                    }
                
                      ?>
                  
                          
                          
                  
                      </div>
                          
                  </form>
            </div>
            
            <div style="overflow-x:auto" id="table" class="container-fluid">

            </div>
            
      
    

      <!-- Footer -->
      
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
