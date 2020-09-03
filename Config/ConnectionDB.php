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


  /**
 * Description of ConnectionDB
 *
 * @author demonscript
 */

//recordemos que el sig "require_once" debe ser como si se 
//estuviera utilizando desde
//los archivos contenidos directamente en el directorio "Model"...
require_once '../Config/ConnectData.php';

class ConnectionDB extends ConnectData
{
    //Los aributos privados estáticos solo serán accedidos desde dentro de la clase
    static public $connex;
    static private $responseSQL;
    static private $failure;
    
    /**
     * Connect database using the constructor
     * Conectarse a la BD mediante el constructor
     */
    public function __construct()
    {
        //echo 'jjjj <br>';
        try
        { 
            self::$connex = new PDO('pgsql:host='.parent::server_system.';
                                  dbname='.parent::db_system,
                                  parent::user_system,
                                  parent::user_pass
                              );
            //self::$connex->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //ejecución para capturar caracteres especiales...
            self::$connex->exec("SET NAMES ".parent::db_charset);
            /*
             * // La siguiente es otra conexión que funciona y tiene nuna sintaxis diferente... 
             * self::$connex = new PDO(
                                    "pgsql:dbname=".parent::db_system.
                                           ";host=".parent::server_system,
                                                    parent::user_system,
                                                    parent::user_pass
                                    );
             */  
            
            //echo "Congratulations Successful Connection!!!";
            
        }
        catch (PDOException $failure)
        {
           $message_error = $failure->getMessage();
           echo "error de acceso a PostgreSql...<br> ".$message_error;
           //header('Location: ../View/error.php?message='.$message_error);
           exit();
        }
        
        
    }
    
    /**
     * SQL procedure that returns a complete content
     * Procedimiento SQL que retorna un contenido Completo
     * @param type $sql_code
     * @return None
     */
    protected function general_query($sql_code)
    {
       
            
            $executeSQL = self::$connex->query($sql_code);
            //echo 'ejecutada SQL<br>';
            self::$responseSQL = $executeSQL;
            //echo 'consulta '.self::$connex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }
    
    /**
     * Este método posiblemente desaparezca porque en Postgresql se obtiene el ultimo
     * ID en la misma consulta de insertar o de seleccionar.
     * @param type $sql_code
     * @param type $id
     */
    protected function simple_query($sql_code,$id)
    {
        $query = self::$connex->query($sql_code);
        {
            $query = false;
        }
        
        
    }
    
    /**
         * procedure that returns SQL response as an object
         * Procedimiento que devuelve la respuesta de SQL Como un Objeto
         * @return string, Object or boolean
         */
        protected function get_response() 
        {
            
            if(self::$responseSQL === FALSE)
            {
                //echo 'NO';
                self::$failure = self::$connex->errorInfo();
            }
            return self::$responseSQL;
        }
        
        /**
         * Procedure that returns an SQL Error
         * Procedimiento que retorna un Error de SQL
         * @return string
         */
        protected function get_error()
        {
            return self::$failure;
        }
        protected function break_connection()
        {
//            unset(self::$connex);
//            exit();
            
        }
}
//class Insert extends ConnectionDB
//{
//    public function __construct()
//    {
//        
//        parent::__construct();
//    
//        
//    }
//    
//    public function all()
//    {
//        $query = "SELECT * FROM category";
//        parent::general_query($query);
//    }
//    public function new_cat()
//    {
//        $query = "INSERT INTO category (name, description) VALUES ('ooii', 'Ropa intima Femenina');"; 
//        parent::general_query($query);
//    }
//    public function get_response()
//    {
//        return parent::get_response();
//    }
//    public function get_error()
//    {
//        return parent::get_error();
//    }
//}
//
//$objectConection = new Insert;
//
//$new_category = $objectConection->all();
//
//$response = $objectConection->get_response();
////echo var_dump($response);
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
//    //$row =0;
//    $resp_obj = $response->fetchall(PDO::FETCH_OBJ);
//    var_dump($resp_obj);
//     while($data_row=$response->fetchall(PDO::FETCH_OBJ))
//        {
//         echo 'active ';
//         
//         if($data_row->status == '1')
//            {
//             echo 'active ';
//                $status = 1;
//            }
//         
//     }
//    $respuesta = $response->pg_fetch_object();
//    var_dump($respuesta);
////    foreach ($respuesta as $nmcat)
////    {
////        echo 'uuuuuuuu';
////    }
//    
//}