<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$urunsor=$db->prepare("SELECT * FROM urun order by urun_id DESC");
$urunsor->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Listeleme <small>

              <?php 

              if ($_GET['durum']=="ok") {?>

                <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

                <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>

            <div class="clearfix"></div>

            <div align="right">
              <a href="urun-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>

            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kullanıcı Adı</th>
                  <th>Kullanıcı Mail</th>
                  <th>Durum</th>
                </tr>
              </thead>

              <tbody>




                  <tr>
                   <th>

                    <?php 

                    $kategorisor=$db->prepare("SELECT * FROM kullanici where kullanici_yetki=:yetki and kullanici_yetki=:yetki");
                    $kategorisor->execute(array(
                      'id' => 1,
                      'yetki' => 1
                    ));
                     while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) { $say++?>




                    <td><?php echo $kategoricek['kullanici_adi']; ?></td>
                    <td><?php echo $kategoricek['kullanici_mail'] ?></td>


                    
                    

</th>


         

          <td><center><a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
        </tr>



      <?php  }

      ?>


    </tbody>
  </table>

  <!-- Div İçerik Bitişi -->


</div>
</div>
</div>
</div>




</div>
</div>

<!-- /page content -->

<?php include 'footer.php'; ?>
