<?php
ob_start();
//session_start();
error_reporting(0);
header('Set-Cookie: ' . session_name() . '=' . session_id() . '; SameSite=None; Secure');
setcookie('' . session_name() . '', '' . session_id() . '', ['samesite' => 'None', 'secure' => true]);


if (!isset($_SESSION["lang"])) {
        require("dil/TR.php");
    }else {
        require("dil/".$_SESSION["lang"].".php");
    }


function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

include 'yonetim/netting/baglan.php';
include 'yonetim/production/fonksiyon.php';
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
  'id' => 0
));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
if (isset($_GET['lang'])) {$_SESSION['lang'] = $_GET['lang'];}
if(isset($_GET["lang"])){$dil = $_GET["lang"];}else{$dil = "NL";}
if ($_SESSION['lang']=="EN") { $deger = 1; } elseif ($_SESSION['lang']=="NL") { $deger = 2;}  
$kod=$_SESSION['kod'];


?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php if($_SESSION['lang']=="EN"){ echo $ayarcek['ayar_title']; } elseif ($_SESSION['lang']=="NL") { echo $ayarcek['ayar_title_en']; }  ?></title>
  <meta name="keywords" content="<?php echo $ayarcek['ayar_keywords']; ?>">
  <meta name="author" content="<?php echo $ayarcek['ayar_author']; ?>">
  <meta name="description" content="<?php echo $ayarcek['ayar_description']; ?>">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Eterna - v2.1.0
  * Template URL: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<?php include 'nav.php' ?>

<style>
  body {

    line-height: 1 !important;

}
</style>