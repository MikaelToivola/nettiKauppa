<?php

require_once ("config/config.php");
session_start();
//require_once("logout.php");

//print_r($_SESSION);

if (isset ($_SESSION['kirjautunut'])):
    ?>



    <nav id="topmenu">
        <ul>

           <!-- <label for="toggle">&#9776</label>
            <input type="checkbox" id="toggle"/> -->

            <li><a href="#" class="button">&#9776</a></li>

            <li><a href="index.php">etusivu</a> </li>

            <li><a href="omattiedot.php">omat tiedot</a> </li>

            <li><a href="myynti.php">tee myynti-ilmoitus</a> </li>



            <li><a href="logout.php">kirjaudu ulos</a></li>
        </ul>
    </nav>
    <?php
else:
    ?>

   <!-- <label for="toggle">&#9776</label>
    <input type="checkbox" id="toggle"/> -->
    <nav id="topmenu">
        <ul>

            <li><a href="#" class="button">&#9776</a></li>

            <li><a href="index.php">etusivu</a> </li>

            <li class="right"><a href="kirjautumislomake.php">kirjaudu sisään</a></li>
        </ul>
    </nav>

    <?php
endif;
?>

<h1 id="sivunnimi">SOITINKIRPPIS</h1>



<!--<form action="kirjautumislomake.php" method="post"><input type="submit" value="kirjaudu sisään"></form> -->
<!--<h3>Eli tää on pääsivu ja tänne tulee kaikki hakukentät, myynti-ilmotukset ynnä muu.</h3> -->


<!--<ul> HAE SIVULTA <form action="haku.php"><input type="submit" value="hae sivulta" name="sivuhaku" class="hakunappi"></form></ul> -->


