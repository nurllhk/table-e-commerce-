<?php include 'header.php'; ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html"><?=$language['anasayfa']?></a></li>
          <li><?=$language['kategoriler']?></li>
        </ol>
        <h2><?=$language['kategoriler']?></h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        <div class="row">

          <div class="col-lg-9 entries">

            <article class="entry">

              <section id="portfolio" class="portfolio">
                <div class="container">



                  <div class="row portfolio-container">


                    <?php

                     $sayfada = 9; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                     $sorgu=$db->prepare("select * from kategori");
                     $sorgu->execute();
                     $toplam_icerik=$sorgu->rowCount();
                     $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                    // eğer sayfa girilmemişse 1 varsayalım.
                     $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                     if($sayfa < 1) $sayfa = 1; 
                // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                     if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
                     $limit = ($sayfa - 1) * $sayfada;



                     //aşağısı bir önceki default kodumuz...
                     if (isset($_GET['sef'])) {


                      $kategorisor=$db->prepare("SELECT * FROM kategori where kategori_seourl=:seourl");
                      $kategorisor->execute(array(
                        'seourl' => $_GET['sef']
                        ));

                      $kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);

                      $kategori_id=$kategoricek['kategori_id'];


                      $urunsor=$db->prepare("SELECT * FROM urun where kategori_id=:kategori_id order by urun_id DESC limit $limit,$sayfada");
                      $urunsor->execute(array(
                        'kategori_id' => $kategori_id
                        ));

                      $say=$urunsor->rowCount();

                     } else {

                      $urunsor=$db->prepare("SELECT * FROM urun order by urun_id DESC limit $limit,$sayfada");
                      $urunsor->execute();

                      $saytoplam=$urunsor->rowCount();

                     }






                     if ($toplam_icerik==0) {
                      echo "Bu kategoride ürün bulunamadı";
                     }


                     while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {
                      ?>


                    <a href="urun-<?=seo($uruncek["urun_ad"]).'?route='.$uruncek["urun_id"]?>" title="More Details" >
                      <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $uruncek['kategori_id']; ?>" title="<?php echo $uruncek['kategori_ad']; ?>">
                        <div class="portfolio-wrap" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
                          <img  src="<?php echo $uruncek['urunfoto_resimyol'] ?>" class="img-fluid" alt="">
                          <div class="portfolio-info">
                            <h4><?php echo $uruncek['urun_ad'] ?></h4>
                            <p><?php echo $uruncek['urun_ad'] ?></p>
                          </div>
                        </div>
                      </div> 
                    </a>

                    <?php } ?>



                  </div>

                </div>
              </section><!-- End Portfolio Section -->

            </article><!-- End blog entry -->


            <div class="blog-pagination">
              <ul class="justify-content-center">
                
                <?php $s=0; while ($s < $toplam_sayfa) { $s++; ?>

                            <?php if ($s==$sayfa) {?>

                
                <li class="active"><a href="kategoriler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
                <?php } else {?>

                  <li><a href="kategoriler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>

                  <?php   } } ?>


                
              </ul>
            </div>

          </div><!-- End blog entries list -->

          <div class="col-lg-3">

            <div class="sidebar">


              <h3 class="sidebar-title"><?=$language['kategoriler']?></h3>
              <div class="sidebar-item categories">
                <ul id="portfolio-flters">


                    <div class="categorybox">
    
    <ul>
       <li data-filter="*" class="filter-active"><a href="#">Hepsi<span>(<?php echo $saytoplam; ?>)</span></a></li>
          <?php 

//bütün kayıtları bir kereye mahsus olmak üzere listeliyoruz; daha doğrusu, bir diziye aktarmak için verileri çekiyoruz

      $query = "SELECT * FROM kategori order by kategori_id";
      $goster = $db->prepare($query);
$goster->execute(); //queriyi tetikliyor

 $toplamSatirSayisi = $goster->rowCount(); //malumunuz üzere sorgudan dönen satır sayısını öğreniyoruz
 
$tumSonuclar = $goster->fetchAll(); //DB'deki bütün satırları ve sutunları $tumSonuclar değişkenine dizi şeklinde aktarıyoruz


//alt kategorisi olmayan kategoriin sayısını öğreniyoruz:
$altKategoriSayisi = 0;
for ($i = 0; $i < $toplamSatirSayisi; $i++) {
  if ($tumSonuclar[$i]['kategori_ust'] == "0") {
    $altKategoriSayisi++;
  }
}



for ($i = 0; $i < $toplamSatirSayisi; $i++) {
  if ($tumSonuclar[$i]['kategori_ust'] == "0") {
    kategori($tumSonuclar[$i]['kategori_id'], $tumSonuclar[$i]['kategori_ad'], $tumSonuclar[$i]['kategori_ust']);
  }
}



function kategori($kategori_id, $kategori_ad, $kategori_ust) {

  global $tumSonuclar;
  global $toplamSatirSayisi;

    //kategorinin, alt kategori sayısını öğreniyoruz:
  $altKategoriSayisi = 0;
  for ($i = 0; $i < $toplamSatirSayisi; $i++) {
    if ($tumSonuclar[$i]['kategori_ust'] == $kategori_id) {
      $altKategoriSayisi++;
    }
  }
    ///////////////////////////////////////////

  ?>

  <!-- Burda Başlıyoruz ana gövde -->
 
   <li data-filter=".filter-<?php echo $kategori_id ?>">
      <a href="#" ><?php echo $kategori_ad ?><span>
    <?php 
    if ($altKategoriSayisi > 0) {
      echo "($altKategoriSayisi)</span>";
    }
    ?>
  </li>

  <?php

    if ($altKategoriSayisi > 0) { //alt kategorisi varsa onları da listele
      echo "<ul style='margin-left: 6px; margin-left: 12px; margin-top: 3px; margin-bottom: 8px;' class='bx-ul'><li>";

      for ($i = 0; $i < $toplamSatirSayisi; $i++) {

        if ($tumSonuclar[$i]['kategori_ust'] == $kategori_id) {
          
          kategori($tumSonuclar[$i]['kategori_id'], "".$tumSonuclar[$i]['kategori_ad'], $tumSonuclar[$i]['kategori_ust']);
        }
      }

      echo "</li></ul>";
    }
    ?>




<!-- Burda Başlıyoruz ana gövde -->

<?php 
}
?>
    </ul>
  </div>




                  

                </ul>

              </div><!-- End sidebar categories-->


              <div class="sidebar-item recent-posts">

              </div><!-- End sidebar recent posts-->

              <h3 class="sidebar-title"><?=$language['tags']?></h3>
              <div class="sidebar-item tags">
                <a href="#"></a><ul>
                  <?php

                  $limit = 15;
                  $urunsor=$db->prepare("SELECT * FROM urun limit $limit");
                  $urunsor->execute();

                     


                   while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <li><a href="#"> <?php echo $uruncek['urun_ad']; ?> </a></li>
                  <?php } ?>

                </ul>

              </div><!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

  <?php include 'footer.php'; ?>