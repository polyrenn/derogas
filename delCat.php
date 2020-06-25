<?php
    
    require_once ("classes/all.php");
    
    $lee = $_POST['catDelete'];
    
    $flee = $_POST['catta'];
    
    $rock = "DELETE FROM price WHERE Bcode = '$lee' AND Category = '$flee' ";
    $flash = mysqli_query($connect, $rock);
    
    if($flash){
        $message = "Category deleted successfully";
        header("Location: managePrice.php?msg=true&type=error&details=". urlencode($message) );
    }else{
        $message = "We were not able to delete this category, try again.";
        header("Location: managePrice.php?msg=true&type=error&details=". urlencode($message) );
    }
    
    
    ?>

