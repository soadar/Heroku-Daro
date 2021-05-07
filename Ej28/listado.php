<?php

include "Usuario.php";
include "Venta.php";
include "Producto.php";
include "AccesoDatos.php";

if ($_POST["txtListado"] != null) {
    $listado = $_POST["txtListado"];

    switch ($listado) {

        case 'producto':
            $array = Producto::TraerTodoLosProductos();
            Producto::ListarProductos($array);
            break;

        case 'usuario':
            $array = Usuario::TraerTodoLosUsuarios();
            Usuario::ListarUsuarios($array);
            break;

        case 'venta':
            $array = Venta::TraerTodoLasVentas();
            Venta::ListarVentas($array);
            break;

        default:
            echo "Dato invalido.";
            break;
    }
}
