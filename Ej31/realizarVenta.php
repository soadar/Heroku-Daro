<?php

include "Venta.php";

if ($_POST["txtCodigo"] != null  & $_POST["txtUsuario"] != null & $_POST["txtCantidad"] != null) {
    $codigo = $_POST["txtCodigo"];
    $usuario = $_POST["txtUsuario"];
    $cantidad = $_POST["txtCantidad"];

    $venta = new Venta($codigo, $usuario, $cantidad);
    $productos = Venta::TraerTodoLosProductos();
    $usuarios = Venta::TraerTodoLosUsuarios();
    $check = $venta->check($productos, $usuarios);
    // 1 si esta SOLO el pruducto
    // 2 si esta SOLO el usuario
    // 3 si estan SOLO el producto y el usuario
    // 4 si estan todos
    if ($check == 1)
        echo "esta SOLO el pruducto";
    elseif ($check == 2)
        echo "esta SOLO el usuario";
    elseif ($check == 3)
        echo "Producto y usuario ok, no hay stock";
    elseif ($check == 4)
        "Venta ok";

    echo " \n $check \n ";
}
