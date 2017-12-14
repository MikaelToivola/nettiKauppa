<?php
/**
 * Created by PhpStorm.
 * User: jyriher
 * Date: 27.11.2017
 * Time: 14.59
 */
session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
session_start();
require_once("config/config.php");
require_once("myynti_ilmoitus.php");
?>
<head>
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>



<div class="container">

    <div id="wrapperHeader">
        <div id="header">
        </div>
    </div>

    <?php require_once("etusivu.php"); ?>

    <p id="error_myynti"></p>

    <div class="myynti">
        <h1>Luo myynti-ilmoitus</h1>
        <form class="form_myynti" action="myynti_ilmoitus.php" method="post" enctype="multipart/form-data" autocomplete="off">

            <input type="text" placeholder="tuoteNimi" name="tuoteNimi" required /> <br />
            <!-- <input type="text" placeholder="kategoria" name="kategoria" required/> <br /> -->
            <?php require_once("kategoriat.php") ?>


            <!--Valitse kategoria: <select name="kategoria">
                <option value="PUHALLIN">puhallin</option>
                <option value="KOSKETINSOITIN">kosketinsoitin</option>
                <option value="KIELISOITIN">kielisoitin</option>
                <option value="LYÖMÄSOITIN">lyömäsoitin</option>
            </select> <br>-->

            <input type="number" placeholder="hinta" name="hinta" required/> <br />

            <input type="email" value="<?php echo($_SESSION['email']); ?>" name="email_myynti" placeholder="sähköposti" required/> <br />

            <textarea id ="tuotekuvailu" name="tuotekuvailu" placeholder="Kuvaile tuotetta muutamalla sanalla"></textarea> <br/>
           <!-- <input type="text" placeholder="img" name="kuva" required/> <br /> -->

            <p>Valitse kuva:</p> <input type="file" name="kuva" id="fileToUpload"> <br/>


          <p>  Valitse äänitiedosto: </p>  <input type="file" name="audio" id="audio"> <br/>

           <p>  Valitse video:</p> <input type="file" name="video" id="video"> <br/>

            <!--<div class ="avatar"><label>Upload picture</label><input type="file" name="avatar" accept="image/*"</div> <br/> -->

            <input type="submit" value="julkaise" name="julkaise" class="myynti_julkaisu" /> <br />

        </form>
    </div>


</div>

<script src="js/navbar.js"></script>
