<?php

require_once('classes/all.php');

$create = new All($connect);

$date = $_POST['date'];

$create->openingSalesTable($date);



?>