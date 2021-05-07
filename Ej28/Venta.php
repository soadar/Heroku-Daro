<?php

class Venta
{
    private $id;
    private $id_producto;
    private $id_usuario;
    private $cantidad;
    private $fecha_de_venta;

    public static function TraerTodoLasVentas()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select * from venta");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");
    }
    public static function ListarVentas($array)
    {
        echo "<head> <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center;
        }
        </style> </head>";
        echo "<body> <table> <thead>";

        foreach ($array as $sasa) {
            echo "<tr>";
            foreach ($sasa as $key => $value) {
                echo "<td> $value </td>";
            }
            echo "</tr>";
        }

        echo "</thead> </table> </body>";
    }
}
