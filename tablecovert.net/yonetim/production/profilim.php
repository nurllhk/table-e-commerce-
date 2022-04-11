<?php 
include 'header.php';

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Admin Panel <small> Panele Hoşgeldiniz.</small></h2>
            

            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <?php 

            if ($_GET['durum']=="no") {?>

            <div class="alert alert-danger">
              <strong>Hata!</strong> İşlem Başarısız
            </div>                   
            
            <?php } else if ($_GET['durum']=="ok") {?>

            <div class="alert alert-success">
              <strong>Bilgi!</strong> İşlem Başarılı
            </div>                   
            
            <?php }  else if ($_GET['durum']=="eskisifrehata") {?>

            <div class="alert alert-danger">
              <strong>Bilgi!</strong> Eski Şifreniz Hatalı
            </div>                   
            
            <?php } else if ($_GET['durum']=="sifreleruyusmuyor") {?>

            <div class="alert alert-danger">
              <strong>Bilgi!</strong> Şifreler Uyuşmuyor
            </div>                   
            
            <?php } else if ($_GET['durum']=="eksiksifre") {?>

            <div class="alert alert-danger">
              <strong>Bilgi!</strong> Şifreniz En Az 6 Karakter Olmalı!
            </div>   

            <?php } else if ($_GET['durum']=="sifredegisti") {?>

            <div class="alert alert-success">
              <strong>Bilgi!</strong> Şifreniz Başarıyla Değiştirildi!
            </div>   
            <?php }
            ?>

            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">

                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Eski Şifre <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="first-name" name="kullanici_eskipassword" placeholder="Eski Şifrenizi Girin!" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yeni Şifre <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="first-name" name="kullanici_passwordone" placeholder="Yeni Şifrenizi Girin!" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yeni Şifre Tekrar<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="first-name" name="kullanici_passwordtwo" placeholder="Tekrar Yeni Şifrenizi Girin!" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="ln_solid"></div>
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="sifreguncelle" class="btn btn-success">Güncelle</button>
                </div>
              </div>

            </form>



          </div>
        </div>
      </div>

      <!-- Bitiyor -->




    </div>
  </div>
</div>
<!-- /page content -->



<?php include 'footer.php'; ?>