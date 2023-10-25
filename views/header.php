<?php
    session_start();  //Crear o heredar la sesión

    //Perfiles de usuarios -CONTROL DE ACCESO
    $permisos = [

        "PCT" =>["index","productos"], 
        "INV" =>["index","clientes","productos","proveedores"],
        "AST" =>["index","clientes","productos","proveedores","ventas"],
        "ADM" =>["index","clientes","productos","usuarios","proveedores","reportes","ventas"]

    ];

    if(!isset($_SESSION["status"]) || $_SESSION["status"] == false){
        //echo "<h1>Acceso denegado </h1>";
        header("Location:../index.php");
        exit();
    }

?>
<!doctype html>
<html lang="es">

<head>
  <title>Clientes</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <!--navbar-dark/light bg-dark/primary/info/danger-->
    <!--Primero color de fuente, segundo fondo de navbar-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
          <div class="container">
            <a class="navbar-brand" href="index.php">SENATI</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="clientes.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="proveedores.php">Proveedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportes.php">Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="usuarios.php">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ventas.php">Ventas</a>
                    </li>
                    -->
                    <?php

                    //Se obitne  la lista de módulos/vistas que tendrá el usuario
                    $listaOpciones = $permisos[$_SESSION["nivelacceso"]];

                    foreach($listaOpciones as $opcion){
                        if($opcion != "index"){
                            echo "
                            <li class='nav-item'>
                                <a class='nav-link' style='text-transform: capitalize' href='{$opcion}.php'>{$opcion}</a>
                            </li>
                            ";
                        }                           
                    }

                    ?>
                </ul>

                <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $_SESSION["apellidos"] ?>
                        <?= $_SESSION["nombres"] ?>
                        (<?= $_SESSION["nivelacceso"] ?>)
                    </a><!--<?php echo $_SESSION["nombres"]?>-->
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="../controllers/usuario.controller.php?operacion=destroy">Cerrar sesión</a>
                        <a class="dropdown-item" href="#">Cambiar contraseña</a>
                    </div>
                    </li>
                </ul>
            </div>
      </div>
    </nav>

    <?php
    $url = $_SERVER['REQUEST_URI'];
    /*
        /sesiones/test/url.php
        /carpeta/subcarpeta/archivo.php
    */

    $arregloURL = explode("/", $url);

    $vistaActual = $arregloURL[count($arregloURL) -1];

    //Debemos verificar si la lista actual se encuentra dentro de la listaOpciones

    $permitido = false;

    foreach ($listaOpciones as $opcion) {
        if($opcion . ".php" == $vistaActual){
            $permitido = true;
        }
    }

    if(!$permitido){
        echo "
            <div class='container'>
                <h3>acceso DENEGADO</h3>
                <hr>
                <p>
                Ud. no cuenta con los permisos suficientes para acceder a este apartado
                </p>
            </div>
        ";
        exit();
    }
    ?>
    <!--Se corto la cabezera de un archivo para no opiar o ser redundante en este codigo, y  con un require_once poder llevar todo este código al resto de archivos-->