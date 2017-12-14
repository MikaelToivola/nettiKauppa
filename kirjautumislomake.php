<?php
require_once("config/config.php");
session_start();
require_once("kirjautuminen.php");
?>
<?php
/**
 * Created by PhpStorm.
 * User: jyriher
 * Date: 20.11.2017
 * Time: 12.20
 */
//session_start();



//$_SESSION['message'] = '';


SSLon();

if (isset($_POST['kirjaudu'])) {
    $data['username'] = $_POST['username'];
    $data['password'] = md5($_POST['password'] . '&%#&%€&');

    $sql_kysely = "SELECT * FROM kayttaja WHERE kayttaja.username= :username AND kayttaja.password = :password";
//echo($sql_kysely);


    $sql_kysely = $DBH->prepare($sql_kysely);

    $sql_kysely->execute($data);
    $sql_kysely->setFetchMode(PDO::FETCH_OBJ);

    $kirjaudu = $sql_kysely->fetch();

   // $_SESSION['username'] = $kirjaudu->username;

   // $_SESSION['id'] = $kirjaudu->id;
    // echo $_SESSION['username'];

    if ($sql_kysely->rowCount() > 0) {
        $okei = "INSERT INTO login (username, login)" .
            "VALUES ('".$_POST['username']."', NOW())";
        $lapi = $DBH->prepare($okei);
        $lapi->execute();
        $_SESSION['kirjautunut'] = 'yes';

        $_SESSION['username'] = $kirjaudu->username;

        $_SESSION['id'] = $kirjaudu->id;

        $_SESSION['avatar'] = $kirjaudu->avatar;

        $_SESSION['email'] = $kirjaudu->email;

        $_SESSION['salasana'] = $kirjaudu->password;
        redirect("index.php");
      //  var_dump($_SESSION);
    } else {
       $_SESSION['message']='Kirjautuminen epäonnistui';
        redirect("kirjautumislomake.php");
    }
}

if (isset($_POST['luotunnukset'])) {
    redirect("rekisterointilomake.php");
}
?>



