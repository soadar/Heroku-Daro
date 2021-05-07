<?php

include "Cuentas.php";

if ($_POST["txtEmail"] != null & $_POST["txtClave"] != null) {
    $email = $_POST["txtEmail"];
    $clave = $_POST["txtClave"];

    $cuenta = new Cuentas($email, $clave);
    $array = Cuentas::TraerTodoLosUsuarios();
    echo $cuenta->check($array);
}
