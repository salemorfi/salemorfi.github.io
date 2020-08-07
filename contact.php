<?php
header('Content-Type: application/json');
if($_POST)
{
require 'PHPMailerAutoload.php';
require("phpmailer/class.phpmailer.php");
// Passing `true` enables exceptions
try {
    $mail = new PHPMailer(); 
    //Server settings
    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    //$mail->Host = '200.80.43.110';
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'morfisale@gmail.com';                 // SMTP username
    $mail->Password = 'sale$$morfi01';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    $mail->CharSet = 'UTF-8';                 // TCP port to connect to


    $user_Name        = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $user_Email       = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $user_Message     = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

    //587 default
    //Recipients
    $mail->setFrom($user_Email);
    $mail->addAddress('info@salemorfi.com.ar');     // Add a recipient
    $mail->addAddress('morfisale@gmail.com');     // Add a recipient

    $mail->addReplyTo($user_Email);

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
   
    $mail->Subject = "Consulta a traves de landing";
    $message_Body = "<strong>Nombre: </strong>". $user_Name ."<br>";
    $message_Body .= "<strong>Email: </strong>". $user_Email ."<br>";
    $message_Body .= "<strong>Mensaje: </strong>". $user_Message ."<br>";
    
    
    $mail->Body    = $message_Body;
    $mail->AltBody = $message_Body;
    $output = json_encode(array('type'=>"message", 'text' => "Gracias por ponerte en contacto con nosotros, te responderemos a la brevedad."));

    if($mail->send()){
        die($output);
    }
    
    } catch (Exception $e) {
            $output = json_encode(array('type'=>'error', 'text' => 'Ha ocurrido un error al enviar el email, intentelo luego.'));
        die($output);
    
}
}
?>
