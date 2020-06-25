        <?php

        require_once('classes/all.php');

       

        $company = $_POST['company'];
        $code = $_POST['bcode'];
        $category = $_POST['category'];
        $priceperkg = mysqli_real_escape_string($connect, $_POST['ppKg']);
          //get cylindersize 
          $cylinder = "SELECT * FROM price WHERE Bcode = '$code' AND Category = '$category' ";
          $gocy = mysqli_query($connect, $cylinder);

        function endsWith($string, $endString) 
        { 
            $len = strlen($endString); 
            if ($len == 0) { 
                return true; 
            } 
            return (substr($string, -$len) === $endString); 
        } 

      
        if(mysqli_num_rows($gocy) > 0){
            while($row = mysqli_fetch_array($gocy)){
                $vpo = $row['id'];

                $size = $row['cylinderSize'];
                
                if($size == 6){
                    $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
                    $goPull = mysqli_query($connect, $pullSize);
                    $ggh = mysqli_fetch_array($goPull);
                        $pri = $ggh['price'];
            
                    $am = $pri * 2;
                   
                }elseif($size == 8){
                    $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 5 ";
                    $goPull = mysqli_query($connect, $pullSize);
                    $ggh = mysqli_fetch_array($goPull);
                        $pri = $ggh['price'];
            
                        $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
                        $govim = mysqli_query($connect, $vim);
                        $gggh2 = mysqli_fetch_array($govim);
                            $pri2 = $gggh2['price'];
                            
                    $am = $pri + $pri2;
            
                }elseif($size == 9){
                    $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 6 ";
                    $goPull = mysqli_query($connect, $pullSize);
                    $ggh = mysqli_fetch_array($goPull);
                        $pri = $ggh['price'];
            
                        $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
                        $govim = mysqli_query($connect, $vim);
                        $gggh2 = mysqli_fetch_array($govim);
                            $pri2 = $gggh2['price'];
                            
                    $am = $pri + $pri2;
            
                }elseif($size == 10){
                    $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 5 ";
                    $goPull = mysqli_query($connect, $pullSize);
                    $ggh = mysqli_fetch_array($goPull);
                        $pri = $ggh['price'];
             
                    $am = $pri * 2;
            
                }elseif($size == 11){
                    $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 8 ";
                    $goPull = mysqli_query($connect, $pullSize);
                    $ggh = mysqli_fetch_array($goPull);
                        $pri = $ggh['price'];
            
                        $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
                        $govim = mysqli_query($connect, $vim);
                        $gggh2 = mysqli_fetch_array($govim);
                            $pri2 = $gggh2['price'];
                            
                    $am = $pri + $pri2;
                }elseif($size == 12){
                    $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 9 ";
                    $goPull = mysqli_query($connect, $pullSize);
                    $ggh = mysqli_fetch_array($goPull);
                        $pri = $ggh['price'];
            
                        $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
                        $govim = mysqli_query($connect, $vim);
                        $gggh2 = mysqli_fetch_array($govim);
                            $pri2 = $gggh2['price'];
                            
                    $am = $pri + $pri2;
                }elseif($size == 15){
                    $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 5 ";
                    $goPull = mysqli_query($connect, $pullSize);
                    $ggh = mysqli_fetch_array($goPull);
                        $pri = $ggh['price'];
            
                        $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 10 ";
                        $govim = mysqli_query($connect, $vim);
                        $gggh2 = mysqli_fetch_array($govim);
                            $pri2 = $gggh2['price'];
                            
                    $am = $pri + $pri2;
            
                }elseif($size == 25){
            
                    $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 5 ";
                    $goPull = mysqli_query($connect, $pullSize);
                    $ggh = mysqli_fetch_array($goPull);
                        $pri = $ggh['price'];
            
                        $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 10 ";
                        $govim = mysqli_query($connect, $vim);
                        $gggh2 = mysqli_fetch_array($govim);
                            $pri2 = $gggh2['price'];
                            
                    $am = $pri + $pri2 + $pri2;
            
            
                }elseif($size == 50){
            
                    $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 25 ";
                    $goPull = mysqli_query($connect, $pullSize);
                    $ggh = mysqli_fetch_array($goPull);
                        $pri = $ggh['price'];
                   
                    $am = $pri * 2;
            
                }elseif($size == 23){
            
                    $pullSize = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 3 ";
                    $goPull = mysqli_query($connect, $pullSize);
                    $ggh = mysqli_fetch_array($goPull);
                        $pri = $ggh['price'];
            
                        $vim = "SELECT price FROM price WHERE Category = '$category' AND Bcode = '$code' AND cylinderSize = 10 ";
                        $govim = mysqli_query($connect, $vim);
                        $gggh2 = mysqli_fetch_array($govim);
                            $pri2 = $gggh2['price'];
                            
                    $am = $pri + $pri2 + $pri2;
                }else{
            
            (int)$am = ceil($size * $priceperkg);
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
    
    //echo '<br/>last price '.$am;
                $sql = "UPDATE price SET pricePerKg = $priceperkg , price = $am WHERE id ='$vpo' AND Category = '$category' AND Bcode = $code AND company = '$company' limit 1";
                $result = mysqli_query($connect, $sql);

                if($result){
                    header("Location: managePrice.php");
                }else{
                    $message = "Error updating price, please try again";
                }
            }

           

        }
    
        
        ?>