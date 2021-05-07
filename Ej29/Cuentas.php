<?php

class Cuentas
{
    private $clave;
    private $mail;

    public function __construct($mail, $clave)
    {
        $this->mail = $mail;
        $this->clave = $clave;
    }

    public function check($array)
    {
        $claveAux = null;
        $flag = 0;
        foreach ($array as $fila) {
            if ($this->mail == trim($fila['mail'])) {
                $claveAux = trim($fila['clave']);
                $flag = 1;
                break;
            }
        }
        if ($flag == 1 && $this->clave == $claveAux)
            return "Verificado";
        elseif ($flag == 1 && $this->clave != $claveAux)
            return "Error en los datos";
        else
            return "Usuario no registrado si no coincide el mail";
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
}
