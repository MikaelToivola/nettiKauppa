<?php

session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
session_start();
require_once("config/config.php");

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}
$sql = "SELECT kategoria FROM kategoria";

$omakysely = $DBH->prepare($sql);

$omakysely->execute();


//PRINT RESULTS
try {
    //$kategoriat = array();
    $omakysely->setFetchMode(PDO::FETCH_OBJ);

    ?>

        <select id="kategoria_id" name="kategoria">
        <option value="">Kategoria</option>
        <?php
        while ($rivi = $omakysely->fetch()) {
            console_log($rivi);
            $kategoria = '<option value="'. $rivi->kategoria . '"' .'>'.  $rivi->kategoria  .'</option>';
            echo($kategoria);//$kategoriat[] = $kategoria;
        }?>
    </select> <br>
    <?php



}catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}
?>



