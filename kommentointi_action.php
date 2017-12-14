<?php
session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
session_start();
//var_dump($_SESSION['id']);

require_once("config/config.php");

/*
$data['username'] = $_SESSION['username'];


$id_kysely = "SELECT * FROM kayttaja WHERE kayttaja.username= :username";
$id_kysely = $DBH->prepare($id_kysely);
$id_kysely->execute($data);
$id_kysely->setFetchMode(PDO::FETCH_OBJ);
$id_tulos = $id_kysely->fetch();

*/


if (isset($_POST['commentSubmit']) && !empty($_POST['kommentti'])) {

    $kayttaja_id = $_POST['kayttaja_id'];
    $pvm = $_POST['pvm'];
    $kommentti = $_POST['kommentti'];
    $ilmoitus_id = $_GET['kID'];

    // $_SESSION['kID'] = $ilmoitus_id;

    //echo($kayttaja_id);

    $sql = "INSERT INTO kommentointi (kayttaja_id, pvm, kommentti, ilmoitus) VALUES ('$kayttaja_id', '$pvm', '$kommentti', $ilmoitus_id)";


    //  echo($sql);
    $kommentoi = $DBH->prepare($sql);
    $kommentoi->execute();

    //   $kommentoi->id;


    // echo("MORO KAIKKI!");

}

$ilmoitus_id = $_GET['kID'];


$sql = "SELECT * FROM kommentointi JOIN kayttaja ON kayttaja.id = kommentointi.kayttaja_id WHERE ilmoitus = $ilmoitus_id;";

$sql = $DBH->prepare($sql);
$sql->execute();

try {
    while ($rivi = $sql->fetch()) {
        echo "<div class='comment-box'><p>";
        echo "<br /> " . htmlspecialchars($rivi["username"]) . "  " . $rivi["pvm"] .
            " </br> " . $rivi["kommentti"];
        echo "</p>";

        if ($_SESSION['id'] == $rivi['id'])  {
        echo "<form class='delete-form' method='POST'>
            <input type='hidden' name='kommentti_id' value='" . $rivi["kom_id"] . "'> 
            <button type='submit' name='poista'>poista</button>
            </form>";

        }

        echo("</div>");

    }



} catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}


if (isset($_POST['poista'])) {

    $kommentti_id = $_POST['kommentti_id'];


    $poisto = "DELETE FROM kommentointi WHERE kom_id = " . '"' . $kommentti_id . '"';


    $delete = $DBH->prepare($poisto);
    $delete->execute();

    redirect("ilmoitussivu.php" . "?kID=" . $ilmoitus_id );


}

?>