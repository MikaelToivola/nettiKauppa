<?php

require_once ("config/config.php");
session_start();


$ilmoitus_id = $_GET['kID'];

$lasku = "SELECT COUNT(*) FROM tykkays where kohde = $ilmoitus_id ";


$calculate = $DBH->prepare($lasku);
$calculate->execute();

$result = $calculate->fetch();

echo($result["COUNT(*)"]);



?>