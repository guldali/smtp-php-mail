<?php

//değişkenleri aldık
$ad = $_POST["ad"];
$soyad = $_POST["soyad"];
$eposta = $_POST["eposta"];
$konu = $_POST["konu"];
$mesaj = $_POST["mesaj"];

//VERİTABANI için bilgiler
$servername = "";
$username = "";
$password = "+";
$dbname = "";
// bağlantı oluşturuldu
$conn = mysqli_connect($servername, $username, $password, $dbname);
// bağlantı kontrol edildi
if ($conn->connect_error) {
    die("Bağlantı Sağlanamadı: " . $conn->connect_error);
}
mysqli_set_charset($conn, 'utf8');
$sql = mysqli_query($conn, "INSERT INTO iletisim_formu (ad , soyad , eposta , konu ,  mesaj) values ('" . $ad . "','" . $soyad . "','" . $eposta . "','" . $konu . "','" . $mesaj . "')");
mysqli_close($conn);
if (sql == true) {
    echo "Veritabanına eklendi!";
} else {
    echo "Veritabanına eklenirken hata oluştu!";
}

//MAİL AYARLARI
include 'class.phpmailer.php';
$mail = new PHPMailer();
$mail->SMTPDebug = 3;
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com.';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->Username = '@gmail.com';
$mail->Password = '';
$mail->SetFrom($eposta, $ad);
$mail->CharSet = 'UTF-8';
$mail->AddAddress("", ""); // SMTP username , Name Surname
$mail->Subject = $konu;
$content = $mesaj;
$mail->MsgHTML($content);
if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
    exit;
} else {
    echo "Başarılı";
}
?>