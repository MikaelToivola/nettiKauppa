<?php
require_once("config/config.php");
require_once("tykkays.php");
session_start();

//var_dump($_SESSION);


 date_default_timezone_set('Europe/Helsinki');
/**
 * Created by PhpStorm.
 * User: jyriher
 * Date: 30.11.2017
 * Time: 14.13
 */
?>
<!DOCTYPE html>
<html>
<head>
     
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<div class="container">

    <div id="wrapperHeader">
        <div id="header">
        </div>
    </div>

    <div id="modal" class="hidden">
        <a href="#" class="closeBtn">&#215;</a>
        <video controls>    <!--  src="http://placekitten.com/800/786" -->
    </div>

    <div id="modal2" class="hidden">
        <a href="#" class="closeBtn2">&#215;</a>
        <audio controls>    <!--  src="http://placekitten.com/800/786" -->
    </div>



    <?php require_once("etusivu.php") ?>




<ul id="tuotetiedot">



</ul>


<?php if (isset ($_SESSION['kirjautunut'])) {

    echo "<form method='post'>
    <button id='like' type='submit'  name='tykkaa'><img src='siteImages/tykkays_ikoni.png'></button>
    

    
    </form>";

     require_once('tykkays_laskuri.php');

}

else {

  //  echo("jotain vaan");
}
    ?>



    <?php

  if (isset ($_SESSION['kirjautunut'])) {

      require_once("kommentointi_action.php");


      echo "   
<form method='POST'>
<input type='hidden' name='kayttaja_id' value='" . $_SESSION['id'] . "'>
<input type='hidden' name='pvm' value='" . date('Y-m-d H:i:s') . "'>
<textarea name='kommentti'></textarea>
<button type='submit' id='comment' name='commentSubmit'>Kommentoi</button>
</form>";

  }

  else{

      echo("Kirjautuneena käyttäjänä voit kommentoida ilmoituksia ja lukea toisten kommentteja");
  }

?>

</div>

<script src="js/ilmoitussivu.js"></script>
<script src="js/navbar.js"></script>
</body>
</html>




