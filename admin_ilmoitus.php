<?php
/**
 * Created by PhpStorm.
 * User: jyriher
 * Date: 8.12.2017
 * Time: 11.36
 */

session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
session_start();
//var_dump($_SESSION['id']);

require_once("config/config.php");

$ilmoitus_id = $_GET['kID'];


if (!empty($ilmoitus_id))  {

    $sql = "SELECT * FROM kommentointi  WHERE ilmoitus = $ilmoitus_id"; //JOIN kayttaja ON kayttaja.id = kommentointi.kayttaja_id

    $sql = $DBH->prepare($sql);
    $sql->execute();


    try {
        while ($rivi = $sql->fetch()) {
            echo "<div class='comment-box'><p>";
            echo "<br /> " . htmlspecialchars($rivi["username"])  . "  " . $rivi["pvm"] .
                " </br> " . $rivi["kommentti"];
            echo "</p>";


            echo "<form class='delete-form' method='POST'>
<input type='hidden' name='kommentti_id' value='" . $rivi["kom_id"] . "'> 
<button type='submit' name='poista_kommentti'>poista</button>
</form></div>";



        }

    } catch (PDOException $e) {
        die("VIRHE: " . $e->getMessage());
    }

}

if (isset($_POST['poista_kommentti'])) {

    $kommentti_id = $_POST['kommentti_id'];


    $poisto = "DELETE FROM kommentointi WHERE kom_id = " . '"' . $kommentti_id . '"';


    $delete = $DBH->prepare($poisto);
    $delete->execute();

}
?>