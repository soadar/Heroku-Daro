<?php

class Usuario
{
    private $id;
    private $nombre;
    private $apellido;
    private $clave;
    private $mail;
    private $fecha_de_registro;
    private $localidad;

    public function InsertarBD()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre, apellido, mail,clave,localidad, fecha_de_registro)values('$this->nombre','$this->apellido','$this->mail','$this->clave','$this->localidad','$this->fecha_de_registro')");
        if ($consulta->execute())
            return true;
        return false;
    }

    public static function TraerTodoLosUsuarios()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select * from usuario");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
    }

    public static function ListarUsuarios($array)
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
