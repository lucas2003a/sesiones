<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenidos</h1>

    <?php
    $url = $_SERVER['REQUEST_URI'];
    /*
        /sesiones/test/url.php
        /carpeta/subcarpeta/archivo.php
    */

    $arregloURL = explode("/", $url);

    echo "<pre>";
    var_dump($arregloURL);
    echo "</pre>";

    echo $arregloURL[count($arregloURL) -1];
    ?>
</body>
</html>