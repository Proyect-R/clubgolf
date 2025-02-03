<?php

namespace Controlador;

use Modelo\clubgolf_model;
use Utils\Utils;

class main_club_controller
{
    public function listadoClubs()
    {     
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
}