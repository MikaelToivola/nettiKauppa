

<?php

require_once ("config/config.php");
session_start();



//if(empty($_POST["haku1"]) ) {

    $sql = "SELECT * FROM myynti_ilmoitukset";//Ei hinta ehtoa

//var_dump("miks tää ei toimi?=???");


 if(!empty($_POST["haku1"])) {



    $Haku1 = $_POST["haku1"];

     file_put_contents('log/DBErrors.txt', 'Connection: '."Miksi koulu ei aukene meille?  \n", FILE_APPEND);

     //print_r($Haku1.'testiiii');

    $sql= "SELECT * FROM myynti_ilmoitukset WHERE NIMI = ".'"' . $Haku1 . '"';//Ei hinta ehtoa

    if(!empty($_POST["kategoria"])){

        $kategoria_kysely = "SELECT kategoria_id FROM kategoria WHERE kategoria = " . '"' . $_POST["kategoria"] . '"';

        $katsku = $DBH->prepare($kategoria_kysely);
        $katsku->execute();

        $katsku->setFetchMode(PDO::FETCH_OBJ);

        $end = $katsku->fetch();



        $kategoria_id = $end->kategoria_id;


       // $Haku2 = $kategoria_id;
        $sql .= "AND KATEGORIA = ".'"' . $kategoria_id . '"'; //KATEGORIA ehto


    }
    if(!empty($_POST["hinta"])){
        $Haku3 = $_POST["hinta"];
        $sql .= "AND HINTA < ". $Haku3 ; //Hinta ehto
    }


    //echo("Kysely:" . $sql); //Testi, miltä lause näyttää - lainausmerkit kohdallaan?
    //echo("</br>");

}
$omakysely = $DBH->prepare($sql);

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







