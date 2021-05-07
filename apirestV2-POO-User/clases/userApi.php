<?php
require_once 'user.php';
require_once 'IApiUsable.php';

class userApi extends user implements IApiUsable
{
    public function TraerUno($request, $response, $args)
    {
        $id = $args['id'];
        $elCd = user::TraerUnCd($id);
        $newResponse = $response->withJson($elCd, 200);
        return $newResponse;
    }
    public function TraerTodos($request, $response, $args)
    {
        $todosLosCds = user::TraerTodoLosCds();
        $newResponse = $response->withJson($todosLosCds, 200);
        return $newResponse;
    }
    public function CargarUno($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $nombre = $ArrayDeParametros['nombre'];
        $password = $ArrayDeParametros['password'];
        $email = $ArrayDeParametros['email'];

        $micd = new user();
        $micd->nombre = $nombre;
        $micd->password = $password;
        $micd->email = $email;
        $micd->InsertarElCdParametros();

        $archivos = $request->getUploadedFiles();
        $destino = "./fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);

        $nombreAnterior = $archivos['foto']->getClientFilename();
        $extension = explode(".", $nombreAnterior);
        //var_dump($nombreAnterior);
        $extension = array_reverse($extension);

        $archivos['foto']->moveTo($destino . $email . "." . $extension[0]);
        $response->getBody()->write("se guardo el cd");

        return $response;
    }
    public function BorrarUno($request, $response, $args)
    {
        $ArrayDeParametros = $request->getParsedBody();
        $id = $ArrayDeParametros['id'];
        $cd = new user();
        $cd->id = $id;
        $cantidadDeBorrados = $cd->BorrarCd();

        $objDelaRespuesta = new stdclass();
        $objDelaRespuesta->cantidad = $cantidadDeBorrados;
        if ($cantidadDeBorrados > 0) {
            $objDelaRespuesta->resultado = "algo borro!!!";
        } else {
            $objDelaRespuesta->resultado = "no Borro nada!!!";
        }
        $newResponse = $response->withJson($objDelaRespuesta, 200);
        return $newResponse;
    }

    public function ModificarUno($request, $response, $args)
    {
        //$response->getBody()->write("<h1>Modificar  uno</h1>");
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);    	
        $micd = new user();
        $micd->id = $ArrayDeParametros['id'];
        $micd->titulo = $ArrayDeParametros['titulo'];
        $micd->cantante = $ArrayDeParametros['cantante'];
        $micd->año = $ArrayDeParametros['anio'];

        $resultado = $micd->ModificarCdParametros();
        $objDelaRespuesta = new stdclass();
        //var_dump($resultado);
        $objDelaRespuesta->resultado = $resultado;
        return $response->withJson($objDelaRespuesta, 200);
    }
}
