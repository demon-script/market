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
/**#@+
 * Description of CommonSQLQueries:...
 * CommonSQLQueries Inherit from the ConnectionDB class to initialize the connection to the Database
 * CommonSQLQueries Hereda de la clase ConexionDB para disparar la conexión a la Base de Datos
 * @author demonscript
 */
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
        $query = "SELECT * FROM $table_name";
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
     * procedimiento para contar registros en una tabla según el contenido de un campo
     * procedure to counting records in a table based on the content of a field
     * @param string $name_table
     * @param string $field_name
     * @param string $word
     * @return 
     */
    public function count_by_field($name_table,$field_name,$word)
    {
        $query = "SELECT COUNT(*) AS number FROM $name_table WHERE $field_name='$word'";
        
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
        
    }
}
/**#@-
 * End of Class CommonSQLQueries
 */



        // Ensayo del código. Seleccionar contenido de una Tabla...
//       $object = new CommonSQLQueries();
//       $query = $object->select_all('category');
//       $response = $object->get_response();
       
      
     
       // retorna false cuando no encuentra una tabla con el nombre solicitado
//       if($response == FALSE)
//       {
           //echo'<br>No Se encuentra una tabla con ese Nombre en la BD:... ';
           //var_dump($response);
//           echo 'no existe la tabla';
//           $error = $object->get_error();
//           echo $error[2];
//       
//      // Si consultamos de nuevo vemos que no se obtiene porque ya rompimos la conexión
//       $object->break_connection();
//       echo '<br>nueva consultassss ...<br> respuesta:... ';
//       $new_query = $object->select_all('category');
//       $new_response = $object->get_response();
//       
//       var_dump($new_response);
//       echo '<br>Error:... ';
//       var_dump($object->get_error());
//       }
       // en caso contrario Retorna el objeto completo
//       else
//       {
//           while($datos =$response->fetchobject())
//           {
//               echo '<br>'.$datos->name;
//           }
           //var_dump($response->fetchall());
         
       // Si consultamos de nuevo vemos que no se obtiene porque ya rompimos la conexión
       //$break = $objetc->break_connection();
//       echo '<br>el final...';
//       var_dump($object->break_connection());
//       echo '<br>Nueva consu';
//       $new_query = $object->select_all('category');
//       $new_response = $object->get_response();
//       echo '<br>nueva consulta ...<br> respuesta:... ';
//       
//       var_dump($new_response);
//     }
