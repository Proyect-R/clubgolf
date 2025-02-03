<?php 
/*
1º composer init
2º composer require nikic/fast-route
3º composer require vlucas/phpdotenv

require 'vendor/autoload.php';

1º fallo: ruta en composer.json, al iniciar composer te define la ruta de autoload en src
  - en este ejemplo he creado esta estructura (en la raiz de proyecto, carpetas Controlador, Modelo, Utils)
    "autoload": {
        "psr-4": {
          "Controlador\\": "Controlador/",
          "Modelo\\": "Modelo/",
          "Utils\\": "Utils/"
        }
    }
  - luego ejecutar: composer dump-autoload
        (siempre que se cambien los nombres y/o las rutas de los directorios o los archivos hay que hacerlo)

2º rutas: mirar nombre de namespace, nombre de class de los archivos en Controlador, Modelo, Utils 
y comparar con composer.json y index.
    - si se cambia el nombre de la carpeta vistas hay que cambiarlo en utils: 
        static function render($view, $data = [])
    {
        //Extract recibe un array asociativo con nombres de variables como las clasves y sus valores y sus valores
        extract($data);
        require_once  "./AQUI--->vista<---/$view.php";
    }
*/
?>