<?php
session_save_path('/home2-1/j/jyriher/public_html/PROJEKTI_jyrimikael/sessiot');
session_start();




require_once("config/config.php");

$data['username'] = $_SESSION['username'];
$data2['id'] = $_SESSION['id'];
//$data3['email'] = $_SESSION['email'];
//$data3['newpassword'] = md5($_POST['newpassword'] . '&%#&%€&');
//$data3['avatar'] = $_SESSION['avatar'];

//echo($data['id']);

//echo($_SESSION);

$tieto_kysely = "SELECT * FROM kayttaja WHERE kayttaja.username= :username";

$tieto_kysely = $DBH->prepare($tieto_kysely);

$tieto_kysely->execute($data);
$tieto_kysely->setFetchMode(PDO::FETCH_OBJ);

$kayttaja = $tieto_kysely->fetch();




if (isset($_POST['muuta']) && $_POST['confirmpassword']==$_POST['newpassword']) {    // && $_SESSION['password'] == $_POST['password']   //  && $_POST['confirmpassword']==$_POST['newpassword'
    $_POST['newpassword']=md5($_POST['newpassword'] . '&%#&%€&');
    $paivitys = "UPDATE kayttaja SET password = " . '"' . $_POST['newpassword'] . '"' . " WHERE kayttaja.id = :id";
    $paivitys = $DBH->prepare($paivitys);
    $paivitys->execute($data2);

    //  $kayttaja2 = $paivitys->fetch();

    //  $kayttaja = $kayttaja2;

    // $_SESSION['username'] = $kayttaja->username;
    echo("Salasana vaihdettu!");


    $_SESSION['password'] = $_POST['newpassword'];



    $_SESSION['avatar'];



    // $_SESSION['avatar'] =  $kayttaja->avatar;

} else if ($_POST['confirmpassword'] !== $_POST['newpassword']){

    echo("Salasanat eivät täsmää!");

}


if (isset($_POST['vaihda'])) {

    $target_dir = "profile_images/";
    $target_file = $target_dir . basename($_FILES["lataaKuva"]["name"]);

    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    $_SESSION['avatar'] = $target_file;
// Check if image file is a actual image or fake image


    if (isset($_POST["vaihda"])) {
        $check = getimagesize($_FILES["lataaKuva"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    /*  if (file_exists($target_file)) {
          echo "Sorry, file already exists.";

          $uploadOk = 0;
      } */
    if ($_FILES["lataaKuva"]["size"] > 500000) {
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
        if (move_uploaded_file($_FILES["lataaKuva"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["lataaKuva"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $profiilikuva_vaihto = "UPDATE kayttaja SET avatar = " . '"' . $target_file . '"' . " WHERE kayttaja.id = :id";
    echo($profiilikuva_vaihto);
    $profiilikuva_vaihto = $DBH->prepare($profiilikuva_vaihto);
    $profiilikuva_vaihto->execute($data2);

    // $_SESSION['avatar'] = $kayttaja->avatar;


    //echo('ONNISTUU');



}

if (isset($_POST['poista_ilmoitus'])) {





    $ilmoitus_id = $_POST['myynti_id'];
    $myynti_kuva = $_POST['myynti_kuva'];


    if (array_key_exists('myynti_kuva', $_POST)) {
        $filename = $_POST['myynti_kuva'];
        if (file_exists($filename)) {
            unlink($filename);
            echo 'File '.$filename.' has been deleted';
        } else {
            echo 'Could not delete '.$filename.', file does not exist';
        }
    }


    if (array_key_exists('myynti_video', $_POST)) {
        $filename = $_POST['myynti_video'];
        if (file_exists($filename)) {
            unlink($filename);
            echo 'File '.$filename.' has been deleted';
        } else {
            echo 'Could not delete '.$filename.', file does not exist';
        }
    }

    if (array_key_exists('myynti_audio', $_POST)) {
        $filename = $_POST['myynti_audio'];
        if (file_exists($filename)) {
            unlink($filename);
            echo 'File '.$filename.' has been deleted';
        } else {
            echo 'Could not delete '.$filename.', file does not exist';
        }
    }


   // echo("ID ON".$ilmoitus_id);


    $poisto = "DELETE FROM myynti_ilmoitukset WHERE ID = " . '"' . $ilmoitus_id . '"';

   // echo($poisto);


    $delete = $DBH->prepare($poisto);

    $delete->execute();



}

if (isset($_POST['email_paivita']) && !empty($_POST['new_email'])){

    $paivitys_email = "UPDATE kayttaja SET email = " . '"' . $_POST['new_email'] . '"' . " WHERE kayttaja.id = :id";
  //  echo($paivitys_email);
    $paivitys_email = $DBH->prepare($paivitys_email);
    $paivitys_email->execute($data2);

    //  $kayttaja2 = $paivitys->fetch();

    //  $kayttaja = $kayttaja2;
    //$email_vaihto = $paivitys_email->fetch();
    // $_SESSION['username'] = $kayttaja->username;

    echo("Email vaihdettu!");


    $_SESSION['email'] = $_POST['new_email'];

}

?>


