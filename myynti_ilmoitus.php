<?php
/**
 * Created by PhpStorm.
 * User: jyriher
 * Date: 20.11.2017
 * Time: 12.20
 */
session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
require_once("config/config.php");
session_start();



SSLon();



//var_dump($_SESSION);

$_SESSION['message'] = '';

//$data['id'] = $_SESSION['id'];




//$data3['id'] = $_SESSION['id'];

//$data3['username'] = $_SESSION['username'];

//$_SESSION['username'] = $username;
//var_dump($_POST);
//echo("myynti-ilmoitusrivi 31");
//echo($_SERVER['REQUEST_METHOD']."rivi31");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {     //molemmat salasanat täsmäävät




    $tuoteNimi = $_POST['tuoteNimi'];
    $kategoria = $_POST['kategoria'];
    $tuotekuvailu = $_POST['tuotekuvailu'];

    $email = $_POST['email_myynti'];

    $hinta = $_POST['hinta'];
    $kuva = $_POST['kuva'];
    $video = $_POST['video'];
    $audio = $_POST['audio'];


    $kategoria_kysely = "SELECT kategoria_id FROM kategoria WHERE kategoria = " . '"' . $kategoria . '"';

    $katsku = $DBH->prepare($kategoria_kysely);
    $katsku->execute();

    $katsku->setFetchMode(PDO::FETCH_OBJ);

    $end = $katsku->fetch();



    $kategoria_id = $end->kategoria_id;

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    //GET USER ID
    $IdSql =  "SELECT id FROM kayttaja WHERE kayttaja.username = " . '"' . $_SESSION["username"] . '"';
   /* $IdSql = $DBH->prepare($IdSql);

    $IdSql->execute($data3);
    $IdSql->setFetchMode(PDO::FETCH_OBJ);

    $tunnus = $IdSql->fetch();
*/
   // echo("rivi 50 hahaa".$IdSql);
   // var_dump($tunnus);


    $getUserId = $DBH->prepare($IdSql);
    $getUserId->execute();
    $userId = $getUserId->fetch();





    console_log($userId["id"]);

    //CHECK FOR SAME NAMED IN myynti_ilmoitus
    $sql_kysely = "SELECT COUNT(*) FROM myynti_ilmoitukset WHERE myynti_ilmoitukset.nimi = " . '"' . $tuoteNimi . '"' ."AND myynti_ilmoitukset.omistaja =" . '"' . $userId[0] . '"';


    $olemassa = $DBH->prepare($sql_kysely);
    $olemassa->execute();
    //$sql_kysely->setFetchMode(PDO::FETCH_OBJ);
    $sql_tulos = $olemassa->fetch();

    // INSERT INTO myynti_ilmoitukset
   // echo($sql_tulos["COUNT(*)"]);


        $target_dir = "./images/";
        $target_file = $target_dir . basename($_FILES["kuva"]["name"]);

        $target_dir2 = "thumbs/";
        $target_file2 = $target_dir2 . basename($_FILES["kuva"]["name"]);

        $target_dir3 = "./audio/";
        $target_file3 = $target_dir3 . basename($_FILES["audio"]["name"]);

        $target_dir4 = "./video/";
        $target_file4 = $target_dir4 . basename($_FILES["video"]["name"]);


        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    $videofileType = pathinfo($target_file4, PATHINFO_EXTENSION);
    $audiofileType = pathinfo($target_file3, PATHINFO_EXTENSION);


    // Check if image file is a actual image or fake image


        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["kuva"]["tmp_name"]);
            echo("mimekoodini".$check["mime"]);
            if ($check !== false) {
                $_SESSION['message']= "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $_SESSION['message']= "File is not an image.";
                $uploadOk = 0;

            }
        }

        if (file_exists($target_file)) {
            $_SESSION['message']= "Sorry, file ".$target_file." already exists.";
            redirect("myynti.php");

            $uploadOk = 0;
        }
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $_SESSION['message']= "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        else {
            $_SESSION['message']= "hyvän näkönen file!";
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $_SESSION['message']=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // ------------ ÄÄNI JA VIDEO CHECK---------------------------------//   &&  $video != "gif"
         if ($videofileType == "mp4" ) {

            $uploadOk = 1;

         } else {
             $_SESSION['message']= "TARVITSET OIKEAN TIEDOSTOMUODON VIDEOIHIN";



         }
        if ($audiofileType == "mp3" ) {

            $uploadOk = 1;

        } else {
            $_SESSION['message']= "TARVITSET OIKEAN TIEDOSTOMUODON AUDIOON";



        }

       /*  if ($audio != "mp3" &&  $audio != "wav" ) {
             echo("HEY YAAAAAAAA HEY YAAAAAA");
             $uploadOk = 0;

         }
*/

     //-----------------------------------------------------------------------//
        if ($uploadOk == 0) {
            $_SESSION['message']= "Sorry, your file was not uploaded.";
       //     redirect("myynti.php");
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["kuva"]["tmp_name"], $target_file)) {
                $_SESSION['message']=  "The file " . basename($_FILES["kuva"]["name"]) . " has been uploaded.";
                // tee thumbnail


           //     $target_dir = "thumbs/";
           //     $target_file2 = $target_dir . basename($_FILES["fileToUpload"]["name"]);

                include_once('inc/easyphpthumbnail.class.php');
                $thumb = new easyphpthumbnail;
                $thumb -> Thumbsize = 120;
                $thumb -> Thumblocation = 'thumbs/';
                $thumb -> Createthumb($target_file,'file');



            } else {
                $_SESSION['message']= "Sorry, there was an error uploading your file.";
            }
        }

    $_SESSION['message']=  'onko ok: '.$uploadOk;

        if ($uploadOk == true ) {
            move_uploaded_file($_FILES["audio"]["tmp_name"], $target_file3);
            move_uploaded_file($_FILES["video"]["tmp_name"], $target_file4);

            $sql_kysely2 = "INSERT INTO myynti_ilmoitukset (nimi, kategoria, hinta, kuva, omistaja, email, thumb, audio, video, kuvaus)" .
                "VALUES ( '$tuoteNimi', '$kategoria_id', '$hinta', '$target_file', '$userId[0]', '$email', '$target_file2', '$target_file3', '$target_file4', '$tuotekuvailu')";//$_0sername ykkösen tilalle!!!!!!
            // echo();
            console_log($sql_kysely2);
            $insert = $DBH->prepare($sql_kysely2);
            $insert->execute();
            //$_SESSION['kirjautunut'] = 'yes';

          //  $_SESSION['KUVA'] = $target_file;

              redirect("index.php");


        }
        else {
            redirect("myynti.php");
           // echo("moikka!".$uploadOk);

        }



}



?>





