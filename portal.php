  <?php

  session_start();


  require_once ('classes/all.php');
  $createStation = new All($connect);
  if(isset($_POST['submit'])){
      $phone = $_POST['cphone'];
  }
      $status = urldecode($_GET['details']);

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

              <div class="topbar-divider d-none d-sm-block"></div>

              

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
                <div class='col-12 col-lg-2'>
                
                </div>
                <div class='col-12 col-lg-8 p-3'>
                <div class="col-12 col-lg-12 mb-4">

<!-- Illustrations -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Login to your workspace</h6>
  </div>
  <div class="card-body">
  
  <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h4 class="text-danger"><?php echo $status ?></h4>
                      <form action="login.php" method="POST" enctype="multipart/form-data">
                          <br>
  
                              <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Phone Number" name="phone">
                              </div>

                              <div class="form-group">
                                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" name="pass">
                                <small class="text-danger">Always keep your password a secret to prevent intruders from using your account to perform illegal actiities.</small>
                              </div>

                            
                              
                              <button type="submit" name="submit" class="col btn btn-outline-primary">Login to my workspace</button>
                      </form>
  
  
  </div>

  
  </div>
  </div>
</div>

<!-- Approach -->

</div>

<div class="col-12 col-lg-12 mb-4">

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h4 class="m-0 font-weight-bold text-primary">Notice</h4>
  </div>
  <div class="card-body">
      <p>Always double check your inputs before proceeding to click any button. Wrong inputs may take a long time to be rectified. In order to deliver fast and quality service to all customers, please be sure to verify all inputs first. <br> <b class="text-info">Have a great day today, remember, the customer is king!</b></p>
  </div>
</div>
</div>
                </div>
                <div class='col-12 col-lg-2'>
                
                </div>
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
