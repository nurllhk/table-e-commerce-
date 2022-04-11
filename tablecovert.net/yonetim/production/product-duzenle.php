<?php 

include 'header.php'; 


$urunsor=$db->prepare("SELECT * FROM products where id=:id");
$urunsor->execute(array(
  'id' => $_GET['id']
));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Düzenleme <small>

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
            <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


              <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Article No<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="article" value="<?php echo $uruncek['article'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">QUALITY TR<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="QUALITYTR" value="<?php echo $uruncek['QUALITYTR'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">QUALITY EN<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="QUALITY" value="<?php echo $uruncek['QUALITY'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>



          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">PRICE<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="PRICE" value="<?php echo $uruncek['PRICE'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">PALLET SHEETS<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="PALLET" value="<?php echo $uruncek['PALLET'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SIZE CMS<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="SIZE" value="<?php echo $uruncek['SIZE'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SIZE REEL CMS<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="SIZE2" value="<?php echo $uruncek['SIZE2'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">GSM<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="GSM" value="<?php echo $uruncek['GSM'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">PACKING PALLET<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="PACKING" value="<?php echo $uruncek['PACKING'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">INNER DIAMETER APPRX.<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="INNERDIAMETER" value="<?php echo $uruncek['INNERDIAMETER'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">REEL DIAMETER APPRX. CM<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="first-name" name="REELDIAMETER" value="<?php echo $uruncek['REELDIAMETER'] ?>"  class="form-control col-md-7 col-xs-12">
            </div>
          </div>





            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Durum<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="heard" class="form-control" name="durum" required>
                  <option value="1" <?php echo $uruncek['durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>
                  <option value="0" <?php if ($uruncek['durum']==0) { echo 'selected=""'; } ?>>Pasif</option>
                 </select>
               </div>
             </div>

             <input type="hidden" name="lang" value="<?php $_SESSION['lang']; ?>"> 
             <input type="hidden" name="id" value="<?php echo $uruncek['id'] ?>"> 


             <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="productduzenle" class="btn btn-success">Güncelle</button>
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
