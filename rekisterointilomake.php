<?php
require_once("config/config.php");
session_start();

require_once("rekisteroidy.php");
$_SESSION['message'] = '';

SSLon();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {     //molemmat salasanat täsmäävät

    if ($_POST['password'] == $_POST['confirmpassword']) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password'] . '&%#&%€&');        //md5 hash password security


        $_SESSION['username'] = $username;


        $sql2 = "SELECT COUNT(*) FROM kayttaja WHERE kayttaja.username=" . '"' . $username . '"';       //". '"'.$email.'"'


        //jos kaikki OK, ohjautuu tervetulo sivulle

        $olemassa = $DBH->prepare($sql2);
        $olemassa->execute();

        $tulos = $olemassa->fetch();
        // $sql2= "SELECT COUNT(*) FROM kayttaja WHERE kayttaja.email=". '"'.$email.'"';
        //     echo($sql2);
        // $kysely1 = $DBH->prepare("SELECT COUNT(*) FROM kayttaja WHERE kayttaja.email=$email");

//        echo("jee". $tulos["COUNT(*)"]);

        if ($tulos["COUNT(*)"] > 0) {

            $_SESSION['message']="Käyttäjänimi on jo olemassa, valitse toinen!";


        } else {

            $target_dir = "profile_images/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image


            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";

                $uploadOk = 0;
            }
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }




            //($omakysely->execute())
            $sql = "INSERT INTO kayttaja (username, email, password, avatar)"
                . "VALUES ('$username', '$email', '$password', '$target_file')";
            $omakysely = $DBH->prepare($sql);
            $omakysely->execute();
          //  $_SESSION['message'] = "Rekisteröiminen onnistui! $username lisätty tietokantaan!";
            $_SESSION['kirjautunut'] = 'yes';

            $_SESSION['username'] = $username;

            $_SESSION['email'] =$email;

            $_SESSION['avatar'] = $target_file;
           // var_dump($_SESSION);

            //  $_SESSION['avatar'] = $target_file;
            redirect("welcome.php");

        }


    } else {
        $_SESSION['message'] = "Salasanat eivät täsmää!";
    }
}


?>

