<?php 

include 'header.php'; 
if ($_SESSION['lang']=="TR") { $deger = 1; } elseif ($_SESSION['lang']=="EN") { $deger = 2;}  
//Belirli veriyi seçme işlemi
$menusor=$db->prepare("SELECT * FROM hizmetlerimiz WHERE dil_id=:dil order by menu_sira ASC");
$menusor->execute(array(
'dil' => $deger
));


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Hizmetlerimiz Listesi <small>

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
              <a href="hizmet-ekle.php"><button class="btn btn-success btn-xs"> Hizmet Ekle</button></a>

            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Hizmet Resim</th>
                  <th>Hizmet Ad</th>
                  <th>Hizmet Url</th>
                  <th>Hizmet Sira</th>
                  <th>Hizmet Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                $say=0;

                while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)) { $say++?>


                <tr>
                 <td width="20"><?php echo $say ?></td>
                 <td>

                  <?php 
                  if ($menucek['menu_video']=="") { ?>
                    <img src="../../<?php echo $menucek['menu_resim'] ?>"  style="height: 50px; width: 70px;" >
                  <?php } else { ?>
                    <img src="../../images/resim-yok.png"  style="height: 60px; width: 100px;" >
                    
                  <?php } ?>
                 </td>
                 <td><?php echo $menucek['menu_ad'] ?></td>
                 <td><?php echo $menucek['menu_url'] ?></td>
                 <td><?php echo $menucek['menu_sira'] ?></td>

                 <td><center><?php 

                  if ($menucek['menu_durum']==1) {?>

                  <button class="btn btn-success btn-xs">Aktif</button>

                  <!--

                  success -> yeşil
                  warning -> turuncu
                  danger -> kırmızı
                  default -> beyaz
                  primary -> mavi buton

                  btn-xs -> ufak buton 

                -->

                <?php } else {?>

                <button class="btn btn-danger btn-xs">Pasif</button>


                <?php } ?>
              </center>


            </td>


            <td><center><a href="hizmet-duzenle.php?menu_id=<?php echo $menucek['menu_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
            <td><center><a href="../netting/islem.php?menu_id=<?php echo $menucek['menu_id']; ?>&menusil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
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
