<?php
$name = $_POST['name'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$message = $_POST['message'];

$header = 'From: ' . $email . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$mensaje = "Este mensaje fue enviado por " . $name . ",\r\n";
$mensaje .= "Su e-mail es: " . $email . " \r\n";
$mensaje .= "Telefono: " . $_POST['telefono'] . " \r\n";
$mensaje .= "Mensaje: " . $_POST['message'] . " \r\n";
$mensaje .= "Enviado el " . date('d/m/Y', time());

$para = 'info@diftinto.com';
$asunto = 'Mensaje de mi sitio web';

mail($para, $asunto, utf8_decode($message), $header);
// <script languaje='javascript' type='text/javascript'>

// document.querySelector(.nombre).innerHTML = "";
// document.querySelector(.email).innerHTML = "";
// document.querySelector(.telefono).innerHTML = "";
// document.querySelector(.comentario).innerHTML = "";

// document.querySelector(.confirmacion).style.display = 'block';
// </script>
header("Location:index.html");
?>