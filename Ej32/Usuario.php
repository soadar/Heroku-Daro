<?php

class Usuario
{
    private $nombre;
    private $claveNueva;
    private $ClaveVieja;
    private $mail;

    public function __construct($nombre, $claveNueva, $ClaveVieja, $mail)
    {
        $this->nombre = $nombre;
        $this->claveNueva = $claveNueva;
        $this->ClaveVieja = $ClaveVieja;
        $this->mail = $mail;
    }


    public function check($usuarios)
    {
        foreach ($usuarios as $fila) {
            if ($fila['nombre'] == $this->nombre & $fila['clave'] == $this->ClaveVieja & $fila['mail'] == $this->mail) {
                if (self::UpdateClave($fila['id'], $this->claveNueva))
                    return true;
            }
        }
        return false;
    }

    public static function UpdateClave($id, $claveNueva)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("update usuario set clave=:claveNueva WHERE id=:id");
        $consulta->bindValue(':claveNueva', $claveNueva, PDO::PARAM_STR);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        return $consulta->execute();
    }

    public static function TraerTodoLosUsuarios()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=tp01;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $sql = $db->query('SELECT * FROM usuario ');
            $catidadFilas = $sql->rowCount();
            $resultado = $sql->fetchall();
            return $resultado;
        } catch (PDOException $ex) {
            echo "error ocurrido!";
            echo $ex->getMessage();
        }
    }
}
