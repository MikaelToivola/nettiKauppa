



<?php

require_once ("config/config.php");
session_start();
//require_once ("myynti.php");

//$haku1= 61;
$sql= "SELECT * FROM myynti_ilmoitukset WHERE ID = :ID ";       //Ei hinta ehtoa ,  WHERE ID = 67 \".'\"' . $Haku1 . '\"';


$omakysely = $DBH->prepare($sql);
$omakysely->bindParam(':ID', $_GET['kID']);

$omakysely->execute();

//PRINT RESULTS
try{
    $rivit = array();
    $omakysely->setFetchMode(PDO::FETCH_OBJ);
    while ($rivi = $omakysely->fetch()) {
        //echo"<br /> " .htmlspecialchars($rivi["ID"]). " " .htmlspecialchars($rivi["NIMI"]);
        $rivit[] = $rivi;

    }
    //Muunna oliotaulukko json string muotoon
    $jsonString = json_encode($rivit);
    //Palauta vastaus Ajax-pyyntöön
    echo($jsonString);

    $f = @fopen("log/DBErrors.txt", "r+");
    if ($f !== false) {
        ftruncate($f, 0);
        fclose($f);
    }

    file_put_contents('log/DBErrors.txt', $jsonString, FILE_APPEND);

} catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}




/**
 * Created by PhpStorm.
 * User: jyriher
 * Date: 30.11.2017
 * Time: 10.47
 */
?>


