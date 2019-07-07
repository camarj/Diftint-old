<?php

function validar_campo($campo)
{
    $campo = trim($campo);
    $campo = stripcslashes($campo);
    $campo = htmlspecialchars($campo);

    return $campo;
}
header('Content-type: application/json');
$recaptcha = $_POST["g-recaptcha-response"];

if(isset($_POST["name"]) && !empty($_POST["name"]) &&
isset($_POST["email"]) && !empty($_POST["email"]) &&
isset($_POST["message"]) && !empty($_POST["message"]) &&
isset($recaptcha) && !empty($recaptcha)) {

    $recaptcha = $_POST["g-recaptcha-response"];
    $secret = "6LfWTqwUAAAAAE8AIeTt3msiX4Jbu7miZSb40IKE";
    $ip = $_SERVER['REMOTE_ADDR'];
    $var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha&remoteip=$ip");

    $array = json_decode($var, true);
    if($array['success']){


    $destinoMail = "info@diftinto.com";
    $name = validar_campo($_POST["name"]);
    $email = validar_campo($_POST["email"]);
    if(isset($_POST["telefono"])){
        $telefono = validar_campo($_POST["telefono"]);
    } 
    $message = validar_campo($_POST["message"]);

    $contenido = " Nombre: " . $name . "\n Email: " . $email;
    $contenido .= "\n Telefono: " . $telefono;
    $contenido .= "\n Mensaje: " . $message;

    mail($destinoMail, "Mensaje de contacto del cliente". $nombre, $contenido);

    return print(json_encode('ok'));
}else{
    return print(json_encode('no'));   
} }

return print(json_encode('no'));
