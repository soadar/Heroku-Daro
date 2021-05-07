<?php

class user
{
    public $id;
    public $nombre; // titulo
    public $password; // cantante
    public $email; //año

    public function BorrarCd()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
				delete 
				from usuario 				
				WHERE id=:id");
        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }

    public static function BorrarCdPorAnio($email)
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
            delete 
            from usuario 				
            WHERE mail=:email");
        $consulta->bindValue(':email', $email, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }
    public function ModificarCd()
    {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
            update usuario 
            set nombre='$this->nombre',
            clave='$this->password',
            mail='$this->email'
            WHERE id='$this->id'");
        return $consulta->execute();
    }


    public function InsertarElCd()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,clave,mail)values('$this->nombre','$this->password','$this->email')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function ModificarCdParametros()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("
            update usuario 
            set nombre=:nombre,
            clave=:password,
            mail=:email
            WHERE id=:id");
        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_INT);
        $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->password, PDO::PARAM_STR);
        return $consulta->execute();
    }

    public function InsertarElCdParametros()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,clave,mail)values(:nombre,:password,:email)");
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_INT);
        $consulta->bindValue(':password', $this->password, PDO::PARAM_STR);
        $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
    public function GuardarCD()
    {

        if ($this->id > 0) {
            $this->ModificarCdParametros();
        } else {
            $this->InsertarElCdParametros();
        }
    }


    public static function TraerTodoLosCds()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, nombre, clave as password, mail as email from usuario");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "user");
    }

    public static function TraerUnCd($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, nombre, clave as password, mail as email from usuario where id = $id");
        $consulta->execute();
        $userBuscado = $consulta->fetchObject('user');
        return $userBuscado;
    }

    public static function TraerUnCdAnio($id, $email)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, nombre, clave as password, mail as email from usuario WHERE id=? AND mail=?");
        $consulta->execute(array($id, $email));
        $userBuscado = $consulta->fetchObject('user');
        return $userBuscado;
    }

    public static function TraerUnCdAnioParamNombre($id, $email)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, nombre, clave as password, mail as email from usuario WHERE id=:id AND mail=:email");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':email', $email, PDO::PARAM_STR);
        $consulta->execute();
        $userBuscado = $consulta->fetchObject('user');
        return $userBuscado;
    }

    public static function TraerUnCdAnioParamNombreArray($id, $email)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, nombre, clave as password, mail as email from usuario WHERE id=:id AND mail=:email");
        $consulta->execute(array(':id' => $id, ':email' => $email));
        $consulta->execute();
        $userBuscado = $consulta->fetchObject('user');
        return $userBuscado;
    }

    public function mostrarDatos()
    {
        return "Metodo mostar:" . $this->nombre . "  " . $this->email . "  " . $this->password;
    }
}
