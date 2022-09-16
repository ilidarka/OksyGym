<?php 

if(array_key_exists('image', $_FILES)){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    print_r($_FILES);
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    
    $expensions= array("jpeg","jpg","png","pdf");
    
    if(in_array($file_ext,$expensions)=== false){
       $errors[]="extension not allowed, please choose a PDF, JPEG or PNG file.";
    }
    
    if($file_size > 2097152) {
       $errors[]='File size must be excately 2 MB';
    }
    
    if(empty($errors)==true) {
       move_uploaded_file($file_tmp,"uploads/".$file_name); //The folder where you would like your file to be saved
       echo "Success";
    }else{
       print_r($errors);
    }
 }

require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$name = $_POST['user_name'];
$text = $_POST['user_text'];

$mail->SMTPDebug = 3;                               // Enable verbose debug output

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
if($file_ext) {
   $mail->addAttachment("uploads/".$file_name);
}
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Отзыв с сайта гимнастики Oksy';
$mail->Body    = '' .$name . ' оставил отзыв, <br>Его сообщение: ' .$text;


if(!$mail->send()) {
    echo 'Error';
} else {
   header('location: thank-you.html');
}

?>