<?php include 'header.php' 



?>


<!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        <div class="carousel-inner" role="listbox">
<?php 
$slidersor=$db->prepare("SELECT * FROM slider where slider_durum=:durum order by slider_sira ASC");
$slidersor->execute(array(
'durum' => 1
));
$say= 0;
while($slidercek=$slidersor->fetch(PDO::FETCH_ASSOC)) { $say++;
    ?>
          <!-- Slide 1 -->
          <div class="carousel-item <?php if($say == 1){ echo "active"; } ?>" style="background: url(<?php echo $slidercek['slider_resimyol']; ?>)">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown"><?php echo $slidercek['slider_ad']; ?></h2>
                <p class="animate__animated animate__fadeInUp"><?php echo $slidercek['slider_alt']; ?></p>

                <?php if (isset($slidercek['slider_url'])) { ?>
                  <a href="<?php echo $slidercek['slider_url']; ?>" class="btn-get-started animate__animated animate__fadeInUp"><?=$language['pvplinkekle']?></a>
               <?php } ?>
                
              </div>
            </div>
          </div>

 <?php } ?>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon icofont-rounded-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon icofont-rounded-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Featured Section ======= -->
    <section id="featured" class="featured">
      <div class="container">

        <div class="row">
          <div class="col-lg-4">
            <div class="icon-box">
              <i class="icofont-computer"></i>
              <h3><a href=""><?=$language['baslik1']?></a></h3>
              <p><?=$language['altbaslik1']?></p>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="icofont-image"></i>
              <h3><a href=""><?=$language['baslik2']?></a></h3>
              <p><?=$language['altbaslik2']?></p>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="icofont-tasks-alt"></i>
              <h3><a href=""><?=$language['baslik3']?></a></h3>
              <p><?=$language['altbaslik3']?></p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Featured Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <img src="<?php if ($_SESSION['lang'] == "NL"){ echo $ayarcek['ayar_home_image_en']; } else { echo $ayarcek['ayar_home_image']; } ?>" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content">
            <h3><?php if ($_SESSION['lang'] == "NL"){ echo $ayarcek['ayar_home_baslik_en']; } else { echo $ayarcek['ayar_home_baslik']; } ?></h3>
            
            <p><?php if ($_SESSION['lang'] == "NL"){ echo $ayarcek['ayar_home_icerik_en']; } else { echo $ayarcek['ayar_home_icerik']; } ?>
        
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->




  </main><!-- End #main -->

  <?php include 'footer.php' ?>