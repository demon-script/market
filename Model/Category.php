<?php

/*
 * * * * * * * * * * * * * * * * * * * * * * * * * *
 * * Copyleft(C)  2020 GNU General Public License V3 * * 
 * * *         Made with love in Colombia!!!           * * *
 * *         @Author:... ==>DEMONSCRIPT<==           * *
 * * * * * * * * * * * * * * * * * * * * * * * * * *
  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once '../Config/ConnectionDB.php';
/**
 * Description of category
 * Inherit from the ConnectionDB class to initialize the connection to the Database
 * Hereda de la clase ConexionDB para disparar la conexión a la Base de Datos
 * @author demonscript
 */

class Category extends ConnectionDB
{
    public function __construct()
    {
        
        parent::__construct();
    
        
    }
    
    /**
     * Procedure to create a New category
     * @param string $name
     * @param string $description
     * @return None
     */
    public function new_cat($nm,$dscrptn)
    {
        $query = "INSERT INTO category (name, description) VALUES ('$nm', '$dscrptn');"; 
        parent::general_query($query);
    }
    
    /**
     * Procedure to update caregory
     * Procedimiento para actualizar categoría
     * @param int $id_ctgry
     * @param string $nm
     * @param string $dscrptn
     */
    public function update_cat($id_ctgry,$nm,$dscrptn)
    {
        $query = "UPDATE category SET name ='$nm', description = '$dscrptn' WHERE id ='$id_ctgry'";
        parent::general_query($query);
            
    }
    
    /**
     * procedure that gets an response
     * Procedimiento para obtener una respuesta
     * @return array, Object or Boolean
     */
    public function get_response()
    {
        return parent::get_response();
    }
    
    /**
     ** Procedure that gets an error
     * @return string
     */
    public function get_error()
    {
        return parent::get_error();
    }
}

//// Prueba de conexión y de ejecución de una Consulta SQL...
//$objectConection = new Category();
//
//$new_category = $objectConection->new_cat('tornillo', 'goloso 1 pulg');
//
//$response = $objectConection->get_response();
//
//if ($response == FALSE)
//{
//    //mostramos el error a partir de un objeto tipo array que
//    //nos retorna el método
//    $error = $objectConection->get_error();
//    echo $error[2];
//    
//    // otra forma que funciona de la misma manera es...
//    //echo implode(":",$objectConection->get_error());
//}
//else
//{
//    echo 'proceso exitoso';
//}
