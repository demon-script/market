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

/**
 * Description of CommonSQLQueries:...
 * Inherit from the ConnectionDB class to initialize the connection to the Database
 * Hereda de la clase ConexionDB para disparar la conexión a la Base de Datos
 * @author demonscript
 */
require_once './Config/ConnectionDB.php';
class CommonSQLQueries extends ConnectionDB
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Procedure To select all Records in a table
     * Procedimiento para seleccionar todos los registros de una tabla
     * @param string $table_name
     * @return None
     */
    public function select_all($table_name)
    {
        $query = "SELECT * FROM $table_name ORDER BY id DESC";
        parent::general_query($query);
    }
    
    /**
     * procedure to select a record from a table
     * Procedimiento para seleccionar un registro de una tabla
     * @param string $table_name
     * @param string $field_name
     * @param int $field_id
     * @return None
     */
    public function select_by_ID($table_name,$field_name,$field_id)
    {
        $query = "SELECT * FROM $table_name WHERE $field_name = $field_id";
        parent::general_query($query);
        
    }
    
    /**
     * Procedure to select all records in a table according to their status
     * Procedimiento para seleccionar registros de una tabla según su estado 
     * @param String $table_name
     * @param Bool $state
     * @return None 
     */
    public function select_by_state($table_name,$state)
    {
        $query = "SELECT * FROM $table_name WHERE status = $state";
        parent::general_query($query);
    }
    
    /**
     * Procedure to Update a Record Status
     * Procedimiento para actualizar el estado de un registro
     * @param string $table_name
     * @param string $name_fieldID
     * @param int $fieldID
     * @param bool $state
     * @return None
     */
    public function update_state($table_name,$name_fieldID,$fieldID,$state)
    {
        $query = "UPDATE $table_name SET status='$state' WHERE $name_fieldID ='$fieldID'";
        parent::general_query($query);
    }
    
    /**
     * * procedure that gets an response
     * Procedimiento para obtener una respuesta
     * @return object, string or boolean.
     */
    public function get_response()
    {
        return parent::get_response();
    }
    
    /**
     * Procedure that gets an error
     * Procedimineto para obtener un error
     * @return string
     */
    public function get_error()
    {
        return parent::get_error();
    }
    
    /**
     * Procedure that request to break the connection with the DBMS
     * Procedimiento que solicita romper la conexión con el SGBD
     * @return Null
     */
    public  function break_connection()
    {
        parent::break_connection();
        return null;
    }
}


//        // Ensayo del código. Seleccionar contenido de una Tabla...
//       $objetc = new CommonSQLQueries();
//       $query = $objetc->select_all('category');
//       $response = $objetc->get_response();
//       
//      
//     
//       // retorna false cuando no encuentra una tabla con el nombre solicitado
//       if($response == FALSE)
//       {
//           //echo'<br>No Se encuentra una tabla con ese Nombre en la BD:... ';
//           //var_dump($response);
//        
//           $error = $objetc->get_error();
//           echo $error[2];
//       
//      // Si consultamos de nuevo vemos que no se obtiene porque ya rompimos la conexión
//       //$objetc->break_connection();
//       echo '<br>nueva consultassss ...<br> respuesta:... ';
//       $new_query = $objetc->select_all('category');
//       $new_response = $objetc->get_response();
//       
//       var_dump($new_response);
//       echo '<br>Error:... ';
//       var_dump($objetc->get_error());
//       }
//       // en caso contrario Retorna el objeto completo
//       else
//       {
//           
//           var_dump($response);
//       // Si consultamos de nuevo vemos que no se obtiene porque ya rompimos la conexión
//       //$break = $objetc->break_connection();
//       echo '<br>el final...';
//       var_dump($objetc->break_connection());
//       echo '<br>Nueva consu';
//       $new_query = $objetc->select_all('category');
//       $new_response = $objetc->get_response();
//       echo '<br>nueva consulta ...<br> respuesta:... ';
//       
//       var_dump($new_response);
//       
//       }
 