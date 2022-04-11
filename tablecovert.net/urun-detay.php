<?php include 'header.php';

$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
$urunsor->execute(array(
  'urun_id' => $_GET['route']
  ));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

$say=$urunsor->rowCount();

if ($say==0) {
  
  header("Location:index.php?durum=oynasma");
  exit;
}

 ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html"><?=$language['anasayfa']?></a></li>
          <li><?=$language['urunlerimiz']?></li>
        </ol>
        <h2><?php echo $uruncek['urun_ad'] ?></h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">


        <div class="row" style="margin-top: 15px; min-height: 550px; padding: 55px;box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px; ">

          <div class="col-lg-6">
            <h2 class="portfolio-title" style="color: #120b0a;"><?php echo $uruncek['urun_ad'] ?></h2>
            <div class="owl-carousel portfolio-details-carousel">


              <?php
          $urun_id=$uruncek['urun_id'];
          $urunfotosor=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id limit 0,3 ");
          $urunfotosor->execute(array(
            'urun_id' => $urun_id
            ));

          while($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)) {

          ?>

              <img src="<?php echo $urunfotocek['urunfoto_resimyol'] ?>" class="img-fluid" alt="">
             <?php } ?>
            </div>
          </div>


          <div class="col-lg-6 portfolio-info">
            <h3 style="color: #120b0a;"><?=$language['proje']?></h3>
            <ul>
              <li style="color: #120b0a;"><strong>Ürün Adı</strong>: <?php echo $uruncek['urun_ad'] ?></li>
              
            </ul>

            <p>
             
            </p>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12" style="margin-top: 35px; min-height: 210px; padding: 35px;box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;background-color: #3b3b3b;opacity: 0.9;text-shadow: 2px 2px 2px rgb(0 0 0 / 60%); font-size:14px; color: #fbe1dd;
    font-size: 14px;
    border-top: 7px solid;">
             <?php echo $uruncek['urun_detay'] ?>
           </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <?php include 'footer.php'; ?>