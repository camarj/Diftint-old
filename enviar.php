<?php

function validar_campo($campo){
    $campo = trim($campo);
    $campo = stripcslashes($campo);
    $campo = htmlspecialchars($campo);
}
header('Content-type: application/json');

if(isset($_POST["name"]) && !empty($_POST["nombre"]) &&
isset($_POST["email"]) && !empty($_POST["email"]) &&
isset($_POST["message"]) && !empty($_POST["message"])) {

    $destinoMail = "info@diftinto.com";
    $name = validar_campo($_POST["name"]);
    $email = validar_campo($_POST["email"]);
    if(isset($_POST["telefono"])){
        $telefono = validar_campo($_POST["telefono"]);
    } 
    $message = validar_campo($_POST["message"]);

    $contenido = "Nombre: " . $name . "\n Email:" . $email;
    $contenido = "\n Telefono: " . $telefono;
    $contenido = "\n Mensaje: " . $message;

    mail($destinoMail, "Mensaje de contacto del cliente". $nombre, $contenido);

    return print(json_encode('ok'));
}

return print(json_encode('no'));
