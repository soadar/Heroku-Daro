<?php

include "Persona.php";

if ($_POST["txtEmail"] != null & $_POST["txtClave"] != null & $_POST["txtLocalidad"] != null & $_POST["txtNombre"] != null & $_POST["txtApellido"] != null) {
    $email = $_POST["txtEmail"];
    $clave = $_POST["txtClave"];
    $localidad = $_POST["txtLocalidad"];
    $nombre = $_POST["txtNombre"];
    $apellido = $_POST["txtApellido"];

    $persona = new Persona($nombre, $apellido, $clave, $email, $localidad);
    if ($persona->InsertarBD())
        echo "Se agrego";
    else
        echo "no se agrego";
} else
    echo "no se agrego";
