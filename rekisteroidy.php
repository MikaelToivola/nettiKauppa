<?php
/**
 * Created by PhpStorm.
 * User: jyriher
 * Date: 11.12.2017
 * Time: 9.10
 */
require_once("config/config.php");
require_once("omattiedot_action.php");

session_start();

?>

<!DOCTYPE HTML>
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


    <div id="rekisterointi_div">
        <h1>Rekisteröidy käyttäjäksi</h1>
        <form class="form_rekisteroidy" action="rekisterointilomake.php" method="post" enctype="multipart/form-data"
              autocomplete="off">
            <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
            <input type="text" placeholder="User Name" name="username" required/> <br/>
            <input type="email" placeholder="Email" name="email" required/> <br/>
            <input type="password" placeholder="Password" name="password" autocomplete="new-password" required/> <br/>
            <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password"
                   required/> <br/>
            <!--   <div class ="avatar"><label>Select your profile picture</label><input type="file" name="avatar" accept="image/*"</div> <br/> -->

            <input type="file" name="fileToUpload" id="fileToUpload"> <br/>
            <input type="submit" value="Rekisteröidy" name="submit" id="rekisterointi_button"/> <br/>
        </form>
    </div>

    <script src="js/navbar.js"></script>
</body>
</html>