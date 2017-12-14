<?php
/**
 * Created by PhpStorm.
 * User: jyriher
 * Date: 8.12.2017
 * Time: 11.25
 */

session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
session_start();

require_once("config/config.php");

require_once("admin_action.php");


?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
<ul id="kuvat">


</ul>


<ul id="tyypit">


</ul>


<script src="js/admin_images.js"></script>
<script src="js/kayttajat_admin.js"></script>
</body>


</html>
