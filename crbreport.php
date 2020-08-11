<?php
require_once ('classes/all.php');
$createStation = new All($connect);
    echo "
          
          <table class='table report-table table-striped table-light' >
                        <thead>
                        <tr> 
                        <th scope='col'>CRB#</th>
                        <th scope='col'>Customer</th>
                        <th scope='col'>Kg</th>
                    
                        <th scope='col'>Amount</th>
                        </tr>
                        </thead> ";

                      echo "<tbody>";
            
                      echo $createStation->crbReport();
                      
                      echo "</tbody>";
           echo "</table>" 

?>