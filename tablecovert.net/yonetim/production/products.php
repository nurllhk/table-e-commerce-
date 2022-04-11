<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$urunsor=$db->prepare("SELECT * FROM products WHERE id > 0 order by id DESC");
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
              <a href="product-ekle.php"><button class="btn btn-success btn-xs"> Yeni Ekle</button></a>

            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Article</th>
                  <th>Quality</th>
                  <th>Price</th>
                  <th>Size</th>
                  <th>Size</th>
                  <th>GSM</th>
                  <th>Packing</th>
                  <th>Innerdiameter</th>
                  <th>Reeldiameter</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                $say=0;

                while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { $say++?>


                  <tr>
                   <td width="20"><?php echo $say ?></td>

                    <td><?php echo $uruncek['article'] ?></td>
                    <td><?php echo $uruncek['QUALITY'] ?></td>
                    <td><?php echo $uruncek['PRICE'] ?></td> 
                    <td><?php echo $uruncek['SIZE'] ?></td>
                    <td><?php echo $uruncek['SIZE2'] ?></td>
                    <td><?php echo $uruncek['GSM'] ?></td> 
                    <td><?php echo $uruncek['PACKING'] ?></td>
                    <td><?php echo $uruncek['INNERDIAMETER'] ?></td>
                    <td><?php echo $uruncek['REELDIAMETER'] ?></td> 
                    

                 <td><center><?php 

                 if ($uruncek['durum']==1) {?>

                  <button class="btn btn-success btn-xs">Aktif</button>

              <?php } else {?>

                <button class="btn btn-danger btn-xs">Pasif</button>

              <?php } ?>
            </center>


          </td>


          <td><center><a href="product-duzenle.php?id=<?php echo $uruncek['id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
          <td><center><a href="../netting/islem.php?id=<?php echo $uruncek['id']; ?>&productsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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
