<?php
require_once("config/config.php");

session_start();


/**
 * Created by PhpStorm.
 * User: jyriher
 * Date: 7.12.2017
 * Time: 9.43
 */

$ilmoitus_id = $_GET['kID'];
$kayttajan_id = $_SESSION['id'];
$username = $_SESSION['username'];

/*
$sql = "SELECT * FROM kayttaja JOIN tykkays ON kayttaja.id = tykkays.kayttaja WHERE ilmoitus = $ilmoitus_id;";

$tykkaaminen = $DBH->prepare($sql);
$tykkaaminen->execute();

//echo($sql);

function debug_to_console($data) {
                if(is_array($data) || is_object($data))
                {
                    echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
                } else {
                    echo("<script>console.log('PHP: ".$data."');</script>");
                }
            }

*/

if (isset($_SESSION['kirjautunut']) && !empty($_SESSION['id'])) {

$sql = "SELECT * FROM tykkays WHERE kayttaja = $kayttajan_id AND kohde = $ilmoitus_id";

$tsekkaus = $DBH->prepare($sql);
$tsekkaus->execute();

$lopputulos = $tsekkaus->fetch();

}else if(isset($_SESSION['kirjautunut']) && empty($_SESSION['id'])){
    $sql_id = "SELECT * FROM kayttaja WHERE kayttaja.username= '$username' ";//"SELECT * FROM kayttaja WHERE kayttaja.username = '$username'";

    $id_kysely =$DBH->prepare($sql_id);
    $id_kysely->execute();

    $id_kysely->setFetchMode(PDO::FETCH_OBJ);

    $loppu = $id_kysely->fetch();

    //console_log("Tässä on tulos:" . $loppu);
    //console_log("Tässä on tulos:" + $loppu);

    $_SESSION['id'] = $loppu->id;
}


if (isset($_POST['tykkaa']) && empty($lopputulos)) {

    $sql2 = "INSERT INTO tykkays (kayttaja, kohde)  VALUES ($kayttajan_id, $ilmoitus_id)";

    $tykkaaminen = $DBH->prepare($sql2);
    $tykkaaminen->execute();


   // echo("KOKEILLAAN, JOS TÄÄ KOODI JOPA TOIMIS");

}

//$sql2 = "INSERT INTO tykkays "

?>