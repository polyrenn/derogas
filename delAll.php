<?php
    
    require_once ("classes/all.php");

    $rock = "DELETE FROM badCrbs";
    $flash = mysqli_query($connect, $rock);
    
    if($flash){
        $message = "All declined crbs deleted successfully ";
        header("Location: badCrbs.php?msg=true&type=error&details=". urlencode($message) );
    }else{
        $message = "We were not able to delete declined crbs, try again.";
        header("Location: badCrbs.php?msg=true&type=error&details=". urlencode($message) );
    }
    
    
    ?>

