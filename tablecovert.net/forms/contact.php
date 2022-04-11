<?php 

//PHP MAILER
require '../PHPMailer/src/Exception.php'; //Mail gönderirken bir hata ortaya çıkarsa hata mesajlarını görebilmek için gerekli. Şart değil
require '../PHPMailer/src/PHPMailer.php'; //Mail göndermek için gerekli.
require '../PHPMailer/src/SMTP.php'; //SMTP ile mail göndermek için gerekli.

use PHPMailer\PHPMailer\PHPMailer; //Kullanılacak sınıfın (PHPMailer) yolu belirtiliyor ve projeye dahil ediliyor
//use PHPMailer\PHPMailer\Exception;



$name = htmlspecialchars($_POST['name']);
$subject = htmlspecialchars($_POST['subject']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);



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

$mail->setFrom($ayarcek['ayar_gelenmail'], 'IMEX'); //Tanımlanan web sunucusuna ait bir gönderen mail adresi ve isim. Username kısmında belirtilen mail adresi ile aynı olmalı. Ornek: gonderenmailadresi@yandex.com, mail@domainadresi.com
//$mail->addReplyTo('gonderenmailadresi2@hotmail.com', 'Muhammed Yaman'); //Mailin gönderildiği kişi maili yanıtlamak isterse buradaki mail adresine mail gönderilmesi gerektiği belirtilir
$mail->addAddress($ayarcek['ayar_gelenmail'], $_POST['name']); //Gönderilecek mail adresi ve isim. İsim yazılmazsa gönderilen kişi kısmında gönderilen kişinin mail adresi yazar. Ornek: alanmailadresi@hotmail.com
//$mail->addCC('haberdarmailadresi@hotmail.com', 'Mert'); //Gönderilecek mail bu adrese de gidecek. Aynı zamanda bu adrese gittiği de mail mesajında belirtilecek.
//$mail->addBCC('haberdarmailadresi2@gmail.com', 'Ömer'); //Gönderilecek mail bu adrese de gidecek. Ancak bu adrese gittiği mail mesajında belirmeyecek.

$mail->Subject = 'İletişim Formu Başvurusu'; //Mail konusu
$mail->Body = //Mail mesaj içeriği
'
    <html>
        <head>
        </head>
        <body>
            <h1>İletişim Formu</h1>
            <hr>
            <p>Gönderen : "'.$name.'"</p>
            <p>Konu : "'.$subject.'"</p>
            <p>Email : "'.$email.'"</p>
            <br>
            <p>Mesajı : "'.$message.'"</p>

        </body>
    </html>
';
//$mail->addAttachment('files/Dusk_on_the_Yangtze_River.jpg', 'resim_ismi.jpg'); //Mail içerisinde ek dosya gönderimi sağlar. Bu kodların çalıştığı klasör içerisindeki files dosyasındaki Dusk_on_the_Yangtze_River.jpg isimli dosyayı seç. Mail içerisinde bu dosyanın ismi 'resim_ismi.jpg' şeklinde gözüksün. İsim girilmezse dosyanın asıl ismi gözükecek
//$mail->addAttachment('files/dosya.rar', 'dosya_ismi.rar');

$mail_gonder = $mail->send(); //Maili gönder ve sonucu değişkene aktar

if($mail_gonder){ //Mail gönderildi mi
    echo "Teşekkürler, mesajınız bize ulaştı!";
}else{
    echo "Mesajınızı gönderirken sorun oluştu";
}





?>