<?php

class Producto
{
    private $codigo_de_barra;
    private $nombre;
    private $tipo;
    private $stock;
    private $precio;

    public function __construct($codigo_de_barra, $nombre, $tipo, $stock, $precio)
    {
        $this->codigo_de_barra = $codigo_de_barra;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
    }

    public static function TraerTodoLosProductos()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=tp01;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $sql = $db->query('SELECT * FROM producto ');
            $productos = $sql->fetchall();
            return $productos;
        } catch (PDOException $ex) {
            echo "error ocurrido!";
            echo $ex->getMessage();
        }
    }

    public function check($productos)
    {
        foreach ($productos as $fila) {
            if ($fila['codigo_de_barra'] == $this->codigo_de_barra) {
                if ($this->UpdateStock())
                    return true;
            }
        }
        return false;
    }

    public function UpdateStock()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("update producto set nombre=:nombre, tipo=:tipo, stock=:stock, precio=:precio  WHERE codigo_de_barra=:codigo");
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
        $consulta->bindValue(':codigo', $this->codigo_de_barra, PDO::PARAM_INT);
        return $consulta->execute();
    }
}
