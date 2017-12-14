<?php
/**
 * Created by PhpStorm.
 * User: jyriher
 * Date: 4.12.2017
 * Time: 13.39
 */
session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
session_start();

require_once("config/config.php");
$ilmoitukseni = "SELECT * FROM myynti_ilmoitukset WHERE omistaja = '".$_SESSION['id']."'";

$omakysely = $DBH->prepare($ilmoitukseni);

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
?>