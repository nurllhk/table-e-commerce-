<?php

include 'baglan.php';

$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
  'id' => 0
));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
if (isset($_GET['lang'])) {$_SESSION['lang'] = $_GET['lang'];}
if(isset($_GET["lang"])){$dil = $_GET["lang"];}else{$dil = "EN";}
if ($_SESSION['lang']=="TR") { $deger = 1; } elseif ($_SESSION['lang']=="EN") { $deger = 2;}  
$kod=$_SESSION['kod'];

//PHP MAILER
require '../../PHPMailerr/src/Exception.php'; //Mail gönderirken bir hata ortaya çıkarsa hata mesajlarını görebilmek için gerekli. Şart değil
require '../../PHPMailerr/src/PHPMailer.php'; //Mail göndermek için gerekli.
require '../../PHPMailerr/src/SMTP.php'; //SMTP ile mail göndermek için gerekli.

use PHPMailer\PHPMailer\PHPMailer; //Kullanılacak sınıfın (PHPMailer) yolu belirtiliyor ve projeye dahil ediliyor
//use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(); //PHPMailer sınıfı kuruluyor

$mail->Host = $ayarcek['ayar_smtphost']; //SMPT mail sunucusu. Ornek: smtp.yandex.com (YANDEX MAIL), smtp.gmail.com (GOOGLE/GMAIL), smtp.live.com (HOTMAIL), mail.ornekmailsunucusu.com (SITENIZE OZEL MAIL SUNUCU)
$mail->Username = $ayarcek['ayar_smtpuser']; //Tanımlanan web sunucusuna ait mail hesabı kullanıcı adı. Ornek: gonderenmailadresi@yandex.com, mail@domainadresi.com
$mail->Password = $ayarcek['ayar_smtppassword']; //Mail hesabı şifre
$mail->Port = $ayarcek['ayar_smtpport']; //Mail sunucu mail gönderme portu. Ornek: 587, 465
$mail->SMTPSecure = 'ssl'; //Veri gizliliği yöntemi. Örnek: tls, ssl

$mail->isSMTP(); //SMPT kullanarak mail gönderilecek
$mail->SMTPAuth = true; //SMPT kimlik doğrulanmasını etkinleştir

$mail->isHTML(true); //Mail içeriğinde HTML etiketlerinin algılanmasına izin vermek. False olarak seçilirse ve mail içeriğinde HTML içerikleri varsa etiketler algılanmaksızın normal düz yazı olarak içerikte belirecek

$mail->CharSet = "UTF-8"; //Mail başlık, konu ve içerikte türkçe karakter desteği mevcut
$mail->setLanguage('tr', 'language/'); //hata mesajlarını tr dili ile yazdır. 'language' isimli klasörden dil ayarları çekilir. Varsayılan olarak ingilizce seçilidir
$mail->SMTPDebug  = 2; //işlem sürecini göster. Hataları belirlemenizi kolaylaştırır

$mail->setFrom('imexdonotreply@gmail.com', 'IMEX'); //Tanımlanan web sunucusuna ait bir gönderen mail adresi ve isim. Username kısmında belirtilen mail adresi ile aynı olmalı. Ornek: gonderenmailadresi@yandex.com, mail@domainadresi.com
//$mail->addReplyTo('gonderenmailadresi2@hotmail.com', 'Muhammed Yaman'); //Mailin gönderildiği kişi maili yanıtlamak isterse buradaki mail adresine mail gönderilmesi gerektiği belirtilir
$mail->addAddress($email, $_POST['name']); //Gönderilecek mail adresi ve isim. İsim yazılmazsa gönderilen kişi kısmında gönderilen kişinin mail adresi yazar. Ornek: alanmailadresi@hotmail.com
//$mail->addCC('haberdarmailadresi@hotmail.com', 'Mert'); //Gönderilecek mail bu adrese de gidecek. Aynı zamanda bu adrese gittiği de mail mesajında belirtilecek.
//$mail->addBCC('haberdarmailadresi2@gmail.com', 'Ömer'); //Gönderilecek mail bu adrese de gidecek. Ancak bu adrese gittiği mail mesajında belirmeyecek.

$mail->Subject = 'Imex üyeliğiniz onaylandı !';
$isim=ucfirst($name);
$soyisim = ucfirst($surname);

$mail->Body = 
'
    <html>
        <head>
        </head>
        <body>
            <h1>Imex üyeliğiniz onaylandı !</h1>
            <p>Sayın : '.$isim." ".$soyisim." "." üyelik başvurunuz onaylanmıştır.".'</p>
            <p>Bir önceki mailde gelen şifreniz ile giriş yapabilirsiniz.</p>
            <p></p>
            <p>www.imexup.com</p>
        </body>
    </html>
';


$mail_gonder = $mail->send(); 
if($mail_gonder){ 
    header('Location: ../production/users.php?status=ok');
    exit;
}else{
    header('Location: ../production/users.php?status=fail');
    exit;
}

?>