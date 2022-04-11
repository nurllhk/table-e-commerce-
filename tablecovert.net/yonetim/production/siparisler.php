<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$urunsor=$db->prepare("SELECT * FROM siparis_success order by siparis_tarih DESC");
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
            <h2>Tüm siparişler <small>

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


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Sipariş Durum</th>
                  <th>Siparis NO</th>
                  <th>İşlem NO</th>
                  <th>Müşteri Adı</th>
                  <th>Siparis Yetkili</th>
                  <th>Siparis Teslim</th>

                  <th>Siparis TTT</th>
                  <th>Siparis Liman</th>

                  <th>Siparis Tutarı</th>
                  <th>Sipariş Tarihi</th>
                  <th>Durum</th>
                   <!--<th></th>
                  <th></th> -->
                </tr>
              </thead>

              <tbody>

                <?php 

                $say=0;

                while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { $say++?>


                  <tr>
                   <td width="20"><?php echo $say ?></td>
                   <td><?php if ($uruncek['siparis_durum'] == 2) { ?>
                      <button class="btn btn-success btn-xs">Ödeme Başarılı</button>
                    <?php } if ($uruncek['siparis_durum'] == 404) { ?>
                     <button class="btn btn-danger btn-xs">Ödeme Başarısız</button>
                   <?php } if ($uruncek['siparis_durum'] == 1) { ?>
                     <button class="btn btn-warning btn-xs">Ödeme Yapılmadı</button>

                   <?php } ?>

                   </td> 




                    <td><?php echo $uruncek['siparis_no']; ?></th>
                    <td><?php if (empty($uruncek['islem_no'])) { ?>
                      <i style="color: mediumvioletred;">İşlem yapılmadı</i></button>
                    <?php } else { echo $uruncek['islem_no']; } ?></td>
                    <td><?php echo $uruncek['musteri'] ?></td>
                    <td><?php echo $uruncek['siparis_yetkili'] ?></td>
                    <td><?php echo $uruncek['siparis_teslim'] ?></td>
 
                    <td><?php echo $uruncek['siparis_ttt'] ?></td>
                    <td><?php echo $uruncek['siparis_liman'] ?></td>
                    <td><?php echo $uruncek['total'] ?> $</td>
                    <td><?php echo $uruncek['siparis_tarih'] ?></td>  
                   

                    
                  <td><center><a href="siparis_detay.php?id=<?php echo $uruncek['siparis_no']; ?>"><button class="btn btn-primary btn-xs">Detay</button></a></center></td>
                  <!--
                  <td><center><a href="../netting/islem.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urunsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                -->
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
