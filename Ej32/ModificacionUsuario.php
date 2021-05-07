<?php

include "Usuario.php";
include "AccesoDatos.php";

if ($_POST["txtNombre"] != null & $_POST["txtClaveNueva"] != null & $_POST["txtClaveVieja"] != null & $_POST["txtEmail"] != null) {
    $nombre = $_POST["txtNombre"];
    $claveNueva = $_POST["txtClaveNueva"];
    $claveVieja = $_POST["txtClaveVieja"];
    $email = $_POST["txtEmail"];

    $usuario = new Usuario($nombre, $claveNueva, $claveVieja, $email);
    $lista = Usuario::TraerTodoLosUsuarios();
    if ($usuario->check($lista))
        echo "se modifico la contraseña";
    else
        echo "no se pudo realizar el cambio";
}
