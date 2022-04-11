<?php 

include 'header.php'; 
if (isset($_GET['lang'])) {$_SESSION['lang'] = $_GET['lang'];}
if(isset($_GET["lang"])){$dil = $_GET["lang"];}else{$dil = "EN";}
if ($_SESSION['lang']=="TR") { $deger = 1; } elseif ($_SESSION['lang']=="EN") { $deger = 2;} 

//Belirli veriyi seçme işlemi
$hakkimizdasor=$db->prepare("SELECT * FROM ayar");
$hakkimizdasor->execute();
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Anasayfa Ayarları <small>

              <?php 

              if ($_GET['durum']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>
            </small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

             <form action="../netting/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Görsel<br><span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <?php 
                  if (strlen($ayarcek['ayar_home_image'])>0) {?>

                    <img width="200"  src="../../<?php if($_SESSION['lang'] == "NL") { echo $ayarcek['ayar_home_image_en']; } else { echo $ayarcek['ayar_home_image']; } ?>">

                  <?php } else {?>


                    <img width="200"  src="../../images/resim-yok.png">


                  <?php } ?>


                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Görsel Seç<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="first-name"  name="<?php if ($_SESSION['lang'] == "NL"){ echo "ayar_home_image_en"; } else { echo "ayar_home_image"; } ?>" required=""  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <input type="hidden" name="eski_yol" value="<?php echo $ayarcek['ayar_home_image']; ?>">
              <input type="hidden" name="eski_yol_en" value="<?php echo $ayarcek['ayar_home_image_en']; ?>">
              <input type="hidden" name="lang" value="<?php echo $_SESSION['lang']; ?>">

              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="homeduzenle" class="btn btn-primary">Görseli Güncelle</button>
              </div>
              <br>
              <br>
              <hr>

            </form>

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlık <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="<?php if ($_SESSION['lang'] == "NL"){ echo "ayar_home_baslik_en"; } else { echo "ayar_home_baslik"; } ?>" value="<?php if ($_SESSION['lang'] == "NL"){ echo $ayarcek['ayar_home_baslik_en']; } else { echo $ayarcek['ayar_home_baslik']; } ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              


              <!-- Ck Editör Başlangıç -->

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İçerik <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <textarea  class="ckeditor" id="editor1" name="<?php if ($_SESSION['lang'] == "NL"){ echo "  ayar_home_icerik_en"; } else { echo "ayar_home_icerik"; } ?>" value="<?php if ($_SESSION['lang'] == "NL"){ echo "ayar_home_icerik_en"; } else { echo "ayar_home_icerik"; } ?>"><?php if ($_SESSION['lang'] == "NL"){ echo $ayarcek['ayar_home_icerik_en']; } else { echo $ayarcek['ayar_home_icerik']; } ?></textarea>
                </div>
              </div>

              <script type="text/javascript">

               CKEDITOR.replace( 'editor1',

               {

                filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

                filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

                filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

                filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                forcePasteAsPlainText: true

              } 

              );

            </script>

            <!-- Ck Editör Bitiş -->




            <input type="hidden" name="lang" value="<?php if($_SESSION['lang']=="TR"){ echo "1"; } elseif($_SESSION['lang']=="EN"){ echo "2"; } ?>">
            <div class="ln_solid"></div>
            <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="<?php if ($_SESSION['lang'] == "NL"){ echo "homekaydet_en"; } else { echo "homekaydet"; } ?>" class="btn btn-success">İçerik Güncelle</button>
              </div>
            </div>

          </form>



        </div>
      </div>
    </div>
  </div>



</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
