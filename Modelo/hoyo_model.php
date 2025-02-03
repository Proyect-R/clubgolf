<?php

namespace Modelo;

use PDO;
use PDOException;
use Utils\Utils;

class Hoyo
{
    protected $con;
    function __construct($con)
    {
        //asignamos la conexion activa
        if ($con != null && $this->con == null) $this->con = $con;
    }
    function getHoyos($con, $idClub)
    {
        try {
            // Consulta para obtener las direcciones asociadas al cliente
            $sql = "SELECT hoyo.* FROM clubgolf INNER JOIN hoyo ON hoyo.idClubGolf = clubgolf.idClubGolf WHERE clubgolf.idClubGolf = :id;";

            // Usamos la conexión activa para preparar la sentencia SQL
            $stmt = $this->con->prepare($sql);

            // Definir la forma de devolver los datos
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            // Vinculamos el parámetro :id a la variable $id
            $stmt->bindParam(':id', $idClub, PDO::PARAM_INT);

            // Ejecutamos la consulta
            $resultado = $stmt->execute();

            if ($resultado) {
                // Obtenemos todas las direcciones asociadas al cliente
                $direcciones = $stmt->fetchAll();
                return $direcciones;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Si ocurre un error, lo mostramos
            echo 'Hubo un problema al obtener las direcciones: ' . $e->getMessage();
            return false;
        }
    }
}
