<?php

require_once 'Conexion.php';

class Usuario extends Conexion{

    private $pdo;  //ATRIBUTO O PROPIEDAD DE LA CLASE

    public function __CONSTRUCT(){

        $this->pdo = parent::getConexion();

    }

    public function login($datos =[]){
        try{
            $consulta = $this->pdo->prepare("call spu_usuarios_login(?)");
            $consulta->execute(
                array(
                    $datos['email']
                )
            );

            return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }
}