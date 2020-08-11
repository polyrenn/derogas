<?php
require_once ('classes/all.php');
if(isset($_GET['bcode'])) {
    $branchCode = $_GET['bcode'];
}




$opening = "SELECT BtankA, BtankB, BtankUse FROM gasStations WHERE Bcode = '$branchCode'";
$openingstock = mysqli_query($connect, $opening);

if(mysqli_num_rows($openingstock) > 0){
    
    while($row = mysqli_fetch_array($openingstock)){
        $tank = $row["BtankUse"];
        $tankA = $row["BtankA"];
        $tankB = $row["BtankB"];
        
    }
    
}
if($tank == 'Tank A'){
    $tank = $tank;
    $remaining = $tankA;
    
    $fish = "SELECT * FROM finalsales WHERE branch = '$branchCode'";
    $star = mysqli_query($connect, $fish);
    if(mysqli_num_rows($star) < 0){
        $openTank = $tankA;
    }else{
        $openTank = $remaining;
    }
    
}elseif($tank == 'Tank B'){
    $tank = $tank;
    $remaining = $tankB;
    
    $fish = "SELECT * FROM finalsales WHERE branch = '$branchCode'";
    $star = mysqli_query($connect, $fish);
    if(mysqli_num_rows($star) < 0){
        $openTank = $tankB;
    }else{
        $openTank = $remaining;
    }
}

//show stats on salespoint
$stats = "SELECT SUM(kg) FROM finalsales WHERE branch = '$branchCode' AND tankUse = '$tank' AND category != 'Switchcontroler' ";
$gostats = mysqli_query($connect, $stats);
if($gostats){
    while($st = mysqli_fetch_array($gostats)){
        $allKgg = $st['SUM(kg)'];
    }
}


$date = date('Y-m-d', strtotime('now'));
//check switch log
$sw = "SELECT * FROM switchLog WHERE datee = '$date' AND branch = '$branchCode' ORDER BY id DESC LIMIT 1";
$swt = mysqli_query($connect, $sw);

if (mysqli_num_rows($swt) > 0){
    
    $staks = "SELECT * FROM finalsales";
    $stkk = mysqli_query($connect, $staks);
    $row = mysqli_fetch_array($stkk);
    $statement = $row['category'];
    $tankkk = $row['tankUse'];
    
    
    $gt = "SELECT * FROM gasStations WHERE BtankUse = '$tank'";
    $gg = mysqli_query($connect, $gt);
    $gow = mysqli_fetch_array($gg);
    $tUse = $gow['BtankUse'];
    $tannkA = $row['BtankA'];
    $tannkB = $row['BtankB'];
    
    if($tUse == 'Tank A'){
        
        if(isset($_POST['val'])){
            $date = $ddaattee;
        }else{
            $date = $date;
        }
        
        $tank = 'Tank B';
        $gf = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
        $ggf = mysqli_query($connect, $gf);
        $tow = mysqli_fetch_array($ggf);
        $bstock = $tow['balancee'];
        $opening = $tow['opening'];
        
        
        $gff = "SELECT * FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$date' ORDER BY id DESC LIMIT 1";
        $ggff = mysqli_query($connect, $gff);
        $towf = mysqli_fetch_array($ggff);
        $bstockf = $towf['balancee'];
        
        $gffz = "SELECT SUM(kg) FROM finalsales WHERE  branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
        $ggffz = mysqli_query($connect, $gffz);
        $towfz = mysqli_fetch_array($ggffz);
        $soldk = $towfz['SUM(kg)'];
        
        $gffza = "SELECT SUM(kg) FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
        $ggffza = mysqli_query($connect, $gffza);
        $towfza = mysqli_fetch_array($ggffza);
        $soldka = $towfza['SUM(kg)'];
        
        $gffa = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND category = 'Switchcontroler' AND datee = '$date' ORDER BY timee DESC LIMIT 1";
        $ggffa = mysqli_query($connect, $gffa);
        $towfa = mysqli_fetch_array($ggffa);
        $bop = $towfa['opening'];

         $did = "SELECT * FROM switchLog WHERE datee = '$date' AND branch = '$branchCode' ";

                $it = mysqli_query($connect, $did);
                $happen = mysqli_num_rows($it);

                if ($happen > 0) {
        
                    if ($happen < 2) {
                        $gffx = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id ASC LIMIT 1";
                        $ggffx = mysqli_query($connect, $gffx);
                        $towfx = mysqli_fetch_array($ggffx);
                        $openingfx = $towfx['opening'];
                    }else{
                        $gffx = "SELECT * FROM finalsales WHERE tankUse = 'Tank B' AND branch = '$branchCode' AND datee = '$date' AND category = 'Switchcontroler' ORDER BY timee DESC LIMIT 1";
                        $ggffx = mysqli_query($connect, $gffx);
                        $towfx = mysqli_fetch_array($ggffx);
                        $openingfx = $towfx['opening'];
                    }
                }else{

                   $gffx = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id ASC LIMIT 1";
        $ggffx = mysqli_query($connect, $gffx);
        $towfx = mysqli_fetch_array($ggffx);
        $openingfx = $towfx['opening'];
                }

       
        
        $sc = "SELECT * FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' AND category != 'Switchcontroler' ";
        $ss = mysqli_query($connect, $sc);
        $fcc = mysqli_num_rows($ss);
        
        $loadno = "SELECT * FROM stockHistory WHERE Bcode = '$branchCode' ORDER BY id DESC LIMIT 1";
        $loadup = mysqli_query($connect, $loadno);
        $las = mysqli_fetch_array($loadup);
        $nowtank = $las['loadNumber'];
        
        
        
        echo "
        
        <h6 class='text-danger' align='center'><b>Previous Tank: ".$tank." | Opening Stock : ".$openingfx." Kg | Balance Stock : ".$bstock." Kg  | Sold : $soldka Kg  </b></h6>
        
        
        ";
        echo "
        
        <h6 class='text-info' align='center'><b>Load No: ".$nowtank." | Current Tank: ".$tUse." | Opening Stock : ".$bop."  Kg | Balance Stock : ".$bstockf." Kg | Sold : ".$soldk." Kg | Sales Count : ".number_format($fcc)."</b></h6>
        
        
        ";
    }elseif($tUse == 'Tank B'){
        
        if(isset($_POST['val'])){
            $date = $ddaattee;
        }else{
            $date = $date;
        }
        
        $tank = 'Tank A';
        $gf = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1" ;
        $ggf = mysqli_query($connect, $gf);
        $tow = mysqli_fetch_array($ggf);
        $bstock = $tow['balancee'];
        $opening = $tow['opening'];
        
        
        $gff = "SELECT * FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$date' ORDER BY id DESC LIMIT 1";
        $ggff = mysqli_query($connect, $gff);
        $towf = mysqli_fetch_array($ggff);
        $bstockf = $towf['balancee'];
        
        $gffz = "SELECT SUM(kg) FROM finalsales WHERE branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
        $ggffz = mysqli_query($connect, $gffz);
        $towfz = mysqli_fetch_array($ggffz);
        $soldk = $towfz['SUM(kg)'];
        
        $gffza = "SELECT SUM(kg) FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id DESC LIMIT 1";
        $ggffza = mysqli_query($connect, $gffza);
        $towfza = mysqli_fetch_array($ggffza);
        $soldka = $towfza['SUM(kg)'];
        
        $gffa = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND category = 'Switchcontroler' AND datee = '$date' ORDER BY timee DESC LIMIT 1";
        $ggffa = mysqli_query($connect, $gffa);
        $towfa = mysqli_fetch_array($ggffa);
        $bop = $towfa['opening'];
        
         $did = "SELECT * FROM switchLog WHERE datee = '$date' AND branch = '$branchCode' ";

                $it = mysqli_query($connect, $did);
                $happen = mysqli_num_rows($it);

                if ($happen > 0) {

        
                    if ($happen < 2) {
                        $gffx = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id ASC LIMIT 1";
                        $ggffx = mysqli_query($connect, $gffx);
                        $towfx = mysqli_fetch_array($ggffx);
                        $openingfx = $towfx['opening'];
                    }else{
                        $gffx = "SELECT * FROM finalsales WHERE tankUse = 'Tank B' AND branch = '$branchCode' AND datee = '$date' AND category = 'Switchcontroler' ORDER BY timee DESC LIMIT 1";
                        $ggffx = mysqli_query($connect, $gffx);
                        $towfx = mysqli_fetch_array($ggffx);
                        $openingfx = $towfx['opening'];
                    }

                }else{

                   $gffx = "SELECT * FROM finalsales WHERE tankUse = '$tank' AND branch = '$branchCode' AND datee = '$date' AND category != 'Switchcontroler' ORDER BY id ASC LIMIT 1";
        $ggffx = mysqli_query($connect, $gffx);
        $towfx = mysqli_fetch_array($ggffx);
        $openingfx = $towfx['opening'];
                }

        
        $sc = "SELECT * FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' AND category != 'Switchcontroler' ";
        $ss = mysqli_query($connect, $sc);
        $fcc = mysqli_num_rows($ss);
        
        $loadno = "SELECT * FROM stockHistory WHERE Bcode = '$branchCode' ORDER BY id DESC LIMIT 1";
        $loadup = mysqli_query($connect, $loadno);
        $las = mysqli_fetch_array($loadup);
        $nowtank = $las['loadNumber'];
        
        
        echo "
        
        <h6 class='text-danger' align='center'><b>Previous Tank: ".$tank." | Opening Stock : ".$openingfx." Kg | Balance Stock : ".$bstock." Kg </b></h6>
        
        
        ";
        echo "
        
        <h6 class='text-info' align='center'><b>Load No: ".$nowtank." | Current Tank: ".$tUse." | Opening Stock : ".$bop." Kg | Balance Stock : ".$bstockf." Kg | Sold : ".$soldk." Kg | Sales Count : ".number_format($fcc)."</b></h6>
        
        
        ";
    }
}else{
    
    $gt = "SELECT * FROM gasStations WHERE BtankUse = '$tank'";
    $gg = mysqli_query($connect, $gt);
    $gow = mysqli_fetch_array($gg);
    $tUse = $gow['BtankUse'];
    
    if(isset($_POST['val'])){
        $date = $ddaattee;
    }else{
        $date = $date;
    }
    
    $gf = "SELECT * FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$date' ORDER BY id DESC LIMIT 1";
    
    $ggf = mysqli_query($connect, $gf);
    $tow = mysqli_fetch_array($ggf);
    $bstock = $tow['balancee'];
    
    $gffz = "SELECT SUM(kg) FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$date' ORDER BY id DESC LIMIT 1";
    $ggffz = mysqli_query($connect, $gffz);
    $towfz = mysqli_fetch_array($ggffz);
    $soldk = $towfz['SUM(kg)'];
    
    $ku = "SELECT * FROM finalsales WHERE tankUse = '$tUse' AND branch = '$branchCode' AND datee = '$date' ORDER BY id ASC LIMIT 1";
    $uu = mysqli_query($connect, $ku);
    $samp = mysqli_fetch_array($uu);
    $opening = $samp['opening'];
    
    $sc = "SELECT * FROM finalsales WHERE datee = '$date' AND branch = '$branchCode' AND category != 'Switchcontroler' ";
    $ss = mysqli_query($connect, $sc);
    $fcc = mysqli_num_rows($ss);
    
    
    $loadno = "SELECT * FROM stockHistory WHERE Bcode = '$branchCode' ORDER BY id DESC LIMIT 1";
    $loadup = mysqli_query($connect, $loadno);
    $las = mysqli_fetch_array($loadup);
    $nowtank = $las['loadNumber'];
    
    echo "
    
    <h6 class='text-info' align='center'><b>Load No: ".$nowtank." | Current Tank: ".$tUse." | Opening Stock : ".$opening." Kg | Balance Stock : ".$bstock." Kg | Sold : ".$soldk." Kg | Sales Count : ".number_format($fcc)."</b></h6>
    
    
    ";
    
    
    
}


?>