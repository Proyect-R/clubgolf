<?php

namespace Modelo;

use PDO;
use PDOException;
use Utils\Utils;

class Socio
{
    protected $con;
    function __construct($con)
    {
        //asignamos la conexion activa
        if ($con != null && $this->con == null) $this->con = $con;
    }
    function getSocios($con, $idClub)
    {
        try {
            // Consulta para obtener las direcciones asociadas al cliente
            $sql = "SELECT socio.* FROM socio INNER JOIN clubgolf_has_socio ON clubgolf_has_socio.idSocio = socio.idSocio WHERE clubgolf_has_socio.idClubGolf = :id";

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
    function removeSocio($con, $idSocio)
    {
        try {

            //Vamos a hacer un ejemplo en el cual borramos el entrenador numero 4
            $sql = "delete from clubgolf where id = ?";

            //Utilizamos la conexion activa de nuestro objeto
            //Para crear la sentencia sql
            $stmt = $this->con->prepare($sql);

            //Ejecutamos la sentencia substituyendo las interrogacions por los valores
            //Que metemos dentro del array que le pasamos a execute
            $resultado = $stmt->execute($idSocio);

            if($resultado){
                return 1;
            }
        } catch (PDOException $e) {
            //Hubo un problema al eliminar el registro
            echo 'Hubo un problema al eliminar el registro: ' . $e->getMessage();
            return -1;
        }
    }
    function insertarSocio($con, $socio)
    {
        try {

            //Vamos a hacer un ejemplo en el cual borramos el entrenador numero 4
            $sql = "INSERT INTO socio (";

            //Sacamos las claves que corresponden con los nombres de los campos
            $campos = array_keys($socio);

            //Primero añadimos los nombres de los campos que vienen como claves en el array asociativo
            for ($i = 0; $i < count($campos); $i++) {
                if ($i < count($campos) - 1)
                    $sql .= "$campos[$i],";
                else
                    $sql .= "$campos[$i]";
            }
            //Concatenamos la mitad de la sentencia
            $sql .= ") VALUES (";
            //Finalmente ponemos los parametros a la query
            for ($i = 0; $i < count($campos); $i++) {
                if ($i < count($campos) - 1)
                    $sql .= ":$campos[$i],";
                else
                    $sql .= ":$campos[$i]";
            }
            //Por ultimo cerramos el parentesis del VALUE
            $sql .= ")";

            //Utilizamos la conexion activa de nuestro objeto
            //Para crear la sentencia sql
            $stmt = $this->con->prepare($sql);

            echo $stmt->queryString;



            //Ejecutamos la sentencia substituyendo las interrogacions por los valores
            //Que metemos dentro del array que le pasamos a execute

            for ($i = 0; $i < count($campos); $i++) {
                //Dependiendo del tipo de dato le pongo el tipo de parametro pdo asociado
                //Usando la funcion obtenertipoparametro
                $tipo = Utils::obtenerTipoParametro($socio[$campos[$i]]);
                //gettype($datos[$campos[$i]])=="int"?PDO::PARAM_INT:PDO::PARAM_STR;
                $stmt->bindValue(':' . $campos[$i], $socio[$campos[$i]], $tipo);
            }
            $resultado = $stmt->execute($socio);

            //Devolvemos el resultado de la ejecucion de la sentencia
            return $resultado;
        } catch (PDOException $e) {
            //Hubo un problema al eliminar el registro
            echo 'Hubo un problema al insertar el registro: ' . $e->getMessage();
            return false;
        }
    }
}