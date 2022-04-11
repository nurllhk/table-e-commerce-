<?php include 'header.php'; 
if (isset($_GET['lang'])) {$_SESSION['lang'] = $_GET['lang'];}
if(isset($_GET["lang"])){$dil = $_GET["lang"];}else{$dil = "EN";}
if ($_SESSION['lang']=="TR") { $deger = 1; } elseif ($_SESSION['lang']=="EN") { $deger = 2;} 

  $haksor=$db->prepare("SELECT * FROM hakkimizda where dil_id=:id");
  $haksor->execute(array(
    'id' => $deger
  ));
  $hakcek=$haksor->fetch(PDO::FETCH_ASSOC);

?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html"><?=$language['anasayfa']?></a></li>
          <li><?=$language['hakkimizda']?></li>
        </ol>
        <h2><?=$language['hakkimizda']?></h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        
        <article class="entry">
          <div class="col-lg-12 col-md-12 col-xs-12">
          <img style="width: 100%; max-height: 400px;margin-bottom: 50px;" src="<?php if($_SESSION['lang'] == "TR"){ echo $ayarcek['ayar_hakkimizda']; } else { echo $ayarcek['ayar_hakkimizda_en']; }  ?>" alt="imexup_aboutus">
        </div>
        <div class="section-title" data-aos="fade-up">
          <h2 style="font-size: 24px;"><?php echo $hakcek['hakkimizda_baslik']; ?></h2>
        </div>
          <?php echo $hakcek['hakkimizda_icerik']; ?>
        </article>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

  <?php include 'footer.php'; ?>