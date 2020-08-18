  <?php

  session_start();


  require_once ('classes/all.php');
  $id = $_SESSION['id'];
  $username = $_SESSION['username'];
  $createStation = new All($connect);
  date_default_timezone_set("Africa/Lagos");
  if(!isset($_SESSION['username'])){
    header('Location: portal.php');
  }

  if(isset($_GET['reciept'])){
      $reciept = $_GET['reciept'];
      $branchCode = $_GET['branch'];
      $company = $_GET['CompanyName'];
      $date = $_GET['date'];
  }
  ///////////////////////////////////////////////////////////

  $sql = "SELECT company.CompanyName, gasStations.Bname, gasStations.Baddress, gasStations.Bcode FROM company, gasStations WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' ";
  $result = mysqli_query($connect, $sql);



  $sql = "SELECT * FROM completeSales WHERE branch = '$branchCode' AND reciept = '$reciept' AND datee = '$date'";
  $go = mysqli_query($connect, $sql);


  $sql2 = "SELECT * FROM crbs WHERE branch = '$branchCode' AND crbnumber = '$reciept' AND datee = '$date'";
  $go2 = mysqli_query($connect, $sql2);



  $train = "SELECT * FROM finalsales WHERE reciept = $reciept AND branch = '$branchCode' AND datee = '$date' ";
  $su = mysqli_query($connect, $train);







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
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion d-none" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminPage.php">
          <div class="sidebar-brand-icon rotate-n-15">
          </div>
          <div class="sidebar-brand-text mx-3">Aicogas Admin</div>
        </a>

      <!-- Divider -->
<hr class="sidebar-divider">

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



                
                                              <div class="col-12 col-lg-6">
<div >
<h3  align='center'>Viewing Reciept Number:  <span class="text-danger" ><?php echo $reciept ?></span> </h3>
<form action='branch.php?date=&branch=<?php echo "$branchCode"?>' method='POST'>
<button align='center' class='col-12 col-lg-6 btn btn-outline-info mt-2 mb-3' name='gotobranch' value='<?php echo $branchCode ?>'>Go back to sales log</button>
</form>

</div>

                                  <div class="card shadow">

                                      <div class="card-body">

                                      <div id="crbprint">

                                      <?php
                                      echo "<h4 align='center'><b>".$company."</b></h4>";
                                      echo "<hr>";

  while($row = mysqli_fetch_array($result)){
      $com = $row['CompanyName'];
      $code = $row['Baddress'];
      $name = $row['Bname'];

      echo "<small align='center'>".$name." <br>".$code. "</small>";
      echo "<hr>";
  }

  if(mysqli_num_rows($go) > 0){
      while($row = mysqli_fetch_array($go)){
          $cname = $row['customer'];
          $phone = $row['phone'];
           $datee = $row['datee'];
          $ti = $row['timee'];
          $rec = $row['reciept'];
          $change = $row['changee'];
          $payment = $row['payment'];

      }
      
      echo "<small>Customer's Name: ".$cname."</small><br>";
      echo "<small>Customer's Phone: ".$phone."</small><br>";
      echo "<small><h5><b>Date: ".$datee."</b></h5></small>";
       echo "<small><h5><b>Time: ".$ti."</b></h5></small>";
      echo "<hr>";
      echo "<small>Reciept No: <b>".$rec."</b></small><br>";
  
  }

  echo "

  <table class='table '>
                                  <thead>
                                  <tr>
                                  <th scope='col'>Cylinder Type</th>
                                  <th scope='col'>Qty</th>
                                          <th scope='col'>Total Kg</th>
                                  <th scope='col'>Payable</th>
                                
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
          echo "<th scope='row'>".$kg."</th>";
          echo "<th scope='row'>".$quantity."</th>";
          echo "<th scope='row'>".$akg." Kg</th>";
          echo "<th scope='row'>".number_format($amount)." NGN</th>";
          
          echo "</tr>";

      }

  }else{

  }
  echo "
  </tbody>
  </table>
  <hr>
  ";
  if($su){

      while($gaga = mysqli_fetch_array($su)){
          $amchange = $gaga['changee'];
          $ampayment = $gaga['payment'];
          $amm = $gaga['amount'];
          $finalAmount = $gaga['finalTotal'];             
      }
      $deduct = $amm - $finalAmount;
      if($amchange != 0){
          $finalAmount = $amm - $amchange;
      }
      
      echo "
              <small align='left'><b class='text-danger'>Change Deducted: ".number_format($deduct)." NGN </b></small><br>
              <small align='left'><b class='text-info'>Total Payable: ".number_format($finalAmount)." NGN </b></small><br>
              <small align='left'><b class='text-info'>Customer Change: ".number_format($amchange)." NGN </b></small><br>
              <small align='left'><b class='text-info'>Total Payable: ".$ampayment."</b></small>
              <hr>
          ";
  }else{

  }

  // $fish = "SELECT * FROM salespoint WHERE 


  echo "
  <div>
  <h6 align='center'>".$company."<br> Thanks for your patronage. Please come again.<br>
                                          Visit Us: Monday to Saturday 7:30 a.m to 6 p.m</h6>
  </div>
  <hr>
  </div>
  
  </div>
  ";






                                          ?>

                                        

                                      </div>

                                      </div>
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
