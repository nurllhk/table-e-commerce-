<?php 

include 'header.php';


?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">


    </div>

    <div class="col-md-12">
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

        </div>
      </div>
    </div>


    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
             <div align="left" class="col-md-6">
              <h2 >Resim İşlemleri <small>
                <?php
                if ($_GET['durum']=='ok') {?> 
                
                <b style="color:green;">İşlem başarılı...</b>

                <?php } elseif ($_GET['durum']=='no')  {?>

                <b style="color:red;">İşlem Başarısız...</b>

                <?php } ?></small></h2><br>
              </div>
              <form  action="../netting/islem.php" method="POST" enctype="multipart/form-data">

                <div align="right" class="col-md-6">
                  <button type="submit" name="galerifotosil"  class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i> Seçilenleri Sil</button>
                  <a class="btn btn-success" href="galeri-foto-yukle.php?urun_id=<?php echo $_GET['urun_id'];?>"><i class="fa fa-plus" aria-hidden="true"></i> Fotoğraf Yükle</a>
                </div>
                <div class="clearfix"></div>
              </div>


              <div class="x_content">


                <?php

                $sayfada = 25; // sayfada gösterilecek içerik miktarını belirtiyoruz.


                $sorgu=$db->prepare("select * from galeri");
                $sorgu->execute();
                $toplam_urunfoto=$sorgu->rowCount();

                $toplam_sayfa = ceil($toplam_urunfoto / $sayfada);

                  // eğer sayfa girilmemişse 1 varsayalım.
                $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

          // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                if($sayfa < 1) $sayfa = 1; 

        // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 

                $limit = ($sayfa - 1) * $sayfada;

                $urunfotosor=$db->prepare("select * from galeri order by id DESC limit $limit,$sayfada");
                $urunfotosor->execute(array(
                  'urun_id' => $_GET['urun_id']
                  ));

                  while($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)) { ?>



                  <div class="col-md-2">
                   <label>
                    <div class="image view view-first">
                      <img style="width: 200px; height: 200px; display: block;" src="../../<?php echo $urunfotocek['urunfoto_resimyol']; ?>" alt="image" />


                    </div>

                    <?php  array("$galerifotosec"); ?>


                    <input type="checkbox" name="galerifotosec[]"  value="<?php echo $urunfotocek['id']; ?>" > Seç
                  </label>


                </div>

                <?php } ?>

                <div align="right" class="col-md-12">
                  <ul class="pagination">

                    <?php

                    $s=0;

                    while ($s < $toplam_sayfa) {

                      $s++; ?>

                      <?php 

                      if ($s==$sayfa) {?>

                      <li class="active">

                        <a href="urunfoto.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

                      </li>

                      <?php } else {?>


                      <li>

                        <a href="urunfoto.php?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

                      </li>

                      <?php   }

                    }

                    ?>

                  </ul>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<style>
  .view .mask, .view .content {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
    top: 130px;
    left: 0;
}
</style>



<?php include 'footer.php'; ?>
