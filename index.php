<?php
session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
session_start();
//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">

    <meta charset="UTF-8">
    <title>Etusivu</title>
</head>
<body>


<div class="container">



<div id="wrapperHeader">


    <div id="header">
    </div>
</div>

    <?php if ($_SESSION['id'] == 73): ?>

<a href="admin.php">ADMIN RAJATON VALTA</a>

        <?php
    endif;
    ?>



<?php require_once("etusivu.php"); ?>
<?php require_once("hakulomake.php"); ?>
<?php require_once("kuvat.php"); ?>
<?php require_once("myynti_ilmoitus.php"); ?>









</div>
<script src="js/showImg.js"></script>
<script src="js/navbar.js"></script>
</body>

</html>

