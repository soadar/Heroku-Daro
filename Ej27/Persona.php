<?php
include "AccesoDatos.php";

class Persona
{
    private $nombre;
    private $apellido;
    private $clave;
    private $email;
    private $localidad;
    private $fechaAlta;

    public function __construct($nombre, $apellido, $clave, $email, $localidad)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->clave = $clave;
        $this->email = $email;
        $this->localidad = $localidad;
        $this->fechaAlta = date("m/d/Y");
    }

    public function InsertarBD()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre, apellido, mail,clave,localidad, fecha_de_registro)values('$this->nombre','$this->apellido','$this->email','$this->clave','$this->localidad','$this->fechaAlta')");
        if ($consulta->execute()) {
            return true;
        }
        return false;
    }
}
