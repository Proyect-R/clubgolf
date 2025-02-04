<?php 
/*
1º composer init
2º composer require nikic/fast-route
3º composer require vlucas/phpdotenv

1º COMPOSER: 
    ruta en composer.json, al iniciar composer te define la ruta de autoload en src
  - en este ejemplo he creado esta estructura (en la raiz de proyecto; carpetas Controlador, Modelo, Utils)
    "autoload": {
        "psr-4": {
          "Controlador\\": "Controlador/",
          "Modelo\\": "Modelo/",
          "Utils\\": "Utils/"
        }
    }
  - luego ejecutar: composer dump-autoload
        (siempre que se cambien los nombres y/o las rutas de los directorios o los archivos hay que hacerlo)

2º RUTAS: 
    - mirar nombre de namespace, nombre de class de los archivos en Controlador, Modelo, Utils 
      y comparar con composer.json y index.
    - si se cambia el nombre de la carpeta vistas hay que cambiarlo en utils: 
        static function render($view, $data = [])
    {
        //Extract recibe un array asociativo con nombres de variables como las clasves y sus valores y sus valores
        extract($data);
        require_once  "./AQUI--->vista<---/$view.php";
    }

3º  GET, 
    - en el index y el controlador se tiene que poner el mismo nombre de ID, ejemplo;
      Index:
        $r->addRoute('GET', '/mostrar_clubs_view/{idClubGolf:\d+}', ['Controlador\main_club_controller', 'eliminarClub']);
      Controlador:
        $clubs->borrarClub($con, $datos['idClubGolf']);

  - Tambien hay que comprobar que la BD no este en DELETE NO ACTION, UPDATE NO ACTION, y quitar VISIBLE
    por espacion en blanco

4º VARIABLES DE ENTORNO
    - agregar donde se vayan a usar: 
      Primero: 
        require_once __DIR__ . '/../vendor/autoload.php';
      Segundo: 
        use Dotenv\Dotenv;
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();
      Tercero:
        - en utils, añadir una funcion para asignar las variables de entorno
                public static function init()
          {
              self::$dsn = $_ENV['DSN'];
              self::$user = $_ENV['DB_USERNAME'];
              self::$password = $_ENV['DB_PASSWORD'];
          }
      Cuarto:
        Instanciar la funcion init(), ponerlo donde se vaya a usar la conexion ejemplo en el controlador;
              public function listadoClubs()
          {     
              Utils::init();
              $con = Utils::getConnection(Utils::$dsn, Utils::$user, Utils::$password);
              // Creamos el modelo
              $clubM = new clubgolf_model();

              // Cargamos los clientes paginados
              $clubs = $clubM->getClubs($con);

              // Compactamos los datos que necesita la vista
              $datos = compact("clubs");

              // Renderizamos la vista
              Utils::render('mostrar_clubs_view', $datos);
          }
*/
?>