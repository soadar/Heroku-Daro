<?php

include "Producto.php";

if ($_POST["txtCodigo"] != null  & $_POST["txtNombre"] != null & $_POST["txtTipo"] != null & $_POST["txtStock"] != null & $_POST["txtPrecio"] != null) {
    $codigo = $_POST["txtCodigo"];
    $nombre = $_POST["txtNombre"];
    $tipo = $_POST["txtTipo"];
    $stock = $_POST["txtStock"];
    $precio = $_POST["txtPrecio"];

    $producto1 = new Producto($codigo, $nombre, $tipo, $stock, $precio);
    //echo $producto1->AltaProducto();
    $array = Producto::TraerTodoLosProductos();
    if ($producto1->check($array))
        echo "Actualizado";
    else {
        if ($producto1->InsertarBD())
            echo "Ingresado";
        else
            echo "no se pudo hacer";
    }
}
