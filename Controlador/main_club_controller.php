<?php

namespace Controlador;

use Modelo\clubgolf_model;
use Utils\Utils;

class main_club_controller
{
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
    public function eliminarClub($datos)
    {
        //Nos conectamos a la bd
        $con = Utils::getConnection(Utils::$dsn, Utils::$user, Utils::$password);
        //Creamos el modelo
        $clubs = new clubgolf_model($con);
        //borramos el entrenador
        $clubs->borrarClub($con, $datos['idClubGolf']);
        //Cargamos la vista
        Utils::redirect('/mostrar_clubs_view');
    }
}