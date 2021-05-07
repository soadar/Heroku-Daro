<?php

class Venta
{
    private $codigo_de_barra;
    private $usuario;
    private $cantidad;

    public function __construct($codigo_de_barra, $usuario, $cantidad)
    {
        $this->codigo_de_barra = $codigo_de_barra;
        $this->usuario = $usuario;
        $this->cantidad = $cantidad;
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

    public static function TraerTodoLosUsuarios()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=tp01;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $sql = $db->query('SELECT * FROM usuario ');
            $resultado = $sql->fetchall();
            return $resultado;
        } catch (PDOException $ex) {
            echo "error ocurrido!";
            echo $ex->getMessage();
        }
    }

    public function check($productos, $usuarios)
    {
        $flag = 0;
        foreach ($productos as $fila) {
            if ($fila['codigo_de_barra'] == $this->codigo_de_barra) {
                $flag = 1;
                break;
            }
        }
        if ($flag == 1) {
            foreach ($usuarios as $fila) {
                if ($fila['id'] == $this->usuario) {
                    $flag += 2;
                    break;
                }
            }
        }
        if ($flag == 3) {
            foreach ($productos as $fila) {
                if ($fila['codigo_de_barra'] == $this->codigo_de_barra & $fila['stock'] >= $this->cantidad) {
                    $flag += 1; // 4 si esta todo ok
                    break;
                }
            }
        }
        return $flag;
        // 1 si esta SOLO el pruducto
        // 2 si esta SOLO el usuario
        // 3 si estan SOLO el producto y el usuario
        // 4 si estan todos
    }
}
