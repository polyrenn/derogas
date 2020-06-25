<?php
    
    require_once ("classes/all.php");
    
    $lee = $_POST['staff'];
    
    $rock = "DELETE FROM staffs WHERE username = '$lee'";
    $flash = mysqli_query($connect, $rock);
    
    if($flash){
        $message = "Staff deleted successfully";
        header("Location: staffs.php?msg=true&type=error&details=". urlencode($message) );
    }else{
        $message = "We were not able to delete this staff, try again.";
        header("Location: staffs.php?msg=true&type=error&details=". urlencode($message) );
    }
    
    
    ?>
