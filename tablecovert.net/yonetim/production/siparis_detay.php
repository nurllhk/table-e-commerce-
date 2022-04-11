<?php 

include 'header.php'; 


 $siparissor=$db->prepare("select * from siparis_product INNER JOIN siparis_success ON siparis_success.siparis_no = siparis_product.siparis_no where LIKE '%siparis_no%'");
                $siparissor->execute(array(
                  'siparis_no' => $_GET['id']
                ));
$sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Sipariş Detay <small>,

              <?php 

              if ($_GET['durum']=="ok") {?>

                <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

                <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <?php

                $siparissor=$db->prepare("select * from siparis_success INNER JOIN kullanici ON kullanici.kullanici_id = siparis_success.uye_id where siparis_no=:siparis_no ");
                $siparissor->execute(array(
                  'siparis_no' => $_GET['id']
                ));

                $say = 0;
                while($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) { $say++;


                ?>

            <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="list-group list-group-flush">
              <li style="background-color: mintcream; opacity: 0.8;" class="list-group-item"><b style="font-size: 14px;">Sipariş Detayları</b></li>
              <li class="list-group-item">Sipariş Tarihi : <?php echo $sipariscek['siparis_tarih']; ?></li>
              <li class="list-group-item">Sipariş No : <b><?php echo $sipariscek['siparis_no']; ?></b></li>
              <li class="list-group-item">İyzico İşlem No : <?php echo $sipariscek['islem_no']; ?></li>
              <li style="border: 1px #424242 dotted; background-color: snow;" class="list-group-item"><b>Toplam Sipariş Tutarı : </b><i style="font-size: 15px; font-weight: 700; color: black;"><?php echo $sipariscek['total']; ?> $</i></li>
              <!--
              <li class="list-group-item">
                <div class="col-12">
                  <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                      <form action="siparis_detay" method="post">
                    <label style="margin-top: 7px;" class="visually-hidden" for="inlineFormSelectPref">Sipariş Durumu</label>
                    </div>
                    <div class="col-md-5">
                    <select class="form-control" id="inlineFormSelectPref">
                      <option selected>Sipariş Durumu Seçin</option>
                      <option value="1">Kargoda</option>
                      <option value="2">İşleme Alındı</option>
                      <option value="3">İptal Edildi</option>
                    </select>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                      <button type="button" class="btn btn-primary">Durum Değiştir</button>
                    </div>
                  </div>
                  </div>


              </li>
              -->
              
            </ul>
           </div>

           <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="list-group list-group-flush">
              <li style="background-color: mintcream; opacity: 0.8;" class="list-group-item"><b style="font-size: 14px;">Müşteri Bilgileri</b></li>
              <li class="list-group-item">Üye Ad soyad : <?php echo $sipariscek['kullanici_ad']." ".$sipariscek['kullanici_soyad'] ?></li>
              <li class="list-group-item">Üye Gsm : <?php echo $sipariscek['kullanici_gsm'] ?></li>
              <li class="list-group-item">Müşteri Mail : <?php echo $sipariscek['uye_mail']; ?></li>
              <li class="list-group-item">Müşteri Adres : <?php echo $sipariscek['kullanici_adres']; ?></li>
              <li class="list-group-item">Müşteri İl/İlçe : <?php echo $sipariscek['kullanici_il']." / ".$sipariscek['kullanici_ilce']; ?></li>
              
              
              

            </ul>
           </div>


           <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="list-group list-group-flush">
              <li style="background-color: mintcream; opacity: 0.8;" class="list-group-item"><b style="font-size: 14px;">Form Sipariş Bilgileri</b></li>
              <li class="list-group-item">Form Müşteri : <?php echo $sipariscek['musteri']; ?></li>
              <li class="list-group-item">Siparis Yetkili : <?php echo $sipariscek['siparis_yetkili']; ?></li>
              <li class="list-group-item">Siparis Teslim : <?php echo $sipariscek['siparis_teslim']; ?></li>
              <li class="list-group-item">Siparis Ödeme : <?php echo $sipariscek['siparis_odeme']; ?></li>
              <li class="list-group-item">Siparis Avans : <?php echo $sipariscek['siparis_avans']; ?></li>
              <li class="list-group-item">Siparis Konteyner : <?php echo $sipariscek['siparis_kont']; ?></li>
            </ul>
           </div>



         <?php } ?>
           
           <div style="margin-top: 150px;">

            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Sipariş no</th>
                  <th scope="col">Ürün adı</th>
                  <th scope="col">Birim fiyatı</th>
                  <th scope="col">Ürün adet</th>
                  <th scope="col">Palet</th>
                  <th scope="col">Packing</th>
                  <th scope="col">Ürün fiyatı</th>
                </tr>
              </thead>
              <tbody>

                <?php

                 $siparissor=$db->prepare("select * from siparis_product where siparis_no=:siparis_no");
                $siparissor->execute(array(
                  'siparis_no' => $_GET['id']
                ));

                $say = 0;
                while($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) { $say++;
                $siparistoplam += $sipariscek['total'];

                ?>
                <tr>
                  <th scope="row"><?php echo $say; ?></th>
                  <td><?php echo $sipariscek['siparis_no']; ?></td>
                  <td><?php echo $sipariscek['QUALITY']; ?></td>
                  <td><?php echo $sipariscek['Price']; ?></td>
                  <td><?php echo $sipariscek['Qty']; ?></td>
                  <td><?php echo $sipariscek['PALLET']; ?></td>
                  <td><?php echo $sipariscek['PACKING']; ?></td>
                  <td><?php echo $sipariscek['total']; ?>$</td>
                </tr>
              <?php } ?>

              </tbody>
            </table>

            </div>





      </div>
    </div>
  </div>


</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
