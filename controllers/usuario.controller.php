<?php
session_start(); //Crear o heredar una sesión

//1.- Recibimos la solicitud del usuario
//2.- Procesamos con la ayuda de la modelo
//3.- Devolvemos un resultado (JSON);

require_once '../models/Usuario.php';

//isse() -> Función que rertorna "bool" si existe un ojeto
//$_POST[] -> Mecanismo envío de datos (usuario), es un tipo de solicitud, puede ser POST o GET
//$_GET[] -> Similar a POST pero muestra datos en URL

if(isset($_POST['operacion'])){

    $usuario = new Usuario(); //Se dispara el  __CONSTRUCT() -> se encuentra en el modelo

    if($_POST['operacion'] == 'login'){

        //Preparamaos el dato a enviar(arreglo asociativo)
        $datosEnviar = [
            "email" => $_POST['email']
        ];

        //Guardamos el registro de acceso(acceso), FALSE(incorrecto)
        $registro = $usuario->login($datosEnviar);

        $statusLogin = [
            "acceso" => false,
            "mensaje" => ""
        ];

        if($registro == false){

            $_SESSION["status"] = false;    //variable de seiones(asociativas)
            $statusLogin["mensaje"] = "el correo no existe";

        }else{

            //Si el correo existe, tenemos que validar la clave enviada ($_POST)
            //Contra la clave encriptada almacenada en la BD

            $claveEncriptada = $registro["claveacceso"];
            $_SESSION["idusuario"] = $registro["idusuario"];
            $_SESSION["nombres"] = $registro["nombres"];
            $_SESSION["apellidos"] = $registro["apellidos"];
            $_SESSION["nivelacceso"] = $registro["nivelacceso"];

            if(password_verify($_POST['claveacceso'],$claveEncriptada)){

                $_SESSION["status"] = true;
                $statusLogin["acceso"] = true;
                $statusLogin["mensaje"] = "Acceso es correcto";
            
            }else{

                $_SESSION["status"] = false;
                $statusLogin["mensaje"] ="error en la clave";
            
            }
        }

        echo json_encode($statusLogin);
    }// Fin de login
}

if(isset($_GET['operacion'])){

    if($_GET['operacion'] == 'destroy'){

        session_destroy();
        session_unset();

        header("Location:../index.php");
    }
}
