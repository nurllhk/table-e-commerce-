<?php include 'header.php'; ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html"><?=$language['anasayfa']?></a></li>
          <li>Contact</li>
        </ol>
        <h2><?=$language['iletisim']?></h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3><?=$language['adresimiz']?></h3>
              <p>&nbsp;</p>
              <p><?php echo $ayarcek['ayar_adress'] ?></p>

            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3><?=$language['emailadresimiz']?></h3>
              <p>&nbsp;</p>
              <p><?php echo $ayarcek['ayar_mail'] ?></p>
              
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3><?=$language['bizeulasin']?></h3>
              <p><?php echo $ayarcek['ayar_tel'] ?></p>
              <p><?php echo $ayarcek['ayar_tel_iki_tr'] ?></p>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-6 ">
            <iframe class="mb-4 mb-lg-0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=tr&amp;geocode=&amp;q=Hurma+Mahallesi+Bo%C4%9Fa%C3%A7ay%C4%B1+Caddesi+No:115+Konyaalt%C4%B1+Antalya&amp;aq=&amp;sll=36.851295,30.616928&amp;sspn=0.007023,0.010697&amp;g=Hurma+Mahallesi+Bo%C4%9Fa%C3%A7ay%C4%B1+Caddesi+No:115%2F1+Konyaalt%C4%B1+Antalya&amp;ie=UTF8&amp;hq=&amp;hnear=Hurma+Mh.,+Bo%C4%9Fa%C3%A7ay+Cd+No:115,+Antalya%2FKonyaalt%C4%B1,+T%C3%BCrkiye&amp;t=m&amp;ll=36.859158,30.605936&amp;spn=0.013735,0.020127&amp;z=15&amp;output=embed" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="<?=$language['yourname']?>" data-rule="minlen:4" data-msg="<?=$language['formname']?>" />
                  <div class="validate"></div>
                </div>
                <div class="col form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="<?=$language['yourmail']?>" data-rule="email" data-msg="<?=$language['formmail']?>" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="<?=$language['konu']?>" data-rule="minlen:4" data-msg="<?=$language['formsubject']?>" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="<?=$language['formyaz']?>" placeholder="<?=$language['mesaj']?>"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message"><?=$language['formmessage']?></div>
              </div>
              <div class="text-center"><button type="submit"><?=$language['gonder']?></button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

<?php include 'footer.php'; ?>