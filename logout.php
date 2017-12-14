<?php
session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
session_start();

require_once("config/config.php");

  session_destroy();
  // redirect('etusivu.php');
    redirect("goodbye.php");
print_r($_SESSION);
?>