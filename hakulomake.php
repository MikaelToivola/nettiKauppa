<?php
require_once ("config/config.php");
session_start();
//include('functions/functions.php');
//SSLon();
?>


<!-- TÄSSÄ ON TÄÄ UUS KOODI -->


<fieldset id="hakufield"><legend><p>Haku</p></legend>
    <form method="post" action="haku.php" id="tuotehaku">
        <input type="text" name="haku1" placeholder="Hakusana" id="haku1">
        <br>
        <input type="number" name="hinta" placeholder="Hinta" id="haku1">
        <br>

        <div id="kategoria_haku">
        <?php require_once ("kategoriat.php") ?>
        </div>

        <input type="submit" id="nappi" value="Lähetä">
    </form>

</fieldset>


