<?php
session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
session_start();
?>

<head>
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
</head>

  <div class="welcome">
   <div class="alert-alert success"><?= $_SESSION['message'] ?> </div>
   <span class="user"><img id="tervetulokuva" src='<?= $_SESSION['avatar']?>'></span><br />
      <p>Tervetuloa käyttäjäksi</p>  <span class="user"><?= $_SESSION['username'] ?></span> <br />

      <a id="siirry_etusivulle" href="index.php">Siirry etusivulle</a>

  </div>