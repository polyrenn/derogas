<?php

require_once('classes/all.php');

$priceDo = new All($connect);
function endsWith($string, $endString) 
{ 
    $len = strlen($endString); 
    if ($len == 0) { 
        return true; 
    } 
    return (substr($string, -$len) === $endString); 
} 









foreach($_POST['cylinder'] as $v){

$company = $_POST['company'];
$code = $_POST['bcode'];
$category = $_POST['category'];




//$cylinder = mysqli_real_escape_string($connect, $_POST['cylinder']);
$priceperkg = mysqli_real_escape_string($connect, $_POST['ppKg']);
$am = $cylinder * $priceperkg;
    $cylinder = $v;

    if($cylinder == 6){

        $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
        $goPull = mysqli_query($connect, $pullSize);
        $ggh = mysqli_fetch_array($goPull);
            $pri = $ggh['price'];

        $am = $pri * 2;
       
    }elseif($cylinder == 8){
        $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 5 ";
        $goPull = mysqli_query($connect, $pullSize);
        $ggh = mysqli_fetch_array($goPull);
            $pri = $ggh['price'];

            $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
            $govim = mysqli_query($connect, $vim);
            $gggh2 = mysqli_fetch_array($govim);
                $pri2 = $gggh2['price'];
                
        $am = $pri + $pri2;

    }elseif($cylinder == 9){
        $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 6 ";
        $goPull = mysqli_query($connect, $pullSize);
        $ggh = mysqli_fetch_array($goPull);
            $pri = $ggh['price'];

            $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
            $govim = mysqli_query($connect, $vim);
            $gggh2 = mysqli_fetch_array($govim);
                $pri2 = $gggh2['price'];
                
        $am = $pri + $pri2;

    }elseif($cylinder == 10){
        $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 5 ";
        $goPull = mysqli_query($connect, $pullSize);
        $ggh = mysqli_fetch_array($goPull);
            $pri = $ggh['price'];
 
        $am = $pri * 2;

    }elseif($cylinder == 11){
        $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 8 ";
        $goPull = mysqli_query($connect, $pullSize);
        $ggh = mysqli_fetch_array($goPull);
            $pri = $ggh['price'];

            $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
            $govim = mysqli_query($connect, $vim);
            $gggh2 = mysqli_fetch_array($govim);
                $pri2 = $gggh2['price'];
                
        $am = $pri + $pri2;
    }elseif($cylinder == 12){
        $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 9 ";
        $goPull = mysqli_query($connect, $pullSize);
        $ggh = mysqli_fetch_array($goPull);
            $pri = $ggh['price'];

            $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
            $govim = mysqli_query($connect, $vim);
            $gggh2 = mysqli_fetch_array($govim);
                $pri2 = $gggh2['price'];
                
        $am = $pri + $pri2;
    }elseif($cylinder == 15){
        $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 5 ";
        $goPull = mysqli_query($connect, $pullSize);
        $ggh = mysqli_fetch_array($goPull);
            $pri = $ggh['price'];

            $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 10 ";
            $govim = mysqli_query($connect, $vim);
            $gggh2 = mysqli_fetch_array($govim);
                $pri2 = $gggh2['price'];
                
        $am = $pri + $pri2;

    }elseif($cylinder == 25){

        $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 5 ";
        $goPull = mysqli_query($connect, $pullSize);
        $ggh = mysqli_fetch_array($goPull);
            $pri = $ggh['price'];

            $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 10 ";
            $govim = mysqli_query($connect, $vim);
            $gggh2 = mysqli_fetch_array($govim);
                $pri2 = $gggh2['price'];
                
        $am = $pri + $pri2 + $pri2;


    }elseif($cylinder == 50){

        $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 25 ";
        $goPull = mysqli_query($connect, $pullSize);
        $ggh = mysqli_fetch_array($goPull);
            $pri = $ggh['price'];
       
        $am = $pri * 2;

    }elseif($cylinder == 23){

        $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
        $goPull = mysqli_query($connect, $pullSize);
        $ggh = mysqli_fetch_array($goPull);
            $pri = $ggh['price'];

            $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 10 ";
            $govim = mysqli_query($connect, $vim);
            $gggh2 = mysqli_fetch_array($govim);
                $pri2 = $gggh2['price'];
                
        $am = $pri + $pri2 + $pri2;
    }elseif($cylinder == 'Others'){
        $am = 0;
    }else{

        $am = $cylinder * $priceperkg;

if(endswith($am, '1')){
    $am = $am + 9;
}elseif(endsWith($am, '2')){
    $am = $am + 8;
}elseif(endsWith($am, '3')){
    $am = $am + 7;
}elseif(endsWith($am, '4')){
    $am = $am + 6;
}elseif(endsWith($am, '5')){
    $am = $am + 5;
}elseif(endsWith($am, '6')){
    $am = $am + 4;
}elseif(endsWith($am, '7')){
    $am = $am + 3;
}elseif(endsWith($am, '8')){
    $am = $am + 2;
}elseif(endsWith($am, '9')){
    $am = $am + 1;
}else{
    $am = $am;
}

}



    $priceDo->addPrice($company,$code, $category, $v, $priceperkg, $am);



}


?>