<?php 

require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$name = $_POST['user_name'];
$text = $_POST['user_text'];
$image = $_POST['user_image'];

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mail.ru';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'leshko-vladik1997@mail.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'iZqysvrPaMpeYgkkPtNE'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('leshko-vladik1997@mail.ru'); // от кого будет уходить письмо?
$mail->addAddress('leshko-vladik1997@mail.ru');     // Кому будет уходить письмо 
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->AddEmbeddedImage($image, 'image');
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Отзыв с сайта гимнастики Oksy';
$mail->Body    = '' .$name . ' оставил отзыв, <br>Его сообщение: ' .$text. '<br>' .$image;
$mail->AltBody = $image;

if(!$mail->send()) {
    echo 'Error';
} else {
    header('location: thank-you.html');
}
?>