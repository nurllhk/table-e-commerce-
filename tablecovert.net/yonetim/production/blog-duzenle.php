<?php 

include 'header.php'; 


$blogsor=$db->prepare("SELECT * FROM blog where blog_id=:id");
$blogsor->execute(array(
  'id' => $_GET['blog_id']
  ));

$blogcek=$blogsor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Blog Düzenleme <small>

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

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Blog Fotoğrafı<br><span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <?php 
                  if (strlen($blogcek['blog_resimyol'])>0) {?>

                  <img width="200"  src="../../<?php echo $blogcek['blog_resimyol']; ?>">

                  <?php } else {?>


                  <img width="200"  src="../../img/logo-yok.png">


                  <?php } ?>


                </div>
              </div>
              


              

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="first-name"  name="blog_resimyol"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <input type="hidden" name="blog_id" value="<?php echo $blogcek['blog_id'] ?>"> 
              <input type="hidden" name="eski_yol" value="<?php echo $blogcek['blog_resimyol']; ?>">
              <div class="form-group">
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                 <button type="submit" name="blogresimduzenle" class="btn btn-success">Güncelle</button>
               </div>
             </div>
           </form>
           <hr>

           <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sayfa Linki <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="" id="first-name" name="kullanici_tc" disabled="" value="<?php echo $ayarcek['ayar_url'] ?>/haber-<?php echo seo($blogcek['blog_ad']) ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Blog Ad <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="blog_ad" value="<?php echo $blogcek['blog_ad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Blog Tarihi <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="date" id="first-name" name="blog_gtarih" class="form-control col-md-7 col-xs-12">
              </div>
            </div>


            <!-- Ck Editör Başlangıç -->

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Blog Detay <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">

                <textarea  class="ckeditor" id="editor1" name="blog_detay"><?php echo $blogcek['blog_detay']; ?></textarea>
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


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Blog Url <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="blog_url" value="<?php echo $blogcek['blog_url'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Blog Sıra <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="blog_sira" value="<?php echo $blogcek['blog_sira'] ?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>





          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Blog Durum<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
             <select id="heard" class="form-control" name="blog_durum" required>



                   <!-- Kısa İf Kulllanımı 

                    <?php echo $blogcek['blog_durum'] == '1' ? 'selected=""' : ''; ?>

                  -->




                  <option value="1" <?php echo $blogcek['blog_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>



                  <option value="0" <?php if ($blogcek['blog_durum']==0) { echo 'selected=""'; } ?>>Pasif</option>
                  <!-- <?php 

                   if ($blogcek['blog_durum']==0) {?>


                   <option value="0">Pasif</option>
                   <option value="1">Aktif</option>


                   <?php } else {?>

                   <option value="1">Aktif</option>
                   <option value="0">Pasif</option>

                   <?php  }

                   ?> -->


                 </select>
               </div>
             </div>


             <input type="hidden" name="blog_id" value="<?php echo $blogcek['blog_id'] ?>"> 


             <div class="ln_solid"></div>
             
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
               <button type="submit" name="blogduzenle" class="btn btn-success">Güncelle</button>
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
