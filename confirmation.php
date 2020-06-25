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

                $priceperkg = "SELECT PricePerKg FROM price WHERE Category = 'Dealer' AND Bcode = '$branchCode'";
                $gaga = mysqli_query($connect, $priceperkg);
                if(mysqli_num_rows($gaga) > 0){
                    while($row = mysqli_fetch_array($gaga)){
                        $getgaga = $row['PricePerKg'];
                    }
                }
                $pricedomestic = "SELECT PricePerKg FROM price WHERE Category = 'Domestic' AND Bcode = '$branchCode'";
                $gagado = mysqli_query($connect, $pricedomestic);
                if(mysqli_num_rows($gagado) > 0){
                    while($row = mysqli_fetch_array($gagado)){
                        $getgagado = $row['PricePerKg'];
                    }
                }
                $priceeat = "SELECT PricePerKg FROM price WHERE Category = 'Eatery' AND Bcode = '$branchCode'";
                $gagaeat = mysqli_query($connect, $priceeat);
                if(mysqli_num_rows($gagado) > 0){
                    while($row = mysqli_fetch_array($gagaeat)){
                        $getgagaeat = $row['PricePerKg'];
                    }
                }
                $priceother = "SELECT PricePerKg FROM price WHERE Category = 'Others' AND Bcode = '$branchCode'";
                $gagaother = mysqli_query($connect, $priceother);
                if(mysqli_num_rows($gagaother) > 0){
                    while($row = mysqli_fetch_array($gagaother)){
                        $getgagaother = $row['PricePerKg'];
                    }
                }

if(isset($_POST['submitsss'])){
    $phone = $_POST['cphone'];
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
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>


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
                
                ?>
                </span>
                <form action="logout.php">
                <button class="btn btn-outline-danger">Logout</button>
                </form>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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

        <div class="container">
            <h1  align="center">Almarence International Company Limited</h1>
        </div>

          <!-- Page Heading -->
          <div class="row">

            <div class="col-lg-3 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Customer Purchase History (<?php $createStation->getPurchaseCount() ?>)</h6>
                </div>

                <div class="card-body">
                <?php $createStation->getCustomerCrb(); ?>
               </div>
               </div>
             

            <div class="col-lg-6 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">CRB Description</h6>
                </div>
                <div class="card-body">
                
                <?php $createStation->getCRB(); ?>

               </div>
               </div>
               </div>

               <div class="col-lg-3 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">

                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Reprint CRB</h6>
                </div>

                <div class="card-body">
               
                </div>
                </div>
              </div>

              <!-- Approach -->
            
            </div>
          </div>  
      
      <!-- Start new gas plant modal -->


     
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

</body>

</html>
