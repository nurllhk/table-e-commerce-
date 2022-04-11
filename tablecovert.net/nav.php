<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i><a href="mailto:<?php echo $ayarcek['ayar_mail'] ?>"><?php echo $ayarcek['ayar_mail'] ?></a>
        <i class="icofont-phone"></i> <?php echo $ayarcek['ayar_tel'] ?>
      </div>
      <div class="social-links" style="margin-right: 15px;">
        
       <div class="row">
          

          <?php if ($_SESSION['lang'] == "TR") { ?>

            <div style="height: 22px; border-bottom: 3px solid #e96b56; display: inline-block; margin-left: 4px;"><a style="margin-right: 4px; margin-left: 3px;" href="lang.php?lang=TR">EN</a></div>

          <?php } else { ?>

          <div style="height: 22px;"><a style="margin-right: 4px; display: inline-block; margin-left: 3px;" href="lang.php?lang=TR">EN</a></div>

          <?php } if ($_SESSION['lang'] == "NL") {  ?>

            <div style="height: 22px; border-bottom: 3px solid #e96b56;"><a style="margin-right: 4px; display: inline-block; margin-left: 3px;" href="lang.php?lang=NL">NL</a></div>

            <?php } else { ?>

              <div style="height: 22px;"><a style="margin-right: 4px; display: inline-block; margin-left: 3px;" href="lang.php?lang=NL">NL</a></div>

              <?php } ?>
       
</div>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container d-flex">

      <div class="logo mr-auto">

        <h1 class="text-light"><a href="homepage"><img style="max-height: 40px;" src="<?php echo $ayarcek['ayar_logo']; ?>"><span> <?=$language['logo']?> </span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">


       
        <ul>
          <li class="<?php  $url=$_SERVER['REQUEST_URI']; $bol = explode("/", $_SERVER['REQUEST_URI']); $sayfaAdi = $bol[2]; 
        if ($sayfaAdi == "homepage") { echo "active"; } ?>"><a href="homepage"><?php echo $language["anasayfa"];?></a></li>

          <!--
          <li class="drop-down"><a href="#"><?=$language['hakkimizda']?></a>
            <ul>
              <li><a href="about.html"><?=$language['hakkimizda']?></a></li>



            </ul>
          </li>
        -->
          <!--
          <li><a href="services.html">Services</a></li>
          <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="pricing.html">Pricing</a></li>
          -->
          <li class="<?php  $url=$_SERVER['REQUEST_URI']; $bol = explode("/", $_SERVER['REQUEST_URI']); $sayfaAdi = $bol[2]; 
        if ($sayfaAdi == "hakkimizda") { echo "active"; } ?>"><a href="hakkimizda"><?=$language['hakkimizda']?></a></li>
          <li class="<?php  $url=$_SERVER['REQUEST_URI']; $bol = explode("/", $_SERVER['REQUEST_URI']); $sayfaAdi = $bol[2]; 
        if ($sayfaAdi == "kategoriler") { echo "active"; } ?>"><a href="kategoriler"><?=$language['kategoriler']?></a></li>
          <li class="<?php  $url=$_SERVER['REQUEST_URI']; $bol = explode("/", $_SERVER['REQUEST_URI']); $sayfaAdi = $bol[2]; 
        if ($sayfaAdi == "iletisim") { echo "active"; } ?>"><a href="iletisim"><?=$language['iletisim']?></a></li>

         

        </ul>

        <div class="row" style="position: absolute;
    bottom: 0px;
    width: 100%;">
        <div class="col-6">
         <?php if(isMobile()){

          if ($_SESSION['lang'] == "TR") { ?>

            <div style="margin-top: 15px; text-align: center;border-bottom: 8px solid #e96b56; border-top: 2px solid lightcoral;"><a style="margin-right: 4px; margin-left: 3px;" href="lang.php?lang=TR">TR</a></div>

          <?php } else { ?>

          <div style="margin-top: 15px;text-align: center; border-top: 2px solid lightcoral;"><a style="margin-right: 4px; " href="lang.php?lang=TR">TR</a></div>

          <?php } ?>
        </div>
        <div class="col-6">
          <?php if ($_SESSION['lang'] == "NL") {  ?>

            <div style="margin-top: 15px;text-align: center;border-bottom: 8px solid #e96b56; border-top: 2px solid lightcoral;"><a style="margin-right: 4px; margin-left: 3px;" href="lang.php?lang=NL">NL</a></div>

            <?php } else { ?>

              <div style="margin-top: 15px;text-align: center;"><a style="margin-right: 4px; border-top: 2px solid lightcoral;" href="lang.php?lang=NL">NL</a></div>
              </div>
        
              <?php } } ?>
        
</div>

             
  

      </nav><!-- .nav-menu -->


    </div>
  </header><!-- End Header -->

  <style>

    #topbar .social-links a {
     padding-left: 0px !important;
}
       </style>