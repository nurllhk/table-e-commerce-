<?php
ob_start();
session_start();
date_default_timezone_set('Europe/Istanbul');
if ($_SESSION['lang']=="") {
  $_SESSION['lang'] = "NL";
}
error_reporting(0);
include '../netting/baglan.php';
include 'fonksiyon.php';


if (isset($_GET['lang'])) {$_SESSION['lang'] = $_GET['lang'];}
if(isset($_GET["lang"])){$dil = $_GET["lang"];}else{$dil = "NL";}
if ($_SESSION['lang']=="TR") { $deger = 1; } elseif ($_SESSION['lang']=="NL") { $deger = 2;} 
//Belirli veriyi seçme işlemi
$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
  'id' => 0
  ));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

//Belirli veriyi seçme işlemi
$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:id");
$urunsor->execute(array(
  'id' => $_GET['urun_id']
  ));
$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

//Belirli veriyi seçme işlemi
$dilsor=$db->prepare("SELECT * FROM diller where dil_ad=:ad");
$dilsor->execute(array(
  'ad' => $_SESSION['lang']
  ));
$dilcek=$dilsor->fetch(PDO::FETCH_ASSOC);


$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
$kullanicisor->execute(array(
  'mail' => $_SESSION['kullanici_mail']
  ));
$say=$kullanicisor->rowCount();
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

if ($say==0) {

  Header("Location:login.php?durum=izinsiz");
  exit;

}



//1.Yöntem
/*
if (!isset($_SESSION['kullanici_mail'])) {


}
*/
?>


<!DOCTYPE html>
<html lang="NL">
<head>
  <META http-equiv="Page-Enter" content="blendTrans(Duration=1)">
<META http-equiv="Page-Exit" content="blendTrans(Duration=1)">
<META http-equiv="Site-Enter" content="blendTrans(Duration=1)">
<META http-equiv="Site-Exit" content="blendTrans(Duration=1)">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin Panel</title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


 <!-- Dropzone.js -->

  <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">



  <!-- Dropzone.js -->

  <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>
  <!-- Ck Editör -->
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>


  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Hoşgeldin</span>
              <h2><?php echo $kullanicicek['kullanici_adsoyad'] ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Admin Panel</h3>
              <ul class="nav side-menu">

                <li><a href="index"><i class="fa fa-home"></i> Anasayfa </a></li>

                <li><a><i class="fa fa-cogs"></i> Site Ayarları <span class="fa fa-cogs"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="genel-ayar.php">Genel Ayarlar</a></li>
                    <li><a href="iletisim-ayarlar.php">İletişim Ayarlar</a></li>
                    <li><a href="sosyal-ayar.php">Sosyal Ayarlar</a></li>
                    <!--

                    Facebook
                    Twitter
                    Youtube
                    Google


                  -->
                  <li><a href="mail-ayar.php">Mail Ayarlar</a></li>

                     <!--

                   Smtp Host
                   Smtp User
                   Smtp Password
                   Smtp Port


                 -->


               </ul>
             </li>

             <li><a href="hakkimizda.php"><i class="fa fa-info"></i> Hakkımızda </a></li>

             <li><a href="slider.php"><i class="fa fa-user"></i> Slider </a></li>


             <!-- <li><a href="hizmetlerimiz.php"><i class="fa fa-list"></i>Hizmetlerimiz </a></li> -->

             <!-- <li><a href="blog.php"><i class="fa fa-list"></i>Blog </a></li> -->


             <li><a href="kategori.php"><i class="fa fa-book"></i>Kategoriler </a></li>
             
             <li><a href="urun.php"><i class="fa fa-list"></i>Ürün Sayfası </a></li>

              <!-- <li><a href="products.php"><i class="fa fa-shopping-basket"></i>Satış Ürünler </a></li> -->

            
             
            



             

           </ul>
         </div>



       </div>
       <!-- /sidebar menu -->

       <!-- /menu footer buttons -->
<!--        <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
          <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
          <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
          <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout">
          <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
      </div> -->
      <!-- /menu footer buttons -->
    </div>
  </div>

  <!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <ul class="nav navbar-nav navbar">
          <li class="">
<?php $url=$_SERVER['REQUEST_URI']; $bol = explode("/", $_SERVER['REQUEST_URI']); $sayfaAdi = $bol[4]; 
        if ($sayfaAdi != "iletisim-ayarlar.php") { ?>
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <b><?php if($_SESSION['lang']=="TR"){ echo "Türkçe"; } elseif ($_SESSION['lang']=="NL") { echo "Flemenkçe"; }  ?></b>
              <span class=" fa fa-angle-down"></span>
            </a>

            <ul style="width: 25px; margin-right: 0px !important; "  class="dropdown-menu dropdown-usermenu pull-right">
              <a href="lang.php?lang=TR"><li style="margin-right: 0px !important;margin-right: 0px !important;
    height: 35px;
    font-size: 13px;
    text-align: center;
    padding: 9px;
     <?php if($_SESSION['lang']=="TR"){ echo "background-color: aliceblue;"; } ?>"><b style="font-weight: 700;">TÜRKÇE</b></li></a>

     
              <a href="lang.php?lang=NL"><li style="margin-right: 0px !important;margin-right: 0px !important;height: 35px;font-size: 13px;text-align: center;padding: 9px;
     <?php if($_SESSION['lang']=="NL"){ echo "background-color: aliceblue;"; } ?>"><b style="font-weight: 700;">FLEMENKÇE</b></li></a>
            </ul>
          </li>

<?php } ?>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li class="">

  
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="images/user.png" alt=""><?php echo $kullanicicek['kullanici_adsoyad'] ?>
              <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <li><a href="profilim.php"> Profil Bilgilerim</a></li>

              
              <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Güvenli Çıkış</a></li>
            </ul>
          </li>


        </ul>

      </nav>
    </div>
  </div>
        <!-- /top navigation -->

        <style>
          .dropdown-menu {

    min-width: 127px !important;
  
}
</style>