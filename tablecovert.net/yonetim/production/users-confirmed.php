<?php 

include 'header.php'; 


  $kullanicisor=$db->prepare("select * from kullanici where kullanici_id=:id");
  $kullanicisor->execute(array(
    'id' => $_GET['kullanici_id']
  ));


  $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
  $name = $kullanicicek['kullanici_ad'];
  $surname = $kullanicicek['kullanici_soyad'];
  $email = $kullanicicek['kullanici_mail'];


if ($_GET['kullanici_id'] && $_SESSION['yetki'] == 5) {
    

  $kullanici_id=$_GET['kullanici_id'];




  $ayarkaydet=$db->prepare("UPDATE kullanici SET
    kullanici_yetki=:kullanici_yetki,
    kullanici_durum=:durum
    WHERE kullanici_id={$_GET['kullanici_id']}");

  $update=$ayarkaydet->execute(array(
    'kullanici_yetki' => 4,
    'durum' => 1
  ));

  if ($update) {
   include '../netting/uyeOnayMail.php';
  } else {
    header('Location: users.php?durum=no');
    exit;

  }




}

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Onaylanan Üyeler<small>

              <?php 

              if ($_GET['durum']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php } elseif ($_GET['sil']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['sil']=="no") {?>

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
                  <th>Kullanıcı Adı</th>
                  <th>Kullanıcı Soyadı</th>
                  <th>Kullanıcı Mail</th>
                  <th>Kullanıcı Gsm</th>
                  <th>İşlem</th>

    
                </tr>
              </thead>

              <tbody>

                <?php 

                $say=0;
                $uyesor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_yetki=:yetki");
                $uyesor->execute(array('yetki' => 4));

                while($uyecek=$uyesor->fetch(PDO::FETCH_ASSOC)) { ?>


                <tr>
                 <td><?php echo $uyecek['kullanici_ad'] ?></td>
                 <td><?php echo $uyecek['kullanici_soyad'] ?></td>
                 <td><?php echo $uyecek['kullanici_mail'] ?></td>
                 <td><?php echo $uyecek['kullanici_gsm'] ?></td>
                 <td><center><a href="../netting/islem.php?id=<?php echo $uyecek['kullanici_id']; ?>&kullanicisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>


            <!--<td width="50"><center><a href="users-detail.php?kullanici_id=<?php echo $uyecek['kullanici_id']; ?>"><button class="btn btn-primary btn-xs">Detaylar</button></a></center></td>-->

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
