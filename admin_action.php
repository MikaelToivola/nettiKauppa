<?php

session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
session_start();


require_once("config/config.php");


if (isset($_POST['poista_ilmoitus'])) {



    $ilmoitus_id = $_POST['myynti_id'];
    $myynti_kuva = $_POST['myynti_kuva'];


    if (array_key_exists('myynti_kuva', $_POST)) {
        $filename = $_POST['myynti_kuva'];
        if (file_exists($filename)) {
            unlink($filename);
            echo 'File '.$filename.' has been deleted';
        } else {
            echo 'Could not delete '.$filename.', file does not exist';
        }
    }


    if (array_key_exists('myynti_video', $_POST)) {
        $filename = $_POST['myynti_video'];
        if (file_exists($filename)) {
            unlink($filename);
            echo 'File '.$filename.' has been deleted';
        } else {
            echo 'Could not delete '.$filename.', file does not exist';
        }
    }

    if (array_key_exists('myynti_audio', $_POST)) {
        $filename = $_POST['myynti_audio'];
        if (file_exists($filename)) {
            unlink($filename);
            echo 'File '.$filename.' has been deleted';
        } else {
            echo 'Could not delete '.$filename.', file does not exist';
        }
    }


    echo("ID ON".$ilmoitus_id);


    $poisto = "DELETE FROM myynti_ilmoitukset WHERE ID = " . '"' . $ilmoitus_id . '"';

    echo($poisto);


    $delete = $DBH->prepare($poisto);

    $delete->execute();



}

$tyypit = "SELECT * FROM kayttaja";


  $kayttajat = $DBH->prepare($tyypit);

  $kayttajat->execute();


try {
    while ($rivi = $kayttajat->fetch()) {
        echo "<div class='jee'><p>";
        echo "<br /> " . htmlspecialchars($rivi["username"]);
        echo "</p>";


        echo "<form class='delete-form_kayttaja' method='POST'>
<input type='hidden' name='kayttajan_id' value='" . $rivi["id"] . "'> 
<input type='hidden' name='kayttajan_kuva' value='" . $rivi["avatar"] . "'> 
<button type='submit' name='poista'>poista</button>
</form></div>";

    }

} catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}


if (isset($_POST['poista'])){

    $kayttaja_id = $_POST['kayttajan_id'];


    if (array_key_exists('kayttajan_kuva', $_POST)) {
        $filename = $_POST['kayttajan_kuva'];
        if (file_exists($filename)) {
            unlink($filename);
            echo 'File '.$filename.' has been deleted';
        } else {
            echo 'Could not delete '.$filename.', file does not exist';
        }
    }



    $poisto = "DELETE FROM kayttaja WHERE id = " . '"' . $kayttaja_id . '"';



    $delete = $DBH->prepare($poisto);
    $delete->execute();




}



?>


