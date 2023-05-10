<?php


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require 'vendor/autoload.php';




$mail = new PHPMailer(true);

try {
  $mail->CharSet = 'utf-8';
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->Host       = 'smtp.yandex.ru';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'example@yandex.ru';
  $mail->Password   = 'password';
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;

  $mail->setFrom('example@yandex.ru', 'ADANT');
  $mail->addAddress('example@yandex.ru');

  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $tel = isset($_POST['tel']) ? $_POST['tel'] : '';

  $mail->isHTML(true);
  $mail->Subject = 'Новое сообщение от ADANT';
  $mail->Body    = "Имя: $name<br>Email: $email<br>Телефон: $tel";

  if ($mail->send()) {
    http_response_code(200);
    echo json_encode(['success' => true]);
    exit();
  } else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => '1 failed php']);
    exit();
  }
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['success' => false, 'error' => '2 failed php']);
  exit();
}

?>