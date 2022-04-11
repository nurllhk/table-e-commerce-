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
						<h2>Ürün Düzenleme <small>,

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
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Article ID<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="first-name" name="article" maxlength="6" placeholder="Article giriniz"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>



							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">QUALITY TR <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="first-name" name="QUALITYTR" placeholder="QUALITY Türkçesini giriniz"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">QUALITY EN<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="first-name" name="QUALITY" placeholder="QUALITY giriniz"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="total">PRICE<span class="required">*</span>
								</label>





								<div class="col-md-6 col-sm-6 col-xs-12">
									<input onchange="setTwoNumberDecimal" min="0" step="0.25"  type="text" name="PRICE" id="total" maxlength="6"  placeholder="0,0165"  class="form-control col-md-7 col-xs-12">

									
								</div>
							</div>

				

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">PALLET<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="first-name" name="PALLET" placeholder="PALLET giriniz"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>


							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">REEL DIAMETER APPRX. CM<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="first-name" name="REELDIAMETER" placeholder="REELDIAMETER giriniz"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">INNER DIAMETER APPRX. <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="first-name" name="INNERDIAMETER" placeholder="INNERDIAMETER giriniz"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">PACKING PALLET <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="first-name" name="PACKING" placeholder="PACKING giriniz"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">GSM <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="first-name" name="GSM" placeholder="GSM giriniz"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SIZE CMS <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="first-name" name="SIZE" placeholder="SIZE giriniz"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SIZE REEL CMS <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="first-name" name="SIZE2" placeholder="SIZE2 giriniz"  class="form-control col-md-7 col-xs-12">
								</div>
							</div>

							



						

							<input type="hidden" name="lang" value="<?php if($_SESSION['lang']=="TR"){ echo "1"; } elseif($_SESSION['lang']=="EN"){ echo "2"; } ?>"> 
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Durum<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select id="heard" class="form-control" name="durum" required>


										<option value="1" >Aktif</option>
										<option value="0" >Pasif</option>



									</select>
								</div>
							</div>

							<div class="ln_solid"></div>
							<div class="form-group">
								<div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="submit" name="productekle" class="btn btn-success">Kaydet</button>
								</div>
							</div>

						</form>



					</div>
				</div>
			</div>
		</div>



		<hr>
		<hr>
		<hr>



	</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
