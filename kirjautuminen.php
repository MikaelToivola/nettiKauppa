<?php
/**
 * Created by PhpStorm.
 * User: jyriher
 * Date: 11.12.2017
 * Time: 9.05
 */

?>

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

    <div class="kirjautuminen">
        <h1>Kirjaudu sisään</h1>
        <form class="form_kirjautuminen" action="kirjautumislomake.php" method="post" enctype="multipart/form-data"
              autocomplete="off">
            <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
            <input type="text" placeholder="User Name" name="username" required
                   value="<?php echo $kayttaja->etunimi; ?>"/> <br/>
            <input type="password" placeholder="Password" name="password" autocomplete="new-password" required/> <br/>
            <input type="submit" value="kirjaudu" name="kirjaudu" class="kirjautumis_nappi"/> <br/>

        </form>
    </div>

    <div class="tunnusten_luonti">
        <form method="post">
            <h3>Eikö vielä tunnuksia?</h3>
            <input type="submit" value="luo tunnukset" name="luotunnukset" class="btn btn-block btn-primary"/> <br/>


        </form>
    </div>

</div>


</body>

<script src="js/navbar.js"></script>
