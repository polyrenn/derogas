  <?php

  session_start();


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
      }else{
          $color = "bg-gradient-primary";
          $link = "adminPage.php";
      }



  if(isset($_POST['submit'])){
      $branch = $_POST['bcode'];

      $sql = "SELECT * FROM customers WHERE branch = '$branch' ORDER BY CpurchaseCount DESC";
  $gosql = mysqli_query($connect, $sql);
  }else{
     $designation = $_SESSION["designation"];

    if ($designation == 'Supervisor') {
       $company = $_SESSION['CompanyName'];
      $greed = " SELECT * FROM gasStations WHERE company = '$companyCode' ";
        $runG = mysqli_query($connect, $greed);
        $bros = mysqli_fetch_array($runG);
        $bra = $bros['Bcode'];
        


        $sql = "SELECT * FROM customers WHERE branch = '$bra' ORDER BY CpurchaseCount DESC";
  $gosql = mysqli_query($connect, $sql);
    }else{
       $sql = "SELECT * FROM customers ORDER BY CpurchaseCount DESC";
  $gosql = mysqli_query($connect, $sql);
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
<link href="css/sb-admin-2.min.css" rel="stylesheet">

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

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
Sales
</div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="salesanalysis.php" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Daily Sales Summary</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="salesanalysis.php">All Branches</a>
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
              <span>Daily Stock Summary</span>
            </a>
            <div id="colThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="stockanalysis.php">All Branches</a>
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
            <span>Declined Sales</span>
          </a>
          <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="badCrbs.php">Declined Sales</a>
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
          Stock
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="allStock.php" data-toggle="collapse" data-target="#colfour" aria-expanded="true" aria-controls="colfour">
              <i class="fas fa-fw fa-cog"></i>
              <span>Manage Stock</span>
            </a>
            <div id="colfour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="allStock.php">View Stock Records</a>
                <a class="collapse-item" href="updateStock.php">Add New Stock</a>
                <a class="collapse-item" href="updateS.php">Update Stock</a>
              </div>
            </div>
          </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="switch.php" data-toggle="collapse" data-target="#colsix" aria-expanded="true" aria-controls="colsix">
              <i class="fas fa-fw fa-cog"></i>
              <span>Switch Tank</span>
            </a>
            <div id="colsix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Select Branch</h6>
                <a class="collapse-item" href="switch.php">Switch Tank In Use</a>
              </div>
            </div>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="addnewprice.php" data-toggle="collapse" data-target="#colseven" aria-expanded="true" aria-controls="colseven">
                <i class="fas fa-fw fa-cog"></i>
                <span>Price List </span>
              </a>
              <div id="colseven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="addnewprice.php">Add New Price / Kg</a>
                  <a class="collapse-item" href="updateprice.php">Update Price</a>
                  <a class="collapse-item active" href="managePrice.php">View Price By Location</a>
                </div>
              </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="loyalty.php" data-toggle="collapse" data-target="#coleight" aria-expanded="true" aria-controls="coleight">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Loyalty Gift Tool </span>
                </a>
                <div id="coleight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="loyalty.php">Loyalty Watch</a>
                  
                  </div>
                </div>
              </li>

              <li class="nav-item">
                  <a class="nav-link" href="staffs.php">
                      <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Accounts</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-fw fa-cog"></i>
                      <span>LogOut</span></a>
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
              <h1 class="h3 mb-0 text-gray-800">Loyalty Watch by Branch</h1>
            </div>

            <div class="row">
            
            <div class="col-lg-10 form-group">

              <form action=" " method="POST" >
                  
              <select class="form-control" name="bcode">
                <option>Select Branch</option>
              <?php  echo $createStation->cusStats();?>
              </select>
              </div>

              <button type="submit" name="submit" class="form-control col-lg-2 btn btn-success">View loyalty</button>

              </form>

              </div>


            


            <table class='table' border="2" >
                      <thead>
                      <tr> 
                      <th scope='col'>Customer Name</th>
                      <th scope='col'>Phone</th>
                      <th scope='col'>Enlisted At</th>
                      <th scope='col'>Total Kg</th>
                      <th scope='col'>Amount</th>
                      <th scope='col'>First Purchase</th>
                      <th scope='col'>Last Purchase</th>
                      <th scope='col'>Purchase Count</th>
                    
                    
                      
                      </tr>
                      </thead> 
                      <tbody>

                          <?php
                      if($gosql){
                          while($row = mysqli_fetch_array($gosql)){
                              $name = $row['Cname'];
                              $phone = $row['Cphone'];
                              $count = $row['CpurchaseCount'];
                              $branch = $row['branch'];

                              //get branch
                              $getBranch = "SELECT Bname FROM gasStations WHERE Bcode = '$branch' ";
                              $goBranch = mysqli_query($connect, $getBranch);
                              if($goBranch){
                                  while($bra = mysqli_fetch_array($goBranch)){
                                      $bname = $bra['Bname'];
                                  }
                              }

                              //get company
                              $getCompany = "SELECT company.CompanyName, gasStations.company FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND gasStations.Bcode = '$branch'";
                              $goCompany = mysqli_query($connect, $getCompany);
                              if($goCompany){
                                  while($com = mysqli_fetch_array($goCompany)){
                                      $company = $com['CompanyName'];
                                  }
                              }

                              //get Sum
                              $getSum = "SELECT SUM(kg), SUM(amount) FROM finalsales WHERE phone = '$phone' ";
                              $runSum = mysqli_query($connect, $getSum);
                              if($runSum){
                                  while($pan = mysqli_fetch_array($runSum)){
                                      $totalkg = $pan['SUM(kg)'];
                                      $amount = $pan['SUM(amount)'];
                                  }
                              }

                              //get purchase dates
                              $getDate = "SELECT datee FROM finalsales WHERE phone = '$phone' ORDER BY id ASC LIMIT 1";
                              $runDate = mysqli_query($connect, $getDate);
                              if($runDate){
                                  while($pan2 = mysqli_fetch_array($runDate)){
                                    $first = $pan2['datee'];
                                  }
                              }

                              //get purchase dates last
                              $getDate2 = "SELECT datee FROM finalsales WHERE phone = '$phone' ORDER BY id DESC LIMIT 1";
                              $runDate2 = mysqli_query($connect, $getDate2);
                              if($runDate2){
                                  while($pan3 = mysqli_fetch_array($runDate2)){
                                    $last = $pan3['datee'];
                                  }
                              }

                              echo "
                              <tr>
                                  <td>".$name."</td>
                                  <td>".$phone."</td>
                                  <td>".$company."<br>".$bname."</td>
                                  <td>".number_format($totalkg)." Kg</td>
                                  <td>".number_format($amount)." NGN</td>
                                  <td>".$first."</td>
                                  <td>".$last."</td>
                                  <td>".$count."</td>
      
                              </tr>
                              ";

                          }
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

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

  </body>

  </html>
