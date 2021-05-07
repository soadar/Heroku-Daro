<?php


include "./AccesoDatos.php";

class Producto
{
    private $codigo_de_barra;
    private $nombre;
    private $tipo;
    private $stock;
    private $precio;
    private $fechaAlta;

    public function __construct($codigo_de_barra, $nombre, $tipo, $stock, $precio)
    {
        $this->codigo_de_barra = $codigo_de_barra;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
        $this->fechaAlta = date("m/d/Y");
    }

    public function InsertarBD()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into producto (codigo_de_barra, nombre, tipo, stock, precio, fecha_de_creacion)values('$this->codigo_de_barra','$this->nombre','$this->tipo','$this->stock','$this->precio','$this->fechaAlta')");
        return $consulta->execute();
    }

    public static function TraerTodoLosProductos()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=tp01;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $sql = $db->query('SELECT * FROM producto ');
            $resultado = $sql->fetchall();
            return $resultado;
        } catch (PDOException $ex) {
            echo "error ocurrido!";
            echo $ex->getMessage();
        }
    }

    public function check($array)
    {
        foreach ($array as $fila) {
            if ($fila['codigo_de_barra'] == $this->codigo_de_barra) {
                $this->stock += $fila['stock'];
                self::UpdateStock($this->codigo_de_barra, $this->stock);
                return true;
            }
        }
        return false;
    }

    public static function UpdateStock($codigo, $stockNuevo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("update producto set stock=:stockNuevo WHERE codigo_de_barra=:codigo");
        $consulta->bindValue(':stockNuevo', $stockNuevo, PDO::PARAM_INT);
        $consulta->bindValue(':codigo', $codigo, PDO::PARAM_INT);
        return $consulta->execute();
        /**
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("update producto set stock=$stockNuevo WHERE codigo_de_barra=$codigo");
        return $consulta->execute();
         */
    }
}
