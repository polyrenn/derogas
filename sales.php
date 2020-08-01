  <?php 
  require_once ("classes/all.php");

  $branch = $_POST['branch'];


  $crbN = "SELECT crbnumber FROM crbstep WHERE branch = '$branch' ORDER BY id DESC LIMIT 1";
  $rogue = mysqli_query($connect, $crbN);

          while($ggg = mysqli_fetch_array($rogue)){
              $crbNUn = $ggg['crbnumber'];
          }

          $ga = "INSERT INTO crbs 
          SELECT * FROM crbstep WHERE crbnumber ='$crbNUn' ";
          $fl = mysqli_query($connect, $ga);
        
    $game = "INSERT INTO salespoint SELECT * FROM crbstep WHERE crbnumber ='$crbNUn' AND branch = '$branch' ";
    $flash = mysqli_query($connect, $game);

    $runT = "DELETE FROM crbstep WHERE crbnumber = '$crbNUn' ";
    $rra = mysqli_query($connect, $runT);


    if($rra){
        $message = "CRB created and sent to cash point succesfully.";
        header("Location: crbHome.php?msg=true&type=error&details=". urlencode($message) );
    }else{
        $message = "Error creating Crb. try again.";
        header("Location: crbHome.php?msg=true&type=error&details=". urlencode($message) );
    }




  ?>
