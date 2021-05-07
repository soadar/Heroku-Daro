<?php

class Producto
{
    private $id;
    private $codigo_de_barra;
    private $nombre;
    private $tipo;
    private $stock;
    private $precio;
    private $fecha_de_creacion;
    private $fecha_de_modificacion;

    public static function TraerTodoLosProductos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select * from producto");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");
    }

    public static function ListarProductos($array)
    {
        foreach ($array as $sasa) {
            echo "<ul>";
            foreach ($sasa as $key => $value) {
                echo "<li> $value </li>";
            }
            echo "</ul>";
        }
    }
}
