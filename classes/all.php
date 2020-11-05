<?php
    
    error_reporting (E_ALL ^ E_NOTICE);
    
  $connect = mysqli_connect('localhost', 'root', 'aicogas', 'solex');
    
    // if(!$connect){
    
    // }else{
    //     echo "we connected";
    // }
    
    class All{
        private $connect ;
        
        public function __construct($connect){
            $this->con = $connect ;
        }
        
        //create a new company
        public function createCompany($name, $comCode){
            $sql = "INSERT INTO company (CompanyName, CompanyCode) VALUES ('$name', '$comCode')";
            $run = mysqli_query($this->con , $sql);
            
            if($run){
                $message = "Company profile created succesfully.";
                header("Location: adminPage.php?msg=true&type=error&details=". urlencode($message) );
            }else{
                $message = "We could not create company profile, pleae try again.";
                header("Location: adminPage.php?msg=true&type=error&details=". urlencode($message) );
            }
        }
        //get company in a dropdown
        public function pullCompany(){

             
            $designation = $_SESSION["designation"];

            if ($designation == 'Supervisor') {
                $company = $_SESSION['CompanyName'];
            $sql = "SELECT * FROM company WHERE CompanyName != 'Almarence' AND companyName = '$company'";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $code = $row['CompanyCode'];
                $name = $row['CompanyName'];
                
                echo "<option value=".$code.">".$name."</option>";
            }
            }else{

            $sql = "SELECT * FROM company WHERE CompanyName != 'Almarence'";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $code = $row['CompanyCode'];
                $name = $row['CompanyName'];
                
                echo "<option value=".$code.">".$name."</option>";
            }
            }

        }
        
        //company, branch, code dropdown
        public function getCompanyBranchCode(){

            $designation = $_SESSION["designation"];

            if ($designation == 'Supervisor') {
                $company = $_SESSION['CompanyName'];
            $sql = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM company, gasStations WHERE company.CompanyCode = gasStations.company AND CompanyName != 'Almarence' AND company.CompanyName = '$company'";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $com = $row['CompanyName'];
                $code = $row['Bcode'];
                $name = $row['Bname'];
                
                
                if(isset($_POST['bcode']) && $_POST['bcode'] == $code) {
                    echo "<option selected='selected' value=".$code.">".$com." : ".$name."</option>";
                }else {
                    echo "<option value=".$code.">".$com." : ".$name."</option>";
                }
            }
            }else{
                $company = $_SESSION['CompanyName'];
            $sql = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM company, gasStations WHERE company.CompanyCode = gasStations.company AND CompanyName != 'Almarence'";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $com = $row['CompanyName'];
                $code = $row['Bcode'];
                $name = $row['Bname'];
                
                if(isset($_POST['bcode']) && $_POST['bcode'] == $code) {
                    echo "<option selected='selected' value=".$code.">".$com." : ".$name."</option>";
                }else {
                    echo "<option value=".$code.">".$com." : ".$name."</option>";
                }
               
            }
            }

            
        }


        public function getCompanyBranchCodeS(){

            $designation = $_SESSION["designation"];

            if ($designation == 'Supervisor') {
                $company = $_SESSION['CompanyName'];
            $sql = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM company, gasStations WHERE company.CompanyCode = gasStations.company AND CompanyName != 'Almarence' AND company.CompanyName = '$company'";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $com = $row['CompanyName'];
                $code = $row['Bcode'];
                $name = $row['Bname'];
                
                
                if(isset($_POST['bcode']) && $_POST['bcode'] == $code) {
                    echo "<option selected='selected' value=".$code.">".$com." : ".$name."</option>";
                }else {
                    echo "<option value=".$code.">".$com." : ".$name."</option>";
                }
            }
            }else{
                $company = $_SESSION['CompanyName'];
            $sql = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM company, gasStations WHERE company.CompanyCode = gasStations.company AND CompanyName != 'Almarence'";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $com = $row['CompanyName'];
                $code = $row['Bcode'];
                $name = $row['Bname'];
                
                if(isset($_POST['bcode']) && $_POST['bcode'] == $code) {
                    echo "<option selected='selected' value=".$code.">".$com." : ".$name."</option>";
                }else {
                    echo "<option value=".$code.">".$com." : ".$name."</option>";
                }
               
            }
            }

            
        }


        public function getCompanyBranchCodeR(){

            $designation = $_SESSION["designation"];

            if ($designation == 'Supervisor') {
                $company = $_SESSION['CompanyName'];
            $sql = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM company, gasStations WHERE company.CompanyCode = gasStations.company AND CompanyName != 'Almarence' AND company.CompanyName = '$company'";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $com = $row['CompanyName'];
                $code = $row['Bcode'];
                $name = $row['Bname'];
                
                
                if(isset($_POST['bcode']) && $_POST['bcode'] == $code) {
                    echo "<option selected='selected' value=".$code.">".$com." : ".$name."</option>";
                }else {
                    echo " <input onclick='ff()' name='branch' type='radio' value=".$code.">
                    <label class='label' for=".$name.">".$name."</label><br> ";
                }
            }
            }else{
                $company = $_SESSION['CompanyName'];
            $sql = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM company, gasStations WHERE company.CompanyCode = gasStations.company AND CompanyName != 'Almarence'";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $com = $row['CompanyName'];
                $code = $row['Bcode'];
                $name = $row['Bname'];
                
                if(isset($_POST['bcode']) && $_POST['bcode'] == $code) {
                    echo "<option selected='selected' value=".$code.">".$com." : ".$name."</option>";
                }else {
                    echo " <input onclick='ff()' name='branch' type='radio' value=".$code.">
                    <label class='label' for=".$name.">".$name."</label><br> ";
                }
               
            }
            }

            
        }





        //create a new gas stattion
        public function createGasStation($company, $bname, $bcode, $loadNumber, $baddress, $loadType, $destination,  $btankA, $btankB, $total, $bpurchasePrice, $btankUse, $date){
            
            $sql = "INSERT INTO gasStations (datee,Bname, Bcode, Baddress, BtankA, BtankB, totalKg,  BpurchasePrice, BtankUse, company)
            VALUES ('$date','$bname', '$bcode', '$baddress', '$btankA', '$btankB', '$total', '$bpurchasePrice', '$btankUse', '$company')";
            
            $run = mysqli_query($this->con , $sql);
            
            if($run){
                
                $sql2 = "INSERT INTO stockHistory (datee,Bcode, loadNumber, totalLoad, offloadType, tank, tankA, tankB, supplyCost)
                VALUES ('$date','$bcode', '$loadNumber', '$total', '$loadType', '$destination', '$btankA', '$btankB', '$bpurchasePrice')";
                $run2 = mysqli_query($this->con , $sql2);
                
                if($run2){
                    $message = "Gas station setup successful.";
                    header("Location: adminPage.php?msg=true&type=error&details=". urlencode($message) );
                }
            }else{
                $message = "Trouble creating gas station, try again.";
                header("Location: adminPage.php?msg=true&type=error&details=". urlencode($message) );
            }
        }
        //show all branches with their codes and address
        public function showAllBranchesAndCodes(){
            $sql = "SELECT Bname, Bcode, Baddress FROM gasStations";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $name = $row['Bname'];
                $code = $row['Bcode'];
                $address = $row['Baddress'];
                
                echo "<tr>";
                echo "<th scope='row'>".$name."</th>";
                echo "<th scope='row'>".$code."</th>";
                echo "<th scope='row'>".$address."</th>";
                echo "</tr>";
                
            }
            
        }
        //populate select tag with branch codes
        public function branchCodeSelect(){
            $sql = "SELECT Bcode FROM gasStations";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $code = $row['Bcode'];
                
                
                echo "<option value=".$code.">".$code."</option>";
            }
        }
        //populate select tag with branch codes and branch name
        public function branchCodeSelectWithName(){
            $sql = "SELECT Bname, Bcode FROM gasStations";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $code = $row['Bcode'];
                $name = $row['Bname'];
                
                
                echo "<option value=".$code.">".$code." - ".$name."</option>";
            }
        }
        //populate select tag with all information needed to swtich tank
        public function allInforForSwitch(){
            $sql = "SELECT gasStations.Bname, gasStations.Bcode, gasStations.BtankA, gasStations.BtankB, gasStations.totalKg, gasStations.BtankUse, company.CompanyName FROM gasStations, company WHERE gasStations.company = company.CompanyCode AND CompanyName != 'Almarence'";
            $getResult = mysqli_query($this->con , $sql);

           
            
            
            echo "<div class='col-lg-12 form-group'>";
            echo "<select class='form-control' name='bcode' id='data'>";
            echo '<option>Select Branch</option>';
            while($row = mysqli_fetch_array($getResult)){
                $name = $row['Bname'];
                $code = $row['Bcode'];
                $tankA = $row['BtankA'];
                $tankB = $row['BtankB'];
                $kg = $tankA + $tankB;
                $inUse = $row['BtankUse'];
                $company = $row['CompanyName'];
                
                echo "<option value=".$code.">".$company." - ".$name." : Tank A:  ".number_format($tankA)." Kg : Tank B: ".number_format($tankB)." Kg : Total: ".number_format($kg)." - In Use: ".$inUse."</option>";
                
            }
            
            echo "</select>";
            echo "</div>";
            
            
           
                echo  "<div class='col-lg-12 form-group'>";
            
                echo "<select class='form-control' name='tanks' id='switch'>";
                
                echo "<option value='Tank B' disabled>Switch From <b>Tank A to Tank B</b></option>";
                
                echo "<option value='Tank A'>Switch From <b>Tank B to Tank A</b></option>";
                
                echo "</select>";
                echo "</div>";
            
            
        }
        //add price to database
        public function addPrice($company,$code, $category, $cylinder, $priceperkg, $am){
            $sql = "INSERT INTO price (company, Bcode, Category, cylinderSize, pricePerKg, price)
            VALUES ('$company','$code', '$category', '$cylinder', '$priceperkg', '$am')";
            
            $result = mysqli_query($this->con , $sql);
            
            if($result){
                $message = "Price addedd successfully";
                header("Location: addnewprice.php?msg=true&type=error&details=". urlencode($message) );
            }else{
                $message = "Error adding price, try again";
                header("Location: addnewprice.php?msg=true&type=error&details=". urlencode($message) );
            }
        }
        
        //pull price list for specific locations
        public function getPriceByLocation($code){
            $gname = "SELECT Bname FROM gasStations WHERE Bcode ='$code' ";
            $goname = mysqli_query($this->con, $gname);
            $row = mysqli_fetch_array($goname);
            $name = $row['Bname'];
            $prrr = "SELECT DISTINCT price.Category, price.pricePerKg FROM price WHERE Bcode = '$code' ";
            $runpz = mysqli_query($this->con, $prrr);
            if(mysqli_num_rows($runpz) > 0){
                while($ran = mysqli_fetch_array($runpz)){
                    $cat = $ran['Category'];
                    $pr = $ran['pricePerKg'];
                    echo "<tr>";
                    echo "<td>".$cat."<br> @ ".$pr."<br><b class='text-danger'>".$name."</b></td>";
                    
                    $sql = "SELECT price.price, price.cylinderSize FROM price WHERE Category = '".$cat."' AND Bcode = '$code' AND cylinderSize != 'Others'";
                    $runThis = mysqli_query($this->con , $sql);
                    
                    if(mysqli_num_rows($runThis) > 0){
                        echo "<td>";
                        while($row = mysqli_fetch_array($runThis)){
                            
                            $amo = $row['price'];
                            $size = $row['cylinderSize'];
                            
                            if ($size == "Others") {
                              
                            }else{
                                echo "<h6>".$size."Kg - ".number_format($amo)." NGN</h6>";
                            }
                            
                            
                            
                        }
                        echo "</td>";
                    }
                    
                    echo "<td  scope='row'>
                    
                    <form action='delCat.php' method='POST'>
                    <input type='text' name='catta' value='".$cat."' style='visibility:hidden'><br>
                    <button class='btn btn-danger' name='catDelete' type='submit' value='".$code."'>Delete Category</button>
                    
                    </form>
                    
                    </td>";
                    echo "<tr>";
                }
            }

           
            
            
            
        }
        //show price list of all locations
        public function priceForAll(){
            
            $sql = "SELECT * FROM price";
            $runThis = mysqli_query($this->con , $sql);
            
            
            
            while($row = mysqli_fetch_array($runThis)){
                
                $code = $row['Bcode'];
                $category = $row['Category'];
                $pricekg = $row['PricePerKg'];
                $three = $row['ThreeKg'];
                $five = $row['FiveKg'];
                $six = $row['SixKg'];
                $ten = $row['TenKg'];
                $twelvefive = $row['TwelveFiveKg'];
                $fifteen = $row['FifteenKg'];
                $twentyfive = $row['TwentyFiveKg'];
                $fifty = $row['FiftyKg'];
                
                
                echo "<tr>";
                echo "<th scope='row'>".$code."</th>";
                echo "<th scope='row'>".$category."</th>";
                echo "<th scope='row'>".$pricekg."</th>";
                echo "<th scope='row'>".$three."</th>";
                echo "<th scope='row'>".$five."</th>";
                echo "<th scope='row'>".$six."</th>";
                echo "<th scope='row'>".$ten."</th>";
                echo "<th scope='row'>".$twelvefive."</th>";
                echo "<th scope='row'>".$fifteen."</th>";
                echo "<th scope='row'>".$twelvefive."</th>";
                echo "<th scope='row'>".$fifty."</th>";
                echo "</tr>";
                
            }
        }
        //show tank details
        public function showTankDets($code){
            $get = "SELECT Bname, BtankA, BtankB, totalKg, BtankUse FROM gasStations Where Bcode = '$code' ";
            $run = mysqli_query($this->con , $get);
            
            while($row = mysqli_fetch_array($run)){
                $name = $row['Bname'];
                $tankA = $row['BtankA'];
                $tankB = $row['BtankB'];
                $total = $row['totalKg'];
                $tankUse = $row['BtankUse'];
                
                echo "<tr>";
                echo "<th scope='row'>".$name."</th>";
                echo "<th scope='row'>".$tankA." Kg</th>";
                echo "<th scope='row'>".$tankB." Kg</th>";
                echo "<th scope='row'>".$total." Kg</th>";
                echo "<th scope='row'>".$tankUse."</th>";
                echo "</tr>";
            }
            
            
        }
        //switch tank in use
        public function switchTanks($code, $value){
            

           
            date_default_timezone_set("Africa/Lagos");
            $time = date("h:i:s a");
            $date = date('Y-m-d', strtotime('now'));
            $sww = "Switchcontroler";
            
            $sql = "UPDATE gasStations SET BtankUse = '$value' WHERE Bcode = '$code' ";
            $do = mysqli_query($this->con , $sql);

            if ($value == 'Tank B') {
                 $sqla = "SELECT * FROM gasStations WHERE BtankUse = '$value' AND Bcode = '$code' ";
            $doa = mysqli_query($this->con, $sqla);
            $fld = mysqli_fetch_array($doa);
            $sis = $fld['BtankB'];
          
            }elseif ($value == 'Tank A') {
                $sqla = "SELECT * FROM gasStations WHERE BtankUse = '$value' AND Bcode = '$code' ";
            $doa = mysqli_query($this->con, $sqla);
            $fld = mysqli_fetch_array($doa);
            $sis = $fld['BtankA'];
      
            }

            $good = "SELECT * FROM finalsales WHERE branch = '$code' ORDER BY id DESC LIMIT 1";
            $goo = mysqli_query($this->con, $good);
            if ($goo) {
                while ($ra = mysqli_fetch_array($goo)) {
                    $closing = $ra['closing'];
                    $tanko = $ra['tankUse'];

                    $did = "SELECT * FROM switchLog WHERE datee = '$date' AND branch = '$code' ";
                    $it = mysqli_query($this->con, $did);
                    $happen = mysqli_num_rows($it);

                    if ($happen > 0) {
                        $track = "SELECT * FROM finalsales WHERE datee = '$date' AND category = 'Switchcontroler' ORDER BY timee DESC LIMIT 1 ";
                    $speed = mysqli_query($this->con, $track);
                    $croks = mysqli_fetch_array($speed);
                    $timex = $croks['timee'];

                         $grade = "SELECT SUM(amount), SUM(Kg), SUM(finalTotal) FROM finalsales WHERE datee = '$date' AND tankUse = '$tanko' AND branch = '$code' AND category != 'Switchcontroler' AND timee > '$timex' ORDER BY timee ASC ";
                        $raid = mysqli_query($this->con, $grade);
                        while ($rat = mysqli_fetch_array($raid)) {
                            $prAm = $rat['SUM(amount)'];
                            $prKg = $rat['SUM(Kg)'];
                            $prFt = $rat['SUM(finalTotal)'];
                        }
                    }else{
                             $grade = "SELECT SUM(amount), SUM(Kg), SUM(finalTotal) FROM finalsales WHERE  datee = '$date' AND tankUse = '$tanko' AND branch = '$code' AND category != 'Switchcontroler'  ORDER BY id ASC ";
                        $raid = mysqli_query($this->con, $grade);
                        while ($rat = mysqli_fetch_array($raid)) {
                            $prAm = $rat['SUM(amount)'];
                            $prKg = $rat['SUM(Kg)'];
                            $prFt = $rat['SUM(finalTotal)'];
                        }
                    }

                    
                }
            }

            $logSwitch = "INSERT INTO switchLog (datee, timee, branch, actionn) VALUES ('$date','$time', '$code', '$value')";
            $doLog = mysqli_query($this->con , $logSwitch);

           
            //send blank data to finalsales table to mark switch time
            $populatefinal = "INSERT INTO finalsales (branch, reciept, datee, timee, customer,category, phone, payment, cash, kg, quantity, amount, salesStatus, changee,changeD, finalTotal, tankUse, opening, balancee, closing)
            VALUES('$code', '0', '$date', '$time', '0', '$sww', '0', '0','0','$prKg','0','$prAm','0','0','0','$prFt','$tanko','$sis','0','$closing')";
            $gopopo = mysqli_query($this->con , $populatefinal);
        
            if($gopopo){
                header("Location: salesanalysis.php");
            }else{
                echo "We has some trouble switching the tanks, please try again.";
            }
        }
        //pull stock history by location
        public function stockHistory($code){
            $get = "SELECT * FROM stockHistory WHERE Bcode = '$code' ";
            $goNow = mysqli_query($this->con , $get);
            
            while ($row = mysqli_fetch_assoc($goNow)) {
                $date = $row['datee'];
                $load = $row['loadNumber'];
                $totalLoad = $row['totalLoad'];
                $offloadType = $row['offloadType'];
                $offTank = $row['tank'];
                $tankA = $row['tankA'];
                $tankB = $row['tankB'];
                $cost = $row['supplyCost'];
                
                echo "<tr>";
                echo "<th scope='row'>".$date."</th>";
                echo "<th scope='row' class='text-success'>".$load."</th>";
                echo "<th scope='row'>".number_format($totalLoad)." Kg</th>";
                echo "<th scope='row'>".$offloadType."</th>";
                echo "<th scope='row'>".$offTank."</th>";
                echo "<th scope='row'>".number_format($tankA)." Kg</th>";
                echo "<th scope='row'>".number_format($tankB)." Kg</th>";
                echo "<th scope='row' class='text-success'>".number_format($cost)."</th>";
                echo "</tr>";
            }
        }
        //populate select tag with branch codes and branch name
        public function branchCodeSelectWithNameTake($code){
            $sql = "SELECT Bname, Bcode FROM gasStations WHERE Bcode = '$code'";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $code = $row['Bcode'];
                $name = $row['Bname'];
                
                
                echo "<b>Branch: " .$code. " - " .$name. "</b>";
            }
        }
        //add stock
        public function updateStock($date, $code, $loadNumber, $totalLoad, $offloadType, $tank, $tankA, $tankB, $cost, $upTankA, $upTankB, $upTotal){
            
            if(empty($totalLoad)){
                $totalLoad = 0;
            }else{
                $totalLoad = $totalLoad;
            }
            
            if(empty($tankA)){
                $tankA = 0;
            }else{
                $tankA = $tankA;
            }
            
            if(empty($tankB)){
                $tankB = 0;
            }else{
                $tankB = $tankB;
            }
            
            if(empty($cost)){
               $cost = 0;
            }else{
               $cost = $cost;
            }
            
            $sql = "INSERT INTO stockHistory (datee, Bcode, loadNumber, totalLoad, offloadType, tank, tankA, tankB, supplyCost)
            VALUES ('$date', '$code', '$loadNumber', '$totalLoad', '$offloadType', '$tank', '$tankA', '$tankB', '$cost')";
            
            $sqlNow = mysqli_query($this->con , $sql);
            
            if($sqlNow){
                $sql2 = "UPDATE gasStations SET BtankA = '$upTankA', BtankB = '$upTankB', totalKg = '$upTotal' WHERE Bcode = '$code' ";
                $sqlNow2 = mysqli_query($this->con , $sql2);
                
                if($sqlNow2){
                    $message = "Stock Added successfully";
                    header("Location: updateStock.php?msg=true&type=error&details=". urlencode($message) );
                }else{
                    $message = "Failed adding stock,, try again";
                    header("Location: updateStock.php?msg=true&type=error&details=". urlencode($message) );
                }
            }else{
                echo "Error at stage one";
            }
        }
        
        //update stock
        public function updateS($date, $code, $loadNumber, $totalLoad, $offloadType, $tank, $tankA, $tankB, $cost, $upTankA, $upTankB, $upTotal){
            
            
            if(empty($totalLoad)){
                $totalLoad = 0;
            }else{
                $totalLoad = $totalLoad;
            }
            
            if(empty($tankA)){
                $tankA = 0;
            }else{
                $tankA = $tankA;
            }
            
            if(empty($tankB)){
                $tankB = 0;
            }else{
                $tankB = $tankB;
            }
            
            if(empty($cost)){
                $cost = 0;
            }else{
                $cost = $cost;
            }
            
            
//            $sql = "INSERT INTO stockHistory (datee, Bcode, loadNumber, totalLoad, offloadType, tank, tankA, tankB, supplyCost) VALUES ('$datee', '$code', '$loadNumber', '$totalLoad', '$offloadType', '$tank', '$tankA', '$tankB', '$cost')";
            
            $sql = "UPDATE stockHistory SET datee = '$date', Bcode = '$code', totalLoad = '$totalLoad', offloadType = '$offloadType',
            tank = '$tank', tankA = '$tankA', tankB = '$tankB', supplyCost = '$cost' WHERE Bcode = '$code' AND loadNumber = '$loadNumber'";
            
            $sqlNow = mysqli_query($this->con , $sql);
            
            if($sqlNow){
                $sql2 = "UPDATE gasStations SET BtankA = '$tankA', BtankB = '$tankB', totalKg = '$upTotal' WHERE Bcode = '$code' ";
                $sqlNow2 = mysqli_query($this->con , $sql2);
                
                if($sqlNow2){
                    
                    $message = "Stock Updated successfully";
                    header("Location: updateS.php?msg=true&type=error&details=". urlencode($message) );
                }else{
                    $message = "Error updating stock records";
                    header("Location: updateS.php?msg=true&type=error&details=". urlencode($message) );
                }
            }else{
                echo "Error at stage here";
            }
        }
        //register new customer
        public function newCustomer($date, $cid, $branch, $name, $phone, $change, $changeStats, $purchase, $ratings){
            
            $ramp = "SELECT * FROM customers WHERE Cphone = '$phone' ";
            $rap = mysqli_query($this->con, $ramp);
            if(mysqli_num_rows($rap) > 0){
                while($row = mysqli_fetch_array($rap)){
                    $thebranchcode = $row['branch'];
                    
                }

            }
    
            $branchname = "SELECT * FROM gasStations WHERE Bcode = '$thebranchcode' ";
            $branchq = mysqli_query($this->con, $branchname);
            if(mysqli_num_rows($branchq) > 0){
                while($row = mysqli_fetch_array($branchq)){
                    $thebranch = $row['Bname'];
                    
                }

            }
           
            if(mysqli_num_rows($rap) > 0){
                $str = "is already registered at";
                $message = $name.' '.$str.' '.$thebranch;
                header("Location: crbHome.php?msg=true&type=error&details=". urlencode($message) );
            }else{
                
                $sql = "INSERT INTO customers (datee, Cid, branch, Cname, Cphone, Cchange, CchangeStats, CpurchaseCount, Cratings)
                VALUES ('$date','$cid', '$branch', '$name', '$phone', '$change', '$changeStats', '$purchase', '$ratings')";
                
                $go = mysqli_query($this->con , $sql);
                
                if($go){
                    $message = $name."'s profile created succesfully.";
                    header("Location: crbHome.php?msg=true&type=error&details=". urlencode($message) );
                }else{
                    $message = "We could not create a profile for ".$name."'s try again.";
                    header("Location: crbHome.php?msg=true&type=error&details=". urlencode($message) );
                }
                
            }
            
           
        }
        //search customer
        public function getCustomer($phone){
            $sql = "SELECT * FROM customers WHERE Cphone = '$phone' ";
            $gogo = mysqli_query($this->con , $sql);
            
            if(mysqli_num_rows($gogo)>0){
                while($row = mysqli_fetch_array($gogo)){
                    $cid = $row['Cid'];
                    $name = $row['Cname'];
                    $phone = $row['Cphone'];
                    $change = $row['Cchange'];
                    $purchase = $row['CpurchaseCount'];
                    
                    
                    
                    $customer = [];
                    $customer['name'] = $name;
                    $customer['phone'] = $phone;
                    $customer['change'] = $change;
                    $customer['purchase'] = $purchase;
                    
                }
            }else{
                $customer = [];
                $customer['name'] = "Not Found";
                $customer['phone'] = "Not Found";
                $customer['change'] = "Not Found";
                $customer['purchase'] = "Not Found";
                
                
            }
            return $customer;
            
        }
        //pull all sales categories
        public function getCategories(){
            $sql = "SELECT DISTINCT Category FROM price";
            $run = mysqli_query($this->con , $sql);
            
            while ($row = mysqli_fetch_assoc($run)) {
                echo "<option>".$row['Category']."</option> ";
            }
        }
        //create staff profile
        public function createStaff($username, $phone, $company, $branch, $designation, $password){
            $sql = "INSERT INTO staffs (username, phone, company, Branch, designation, password) VALUES
            ('$username', '$phone', '$company', '$branch', '$designation', '$password')";
            $query = mysqli_query($this->con , $sql);
            
            if($query){
                $message = "Staff Created successfully";
                header("Location: staffs.php?msg=true&type=error&details=". urlencode($message) );
            }else{
                $message = "We were unable to create staff, try again.";
                header("Location: staffs.php?msg=true&type=error&details=". urlencode($message) );
            }
        }
        //pull all staff records
        public function getStaffRecords(){

             
            $designation = $_SESSION["designation"];

            if ($designation == 'Supervisor') {
               $companyCode = $_SESSION['CompanyCode'];
            $sql = "SELECT staffs.id, staffs.username,staffs.phone,staffs.Branch,company.CompanyName, gasStations.Bname,staffs.designation,staffs.password, gasStations.company FROM staffs, company, gasStations
            WHERE staffs.company = company.CompanyCode AND gasStations.company = company.CompanyCode AND staffs.Branch = gasStations.Bcode AND staffs.designation != 'Admin' AND gasStations.company = '$companyCode' ";
            $run = mysqli_query($this->con , $sql);
            
            while ($row = mysqli_fetch_array($run)) {
                $id = $row['id'];
                $username = $row['username'];
                $phone = $row['phone'];
                $branch = $row['Branch'];
                $company = $row['CompanyName'];
                $bname = $row['Bname'];
                $designation = $row['designation'];
                $password = $row['password'];
                
                
                echo "<tr>";
                echo "<th scope='row'>".$id."</th>";
                echo "<th scope='row'>".$username." </th>";
                echo "<th scope='row'>".$phone."</th>";
                echo "<th scope='row'>".$company."</th>";
                echo "<th scope='row'>".$branch."</th>";
                echo "<th scope='row'>".$bname."</th>";
                echo "<th scope='row'>".$designation."</th>";
                echo "<th scope='row'>".$password."</th>";
                echo "<th scope='row'>
                <form action='deleteStaff.php' method='POST'>
                    <button class='btn btn-danger' value='".$username."' type='submit' name='staff'>Delete</button>
                </form>
                </th>";
                echo "</tr>";
            }
            }else{
                $company = $_SESSION['CompanyName'];
            $sql = "SELECT staffs.id, staffs.username,staffs.phone,staffs.Branch,company.CompanyName, gasStations.Bname,staffs.designation,staffs.password FROM staffs, company, gasStations
            WHERE staffs.company = company.CompanyCode AND gasStations.company = company.CompanyCode AND staffs.Branch = gasStations.Bcode AND staffs.designation != 'Admin' ";
            $run = mysqli_query($this->con , $sql);
            
            while ($row = mysqli_fetch_array($run)) {
                $id = $row['id'];
                $username = $row['username'];
                $phone = $row['phone'];
                $branch = $row['Branch'];
                $company = $row['CompanyName'];
                $bname = $row['Bname'];
                $designation = $row['designation'];
                $password = $row['password'];
                
                
                echo "<tr>";
                echo "<th scope='row'>".$id."</th>";
                echo "<th scope='row'>".$username." </th>";
                echo "<th scope='row'>".$phone."</th>";
                echo "<th scope='row'>".$company."</th>";
                echo "<th scope='row'>".$branch."</th>";
                echo "<th scope='row'>".$bname."</th>";
                echo "<th scope='row'>".$designation."</th>";
                echo "<th scope='row'>".$password."</th>";
                echo "<th scope='row'>
                <form action='deleteStaff.php' method='POST'>
                    <button class='btn btn-danger' value='".$username."' type='submit' name='staff'>Delete</button>
                </form>
                </th>";
                echo "</tr>";
            }
            }
        }
        //login activities
        public function loginAll($phone, $password){
            $sql = "SELECT staffs.id, staffs.username, staffs.phone, staffs.designation, staffs.password, gasStations.Bname, gasStations.Bcode, company.CompanyName, company.CompanyCode FROM
            staffs, gasStations, company WHERE phone = '$phone' AND password = '$password' AND staffs.company && gasStations.company = company.CompanyCode AND staffs.branch = gasStations.Bcode ";
            $run  = mysqli_query($this->con , $sql);
            
            if (mysqli_num_rows($run) > 0){
                
                while($row = mysqli_fetch_assoc($run))
                {
                    $id = $row["id"];
                    $username = $row["username"];
                    $phone = $row["phone"];
                    $designation = $row['designation'];
                    $branch = $row['Bname'];
                    $companyCode = $row['CompanyCode'];
                    $company = $row['CompanyName'];
                    $branchCode = $row['Bcode'];
                    if($designation == "Supervisor"){
                        session_start();
                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $username;
                        $_SESSION["Bname"] = $branch;
                        $_SESSION["designation"] = $designation;
                        $_SESSION['phone'] = $phone;
                        $_SESSION['CompanyCode'] = $companyCode; 
                        $_SESSION['CompanyName'] = $company;
                        header ("Location: superV.php");
                    }elseif($designation == "CRB Attendant"){
                        session_start();
                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $username;
                        $_SESSION["Bname"] = $branch;
                        $_SESSION["designation"] = $designation;
                        $_SESSION['phone'] = $phone;
                        $_SESSION['CompanyName'] = $company;
                        $_SESSION['Bcode'] = $branchCode;
                        
                        header ("Location: crbHome.php");
                    }elseif($designation == "Cash Point Attendant"){
                        session_start();
                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $username;
                        $_SESSION["Bname"] = $branch;
                        $_SESSION["designation"] = $designation;
                        $_SESSION['phone'] = $phone;
                        $_SESSION['CompanyName'] = $company;
                        $_SESSION['Bcode'] = $branchCode;
                        header ("Location: salespoint.php");
                    }elseif($designation == "Gifts Issuer"){
                        session_start();
                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $username;
                        $_SESSION["Bname"] = $branch;
                        $_SESSION["designation"] = $designation;
                        $_SESSION['phone'] = $phone;
                        $_SESSION['CompanyName'] = $company;
                        header ("Location: gifts.php");
                    }elseif($designation == "Admin"){
                        session_start();
                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $username;
                        $_SESSION["Bname"] = $branch;
                        $_SESSION["designation"] = $designation;
                        $_SESSION['phone'] = $phone;
                        $_SESSION['CompanyName'] = $company;
                        header ("Location: adminPage.php");
                    }
                }
            }else{
                $message = "Incorrect username or password, please try again";
                header("Location: portal.php?msg=true&type=error&details=". urlencode($message) );
            }
        }
        //create new crb
        public function newCRB($crb, $date, $time, $branch, $name, $phone, $cat, $kg, $quant, $tq, $amount, $k, $q, $t, $a, $b){
            
            $fet = "SELECT crbnumber FROM crbstep WHERE datee = '$date' AND branch = '$branch' AND crbnumber = '$crb' ";
            $grt = mysqli_query($this->con, $fet);
            if(mysqli_num_rows($grt) > 0){
                
             
                    $message = "Crb already exisits, please proceed to sent to cash point";
                    header("Location: crbHome.php?msg=true&type=error&details=". urlencode($message) );
               
            }else{
                
                if (empty($phone)) {
                    $phone = "No phone";
                }else{
                    $phone = $phone;
                }
                
                
                if (empty($name)) {
                    $name = "No name";
                }else{
                    $name = $name;
                }
                
                //first check the size of the array
                if(sizeof($kg != $quant && $amount)){
                    
                    // next, filter the array to remove empty entries
                    $q = array_filter($quant);
                    $a = array_filter($amount);
                    $t = array_filter($tq);
                    
                    //lastly, reindex the array to start from zero.
                    $qq = array_values($q);
                    $aa = array_values($a);
                    $tt = array_values($t);


                    
                    foreach($kg as $key => $value){

                         if ($qq[$key] == 0) {
                        
                    }else{

                        $sql = "INSERT INTO crbstep (crbnumber, datee, timee, branch, customer, phone, category, kg, quantity, tquant, amount, amount2)VALUES
                        ('$crb', '$date', '$time', '$branch', '$name', '$phone', '$cat', '$value', '$qq[$key]', '$tt[$key]', '$aa[$key]', '$aa[$key]')";
                        
                        
                        
                        $load = mysqli_query($this->con , $sql);
                        
                        
                        header("Location: crbHome.php");
                        
                    }
                        
                          
                    }
                    
                }else{
                    
                    foreach($kg as $key => $value){

                        if ($quant[$key] == 0) {
                            # code...
                        }else{

                             $sql = "INSERT INTO crbstep (crbnumber, datee, timee, branch, customer, phone, category, kg, quantity, tquant, amount, amount2)VALUES
                        ('$crb', '$date', '$time', '$branch', '$name', '$phone', '$cat', '$value', '$quant[$key]', '$tt[$key]', '$amount[$key]', '$aa[$key]')";
                        
                        
                        
                        $load = mysqli_query($this->con , $sql);
                        
                        if($load){
                            echo "all done";
                        }else{
                            echo "Error doing this";
                        }
                        
                        header("Location: crbHome.php");

                        }
                        
                       
                        
                    }
                    
                    
                }
                
                
            }
            
            
            
            
        }

        //create new crb offline
        public function newCRBB($crb, $date, $time, $branch, $name, $phone, $cat, $kg, $quant, $tq, $amount, $k, $q, $t, $a, $b){
            
            $fet = "SELECT crbnumber FROM crbstep WHERE datee = '$date' AND branch = '$branch' AND crbnumber = '$crb' ";
            $grt = mysqli_query($this->con, $fet);
            if(mysqli_num_rows($grt) > 0){
                
             
                    $message = "Crb already exisits, please proceed to sent to cash point";
                    header("Location: crbHome.php?msg=true&type=error&details=". urlencode($message) );
               
            }else{
                
                if (empty($phone)) {
                    $phone = "No phone";
                }else{
                    $phone = $phone;
                }
                
                
                if (empty($name)) {
                    $name = "No name";
                }else{
                    $name = $name;
                }
                
                //first check the size of the array
                if(sizeof($kg != $quant && $amount)){
                    
                    // next, filter the array to remove empty entries
                    $q = array_filter($quant);
                    $a = array_filter($amount);
                    $t = array_filter($tq);
                    
                    //lastly, reindex the array to start from zero.
                    $qq = array_values($q);
                    $aa = array_values($a);
                    $tt = array_values($t);


                    
                    foreach($kg as $key => $value){

                         if ($qq[$key] == 0) {
                        
                    }else{

                        $sql = "INSERT INTO crbstep (crbnumber, datee, timee, branch, customer, phone, category, kg, quantity, tquant, amount, amount2)VALUES
                        ('$crb', '$date', '$time', '$branch', '$name', '$phone', '$cat', '$value', '$qq[$key]', '$tt[$key]', '$aa[$key]', '$aa[$key]')";
                        
                        
                        
                        $load = mysqli_query($this->con , $sql);
                        
                        
                        header("Location: crbHome2.php");
                        
                    }
                        
                          
                    }
                    
                }else{
                    
                    foreach($kg as $key => $value){

                        if ($quant[$key] == 0) {
                            # code...
                        }else{

                             $sql = "INSERT INTO crbstep (crbnumber, datee, timee, branch, customer, phone, category, kg, quantity, tquant, amount, amount2)VALUES
                        ('$crb', '$date', '$time', '$branch', '$name', '$phone', '$cat', '$value', '$quant[$key]', '$tt[$key]', '$amount[$key]', '$aa[$key]')";
                        
                        
                        
                        $load = mysqli_query($this->con , $sql);
                        
                        if($load){
                            echo "all done";
                        }else{
                            echo "Error doing this";
                        }
                        
                        header("Location: crbHome2.php");

                        }
                        
                       
                        
                    }
                    
                    
                }
                
                
            }
            
            
            
            
        }
        
        
        //get crb details
        public function getCRB(){
            $branchCode = $_SESSION['Bcode'];
            $crbN = "SELECT crbnumber FROM crbstep WHERE branch = '$branchCode' ORDER BY id DESC LIMIT 1";
            $rogue = mysqli_query($this->con , $crbN);
            
            
            while($ggg = mysqli_fetch_array($rogue)){
                $crbNUn = $ggg['crbnumber'];
            }
            
            $sql = "SELECT * FROM crbstep WHERE branch = '$branchCode' AND crbnumber = '$crbNUn' ";
            $run = mysqli_query($this->con , $sql);
            
            
            while($row = mysqli_fetch_array($run)){
                
                $category = $row['category'];
                $date = $row['datee'];
                $time = $row['timee'];
                $crb = $row['crbnumber'];
                $name = $row['customer'];
                $phone = $row['phone'];
                $kg = $row['kg'];
                $tq = $row['tquant'];
                $quantity = $row['quantity'];
                $amount = $row['amount'];
                
                $check = $tq / $quantity ;
                
                if($check != $kg){
                    echo "<tr class='bg-danger'><td class='text-white' colspan='4'>Kg below is wrong, please cancel this crb</td></tr>";
                    
                    echo "<tr style='border:2px solid #ff0000;'>";
                    echo "<td scope='row' class='text-danger'><h5><b>".$kg." Kg</b></h5></td>";
                    echo "<td scope='row'><h5><b>".$quantity." </b></h5></td>";
                    echo "<td scope='row'><h5><b>".$tq." Kg</b></h5></td>";
                    echo "<td scope='row'><h5><b>".number_format($amount)."</b></td>";
                    
                    echo "</tr>";
                    
                }else{
                    
                    echo "<tr style='border:2px solid #000;'>";
                    echo "<td scope='row'><h5><b>".$kg." Kg</b></h5></td>";
                    echo "<td scope='row'><h5><b>".$quantity." </b></h5></td>";
                    echo "<td scope='row'><h5><b>".$tq." Kg</b></h5></td>";
                    echo "<td scope='row'><h5><b>".number_format($amount)."</b></td>";
                    
                    echo "</tr>";
                    
                }
                
                
               
            }
            
            $train = "SELECT SUM(kg), SUM(quantity), SUM(amount), SUM(tquant) FROM crbstep WHERE crbnumber = $crbNUn AND branch = '$branchCode' ";
            $su = mysqli_query($this->con , $train);
            
            if($su){
                
                while($trone = mysqli_fetch_array($su)){
                    $totalKgg = $trone['SUM(kg)'];
                    $totalq = $trone['SUM(quantity)'];
                    $totalam = $trone['SUM(amount)'];
                    $tqq = $trone['SUM(tquant)'];
                }
                
                
            }
            
            
            
            echo "<tr>";
            
            echo "<td scope='row' class=''><h5><b>Total</b><h5></td>";
            echo "<td scope='row' class=''><h5><b> ".$totalq." <b><h5></td>";
            echo "<td scope='row' class=''><h5><b> ".$tqq." Kg<b><h5></td>";
            echo "<td scope='row' class='bg-success text-white'><h5><b> ".number_format($totalam)." NGN<b><h5></td>";
            
            echo "</tr>";
            
            
            if(mysqli_num_rows($run) > 0){
                echo "<h4><b>Order Summary</b></h4>";
                 echo "<hr>";
                 echo "<h1 style='font-size: 35px'><b> CRB #: ".$crb." </b><b><br> ".$date." <br> ".$time."</b></h1>";
                 echo "<hr>";
                echo "<h4><b>Sales category: ".$category."</b></h4>";
                echo "<h4><b>".$name." <br>".$phone."</b></h4>";
                echo "<input type='text' name='dd' value='".$name."' style='visibility:hidden; width:5px'/>";
                 echo "<input type='text' name='phone' value='".$phone."' style='visibility:hidden; width:5px'/>";
                 echo "<input type='text' name='am' value='".$totalam."' style='visibility:hidden; width:5px'/>";
                 echo "<input type='text' name='crb' value='".$crbNUn."' style='visibility:hidden; width:5px'/>";
                // echo "<hr>";
            }
            
            
            
        }

        //get crb details
        public function getCRBB(){
            $branchCode = $_SESSION['Bcode'];
            $crbN = "SELECT crbnumber FROM crbstep WHERE branch = '$branchCode' ORDER BY id DESC LIMIT 1";
            $rogue = mysqli_query($this->con , $crbN);
            
            
            while($ggg = mysqli_fetch_array($rogue)){
                $crbNUn = $ggg['crbnumber'];
            }
            
            $sql = "SELECT * FROM crbstep WHERE branch = '$branchCode' AND crbnumber = '$crbNUn' ";
            $run = mysqli_query($this->con , $sql);
            
            
            while($row = mysqli_fetch_array($run)){
                
                $category = $row['category'];
                $date = $row['datee'];
                $time = $row['timee'];
                $crb = $row['crbnumber'];
                $name = $row['customer'];
                $phone = $row['phone'];
                $kg = $row['kg'];
                $tq = $row['tquant'];
                $quantity = $row['quantity'];
                $amount = $row['amount'];
                
                $check = $tq / $quantity ;
                
                if($check != $kg){
                    echo "<tr class='bg-danger'><td class='text-white' colspan='4'>Kg below is wrong, please cancel this crb</td></tr>";
                    
                    echo "<tr style='border:2px solid #ff0000;'>";
                    echo "<td scope='row' class='text-danger'><h5><b>".$kg." Kg</b></h5></td>";
                    echo "<td scope='row'><h5><b>".$quantity." </b></h5></td>";
                    echo "<td scope='row'><h5><b>".$tq." Kg</b></h5></td>";
                    echo "<td scope='row'><h5><b>".number_format($amount)."</b></td>";
                    
                    echo "</tr>";
                    
                }else{
                    
                    echo "<tr style='border:2px solid #000;'>";
                    echo "<td scope='row'><h5><b>".$kg." Kg</b></h5></td>";
                    echo "<td scope='row'><h5><b>".$quantity." </b></h5></td>";
                    echo "<td scope='row'><h5><b>".$tq." Kg</b></h5></td>";
                    echo "<td scope='row'><h5><b>".number_format($amount)."</b></td>";
                    
                    echo "</tr>";
                    
                }
                
                
               
            }
            
            $train = "SELECT SUM(kg), SUM(quantity), SUM(amount), SUM(tquant) FROM crbstep WHERE crbnumber = $crbNUn AND branch = '$branchCode' ";
            $su = mysqli_query($this->con , $train);
            
            if($su){
                
                while($trone = mysqli_fetch_array($su)){
                    $totalKgg = $trone['SUM(kg)'];
                    $totalq = $trone['SUM(quantity)'];
                    $totalam = $trone['SUM(amount)'];
                    $tqq = $trone['SUM(tquant)'];
                }
                
                
            }
            
            
            
            echo "<tr>";
            
            echo "<td scope='row' class=''><h5><b>Total</b><h5></td>";
            echo "<td scope='row' class=''><h5><b> ".$totalq." <b><h5></td>";
            echo "<td scope='row' class=''><h5><b> ".$tqq." Kg<b><h5></td>";
            echo "<td scope='row' class='bg-success text-white'><h5><b> ".number_format($totalam)." NGN<b><h5></td>";
            
            echo "</tr>";
            
            
            if(mysqli_num_rows($run) > 0){
                echo "<h4><b>Order Summary</b></h4>";
                 echo "<hr>";
                 echo "<h1 style='font-size: 35px'><b> CRB #: ".$crb." </b><b><br> ".$date." <br> ".$time."</b></h1>";
                 echo "<hr>";
                echo "<h4><b>Sales category: ".$category."</b></h4>";
                echo "<h4><b>".$name." <br>".$phone."</b></h4>";
                echo "<input type='text' name='dd' value='".$name."' style='visibility:hidden; width:5px'/>";
                 echo "<input type='text' name='phone' value='".$phone."' style='visibility:hidden; width:5px'/>";
                 echo "<input type='text' name='am' value='".$totalam."' style='visibility:hidden; width:5px'/>";
                 echo "<input type='text' name='crb' value='".$crbNUn."' style='visibility:hidden; width:5px'/>";
                // echo "<hr>";
            }
            
            
            
        }

        // get all customer crbs and display them
        public function getCustomerCrb(){
            $branchCode = $_SESSION['Bcode'];
            $sqlget = "SELECT phone FROM crbs WHERE branch = '$branchCode' ORDER BY id DESC LIMIT 1";
            $getGo = mysqli_query($this->con , $sqlget);
            while($row = mysqli_fetch_array($getGo)){
                $phone = $row['phone'];
            }
            
            $sql = "SELECT crbnumber, datee, timee, totalkg, totalAmount From crbs WHERE phone = '$phone' ORDER BY id DESC LIMIT 10";
            $train = mysqli_query($this->con , $sql);
            
            if(mysqli_num_rows($train) > 0){
                while($gg = mysqli_fetch_array($train)){
                    $crbbb = $gg['crbnumber'];
                    $dateee = $gg['datee'];
                    $timeee = $gg['timee'];
                    $kg = $gg['totalkg'];
                    $amount = $gg['totalAmount'];
                    
                    echo "<small>CRB #: ".$crbbb."</small><br><small class='text-primary'>".$dateee."</small><br><small class='text-success'>".$timeee."</small><br>
                    <small class='text-info'>".$kg."Kg / ".$amount." NGN</small>";
                    echo "<hr>";
                }
            }
        }
        // get purchase count
        public function getPurchaseCount(){
            $branchCode = $_SESSION['Bcode'];
            $sql = "SELECT phone FROM crbs WHERE branch = '$branchCode' ORDER BY id DESC LIMIT 1";
            $gett = mysqli_query($this->con , $sql);
            while($row = mysqli_fetch_array($gett)){
                $phone = $row['phone'];
            }
            
            $num = "SELECT * From crbs WHERE phone = '$phone'";
            $numb = mysqli_query($this->con , $num);
            
            $pur = mysqli_num_rows($numb);
            echo $pur;
        }
        //get all locations and display them
        public function locations(){
            
            
            $sql = "SELECT company.CompanyName, gasStations.Bname, gasStations.Baddress FROM company, gasStations WHERE gasStations.company = company.CompanyCode AND company.CompanyName LIKE '%Aico%'";
            $getThem = mysqli_query($this->con , $sql);
            if ($getThem){
                while($row = mysqli_fetch_array($getThem)){
                    $company = $row['CompanyName'];
                    $branch = $row['Bname'];
                    $add = $row['Baddress'];
                    
                    echo "
                    <div class=' col-md-3 mb-3'>
                    <div class='card'>
                    <div class='card-header'>
                        <h4 class='serif font-weight-bold mb-3'>".$branch."</h4>
                    </div>
                    <div class='card-body'>
                        <p class='font-weight-bold'>".$add."</p>
                    </div>
                    </div>
                    </div>
                    ";
                }
            }
        }
        // get pricing for dealer
        public function dealerPrice(){
            $branchCode = $_SESSION['Bcode'];
            $sql = "SELECT     * FROM price WHERE Category = 'Dealer' AND Bcode = '$branchCode' ";
            $run = mysqli_query($this->con , $sql);
            
            if(mysqli_num_rows($run) > 0){
                
                while($row = mysqli_fetch_array($run)){
                    $kg = $row['cylinderSize'];
                    $ppkg = $row['pricePerKg'];
                    $price = $row['price'];
                    $amount = rand(11111, 99999);
                    $quant = rand(11111, 99999);
                    $ttqq = rand(11111,99999);
                    $kid = rand(11111,99999);
                    $amtt = rand(11111, 99999);


                    if($kg != "Others"){

                        echo "
                        <script>
                        $(document).ready(function(){
                                          $('#".$quant."').keyup(function(){
                                                                 $('#".$amount."').val($('#".$quant."').val() * ".$price.");
                                                                 $('#".$ttqq."').val($('#".$quant."').val() * ".$kg.");
                                                                 $('#".$kid."').attr('checked', true);
                                                                 });
                                          
                                          
                                          
                                          });
                        </script>
                        ";
                       
                        echo "
                        <tr>
                        <th>
                        <div class='form-check'>
                        <input type='checkbox' class='checkbox-d'  value=".$kg." id=".$kid."   name='kgg[]' />
                        <label class='form-check-label'  for='exampleCheck1'>".$kg." Kg</label>
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='text' class='form-control' value=".number_format($price)." name='fiftykgvalue' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control qt-d'  id=".$quant." name='qu[]' />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$ttqq." name='tq[]' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control amount-d'  id=".$amount." name='am[]' readonly />
                            </div></th>
                            </tr>
                            ";
                    }else{

                        echo "
                        <script>
                        $(document).ready(function(){
                                          $('#".$quant."').keyup(function(){
                                                                 var num1 = $('#".$amtt."').val();
                                                                 var num2 = $('#".$kid."').val();
                                                                 $('#".$amount."').val( $('#".$quant."').val() * num1 );
                                                                 $('#".$ttqq."').val( $('#".$quant."').val() * num2 );
                                                                 });
                                          
                                          
                                          
                                          });
                        </script>
                        ";
                        echo "
                        <tr>
                           <th>
                            <div class='form-check'>Total</div>
                           </th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th class='bg-success'>
                            <div id='total-text-d' class='total-text form-group mx-sm-3 mb-2'>
                                0
                            </div>
                           </th>
                       
                        </tr>
                        <tr class='bg-danger'>
                        
                        <th colspan='5'><h5 class='text-white' align='center'><b>Do not sell this category unless approved by your supervisor or manager</h5></t>
                        
                        </tr>
                        <tr class='bg-danger'>
                        <th>
                        <div class='form-check'>
                        <input type='float' class='form-control'  id=".$kid."   name='kgg[]' placeholder='Kg ?' />
                        <label class='form-check-label'  for='exampleCheck1'><h5 align='center'>".$kg."</h5></label>
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control' id=".$amtt." value=".number_format($price)." name='fiftykgvalue'  />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$quant." name='qu[]' />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$ttqq." name='tq[]' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$amount." name='am[]' readonly />
                            </div></th>
                            </tr>
                            ";
                            }
                    
                    
                }
            }
            
        }
        
        public function eateryPrice(){
            $branchCode = $_SESSION['Bcode'];
            $sql = "SELECT     * FROM price WHERE Category = 'Eatery' AND Bcode = '$branchCode' ";
            $run = mysqli_query($this->con , $sql);
            
            if(mysqli_num_rows($run) > 0){
                
                while($row = mysqli_fetch_array($run)){
                    $kg = $row['cylinderSize'];
                    $ppkg = $row['pricePerKg'];
                    $price = $row['price'];
                    $amount = rand(11111, 99999);
                    $quant = rand(11111, 99999);
                    $ttqq = rand(11111,99999);
                    $kid = rand(11111,99999);
                    $amtt = rand(11111, 99999);

                    if($kg != "Others"){
                        echo "
                        <script>
                        $(document).ready(function(){
                                          $('#".$quant."').keyup(function(){
                                                                 $('#".$amount."').val($('#".$quant."').val() * ".$price.");
                                                                 $('#".$ttqq."').val($('#".$quant."').val() * ".$kg.");
                                                                 $('#".$kid."').attr('checked', true);
                                                                 });
                                          
                                          
                                          
                                          });
                        </script>
                        ";
                        echo "
                        <tr>
                        <th>
                        <div class='form-check'>
                        <input type='checkbox' class='checkbox-e'  value=".$kg." id=".$kid."   name='kgg[]' />
                        <label class='form-check-label'  for='exampleCheck1'>".$kg." Kg</label>
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='text' class='form-control' value=".number_format($price)." name='fiftykgvalue' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control qt-e'  id=".$quant." name='qu[]' />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$ttqq." name='tq[]' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control amount-e'  id=".$amount." name='am[]' readonly />
                            </div></th>
                            </tr>
                            ";
                    }else{
                        echo "
                        <script>
                        $(document).ready(function(){
                                          $('#".$quant."').keyup(function(){
                                                                 var num1 = $('#".$amtt."').val();
                                                                 var num2 = $('#".$kid."').val();
                                                                 $('#".$amount."').val( $('#".$quant."').val() * num1 );
                                                                 $('#".$ttqq."').val( $('#".$quant."').val() * num2 );
                                                                 });
                                          
                                          
                                          
                                          });
                        </script>
                        ";
                        echo "
                        <tr>
                           <th>
                            <div class='form-check'>Total</div>
                           </th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th class='bg-success'>
                            <div id='total-text-e' class='total-text form-group mx-sm-3 mb-2'>
                                0
                            </div>
                           </th>
                       
                        </tr>
                        <tr class='bg-danger'>
                        
                        <th colspan='5'><h5 class='text-white' align='center'><b>Do not sell this category unless approved by your supervisor or manager</h5></t>
                        
                        </tr>
                        <tr class='bg-danger'>
                        <th>
                        <div class='form-check'>
                        <input type='float' class='form-control'  id=".$kid."   name='kgg[]' placeholder='Kg ?' />
                        <label class='form-check-label'  for='exampleCheck1'><h5 align='center'>".$kg."</h5></label>
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control' id=".$amtt." value=".number_format($price)." name='fiftykgvalue'  />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$quant." name='qu[]' />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$ttqq." name='tq[]' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$amount." name='am[]' readonly />
                            </div></th>
                            </tr>
                            ";
                            }
                    
                    
                }
            }
            
        }
        
        public function domesticPrice(){
            $branchCode = $_SESSION['Bcode'];
            $sql = "SELECT     * FROM price WHERE Category = 'Domestic' AND Bcode = '$branchCode' ";
            $run = mysqli_query($this->con , $sql);
            
            if(mysqli_num_rows($run) > 0){
                
                while($row = mysqli_fetch_array($run)){
                    $kg = $row['cylinderSize'];
                    $ppkg = $row['pricePerKg'];
                    $price = $row['price'];
                    $amount = rand(11111, 99999);
                    $quant = rand(11111, 99999);
                    $ttqq = rand(11111,99999);
                    $kid = rand(11111,99999);
                    $kidd = rand(11111,99999);
                    $amtt = rand(11111, 99999);


                    if($kg != "Others"){
                       echo "
                        <script>
                        $(document).ready(function(){
                                          $('#".$quant."').keyup(function(){
                                                                 $('#".$amount."').val($('#".$quant."').val() * ".$price.");
                                                                 $('#".$ttqq."').val($('#".$quant."').val() * ".$kg.");
                                                                 $('#".$kid."').attr('checked', true);
                                                                 $('#".$qua."').val()
                                                                 });
                                          
                                          
                                          
                                          });
                        </script>
                        ";
                        echo "
                        <tr>
                        <th>
                        <div class='form-check'>
                        <input type='checkbox' class='checkbox'  value=".$kg." id=".$kid."   name='kgg[]' />
                        <label class='form-check-label'  for='exampleCheck1'>".$kg." Kg</label>
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='text' class='form-control price' value=".number_format($price)." name='fiftykgvalue' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control qt'  id=".$quant." name='qu[]' />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".floatval($ttqq)." name='tq[]' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control amount'  id=".$amount." name='am[]' readonly />
                            </div></th>
                            </tr>
                            ";
                    }else{
                       echo "
                        <script>
                        $(document).ready(function(){
                                          $('#".$quant."').keyup(function(){
                                                                 var num1 = $('#".$amtt."').val();
                                                                 var num2 = $('#".$kidd."').val();
                                                                 $('#".$amount."').val( $('#".$quant."').val() * num1 );
                                                                 $('#".$ttqq."').val( $('#".$quant."').val() * num2 );
                                                                 });
                                          
                                          
                                          
                                          });
                        </script>
                        ";
                        echo "
                        <tr>
                           <th>
                            <div class='form-check'>Total</div>
                           </th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th class='bg-success'>
                            <div id='total-text' class='total-text form-group mx-sm-3 mb-2'>
                                0
                            </div>
                           </th>
                       
                        </tr>
                        <tr class='bg-danger'>

                        <th colspan='5'><h5 class='text-white' align='center'><b>Do not sell this category unless approved by your supervisor or manager</h5></t>
    
                        </tr>
                        
                        <tr class='bg-danger'>
                        <th>
                        <div class='form-check'>
                        <input type='float' class='form-control'  id=".$kidd."   name='kgg[]' placeholder='Kg ?' />
                        <label class='form-check-label'  for='exampleCheck1'><h5 align='center'>".$kg."</h5></label>
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control' id=".$amtt." value=".number_format($price)." name='fiftykgvalue'  />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$quant." name='qu[]' />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$ttqq." name='tq[]' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$amount." name='am[]' readonly />
                            </div></th>
                            </tr>
                            ";
                    }
                    
                   
                }
                       
            }
            
        }
        
        public function othersPrice(){
            $branchCode = $_SESSION['Bcode'];
            $sql = "SELECT     * FROM price WHERE Category = 'Others' AND Bcode = '$branchCode' ";
            $run = mysqli_query($this->con , $sql);
            
            if(mysqli_num_rows($run) > 0){
                
                while($row = mysqli_fetch_array($run)){
                    $kg = $row['cylinderSize'];
                    $ppkg = $row['pricePerKg'];
                    $price = $row['price'];
                    $amount = rand(11111, 99999);
                    $quant = rand(11111, 99999);
                    $ttqq = rand(11111,99999);
                    $kid = rand(11111,99999);
                    $amtt = rand(11111, 99999);

                  

                    if($kg != "Others"){
                       echo "
                        <script>
                        $(document).ready(function(){
                                          $('#".$quant."').keyup(function(){
                                                                 $('#".$amount."').val($('#".$quant."').val() * ".$price.");
                                                                 $('#".$ttqq."').val($('#".$quant."').val() * ".$kg.");
                                                                 $('#".$kid."').attr('checked', true);
                                                                 });
                                          
                                          
                                          
                                          });
                        </script>
                        ";
                        echo "
                        <tr>
                        <th>
                        <div class='form-check'>
                        <input type='checkbox' class='checkbox-o'  value=".$kg." id=".$kid."   name='kgg[]' />
                        <label class='form-check-label'  for='exampleCheck1'>".$kg." Kg</label>
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='text' class='form-control' value=".number_format($price)." name='fiftykgvalue' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control qt-o'  id=".$quant." name='qu[]' />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$ttqq." name='tq[]' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control amount-o'  id=".$amount." name='am[]' readonly />
                            </div></th>
                            </tr>
                            ";
                    }else{
                        echo "
                        <script>
                        $(document).ready(function(){
                                          $('#".$quant."').keyup(function(){
                                                                 var num1 = $('#".$amtt."').val();
                                                                 var num2 = $('#".$kid."').val();
                                                                 $('#".$amount."').val( $('#".$quant."').val() * num1 );
                                                                 $('#".$ttqq."').val( $('#".$quant."').val() * num2 );
                                                                 });
                                          
                                          
                                          
                                          });
                        </script>
                        ";
                        echo "
                        <tr>
                           <th>
                            <div class='form-check'>Total</div>
                           </th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th class='bg-success'>
                            <div id='total-text-o' class='total-text form-group mx-sm-3 mb-2'>
                                0
                            </div>
                           </th>
                       
                        </tr>
                        <tr class='bg-danger'>
                        
                        <th colspan='5'><h5 class='text-white' align='center'><b>Do not sell this category unless approved by your supervisor or manager</h5></t>
                        
                        </tr>
                        <tr class='bg-danger'>
                        <th>
                        <div class='form-check'>
                        <input type='float' class='form-control'  id=".$kid."   name='kgg[]' placeholder='Kg ?' />
                        <label class='form-check-label'  for='exampleCheck1'><h5 align='center'>".$kg."</h5></label>
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control' id=".$amtt." value=".number_format($price)." name='fiftykgvalue'  />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$quant." name='qu[]' />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$ttqq." name='tq[]' readonly />
                            </div></th>
                            <th><div class='form-group mx-sm-3 mb-2'>
                            <input type='number' class='form-control'  id=".$amount." name='am[]' readonly />
                            </div></th>
                            </tr>
                            ";
                            }
                    
                    
                }
            }
            
        }
        
        //get crb number
        public function nextCrb(){
            $branchCode = $_SESSION['Bcode'];
            $datenow = date('Y-m-d', strtotime('now'));
            $sql = "SELECT     crbnumber FROM crbs WHERE branch = '$branchCode' AND datee = '$datenow' ORDER BY id DESC LIMIT 1";
            $run = mysqli_query($this->con , $sql);
            
            if(mysqli_num_rows($run) > 0){
                
                while($row = mysqli_fetch_array($run)){
                    $nowCrb = $row['crbnumber'];
                    
                    $nowCrb = $nowCrb + 1;
                    echo $nowCrb;
                }
                
            }else{
                
                $nowCrb = 0;
                
                $nowCrb = $nowCrb + 1;
                echo $nowCrb;
            }
            
            
        }
        
        //pull crbs
        public function pullCRBs(){
            $branchCode = $_SESSION['Bcode'];
            
            $sql = "SELECT DISTINCT crbnumber FROM salespoint WHERE branch = '$branchCode'";
            $run = mysqli_query($this->con , $sql);
            
            if(mysqli_num_rows($run) > 0){
                while($row = mysqli_fetch_array($run)){
                    $crb = $row['crbnumber'];
                    
                    echo "<form class='crb-queue-no' action=' ' method='POST'>
                    <button class='btn btn-outline-primary' type='submit' name='salesCrb' value=".$crb.">".$crb."</button>
                    </form>
                    ";
                    //echo "<hr>";
                    
                }
            }
        }
        
        
        //pull crb report
        public function crbReport(){
            $branchCode = $_GET['bcode'];
            if(isset($_GET['date']) && $_GET['date'] != "") {
                $date = $_GET['date'];
            } else {
                $date = date('Y-m-d', strtotime('now'));
            }
           
            
            $train = "SELECT SUM(tquant), SUM(amount) FROM crbs WHERE datee = '$date' AND branch = '$branchCode' ";
            $su = mysqli_query($this->con , $train);
            
           
            
            $report = "SELECT * FROM crbs WHERE datee = '$date' AND branch = '$branchCode'";
            $run = mysqli_query($this->con , $report);
            
            if($run){
                While($cat = mysqli_fetch_array($run)){
                    $crb = $cat['crbnumber'];
                    $name = $cat['customer'];
                    $kg = $cat['kg'];
                    $quantity = $cat['quantity'];
                    $amount = $cat['amount'];
                    $tkg = $cat['tquant'];
                    
                    if($kg == 0 && $quantity == 0 && $amount == 0){
                        
                        echo "<tr class='bg-danger'>";
                        echo "<th scope='row' class='text-white'><strike style='color:#000'>".$crb."</strike></th>";
                        echo "<th scope='row' class='text-white'><strike style='color:#000'>".$name."</strike></th>";
                        echo "<th scope='row' class='text-white'><strike style='color:#000'>".number_format($kg)."</strike></th>";
                        echo "<th scope='row' class='text-white'><strike style='color:#000'>".number_format($amount)."</strike></th>";
                        echo "</tr>";
                        
                    }else{
                        
                        echo "<tr>";
                        echo "<th scope='row'>".$crb."</th>";
                        echo "<th scope='row'>".$name."</th>";
                        echo "<th scope='row'>".$tkg."</th>";
                        echo "<th scope='row'>".number_format($amount)."</th>";
                        echo "</tr>";
                        
                    }
                    
                }
            }

            if($su){
                
                while($trone = mysqli_fetch_array($su)){
                    $totalq = $trone['SUM(tquant)'];
                    $totalam = $trone['SUM(amount)'];
                    
                }
                
                
                echo "<tr class='bg-info'>";
                echo "<th scope='row' class='text-white'>Total</th>";
                echo "<th scope='row' class='text-white'></th>";
                echo "<th scope='row' class='text-white'>".number_format($totalq)." Kg</th>";
                echo "<th scope='row' class='text-white'>".number_format($totalam)."</th>";
                
                echo "</tr>";
                
                
            }else{
                echo "error in query";
            }
            
        }
        //sales person report
        public function salesReport(){
            $date = date('Y-m-d', strtotime('now'));
            $branchCode = $_SESSION['Bcode'];
            
            
            $train = "SELECT SUM(kg), SUM(quantity), SUM(finalTotal) FROM finalsales WHERE datee = '$date'  AND branch = '$branchCode' ";
            $su = mysqli_query($this->con , $train);
            
            
            
            if($su){
                
                while($trone = mysqli_fetch_array($su)){
                    $totalKgg = $trone['SUM(kg)'];
                    $totalq = $trone['SUM(quantity)'];
                    $totalam = $trone['SUM(finalTotal)'];
                }
                
                
                
                echo "<tr class='bg-info'>";
                echo "<th scope='row' class='text-white'>Total</th>";
                echo "<th scope='row' class='text-white'></th>";
                echo "<th scope='row' class='text-white'>".number_format($totalKgg)." Kg</th>";
                echo "<th scope='row' class='text-white'>".number_format($totalam)." NGN</th>";
                echo "</tr>";
                
                
            }
            
            $report = "SELECT * FROM finalsales WHERE datee = '$date'  AND branch = '$branchCode'";
            $run = mysqli_query($this->con , $report);
            
            if($run){
                While($cat = mysqli_fetch_array($run)){
                    $crb = $cat['reciept'];
                    $category = $cat['customer'];
                    $kg = $cat['kg'];
                    $quantity = $cat['quantity'];
                    $amount = $cat['finalTotal'];
                    
                    echo "<tr>";
                    echo "<th scope='row'>".$crb."</th>";
                    echo "<th scope='row'>".$category."</th>";
                    echo "<th scope='row'>".number_format($kg)." Kg</th>";
                    
                    echo "<th scope='row'>".number_format($amount)." NGN</th>";
                    echo "</tr>";
                }
            }
        }
        
        //pull locations in table head
        public function locationsTableHead(){
             $designation = $_SESSION["designation"];

             if ($designation == 'Supervisor') {
                 $company = $_SESSION['CompanyName'];
            $loc = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company'";
            $loca = mysqli_query($this->con , $loc);
            
            if(mysqli_num_rows($loca) > 0){
                while($row = mysqli_fetch_array($loca)){
                    $branch = $row['Bname'];
                    $company = $row['CompanyName'];
                    $branchCode = $row['Bcode'];
                    $date = $_POST['date'];
                    
                    echo " <th scope='col'>".$company."<br>".$branch."<br>
                    <form action='branch.php?date=$date&branch=$branchCode' method='POST'>
                    <button class='btn btn-outline-info' name='gotobranch' value='".$branchCode."'>Goto sales log</button>
                    </form>
                    </th>";
                    
                }
            }
             }else{

            $loc = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
            $loca = mysqli_query($this->con , $loc);
            
            if(mysqli_num_rows($loca) > 0){
                while($row = mysqli_fetch_array($loca)){
                    $branch = $row['Bname'];
                    $company = $row['CompanyName'];
                    $branchCode = $row['Bcode'];
                    $date = $_POST['date'];
                    
                    
                    echo " <th scope='col'>".$company."<br>".$branch."<br>
                    <form action='branch.php?date=$date&branch=$branchCode' method='POST'>
                    <button class='btn btn-outline-info' name='gotobranch' value='".$branchCode."'>Goto sales log</button>
                    </form>
                    </th>";
                    
                }
            }
             }

            
        }
        
        //get stock details
        public function pullStockRecord(){
            $designation = $_SESSION["designation"];

            if ($designation == 'Supervisor') {
                    
                 $company = $_SESSION['CompanyName'];
                 $get = "SELECT gasStations.id, gasStations.Bname, gasStations.Bcode, gasStations.BtankA, gasStations.BtankB, gasStations.BpurchasePrice, gasStations.BtankUse, company.CompanyName FROM gasStations, company WHERE gasStations.company = company.CompanyCode AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company'";
            $getgo = mysqli_query($this->con , $get);
            if(mysqli_num_rows($getgo) > 0){
                while ($row = mysqli_fetch_array($getgo)) {
                    $id = $row['id'];
                    $loc = $row['Bname'];
                    $tankA = $row['BtankA'];
                    $tankB = $row['BtankB'];
                    $totalKg = $tankA + $tankB;
                    $price = $row['BpurchasePrice'];
                    $tank = $row['BtankUse'];
                    $company = $row['CompanyName'];
                    $bcode = $row['Bcode'];
                    
                    $getSold = "SELECT SUM(finalTotal) FROM finalsales WHERE branch = '$bcode' AND tankUse = '$tank' ";
                    $pullSold = mysqli_query($this->con , $getSold);
                    if($pullSold){
                        while ($ken = mysqli_fetch_array($pullSold)) {
                            $sold = $ken['SUM(finalTotal)'];
                        }
                    }
                    
                    echo "
                    
                    <tr>
                    <td>".$id."</td>
                    <td>".$company."</td>
                    <td>".$loc." <br>
                    <form action='stocklog.php' method='POST'>
                    <button class='btn btn-outline-info' value='".$bcode."' name='branchCode'> See stock log </button>
                    </form>
                    </td>
                    <td>".$tankA." Kg</td>
                    <td>".$tankB." Kg</td>
                    <td>".$totalKg." Kg</td>
                    <td>".number_format($price)." NGN</td>
                    <td>".number_format($sold)." NGN</td>
                    <td>".$tank."</td>
                    
                    </tr>
                    ";
                }
            }

            }else{

                 $get = "SELECT gasStations.id, gasStations.Bname, gasStations.Bcode, gasStations.BtankA, gasStations.BtankB, gasStations.BpurchasePrice, gasStations.BtankUse, company.CompanyName FROM gasStations, company WHERE gasStations.company = company.CompanyCode AND company.CompanyName != 'Almarence'";
            $getgo = mysqli_query($this->con , $get);
            if(mysqli_num_rows($getgo) > 0){
                while ($row = mysqli_fetch_array($getgo)) {
                    $id = $row['id'];
                    $loc = $row['Bname'];
                    $tankA = $row['BtankA'];
                    $tankB = $row['BtankB'];
                    $totalKg = $tankA + $tankB;
                    $price = $row['BpurchasePrice'];
                    $tank = $row['BtankUse'];
                    $company = $row['CompanyName'];
                    $bcode = $row['Bcode'];
                    
                    $getSold = "SELECT SUM(finalTotal) FROM finalsales WHERE branch = '$bcode' AND tankUse = '$tank' ";
                    $pullSold = mysqli_query($this->con , $getSold);
                    if($pullSold){
                        while ($ken = mysqli_fetch_array($pullSold)) {
                            $sold = $ken['SUM(finalTotal)'];
                        }
                    }
                    
                    echo "
                    
                    <tr>
                    <td>".$id."</td>
                    <td>".$company."</td>
                    <td>".$loc." <br>
                    <form action='stocklog.php' method='POST'>
                    <button class='btn btn-outline-info' value='".$bcode."' name='branchCode'> See stock log </button>
                    </form>
                    </td>
                    <td>".$tankA." Kg</td>
                    <td>".$tankB." Kg</td>
                    <td>".$totalKg." Kg</td>
                    <td>".number_format($price)." NGN</td>
                    <td>".number_format($sold)." NGN</td>
                    <td>".$tank."</td>
                    
                    </tr>
                    ";
                }
            }

            }
           
        }
        //get name, number and cid from customers
        public function getCustomerDetails(){
            $branchCode = $_SESSION['Bcode'];
            $cus = "SELECT * FROM customers WHERE branch = '$branchCode' ";
            $gocus = mysqli_query($this->con , $cus);
            if($gocus){
                $data = [];
                while($row = mysqli_fetch_array($gocus)){
                    $na = $row['Cname'];
                    $cphone = $row['Cphone'];
                    $cid = $row['Cid'];
                    
                    //write a part to ret
                    
                    $getData = $cphone." , " .$na. " , " .$cid. "";
                    $data[] = $getData;
                    $encode = json_encode($data);
                    
                    
                }
                return $encode;
            }
            
        }  

        public function getCustomerDetailsL(){
            $branchCode = $_POST['bcode'];
            $cus = "SELECT * FROM customers WHERE branch = '$branchCode' ";
            $gocus = mysqli_query($this->con , $cus);
            if($gocus){
                $data = [];
                while($row = mysqli_fetch_array($gocus)){
                    $na = $row['Cname'];
                    $cphone = $row['Cphone'];
                    $cid = $row['Cid'];
                    
                    //write a part to ret
                    
                    $getData = $cphone." , " .$na. " , " .$cid. "";
                    $data[] = $getData;
                    $encode = json_encode($data);
                    
                    
                }
                return $encode;
            }
            
        }

        //populate table head with kgs
        public function tableHeadkg(){
            $sql = "SELECT DISTINCT(cylinderSize) FROM price WHERE cylinderSize != 'Others' ";
            $query = mysqli_query($this->con , $sql);
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_array($query)){
                    $kg = $row['cylinderSize'];
                    
                    
                    echo "<th scope='col'>".$kg." Kg</th>";
                }
            }
        }
        //populate kg
        public function populateKgData($branchCode, $date){
            $sql = "SELECT DISTINCT(cylinderSize) FROM price WHERE cylinderSize != 'Others'";
            $query = mysqli_query($this->con , $sql);
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_array($query)){
                    $kg = $row['cylinderSize'];
                    
                    $sql2 = "SELECT SUM(quantity), SUM(amount), SUM(allKg) FROM completeSales WHERE kg = '$kg' AND datee = '$date' AND branch = '$branchCode' ";
                    $query2 = mysqli_query($this->con , $sql2);
                    if($query2){
                        while($rolla = mysqli_fetch_array($query2)){
                            $qan = $rolla['SUM(quantity)'];
                            $ammm = $rolla['SUM(amount)'];
                            $akg = $rolla['SUM(allKg)'];
                            
                            echo " <td class=''>".number_format($qan)." / ".number_format($ammm)." <br> <b class='text-danger'> ".$akg." Kg </b></td>";
                        }
                    }
                    
                }
            }
        }
        //get customer reg statistics into options tag
        public function cusStats(){
            
            $designation = $_SESSION["designation"];

            if ($designation == 'Supervisor') {

                 $company = $_SESSION['CompanyName'];
            $sql = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM company, gasStations WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence' AND company.CompanyName = '$company'";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $com = $row['CompanyName'];
                $code = $row['Bcode'];
                $name = $row['Bname'];
                
                $roll = "SELECT * FROM customers WHERE branch = '$code' ";
                $goroll = mysqli_query($this->con , $roll);
                if($goroll){
                    $rollcount = mysqli_num_rows($goroll);
                }
                echo "<option value=".$code.">".$com." : ".$name." - ".$code. " : ".$rollcount." Members</option>";
            }
                
            }else{

            $sql = "SELECT company.CompanyName, gasStations.Bname, gasStations.Bcode FROM company, gasStations WHERE company.CompanyCode = gasStations.company AND company.CompanyName != 'Almarence'";
            $result = mysqli_query($this->con , $sql);
            
            while($row = mysqli_fetch_array($result)){
                $com = $row['CompanyName'];
                $code = $row['Bcode'];
                $name = $row['Bname'];
                
                $roll = "SELECT * FROM customers WHERE branch = '$code' ";
                $goroll = mysqli_query($this->con , $roll);
                if($goroll){
                    $rollcount = mysqli_num_rows($goroll);
                }
                
                if(isset($_POST['bcode']) && $_POST['bcode'] == $code) {
                    echo "<option selected='selected' value=".$code.">".$com." : ".$name." - ".$code. " : ".$rollcount." Members</option>";
                }elseif(isset($_GET['branch']) && $_GET['branch'] == $code){
                    echo "<option selected='selected' value=".$code.">".$com." : ".$name." - ".$code. " : ".$rollcount." Members</option>";
                }else{ 
                echo "<option value=".$code.">".$com." : ".$name." - ".$code. " : ".$rollcount." Members</option>";
            }
              
        }

            }

           
        }
        //site statistics
        public function statistics(){
            $date = date('Y-m-d', strtotime('now'));

             
    $designation = $_SESSION["designation"];

    if ($designation == 'Supervisor') {

        $companyCode = $_SESSION['CompanyCode'];
        

        $greed = " SELECT * FROM gasStations WHERE company = '$companyCode' ";
        $runG = mysqli_query($this->con, $greed);
        $bros = mysqli_fetch_array($runG);
        $bra = $bros['Bcode'];

        $start = "SELECT DISTINCT(branch) FROM finalsales WHERE datee = '$date' AND branch = '$bra' AND category != 'Switchcontroler' ";
            $gostart = mysqli_query($this->con , $start);
            if($gostart){
                while ($row = mysqli_fetch_array($gostart)){
                    $branch = $row['branch'];
                    //get bad crb count
                    $bad = "SELECT * FROM badCrbs WHERE datee = '$date' AND branch = '$branch' ";
                    $gobad = mysqli_query($this->con , $bad);
                    $numBad = mysqli_num_rows($gobad);
                    
                    //get branch
                    $getBranch = "SELECT Bname FROM gasStations WHERE Bcode = '$branch' ";
                    $goBranch = mysqli_query($this->con , $getBranch);
                    if($goBranch){
                        while($bra = mysqli_fetch_array($goBranch)){
                            $bname = $bra['Bname'];
                        }
                    }
                    
                    //get company
                    $getCompany = "SELECT company.CompanyName, gasStations.company FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND gasStations.Bcode = '$branch' ";
                    $goCompany = mysqli_query($this->con , $getCompany);
                    if($goCompany){
                        while($com = mysqli_fetch_array($goCompany)){
                            $company = $com['CompanyName'];
                        }
                    }
                    
                    //get successful sales
                    $success = "SELECT * FROM finalsales WHERE datee = '$date' AND branch = '$branch' AND category != 'Switchcontroler' ";
                    $gosuccess = mysqli_query($this->con , $success);
                    $numsuccess = mysqli_num_rows($gosuccess);
                    
                    //get total amount sold
                    $sold = "SELECT SUM(finalTotal), SUM(changee), SUM(changeD), SUM(kg) FROM finalsales WHERE datee = '$date' AND branch = '$branch' AND category != 'Switchcontroler' ";
                    $gosold = mysqli_query($this->con , $sold);
                    $numsold = mysqli_fetch_array($gosold);
                    $acsold = $numsold['SUM(finalTotal)'];
                    $changeHeld = $numsold['SUM(changee)'];
                    $changeDebit = $numsold['SUM(changeD)'];
                    $kgSum = $numsold['SUM(kg)'];
                    
                    //get Crbs on que
                    $que = "SELECT DISTINCT(crbnumber) FROM salespoint WHERE datee = '$date' AND branch = '$branch' ";
                    $goque = mysqli_query($this->con , $que);
                    $numque = mysqli_num_rows($goque);

                    $offline = "SELECT SUM(finalTotal), SUM(changee), SUM(changeD), SUM(kg) FROM finalsales WHERE datee = '$date' AND branch = '$branch' AND category LIKE '%Offline%'";
                    $off = mysqli_query($this->con, $offline);
                      while ($ofa = mysqli_fetch_array($off)) {
                        $offamount = $ofa['SUM(finalTotal)'];
                        $offcash = $ofa['SUM(cash)'];
                        $offKg = $ofa['SUM(kg)'];
                    }
                    
                    
                    echo "
                    <div class='col-lg-4 mb-4'>
                    <div class='card shadow mb-4'>
                    <div class='card-header py-3'>
                    <h6 class='m-0 font-weight-bold text-primary'>".$company." <br>[ ".$bname." ]<br>  Date: ".$date."</h6>
                    </div>
                    <div class='card-body'>
                    <h6><b>Declined Sales: ".$numBad." </b></h6><hr>
                    <h6><b>Crbs On Que: ".$numque." </b></h6><hr>
                    <h6><b>Successful Sales: ".$numsuccess." </b></h6><hr>
                    <h6><b>Total Sold: ".number_format($acsold)." NGN </b></h6>
                    <hr>
                    <h6><b>Sold Offline: ".number_format($offamount)." NGN </b></h6>
                    <hr>
                    <h6><b>Offline Kg Sold: ".$offKg." Kg </b></h6>
                    <hr>
                    <h6><b>Total Kg: ".$kgSum." Kg </b></h6><hr>
                    </div>
                    </div>
                    </div>
                    
                    ";
                }
            }
        
    }else{

          $start = "SELECT DISTINCT(branch) FROM finalsales WHERE datee = '$date' ";
            $gostart = mysqli_query($this->con , $start);
            if($gostart){
                while ($row = mysqli_fetch_array($gostart)){
                    $branch = $row['branch'];
                    //get bad crb count
                    $bad = "SELECT * FROM badCrbs WHERE datee = '$date' AND branch = '$branch' ";
                    $gobad = mysqli_query($this->con , $bad);
                    $numBad = mysqli_num_rows($gobad);
                    
                    //get branch
                    $getBranch = "SELECT Bname FROM gasStations WHERE Bcode = '$branch' ";
                    $goBranch = mysqli_query($this->con , $getBranch);
                    if($goBranch){
                        while($bra = mysqli_fetch_array($goBranch)){
                            $bname = $bra['Bname'];
                        }
                    }
                    
                    //get company
                    $getCompany = "SELECT company.CompanyName, gasStations.company FROM gasStations, company WHERE company.CompanyCode = gasStations.company AND gasStations.Bcode = '$branch'";
                    $goCompany = mysqli_query($this->con , $getCompany);
                    if($goCompany){
                        while($com = mysqli_fetch_array($goCompany)){
                            $company = $com['CompanyName'];
                        }
                    }
                    
                    //get successful sales
                    $success = "SELECT * FROM finalsales WHERE datee = '$date' AND branch = '$branch' AND category != 'Switchcontroler' ";
                    $gosuccess = mysqli_query($this->con , $success);
                    $numsuccess = mysqli_num_rows($gosuccess);
                    
                    //get total amount sold
                    $sold = "SELECT SUM(finalTotal), SUM(changee), SUM(changeD), SUM(kg) FROM finalsales WHERE datee = '$date' AND branch = '$branch' AND category != 'Switchcontroler' ";
                    $gosold = mysqli_query($this->con , $sold);
                    $numsold = mysqli_fetch_array($gosold);
                    $acsold = $numsold['SUM(finalTotal)'];
                    $changeHeld = $numsold['SUM(changee)'];
                    $changeDebit = $numsold['SUM(changeD)'];
                    $kgSum = $numsold['SUM(kg)'];
                    
                    //get Crbs on que
                    $que = "SELECT DISTINCT(crbnumber) FROM salespoint WHERE datee = '$date' AND branch = '$branch' ";
                    $goque = mysqli_query($this->con , $que);
                    $numque = mysqli_num_rows($goque);

                    $offline = "SELECT SUM(finalTotal), SUM(changee), SUM(changeD), SUM(kg) FROM finalsales WHERE datee = '$date' AND branch = '$branch' AND category LIKE '%Offline%'";
                    $off = mysqli_query($this->con, $offline);
                      while ($ofa = mysqli_fetch_array($off)) {
                        $offamount = $ofa['SUM(finalTotal)'];
                        $offcash = $ofa['SUM(cash)'];
                        $offKg = $ofa['SUM(kg)'];
                    }
                    
                    
                    echo "
                    <div class='col-lg-4 mb-4'>
                    <div class='card shadow mb-4'>
                    <div class='card-header py-3'>
                    <h6 class='m-0 font-weight-bold text-primary'>".$company." <br>[ ".$bname." ]<br>  Date: ".$date."</h6>
                    </div>
                    <div class='card-body'>
                    <h6><b>Declined Sales: ".$numBad." </b></h6><hr>
                    <h6><b>Crbs On Que: ".$numque." </b></h6><hr>
                    <h6><b>Successful Sales: ".$numsuccess." </b></h6><hr>
                    <h6><b>Total Sold: ".number_format($acsold)." NGN </b></h6>
                    <hr>
                    <h6><b>Sold Offline: ".number_format($offamount)." NGN </b></h6>
                    <hr>
                    <h6><b>Offline Kg Sold: ".$offKg." Kg </b></h6>
                    <hr>
                    <h6><b>Total Kg: ".$kgSum." Kg </b></h6><hr>
                    </div>
                    </div>
                    </div>
                    
                    ";
                }
            }

    }
            
          
        }
        //company dets for delete company
        public function companyDets(){
            $sql = "SELECT * FROM company WHERE companyName != 'Almarence'";
            $gosql = mysqli_query($this->con, $sql);
            echo "
            
            <select name='comSelect' class='form-control mb-2'>
            ";
            while($row = mysqli_fetch_array($gosql)){
                $name = $row['CompanyName'];
                $ccode = $row['CompanyCode'];
                
                
                echo  "<option value='".$ccode."'>".$name." - ".$ccode."</option>";
                
                
                
            }
            echo "
            </select>
            
            ";
        }
        
        //branch dets for delete branch
        public function branchDets(){
            $sql = "SELECT * FROM company WHERE companyName != 'Almarence'";
            $gosql = mysqli_query($this->con, $sql);
            echo "
            
            <select name='comSelect' class='form-control mb-2'>
            ";
            while($row = mysqli_fetch_array($gosql)){
                $name = $row['CompanyName'];
                $ccode = $row['CompanyCode'];
                
                
                $sql2 = "SELECT * FROM gasStations WHERE gasStations.company = '$ccode' ";
                $gosql2 = mysqli_query($this->con, $sql2);
                while($row2 = mysqli_fetch_array($gosql2)){
                    $branch = $row2['Bname'];
                    $bcode = $row2['Bcode'];
                    echo  "<option value='".$bcode."'>".$name." - ".$branch."</option>";
                }
                
            }
           
            echo "
            </select>
            
            ";
        }
        
        
        
        
        
        
    }
    
    
    ?>
