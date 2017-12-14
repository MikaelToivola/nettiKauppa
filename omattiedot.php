<?php

require_once("config/config.php");
require_once("omattiedot_action.php");

session_start();
//echo($_SESSION);


?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


<div class="container">


    <div id="wrapperHeader">
        <div id="header">
        </div>
    </div>

    <?php require_once("etusivu.php") ?>

    <h2 id="alku_omat">Omat tietoni</h2>

    <!--      <canvas id="profiili">   </canvas> -->


    <div class="row">
        <div class="column">

            <form class="form_omattiedot" action="omattiedot.php" method="post" enctype="multipart/form-data"
                  id="changepass">

                <h3>Käyttäjänimi: <?php echo $kayttaja->username; ?> <br/></h3>

                <h3>Sähköposti: <?php echo $kayttaja->email; ?> <br/></h3>


                <!--  <input type="text" name="username" value=""/> <br/>  <!-- //$kayttaja->username; -->
                <!--  <input type="email" placeholder="Email" name="email" /> <br/> -->
                <!--  <input type="password" placeholder="Vanha salasana" name="password" autocomplete="new-password" required/> <br/> -->
                <!--placeholder="Uusi salasana"  -->
                <input type="password" placeholder="Uusi salasana" name="newpassword" autocomplete="new-password"
                       required/> <br/>
                <input type="password" placeholder="Vahvista salasana" name="confirmpassword"
                       autocomplete="new-password" required/> <br/>
                <input type="submit" value="Päivitä salasana" name="muuta" class="btn btn-block btn-primary"/>


            </form>

            <form method="post" action="omattiedot.php" class="mailin_vaihto">

                <input type="email" name="new_email" value="<?php echo($kayttaja->email); ?>" required/> <br/>

                <input type="submit" value="Päivitä email" name="email_paivita" class="email_paivitys_button"/>
            </form>

        </div>
        <div class="column">


            <div class="kuvalomake">
                <form method="post" id="kuvaform" action="omattiedot.php" method="post" enctype="multipart/form-data">
                    <img id="proffakuva" src="<?php echo($kayttaja->avatar); ?>"> <br/>
                    <p>Vaihda profiilikuva </p> <input type="file" name="lataaKuva" id="lataaKuva"> <br/>
                    <input type="submit" value="vaihda kuva" name="vaihda" class="btn btn-block btn-primary"/> <br/>
                </form>
            </div>

        </div>
    </div>


    <!-- <h4 id="info">Omat ilmoitukseni:</h4> -->

    <fieldset>
        <legend><h4 id="h4_omat">Omat ilmoitukseni</h4></legend>

        <ul id="kuvat">


        </ul>


    </fieldset>
    <!--  <img src="profile_images/kayntikortti.jpg"> -->

    <script src="js/omattiedot.js"></script>
    <script src="js/navbar.js"></script>
</body>
</html>