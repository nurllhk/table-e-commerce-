<?php
ob_start();
session_start();

include 'baglan.php';
include '../production/fonksiyon.php';

if (isset($_POST['kullanicikaydet'])) {

	
	echo $kullanici_adsoyad=htmlspecialchars($_POST['kullanici_adsoyad']); echo "<br>";
	echo $kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); echo "<br>";

	echo $kullanici_passwordone=trim($_POST['kullanici_passwordone']); echo "<br>";
	echo $kullanici_passwordtwo=trim($_POST['kullanici_passwordtwo']); echo "<br>";



	if ($kullanici_passwordone==$kullanici_passwordtwo) {


		if (strlen($kullanici_passwordone)>=6) {


			

			


// Başlangıç

			$kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail");
			$kullanicisor->execute(array(
				'mail' => $kullanici_mail
			));

			//dönen satır sayısını belirtir
			$say=$kullanicisor->rowCount();



			if ($say==0) {

				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=md5($kullanici_passwordone);

				$kullanici_yetki=1;

			//Kullanıcı kayıt işlemi yapılıyor...
				$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
					kullanici_adsoyad=:kullanici_adsoyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_yetki=:kullanici_yetki
					");
				$insert=$kullanicikaydet->execute(array(
					'kullanici_adsoyad' => $kullanici_adsoyad,
					'kullanici_mail' => $kullanici_mail,
					'kullanici_password' => $password,
					'kullanici_yetki' => $kullanici_yetki
				));

				if ($insert) {


					header("Location:../../index.php?durum=loginbasarili");


				//Header("Location:../production/genel-ayarlar.php?durum=ok");

				} else {


					header("Location:../../register.php?durum=basarisiz");
				}

			} else {

				header("Location:../../register.php?durum=mukerrerkayit");



			}




		// Bitiş



		} else {


			header("Location:../../register.php?durum=eksiksifre");


		}



	} else {



		header("Location:../../register.php?durum=farklisifre");
	}
	


}


if (isset($_POST['sifreguncelle'])) {


	$kullanici_eskipassword=htmlspecialchars($_POST['kullanici_eskipassword']);
	$kullanici_passwordone=htmlspecialchars($_POST['kullanici_passwordone']);
	$kullanici_passwordtwo=htmlspecialchars($_POST['kullanici_passwordtwo']);

	$kullanici_password=md5($kullanici_eskipassword);

	$kullanicisor=$db->prepare("SELECT * from kullanici where kullanici_password=:password");
	$kullanicisor->execute(array(
		'password' => $kullanici_password
	));

	$say=$kullanicisor->rowCount();

	if ($say==0) {

		Header("Location:../production/profilim.php?durum=eskisifrehata");
		exit;

	}

	if ($kullanici_passwordone==$kullanici_passwordtwo) {


		if (strlen($kullanici_passwordone)>=6) {


			$sifre=md5($kullanici_passwordone);


			$kullaniciguncelle=$db->prepare("UPDATE kullanici SET

				kullanici_password=:kullanici_password

				WHERE kullanici_id=147");


			$update=$kullaniciguncelle->execute(array(

				'kullanici_password' => $sifre


			));

			if ($update) {

				Header("Location:../production/profilim.php?durum=ok");
				exit;
			} else {

				Header("Location:../production/profilim.php?durum=hata");
				exit;
			}



		} else {

			Header("Location:../production/profilim.php?durum=eksiksifre");
			exit;

		}


	} else {

		Header("Location:../production/profilim.php?durum=sifreleruyusmuyor");
		exit;

	}


}


if (isset($_POST['sliderkaydet'])) {


	$uploads_dir = '../../images/slider';
	@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
	@$name = $_FILES['slider_resimyol']["name"];
	//resmin isminin benzersiz olması
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);	
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad");
	


	$kaydet=$db->prepare("INSERT INTO slider SET
		slider_ad=:slider_ad,
		slider_sira=:slider_sira,
		slider_link=:slider_link,
		slider_resimyol=:slider_resimyol
		");
	$insert=$kaydet->execute(array(
		'slider_ad' => $_POST['slider_ad'],
		'slider_sira' => $_POST['slider_sira'],
		'slider_link' => $_POST['slider_link'],
		'slider_resimyol' => $refimgyol
	));

	if ($insert) {

		Header("Location:../production/slider.php?durum=ok");

	} else {

		Header("Location:../production/slider.php?durum=no");
	}




}



// Slider Düzenleme Başla


if (isset($_POST['sliderduzenle'])) {

	
	if($_FILES['slider_resimyol']["size"] > 0)  { 


		$uploads_dir = '../../images/slider';
		@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
		@$name = $_FILES['slider_resimyol']["name"];
		$benzersizsayi1=rand(20000,32000);
		$benzersizsayi2=rand(20000,32000);
		$benzersizsayi3=rand(20000,32000);
		$benzersizsayi4=rand(20000,32000);
		$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

		$duzenle=$db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum,
			slider_resimyol=:resimyol	
			WHERE slider_id={$_POST['slider_id']}");
		$update=$duzenle->execute(array(
			'ad' => $_POST['slider_ad'],
			'link' => $_POST['slider_link'],
			'sira' => $_POST['slider_sira'],
			'durum' => $_POST['slider_durum'],
			'resimyol' => $refimgyol,
		));
		

		$slider_id=$_POST['slider_id'];

		if ($update) {

			$resimsilunlink=$_POST['slider_resimyol'];
			unlink("../../$resimsilunlink");

			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");

		} else {

			Header("Location:../production/slider-duzenle.php?durum=no");
		}



	} else {

		$duzenle=$db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum		
			WHERE slider_id={$_POST['slider_id']}");
		$update=$duzenle->execute(array(
			'ad' => $_POST['slider_ad'],
			'link' => $_POST['slider_link'],
			'sira' => $_POST['slider_sira'],
			'durum' => $_POST['slider_durum']
		));

		$slider_id=$_POST['slider_id'];

		if ($update) {

			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");

		} else {

			Header("Location:../production/slider-duzenle.php?durum=no");
		}
	}

}


// Slider Düzenleme Bitiş

if ($_GET['slidersil']=="ok") {
	
	$sil=$db->prepare("DELETE from slider where slider_id=:slider_id");
	$kontrol=$sil->execute(array(
		'slider_id' => $_GET['slider_id']
	));

	if ($kontrol) {

		$resimsilunlink=$_GET['slider_resimyol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/slider.php?durum=ok");

	} else {

		Header("Location:../production/slider.php?durum=no");
	}

}


if (isset($_POST['logoduzenle'])) {

	

	$uploads_dir = '../../images';

	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'logo' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/genel-ayar.php?durum=ok");

	} else {

		Header("Location:../production/genel-ayar.php?durum=no");
	}

}

if (isset($_POST['hakduzenle'])) {

	if ($_POST['lang'] == "NL") {
	$uploads_dir = '../../images';

	@$tmp_name = $_FILES['ayar_hakkimizda_en']["tmp_name"];
	@$name = $_FILES['ayar_hakkimizda_en']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4");

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_hakkimizda_en=:ayar_hakkimizda_en
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'ayar_hakkimizda_en' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol_en'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/hakkimizda.php?durum=ok");
		exit;

	} else {

		Header("Location:../production/hakkimizda.php?durum=no");
		exit;
	}

}
	 else {

	$uploads_dir = '../../images';

	@$tmp_name = $_FILES['ayar_hakkimizda']["tmp_name"];
	@$name = $_FILES['ayar_hakkimizda']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4");

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_hakkimizda=:ayar_hakkimizda
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'ayar_hakkimizda' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/hakkimizda.php?durum=ok");
		exit;

	} else {

		Header("Location:../production/hakkimizda.php?durum=no");
		exit;
	}

}

	}





if (isset($_POST['homeduzenle'])) {

	if ($_POST['lang'] == "NL") {
	$uploads_dir = '../../images';

	@$tmp_name = $_FILES['ayar_home_image_en']["tmp_name"];
	@$name = $_FILES['ayar_home_image_en']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4");

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_home_image_en=:ayar_home_image_en
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'ayar_home_image_en' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol_en'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/index.php?durum=ok");
		exit;

	} else {

		Header("Location:../production/index.php?durum=no");
		exit;
	}

}
	 else {

	$uploads_dir = '../../images';

	@$tmp_name = $_FILES['ayar_home_image']["tmp_name"];
	@$name = $_FILES['ayar_home_image']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4");

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_home_image=:ayar_home_image
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'ayar_home_image' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/index.php?durum=ok");
		exit;

	} else {

		Header("Location:../production/index.php?durum=no");
		exit;
	}

}

	}





if (isset($_POST['iletduzenle'])) {

	if ($_POST['lang'] == "NL") {
	$uploads_dir = '../../images';

	@$tmp_name = $_FILES['ayar_iletisimf_en']["tmp_name"];
	@$name = $_FILES['ayar_iletisimf_en']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4");

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_iletisimf_en=:ayar_iletisimf_en
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'ayar_iletisimf_en' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/iletisim-ayarlar.php?durum=ok");
		exit;

	} else {

		Header("Location:../production/iletisim-ayarlar.php?durum=no");
		exit;
	}

}
	 else {

	$uploads_dir = '../../images';

	@$tmp_name = $_FILES['ayar_iletisimf']["tmp_name"];
	@$name = $_FILES['ayar_iletisimf']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4");

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_iletisimf=:ayar_iletisimf
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'ayar_iletisimf' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/iletisim-ayarlar.php?durum=ok");
		exit;

	} else {

		Header("Location:../production/iletisim-ayarlar.php?durum=no");
		exit;
	}

}

	}



if (isset($_POST['admingiris'])) {

	$kullanici_mail=$_POST['kullanici_mail'];
	$kullanici_password=md5($_POST['kullanici_password']);

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:password and kullanici_yetki=:yetki");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'password' => $kullanici_password,
		'yetki' => 5
	));

	echo $say=$kullanicisor->rowCount();

	if ($say==1) {

		$_SESSION['kullanici_mail']=$kullanici_mail;
		$_SESSION['lang']="EN";
		$_SESSION['yetki']="5";
		header("Location:../production/index.php");
		exit;



	} else {

		header("Location:../production/login.php?durum=no");
		exit;
	}
	

}




if (isset($_POST['memberlogin'])) {


	
	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); 
	$kullanici_password=md5(htmlspecialchars($_POST['kullanici_password'])); 

	$kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail and kullanici_yetki=:yetki and kullanici_password=:password and kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'yetki' => 0,
		'password' => $kullanici_password,
		'durum' => 0
	));
	$zay=$kullanicisor->rowCount();

	if ($zay==1) {
		header("Location:../../404.php");
		exit;

	} else {


	$kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail and kullanici_yetki=:yetki and kullanici_password=:password and kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'yetki' => 4,
		'password' => $kullanici_password,
		'durum' => 1
	));


	$say=$kullanicisor->rowCount();



	if ($say==1) {

		$_SESSION['userkullanici_mail']=$kullanici_mail;
		$_SESSION['yetki']=4;

		header("Location:../../usercp?login=success");
		exit;
		




	} else {


		header("Location:../../?return=failattempt");
		exit;

	}


}
}

if (isset($_POST['sosyalayarkaydet'])) {
	
	//Tablo güncelleme işlemi kodları...
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_facebook=:ayar_facebook,
		ayar_twitter=:ayar_twitter,
		ayar_linked=:ayar_linked
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(
		'ayar_facebook' => $_POST['ayar_facebook'],
		'ayar_twitter' => $_POST['ayar_twitter'],
		'ayar_linked' => $_POST['ayar_linked']
	));


	if ($update) {

		header("Location:../production/sosyal-ayar.php?durum=ok");

	} else {

		header("Location:../production/sosyal-ayar.php?durum=no");
	}
	
}



if (isset($_POST['genelayarkaydet'])) {
	
	//Tablo güncelleme işlemi kodları...
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_title=:ayar_title,
		ayar_title_en=:ayar_title_en,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_author=:ayar_author
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(
		'ayar_title' => $_POST['ayar_title'],
		'ayar_title_en' => $_POST['ayar_title_en'],
		'ayar_description' => $_POST['ayar_description'],
		'ayar_keywords' => $_POST['ayar_keywords'],
		'ayar_author' => $_POST['ayar_author']
	));


	if ($update) {

		header("Location:../production/genel-ayar.php?durum=ok");

	} else {

		header("Location:../production/genel-ayar.php?durum=no");
	}
	
}



if (isset($_POST['iletisimayarkaydet'])) {



	
	//Tablo güncelleme işlemi kodları...
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_tel=:ayar_tel,
		ayar_gsm=:ayar_gsm,
		ayar_mail=:ayar_mail,
		ayar_tel_iki_tr=:ayar_tel_iki_tr,
		ayar_adress=:ayar_adress
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(
		'ayar_tel' => $_POST['ayar_tel'],
		'ayar_gsm' => $_POST['ayar_gsm'],
		'ayar_tel_iki_tr' => $_POST['ayar_tel_iki_tr'],
		'ayar_mail' => $_POST['ayar_mail'],
		'ayar_adress' => $_POST['ayar_adress']
	));


	if ($update) {

		header("Location:../production/iletisim-ayarlar.php?durum=ok");
		exit;

	} else {

		header("Location:../production/iletisim-ayarlar.php?durum=no");
		exit;
	}
	
}



if (isset($_POST['apiayarkaydet'])) {
	
	//Tablo güncelleme işlemi kodları...
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		
		ayar_analystic=:ayar_analystic,
		ayar_maps=:ayar_maps,
		ayar_zopim=:ayar_zopim
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(

		'ayar_analystic' => $_POST['ayar_analystic'],
		'ayar_maps' => $_POST['ayar_maps'],
		'ayar_zopim' => $_POST['ayar_zopim']
	));


	if ($update) {

		header("Location:../production/api-ayarlar.php?durum=ok");

	} else {

		header("Location:../production/api-ayarlar.php?durum=no");
	}
	
}


if (isset($_POST['hakkimizdakaydet'])) {


	$ayarkaydet=$db->prepare("UPDATE hakkimizda SET
		hakkimizda_baslik=:hakkimizda_baslik,
		hakkimizda_icerik=:hakkimizda_icerik
		WHERE dil_id={$_POST['dil']}");

	$update=$ayarkaydet->execute(array(
		'hakkimizda_baslik' => $_POST['hakkimizda_baslik'],
		'hakkimizda_icerik' => $_POST['hakkimizda_icerik']
	));


	if ($update) {

		header("Location:../production/hakkimizda.php?durum=ok");
		exit;

	} else {

		header("Location:../production/hakkimizda.php?durum=no");
		exit;
	}
	
}


if (isset($_POST['homekaydet'])) {

    
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_home_baslik=:ayar_home_baslik,
		ayar_home_icerik=:ayar_home_icerik
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(
		'ayar_home_baslik' => $_POST['ayar_home_baslik'],
		'ayar_home_icerik' => $_POST['ayar_home_icerik']
	));


	if ($update) {

		header("Location:../production/index.php?durum=ok");

	} else {

		header("Location:../production/index.php?durum=no");
	}
	
}


if (isset($_POST['homekaydet_en'])) {
	

    
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_home_baslik_en=:ayar_home_baslik_en,
		ayar_home_icerik_en=:ayar_home_icerik_en
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(
		'ayar_home_baslik_en' => $_POST['ayar_home_baslik_en'],
		'ayar_home_icerik_en' => $_POST['ayar_home_icerik_en']
	));


	if ($update) {

		header("Location:../production/index.php?durum=ok");

	} else {

		header("Location:../production/index.php?durum=no");
	}
	
}



if (isset($_POST['kullaniciduzenle'])) {

	$kullanici_id=$_POST['kullanici_id'];

	$ayarkaydet=$db->prepare("UPDATE kullanici SET
		kullanici_tc=:kullanici_tc,
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_durum=:kullanici_durum
		WHERE kullanici_id={$_POST['kullanici_id']}");

	$update=$ayarkaydet->execute(array(
		'kullanici_tc' => $_POST['kullanici_tc'],
		'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
		'kullanici_durum' => $_POST['kullanici_durum']
	));


	if ($update) {

		Header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");

	} else {

		Header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
	}

}


if (isset($_POST['kullanicibilgiguncelle'])) {

	$kullanici_id=$_POST['kullanici_id'];

	$ayarkaydet=$db->prepare("UPDATE kullanici SET
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_il=:kullanici_il,
		kullanici_ilce=:kullanici_ilce
		WHERE kullanici_id={$_POST['kullanici_id']}");

	$update=$ayarkaydet->execute(array(
		'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
		'kullanici_il' => $_POST['kullanici_il'],
		'kullanici_ilce' => $_POST['kullanici_ilce']
	));


	if ($update) {

		Header("Location:../../hesabim?durum=ok");

	} else {

		Header("Location:../../hesabim?durum=no");
	}

}


if ($_GET['kullanicisil']=="ok") {

	if ($_SESSION['yetki']=="5") {
			$sil=$db->prepare("DELETE from kullanici where kullanici_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['id']
	));


	if ($kontrol) {


		header("location:../production/users-confirmed.php?sil=ok");
		exit;

	} else {

		header("location:../production/users-confirmed.php?sil=no");
		exit;

	}
	} else {

		header("location:../production/users-confirmed.php?sil=yetkisiz");
		exit;
	}



}

// HABER BASLANGIC

if (isset($_POST['haberduzenle'])) {

	$haber_id=$_POST['haber_id'];

	$haber_seourl=seo($_POST['haber_ad']);
	
	$ayarkaydet=$db->prepare("UPDATE haberler SET
		haber_ad=:haber_ad,
		haber_detay=:haber_detay,
		haber_url=:haber_url,
		haber_sira=:haber_sira,
		haber_seourl=:haber_seourl,
		haber_durum=:haber_durum
		WHERE haber_id={$_POST['haber_id']}");

	$update=$ayarkaydet->execute(array(
		'haber_ad' => $_POST['haber_ad'],
		'haber_detay' => $_POST['haber_detay'],
		'haber_url' => $_POST['haber_url'],
		'haber_sira' => $_POST['haber_sira'],
		'haber_seourl' => $haber_seourl,
		'haber_durum' => $_POST['haber_durum']
	));


	if ($update) {

		Header("Location:../production/hizmet-duzenle.php?haber_id=$haber_id&durum=ok");

	} else {

		Header("Location:../production/hizmet-duzenle.php?haber_id=$haber_id&durum=no");
	}

}


if ($_GET['habersil']=="ok") {

	$sil=$db->prepare("DELETE from haberler where haber_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['haber_id']
	));


	if ($kontrol) {


		header("location:../production/haberler.php?sil=ok");


	} else {

		header("location:../production/haberler.php?sil=no");

	}


}



if (isset($_POST['haberkaydet'])) {


	$haber_seourl=seo($_POST['haber_ad']);


	$ayarekle=$db->prepare("INSERT INTO haberler SET
		haber_ad=:haber_ad,
		haber_detay=:haber_detay,
		haber_url=:haber_url,
		haber_sira=:haber_sira,
		haber_seourl=:haber_seourl,
		haber_durum=:haber_durum
		");

	$insert=$ayarekle->execute(array(
		'haber_ad' => $_POST['haber_ad'],
		'haber_detay' => $_POST['haber_detay'],
		'haber_url' => $_POST['haber_url'],
		'haber_sira' => $_POST['haber_sira'],
		'haber_seourl' => $haber_seourl,
		'haber_durum' => $_POST['haber_durum']
	));


	if ($insert) {

		Header("Location:../production/haberler.php?durum=ok");

	} else {

		Header("Location:../production/haberler.php?durum=no");
	}

}

// HABER BITIS

// MAKALELER BASLANGIC

if (isset($_POST['makaleduzenle'])) {

	$makale_id=$_POST['makale_id'];

	$makale_seourl=seo($_POST['makale_ad']);
	
	$ayarkaydet=$db->prepare("UPDATE makaleler SET
		makale_ad=:makale_ad,
		makale_detay=:makale_detay,
		makale_url=:makale_url,
		makale_sira=:makale_sira,
		makale_seourl=:makale_seourl,
		makale_durum=:makale_durum
		WHERE makale_id={$_POST['makale_id']}");

	$update=$ayarkaydet->execute(array(
		'makale_ad' => $_POST['makale_ad'],
		'makale_detay' => $_POST['makale_detay'],
		'makale_url' => $_POST['makale_url'],
		'makale_sira' => $_POST['makale_sira'],
		'makale_seourl' => $makale_seourl,
		'makale_durum' => $_POST['makale_durum']
	));


	if ($update) {

		Header("Location:../production/hizmet-duzenle.php?makale_id=$makale_id&durum=ok");

	} else {

		Header("Location:../production/hizmet-duzenle.php?makale_id=$makale_id&durum=no");
	}

}


if ($_GET['makalesil']=="ok") {

	$sil=$db->prepare("DELETE from makaleler where makale_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['makale_id']
	));


	if ($kontrol) {


		header("location:../production/makaleler.php?sil=ok");


	} else {

		header("location:../production/makaleler.php?sil=no");

	}


}


if (isset($_POST['makalekaydet'])) {


	$makale_seourl=seo($_POST['makale_ad']);


	$ayarekle=$db->prepare("INSERT INTO makaleler SET
		makale_ad=:makale_ad,
		makale_detay=:makale_detay,
		makale_url=:makale_url,
		makale_sira=:makale_sira,
		makale_seourl=:makale_seourl,
		makale_durum=:makale_durum
		");

	$insert=$ayarekle->execute(array(
		'makale_ad' => $_POST['makale_ad'],
		'makale_detay' => $_POST['makale_detay'],
		'makale_url' => $_POST['makale_url'],
		'makale_sira' => $_POST['makale_sira'],
		'makale_seourl' => $makale_seourl,
		'makale_durum' => $_POST['makale_durum']
	));


	if ($insert) {

		Header("Location:../production/makaleler.php?durum=ok");

	} else {

		Header("Location:../production/makaleler.php?durum=no");
	}

}

// MAKALELER BITIS

if (isset($_POST['menuduzenle'])) {

	if($_FILES['menu_resim']["size"] > 0)  { 


		$uploads_dir = '../../images/hizmetlerimiz';
		@$tmp_name = $_FILES['menu_resim']["tmp_name"];
		@$name = $_FILES['menu_resim']["name"];
		$benzersizsayi1=rand(20000,32000);
		$benzersizsayi2=rand(20000,32000);
		$benzersizad=$benzersizsayi1.$benzersizsayi2;
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

		$menu_id=$_POST['menu_id'];

		$menu_seourl=seo($_POST['menu_ad']);

		$ayarkaydet=$db->prepare("UPDATE hizmetlerimiz SET
			menu_ad=:menu_ad,
			menu_resim=:menu_resim,
			menu_video=:menu_video,
			menu_detay=:menu_detay,
			menu_sira=:menu_sira,
			menu_seourl=:menu_seourl,
			menu_durum=:menu_durum
			WHERE menu_id={$_POST['menu_id']}");

		$update=$ayarkaydet->execute(array(
			'menu_ad' => $_POST['menu_ad'],
			'menu_resim' => $refimgyol,
			'menu_video' => $_POST['menu_video'],
			'menu_detay' => $_POST['menu_detay'],
			'menu_sira' => $_POST['menu_sira'],
			'menu_seourl' => $menu_seourl,
			'menu_durum' => $_POST['menu_durum']
		));


		if ($update) {

			$resimsilunlink=$_POST['eski_yol'];
			unlink("../../$resimsilunlink");

			Header("Location:../production/hizmet-duzenle.php?menu_id=$menu_id&durum=ok");

		} else {

			Header("Location:../production/hizmet-duzenle.php?menu_id=$menu_id&durum=no");
		}

	} else {

		$menu_id=$_POST['menu_id'];

		$menu_seourl=seo($_POST['menu_ad']);

		$ayarkaydet=$db->prepare("UPDATE hizmetlerimiz SET
			menu_ad=:menu_ad,
			menu_video=:menu_video,
			menu_detay=:menu_detay,
			menu_sira=:menu_sira,
			menu_seourl=:menu_seourl,
			menu_durum=:menu_durum
			WHERE menu_id={$_POST['menu_id']}");

		$update=$ayarkaydet->execute(array(
			'menu_ad' => $_POST['menu_ad'],
			'menu_video' => $_POST['menu_video'],
			'menu_detay' => $_POST['menu_detay'],
			'menu_sira' => $_POST['menu_sira'],
			'menu_seourl' => $menu_seourl,
			'menu_durum' => $_POST['menu_durum']
		));


		if ($update) {

			Header("Location:../production/hizmet-duzenle.php?menu_id=$menu_id&durum=ok");

		} else {

			Header("Location:../production/hizmet-duzenle.php?menu_id=$menu_id&durum=no");
		}

	}
}

if ($_GET['menusil']=="ok") {

	$sil=$db->prepare("DELETE from hizmetlerimiz where menu_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['menu_id']
	));


	if ($kontrol) {


		header("location:../production/hizmetlerimiz.php?sil=ok");


	} else {

		header("location:../production/hizmetlerimiz.php?sil=no");

	}


}


if (isset($_POST['menukaydet'])) {


	$uploads_dir = '../../images/hizmetlerimiz';
	@$tmp_name = $_FILES['menu_resim']["tmp_name"];
	@$name = $_FILES['menu_resim']["name"];
	//resmin isminin benzersiz olması
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);	
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

	$menu_seourl=seo($_POST['menu_ad']);
	$ayarekle=$db->prepare("INSERT INTO hizmetlerimiz SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum,
		menu_video=:menu_video,
		dil_id=:dil_id,
		menu_resim=:menu_resim
		");

	$insert=$ayarekle->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_detay' => $_POST['menu_detay'],
		'dil_id' => $_POST['lang'],
		'menu_video' => $_POST['menu_video'],
		'menu_sira' => $_POST['menu_sira'],
		'menu_seourl' => $menu_seourl,
		'menu_durum' => $_POST['menu_durum'],
		'menu_resim' => $refimgyol
	));


	if ($insert) {

		Header("Location:../production/hizmetlerimiz.php?durum=ok");

	} else {

		Header("Location:../production/hizmetlerimiz.php?durum=no");
	}

}


if (isset($_POST['kategoriduzenle'])) {

	$kategori_id=$_POST['kategori_id'];
	$kategori_seourl=seo($_POST['kategori_ad']);

	
	$kaydet=$db->prepare("UPDATE kategori SET
		kategori_ad=:ad,
		kategori_durum=:kategori_durum,	
		kategori_seourl=:seourl,
		kategori_sira=:sira
		WHERE kategori_id={$_POST['kategori_id']}");
	$update=$kaydet->execute(array(
		'ad' => $_POST['kategori_ad'],
		'kategori_durum' => $_POST['kategori_durum'],
		'seourl' => $kategori_seourl,
		'sira' => $_POST['kategori_sira']		
	));

	if ($update) {

		Header("Location:../production/kategori-duzenle.php?durum=ok&kategori_id=$kategori_id");

	} else {

		Header("Location:../production/kategori-duzenle.php?durum=no&kategori_id=$kategori_id");
	}

}


if (isset($_POST['kategoriekle'])) {

	$kategori_seourl=seo($_POST['kategori_ad']);

	$kaydet=$db->prepare("INSERT INTO kategori SET
		kategori_ad=:ad,
		kategori_durum=:kategori_durum,	
		kategori_seourl=:seourl,
		kategori_sira=:sira
		");
	$insert=$kaydet->execute(array(
		'ad' => $_POST['kategori_ad'],
		'kategori_durum' => $_POST['kategori_durum'],
		'seourl' => $kategori_seourl,
		'sira' => $_POST['kategori_sira']		
	));

	if ($insert) {

		Header("Location:../production/kategori.php?durum=ok");

	} else {

		Header("Location:../production/kategori.php?durum=no");
	}

}



if ($_GET['kategorisil']=="ok") {
	
	$sil=$db->prepare("DELETE from kategori where kategori_id=:kategori_id");
	$kontrol=$sil->execute(array(
		'kategori_id' => $_GET['kategori_id']
	));

	if ($kontrol) {

		Header("Location:../production/kategori.php?durum=ok");

	} else {

		Header("Location:../production/kategori.php?durum=no");
	}

}

if ($_GET['urunsil']=="ok") {
	
	$sil=$db->prepare("DELETE from urun where urun_id=:urun_id");
	$kontrol=$sil->execute(array(
		'urun_id' => $_GET['urun_id']
	));

	if ($kontrol) {

		Header("Location:../production/urun.php?durum=ok");

	} else {

		Header("Location:../production/urun.php?durum=no");
	}

}


if ($_GET['productsil']=="ok") {

	if ($_SESSION['yetki']==5) {
			$sil=$db->prepare("DELETE from products where id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['id']
	));

	if ($kontrol) {

		Header("Location:../production/products.php?durum=ok");
		exit;

	} else {

		Header("Location:../production/products.php?durum=no");
		exit;
	}
	}

	


} else {

	"yetkisiz";
}





if (isset($_POST['urunekle'])) {

	$kullanicisor=$db->prepare("select * from urun where urun_seourl=:seourl");
	$kullanicisor->execute(array(
		'seourl' => $urun_seourl
	));

	$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

	$id = $kullanicicek['urun_id'];

	$uploads_dir = '../../images/urunler';
	@$tmp_name = $_FILES['urun_resim']["tmp_name"];
	@$name = $_FILES['urun_resim']["name"];
	//resmin isminin benzersiz olması
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);	
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

	$urun_seourl=seo($_POST['urun_ad']);

	$kaydet=$db->prepare("INSERT INTO urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_durum=:urun_durum,
		urun_seourl=:seourl,
		dil_id=:dil_id,
		urunfoto_resimyol=:urunfoto_resimyol		
		");
	$insert=$kaydet->execute(array(
		'kategori_id' => $_POST['kategori_id'],
		'urun_ad' => $_POST['urun_ad'],
		'dil_id' => $_POST['lang'],
		'urun_detay' => $_POST['urun_detay'],
		'urun_durum' => $_POST['urun_durum'],
		'seourl' => $urun_seourl,
		'urunfoto_resimyol' => $refimgyol

	));


	if ($insert) {
		Header("Location:../production/urun-ekle.php?durum=ok");
		exit;
	} else {

		Header("Location:../production/urun-ekle.php?durum=no");
		exit;
	}




}

/*
if (isset($_POST['urunduzenle'])) {

	$urun_id=$_POST['urun_id'];
	$urun_seourl=seo($_POST['urun_ad']);

	$kaydet=$db->prepare("UPDATE urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_video=:urun_video,
		urun_onecikar=:urun_onecikar,
		urun_keyword=:urun_keyword,
		urun_durum=:urun_durum,
		urun_stok=:urun_stok,	
		urun_seourl=:seourl		
		WHERE urun_id={$_POST['urun_id']}");
	$update=$kaydet->execute(array(
		'kategori_id' => $_POST['kategori_id'],
		'urun_ad' => $_POST['urun_ad'],
		'urun_detay' => $_POST['urun_detay'],
		'urun_fiyat' => $_POST['urun_fiyat'],
		'urun_video' => $_POST['urun_video'],
		'urun_onecikar' => $_POST['urun_onecikar'],
		'urun_keyword' => $_POST['urun_keyword'],
		'urun_durum' => $_POST['urun_durum'],
		'urun_stok' => $_POST['urun_stok'],
		'seourl' => $urun_seourl

	));

	if ($update) {

		Header("Location:../production/urun-duzenle.php?durum=ok&urun_id=$urun_id");

	} else {

		Header("Location:../production/urun-duzenle.php?durum=no&urun_id=$urun_id");
	}

}


*/






if (isset($_POST['urunduzenle'])) {
	$urun_id=$_POST['urun_id'];
	$urun_seourl=seo($_POST['urun_ad']);

	if($_FILES['urunfoto_resimyol']["size"] > 0)  { 


		$uploads_dir = '../../images/urunler';
		@$tmp_name = $_FILES['urunfoto_resimyol']["tmp_name"];
		@$name = $_FILES['urunfoto_resimyol']["name"];
		$benzersizsayi1=rand(20000,32000);
		$benzersizsayi2=rand(20000,32000);
		$benzersizsayi3=rand(20000,32000);
		$benzersizsayi4=rand(20000,32000);
		$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

		$duzenle=$db->prepare("UPDATE urun SET
			kategori_id=:kategori_id,
			urun_ad=:urun_ad,
			urun_detay=:urun_detay,
			urun_durum=:urun_durum,
			urun_seourl=:seourl,		
			urunfoto_resimyol=:urunfoto_resimyol	
			WHERE urun_id={$_POST['urun_id']}");
		$update=$duzenle->execute(array(
			'kategori_id' => $_POST['kategori_id'],
			'urun_ad' => $_POST['urun_ad'],
			'urun_detay' => $_POST['urun_detay'],
			'urun_durum' => $_POST['urun_durum'],
			'seourl' => $urun_seourl,
			'urunfoto_resimyol' => $refimgyol
		));
		

		$urun_id=$_POST['urun_id'];

		if ($update) {

			$resimsilunlink=$_POST['eski_yol'];
			unlink("../../$resimsilunlink");

			Header("Location:../production/urun-duzenle.php?durum=ok&urun_id=$urun_id");
			exit;

		} else {

			Header("Location:../production/urun-duzenle.php?durum=no&urun_id=$urun_id");
			exit;
		}



	} else {

		$duzenle=$db->prepare("UPDATE urun SET
			kategori_id=:kategori_id,
			urun_ad=:urun_ad,
			urun_detay=:urun_detay,
			urun_durum=:urun_durum,
			urun_seourl=:seourl	
			WHERE urun_id={$_POST['urun_id']}");
		$update=$duzenle->execute(array(
			'kategori_id' => $_POST['kategori_id'],
			'urun_ad' => $_POST['urun_ad'],
			'urun_detay' => $_POST['urun_detay'],
			'urun_durum' => $_POST['urun_durum'],
			'seourl' => $urun_seourl
		));

		$urun_id=$_POST['urun_id'];

		if ($update) {

			Header("Location:../production/urun-duzenle.php?durum=ok&urun_id=$urun_id");

		} else {

			Header("Location:../production/urun-duzenle.php?durum=no&urun_id=$urun_id");
		}

	}

}



if (isset($_POST['productekle'])) {



$sayi = $_POST['PRICE'];
$eski = array(",");
$yeni = array(".");

$sonuc = str_replace($eski, $yeni, $sayi);


	$kaydet=$db->prepare("INSERT INTO products SET

			REELDIAMETER=:REELDIAMETER,
			INNERDIAMETER=:INNERDIAMETER,
			PACKING=:PACKING,
			GSM=:GSM,
			SIZE=:SIZE,
			SIZE2=:SIZE2,
			PRICE=:PRICE,
			PALLET=:PALLET,
			QUALITYTR=:QUALITYTR,
			article=:article,			
			QUALITY=:QUALITY,
			durum=:durum		
		");
	$insert=$kaydet->execute(array(

			'REELDIAMETER' => $_POST['REELDIAMETER'],
			'INNERDIAMETER' => $_POST['INNERDIAMETER'],
			'PACKING' => $_POST['PACKING'],
			'GSM' => $_POST['GSM'],
			'PALLET' => $_POST['PALLET'],
			'SIZE' => $_POST['SIZE'],
			'SIZE2' => $_POST['SIZE2'],
			'PRICE' => $sonuc,
			'QUALITYTR' => $_POST['QUALITYTR'],
			'QUALITY' => $_POST['QUALITY'],
			'article' => $_POST['article'],
			'durum' => $_POST['durum']

	));


	if ($insert) {
		Header("Location:../production/products.php?durum=ok");
		exit;
	} else {

		Header("Location:../production/products.php?durum=no");
		exit;
	}




}

if ($_GET['productdel']=="ok") {

	
	$sil=$db->prepare("DELETE from siparis_draft where id=:id and uye_id=:uye_id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['id'],
		'uye_id' => $_SESSION['userkullanici_mail']
	));

	if ($kontrol) {

		
		Header("Location:../../usercp?route=neworder#del");

	} else {

		Header("Location:../../usercp?route=no#del");
	}

}


if (isset($_POST['productduzenle'])) {
	$urun_id=$_POST['id'];

	$sayi = $_POST['PRICE'];
	$eski = array(",");
	$yeni = array(".");

	$sonuc = str_replace($eski, $yeni, $sayi);



		$duzenle=$db->prepare("UPDATE products SET

			REELDIAMETER=:REELDIAMETER,
			INNERDIAMETER=:INNERDIAMETER,
			PACKING=:PACKING,
			GSM=:GSM,
			SIZE=:SIZE,
			SIZE2=:SIZE2,
			PRICE=:PRICE,
			PALLET=:PALLET,
			QUALITYTR=:QUALITYTR,
			article=:article,			
			QUALITY=:QUALITY,
			durum=:durum	
			WHERE id={$_POST['id']}");
		$update=$duzenle->execute(array(

			'REELDIAMETER' => $_POST['REELDIAMETER'],
			'INNERDIAMETER' => $_POST['INNERDIAMETER'],
			'PACKING' => $_POST['PACKING'],
			'GSM' => $_POST['GSM'],
			'PALLET' => $_POST['PALLET'],
			'SIZE' => $_POST['SIZE'],
			'SIZE2' => $_POST['SIZE2'],
			'PRICE' => $sonuc,
			'QUALITYTR' => $_POST['QUALITYTR'],
			'QUALITY' => $_POST['QUALITY'],
			'article' => $_POST['article'],
			'durum' => $_POST['durum']
		));
		

		$id=$_POST['id'];

		if ($update) {

			Header("Location:../production/product-duzenle.php?durum=ok&id=$id");
			exit;

		} else {

			Header("Location:../production/product-duzenle.php?durum=no&id=$id");
			exit;
		}



	

}






if (isset($_POST['yorumkaydet'])) {


	$gelen_url=$_POST['gelen_url'];

	$ayarekle=$db->prepare("INSERT INTO yorumlar SET
		yorum_detay=:yorum_detay,
		kullanici_id=:kullanici_id,
		urun_id=:urun_id	
		
		");

	$insert=$ayarekle->execute(array(
		'yorum_detay' => $_POST['yorum_detay'],
		'kullanici_id' => $_POST['kullanici_id'],
		'urun_id' => $_POST['urun_id']
		
	));


	if ($insert) {

		Header("Location:$gelen_url?durum=ok");

	} else {

		Header("Location:$gelen_url?durum=no");
	}

}


if (isset($_POST['sepetekle'])) {


	$ayarekle=$db->prepare("INSERT INTO sepet SET
		urun_adet=:urun_adet,
		kullanici_id=:kullanici_id,
		urun_id=:urun_id	
		
		");

	$insert=$ayarekle->execute(array(
		'urun_adet' => $_POST['urun_adet'],
		'kullanici_id' => $_POST['kullanici_id'],
		'urun_id' => $_POST['urun_id']
		
	));


	if ($insert) {

		Header("Location:../../sepet?durum=ok");

	} else {

		Header("Location:../../sepet?durum=no");
	}

}


if ($_GET['urun_onecikar']=="ok") {

	

	
	$duzenle=$db->prepare("UPDATE urun SET
		
		urun_onecikar=:urun_onecikar
		
		WHERE urun_id={$_GET['urun_id']}");
	
	$update=$duzenle->execute(array(


		'urun_onecikar' => $_GET['urun_one']
	));



	if ($update) {

		

		Header("Location:../production/urun.php?durum=ok");

	} else {

		Header("Location:../production/urun.php?durum=no");
	}

}

if ($_GET['yorum_onay']=="ok") {

	
	$duzenle=$db->prepare("UPDATE yorumlar SET
		
		yorum_onay=:yorum_onay
		
		WHERE yorum_id={$_GET['yorum_id']}");
	
	$update=$duzenle->execute(array(

		'yorum_onay' => $_GET['yorum_one']
	));



	if ($update) {

		

		Header("Location:../production/yorum.php?durum=ok");

	} else {

		Header("Location:../production/yorum.php?durum=no");
	}

}



if ($_GET['yorumsil']=="ok") {
	
	$sil=$db->prepare("DELETE from yorumlar where yorum_id=:yorum_id");
	$kontrol=$sil->execute(array(
		'yorum_id' => $_GET['yorum_id']
	));

	if ($kontrol) {

		
		Header("Location:../production/yorum.php?durum=ok");

	} else {

		Header("Location:../production/yorum.php?durum=no");
	}

}


if (isset($_POST['bankaekle'])) {

	$kaydet=$db->prepare("INSERT INTO banka SET
		banka_ad=:ad,
		banka_durum=:banka_durum,	
		banka_hesapadsoyad=:banka_hesapadsoyad,
		banka_iban=:banka_iban
		");
	$insert=$kaydet->execute(array(
		'ad' => $_POST['banka_ad'],
		'banka_durum' => $_POST['banka_durum'],
		'banka_hesapadsoyad' => $_POST['banka_hesapadsoyad'],
		'banka_iban' => $_POST['banka_iban']		
	));

	if ($insert) {

		Header("Location:../production/banka.php?durum=ok");

	} else {

		Header("Location:../production/banka.php?durum=no");
	}

}


if (isset($_POST['bankaduzenle'])) {

	$banka_id=$_POST['banka_id'];

	$kaydet=$db->prepare("UPDATE banka SET

		banka_ad=:ad,
		banka_durum=:banka_durum,	
		banka_hesapadsoyad=:banka_hesapadsoyad,
		banka_iban=:banka_iban
		WHERE banka_id={$_POST['banka_id']}");
	$update=$kaydet->execute(array(
		'ad' => $_POST['banka_ad'],
		'banka_durum' => $_POST['banka_durum'],
		'banka_hesapadsoyad' => $_POST['banka_hesapadsoyad'],
		'banka_iban' => $_POST['banka_iban']		
	));

	if ($update) {

		Header("Location:../production/banka-duzenle.php?banka_id=$banka_id&durum=ok");

	} else {

		Header("Location:../production/banka-duzenle.php?banka_id=$banka_id&durum=no");
	}


	

}


if ($_GET['bankasil']=="ok") {
	
	$sil=$db->prepare("DELETE from banka where banka_id=:banka_id");
	$kontrol=$sil->execute(array(
		'banka_id' => $_GET['banka_id']
	));

	if ($kontrol) {

		
		Header("Location:../production/banka.php?durum=ok");

	} else {

		Header("Location:../production/banka.php?durum=no");
	}

}



if (isset($_POST['kullanicisifreguncelle'])) {

	echo $kullanici_eskipassword=trim($_POST['kullanici_eskipassword']); echo "<br>";
	echo $kullanici_passwordone=trim($_POST['kullanici_passwordone']); echo "<br>";
	echo $kullanici_passwordtwo=trim($_POST['kullanici_passwordtwo']); echo "<br>";

	$kullanici_password=md5($kullanici_eskipassword);


	$kullanicisor=$db->prepare("select * from kullanici where kullanici_password=:password");
	$kullanicisor->execute(array(
		'password' => $kullanici_password
	));

			//dönen satır sayısını belirtir
	$say=$kullanicisor->rowCount();



	if ($say==0) {

		header("Location:../../sifre-guncelle?durum=eskisifrehata");



	} else {



	//eski şifre doğruysa başla


		if ($kullanici_passwordone==$kullanici_passwordtwo) {


			if (strlen($kullanici_passwordone)>=6) {


				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=md5($kullanici_passwordone);

				$kullanici_yetki=1;

				$kullanicikaydet=$db->prepare("UPDATE kullanici SET
					kullanici_password=:kullanici_password
					WHERE kullanici_id={$_POST['kullanici_id']}");

				
				$insert=$kullanicikaydet->execute(array(
					'kullanici_password' => $password
				));

				if ($insert) {


					header("Location:../../sifre-guncelle.php?durum=sifredegisti");


				//Header("Location:../production/genel-ayarlar.php?durum=ok");

				} else {


					header("Location:../../sifre-guncelle.php?durum=no");
				}





		// Bitiş



			} else {


				header("Location:../../sifre-guncelle.php?durum=eksiksifre");


			}



		} else {

			header("Location:../../sifre-guncelle?durum=sifreleruyusmuyor");

			exit;


		}


	}

	exit;

	if ($update) {

		header("Location:../../sifre-guncelle?durum=ok");

	} else {

		header("Location:../../sifre-guncelle?durum=no");
	}

}


//Sipariş İşlemleri

if (isset($_POST['bankasiparisekle'])) {


	$siparis_tip="Banka Havalesi";


	$kaydet=$db->prepare("INSERT INTO siparis SET
		kullanici_id=:kullanici_id,
		siparis_tip=:siparis_tip,	
		siparis_banka=:siparis_banka,
		siparis_toplam=:siparis_toplam
		");
	$insert=$kaydet->execute(array(
		'kullanici_id' => $_POST['kullanici_id'],
		'siparis_tip' => $siparis_tip,
		'siparis_banka' => $_POST['siparis_banka'],
		'siparis_toplam' => $_POST['siparis_toplam']		
	));

	if ($insert) {

		//Sipariş başarılı kaydedilirse...

		echo $siparis_id = $db->lastInsertId();

		echo "<hr>";


		$kullanici_id=$_POST['kullanici_id'];
		$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:id");
		$sepetsor->execute(array(
			'id' => $kullanici_id
		));

		while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) {

			$urun_id=$sepetcek['urun_id']; 
			$urun_adet=$sepetcek['urun_adet'];

			$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:id");
			$urunsor->execute(array(
				'id' => $urun_id
			));

			$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
			
			echo $urun_fiyat=$uruncek['urun_fiyat'];


			
			$kaydet=$db->prepare("INSERT INTO siparis_detay SET
				
				siparis_id=:siparis_id,
				urun_id=:urun_id,	
				urun_fiyat=:urun_fiyat,
				urun_adet=:urun_adet
				");
			$insert=$kaydet->execute(array(
				'siparis_id' => $siparis_id,
				'urun_id' => $urun_id,
				'urun_fiyat' => $urun_fiyat,
				'urun_adet' => $urun_adet

			));


		}

		if ($insert) {

			

			//Sipariş detay kayıtta başarıysa sepeti boşalt

			$sil=$db->prepare("DELETE from sepet where kullanici_id=:kullanici_id");
			$kontrol=$sil->execute(array(
				'kullanici_id' => $kullanici_id
			));

			
			Header("Location:../../siparislerim?durum=ok");
			exit;


		}

		




	} else {

		echo "başarısız";

		//Header("Location:../production/siparis.php?durum=no");
	}



}


if(isset($_POST['urunfotosil'])) {

	$urun_id=$_POST['urun_id'];


	echo $checklist = $_POST['urunfotosec'];

	
	foreach($checklist as $list) {

		$sil=$db->prepare("DELETE from urunfoto where urunfoto_id=:urunfoto_id");
		$kontrol=$sil->execute(array(
			'urunfoto_id' => $list
		));
	}

	if ($kontrol) {

		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=ok");

	} else {

		Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=no");
	}


} 


if(isset($_POST['galerifotosil'])) {

	$urun_id=$_POST['urun_id'];


	echo $checklist = $_POST['galerifotosec'];

	
	foreach($checklist as $list) {

		$sil=$db->prepare("DELETE from galeri where id=:id");
		$kontrol=$sil->execute(array(
			'id' => $list
		));
	}

	if ($kontrol) {

		Header("Location:../production/galeri.php?id=$id&durum=ok");

	} else {

		Header("Location:../production/galeri.php?id=$id&durum=no");
	}


} 


if (isset($_POST['mailayarkaydet'])) {
	
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_smtphost=:smtphost,
		ayar_smtpuser=:smtpuser,
		ayar_smtppassword=:smtppassword,
		ayar_smtpport=:smtpport,
		ayar_gelenmail=:ayar_gelenmail
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'smtphost' => $_POST['ayar_smtphost'],
		'smtpuser' => $_POST['ayar_smtpuser'],
		'smtppassword' => $_POST['ayar_smtppassword'],
		'ayar_gelenmail' => $_POST['ayar_gelenmail'],
		'smtpport' => $_POST['ayar_smtpport']
	));

	if ($update) {

		Header("Location:../production/mail-ayar.php?durum=ok");

	} else {

		Header("Location:../production/mail-ayar.php?durum=no");
	}

}


// Blog Başlangıç


if (isset($_POST['blogduzenle'])) {

	$blog_id=$_POST['blog_id'];

	$blog_seourl=seo($_POST['blog_ad']);

	
	$ayarkaydet=$db->prepare("UPDATE blog SET
		blog_ad=:blog_ad,
		blog_gtarih=:blog_gtarih,
		blog_detay=:blog_detay,
		blog_url=:blog_url,
		blog_sira=:blog_sira,
		blog_seourl=:blog_seourl,
		blog_durum=:blog_durum
		WHERE blog_id={$_POST['blog_id']}");

	$update=$ayarkaydet->execute(array(
		'blog_ad' => $_POST['blog_ad'],
		'blog_gtarih' => $_POST['blog_gtarih'],
		'blog_detay' => $_POST['blog_detay'],
		'blog_url' => $_POST['blog_url'],
		'blog_sira' => $_POST['blog_sira'],
		'blog_seourl' => $blog_seourl,
		'blog_durum' => $_POST['blog_durum']
	));


	if ($update) {


		Header("Location:../production/blog-duzenle.php?blog_id=$blog_id&durum=ok");
		exit;
	} else {

		Header("Location:../production/blog-duzenle.php?blog_id=$blog_id&durum=no");
		exit;
	}

}


if (isset($_POST['blogresimduzenle'])) {
	$uploads_dir = '../../images/blog';
	@$tmp_name = $_FILES['blog_resimyol']["tmp_name"];
	@$name = $_FILES['blog_resimyol']["name"];
	//resmin isminin benzersiz olması
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);	
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

	$blog_id=$_POST['blog_id'];

	$blog_seourl=seo($_POST['blog_ad']);

	
	$ayarkaydet=$db->prepare("UPDATE blog SET
		blog_resimyol=:blog_resimyol
		WHERE blog_id={$_POST['blog_id']}");

	$update=$ayarkaydet->execute(array(
		'blog_resimyol' => $refimgyol
	));


	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/blog-duzenle.php?blog_id=$blog_id&durum=ok");
		exit;
	} else {

		Header("Location:../production/blog-duzenle.php?blog_id=$blog_id&durum=no");
		exit;
	}

}


if (!empty($_GET['blogsil']=="ok")) {
	$sil=$db->prepare("DELETE from blog where blog_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['blog_id']
	));


	if ($kontrol) {


		header("location:../production/blog.php?sil=ok");
		exit;

	} else {

		header("location:../production/blog.php?sil=no");
		exit;

	}


}


if (isset($_POST['blogkaydet'])) {

	$blog_seourl=seo($_POST['blog_ad']);
	$uploads_dir = '../../images/blog';
	@$tmp_name = $_FILES['blog_resimyol']["tmp_name"];
	@$name = $_FILES['blog_resimyol']["name"];
	//resmin isminin benzersiz olması
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);	
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	


	$ayarekle=$db->prepare("INSERT INTO blog SET
		blog_ad=:blog_ad,
		blog_gtarih=:blog_gtarih,
		blog_detay=:blog_detay,
		blog_url=:blog_url,
		blog_sira=:blog_sira,
		blog_seourl=:blog_seourl,
		blog_resimyol=:blog_resimyol,
		blog_durum=:blog_durum
		");

	$insert=$ayarekle->execute(array(
		'blog_ad' => $_POST['blog_ad'],
		'blog_gtarih' => $_POST['blog_gtarih'],
		'blog_detay' => $_POST['blog_detay'],
		'blog_url' => $_POST['blog_url'],
		'blog_sira' => $_POST['blog_sira'],
		'blog_durum' => $_POST['blog_durum'],
		'blog_seourl' => $blog_seourl,
		'blog_resimyol' => $refimgyol
	));


	if ($insert) {

		Header("Location:../production/blog.php?durum=ok");
		exit;
	} else {

		Header("Location:../production/blog.php?durum=no");
		exit;
	}

}

// Blog bitiş


if (isset($_POST['uyekaydet'])) {


	if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
}
if (!$captcha) {
    Header("Location:../../signup2.php?result=captcha");
	exit;
}
$kontrol = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcGjwEfAAAAAEIV9x21q7XtFbS7-yCNRRdmO6U6&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
if ($kontrol.success == false) {
    Header("Location:../../signup2.php?result=captcha");
	exit;
} else {
    




					// TEL TEMIZLEME
                    $num = str_replace("(","", $_POST['phone']);
                    $num_a = str_replace(")","", $num);
                    $num_b = str_replace(" ","", $num_a);
                    $num_c = str_replace("-","", $num_b);
                    // POST TEMIZLEME
                    $name = trim(htmlspecialchars($_POST['name']));
                    $surname = trim(htmlspecialchars($_POST['surname']));
                    $phone = trim(htmlspecialchars($num_c));
                    $email = trim(htmlspecialchars($_POST['email']));
                    $pass = trim(htmlspecialchars($_POST['pass']));
                    $passtekrar = trim(htmlspecialchars($_POST['passtekrar']));
                    $sifre = trim(htmlspecialchars($_POST['captcha']));
                    $sifreson = md5($pass);
                    $gelentoplam = trim(htmlspecialchars($_POST['toplam']));


                    $kullanicisor=$db->prepare("select * from kullanici where kullanici_mail=:mail");
					$kullanicisor->execute(array(
						'mail' => $email
					));

					//dönen satır sayısını belirtir
					$say=$kullanicisor->rowCount();



					if ($say==0) {

                        if ($pass == $passtekrar) {

                        	

                        		 $ayarekle=$db->prepare("INSERT INTO kullanici SET
									kullanici_ad=:kullanici_ad,
									kullanici_soyad=:kullanici_soyad,
									kullanici_mail=:kullanici_mail,
									kullanici_gsm=:kullanici_gsm,
									kullanici_yetki=:kullanici_yetki,
									kullanici_password=:kullanici_password,
									kullanici_durum=:kullanici_durum
									");

								$insert=$ayarekle->execute(array(
									'kullanici_ad' => $name,
									'kullanici_soyad' => $surname,
									'kullanici_mail' => $email,
									'kullanici_gsm' => $phone,
									'kullanici_yetki' => 0,
									'kullanici_password' => $sifreson,
									'kullanici_durum' => 0
								));
									if ($insert) {

										include 'uyeBasvuruMail.php';


									} else {

										Header("Location:../../signup.php?result=no");
										exit;
									}



                        
                        	
                        } else {

                        	Header("Location:../../signup.php?result=passnotmatch");
							exit;

                        }
} else {


                        	Header("Location:../../signup.php?result=email");
							exit;

}

 	}					


}







?>