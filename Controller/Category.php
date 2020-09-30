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

//Inicialmente capturamos los datos provenientes de la capa View...
//Initially we capture the data coming from the Views layer.
$view_data = $_POST;
if(empty($view_data))
{
    exit('No hay Datos para procesar');
}

//capturar el valor de la clave "option"
//capture the value of the "option" key
$option = $view_data["option"];

//Condicionar el contenido de la var "option" para obtener la herencia requerida
//Condition the content of the "option" variable to obtain the required inheritance
/**#@+
 * Bloque condicional de la variable $opción para heredar de la clase CommonSQLSQueries
 * Conditional block of variable $option to inherit from CommonSQLSQueries class
 */

if($option=='select_all' || $option=='by_id' || $option=='by_state' || $option=='update_state' || $option=='repeat')
{ 
    require_once '../Model/CommonSQLQueries.php';
    
    /*
     * Clase que hereda de CommonSQLQueries
     * class inherit to CommonSQLQueries
     */
    class AjaxCategory extends CommonSQLQueries
    {
        /**
         * Datos de la capa View destinados a la Clase CommonSQLQueries
         */
        static private $data_process;
        
        /**
         * recibir los datos requeridos para el proceso, mediante el constructor
         * receive the data required for the process, through the constructor...
         * posteriormente, se lanza la conexión con el SGBD
         * subsequently, the connection with the DBMS is launched
         * finalmente, los datos requeridos se asignan al atributo $view_data
         * finally, the required data is assigned to the $view_data attribute
         * @param array() $view_data
         */
        public function __construct($view_data)
        {
            parent::__construct();
            self::$data_process = $view_data;
        }
        
        
        /**
         * Método para enviar datos al Modelo
         * Method to send data to Model
         */
        public function process()
        {
            /*
             * capturar los datos del formulario en variables independientes
             * capture form data into independent variables...
             * @var string option
             * @var string search_words
             * @var string search_field_name
             * @var int id_cat
             * @var bool actual_state
             * @var bool new_state
             */
            $option = self::$data_process["option"];
            $search_words = self::$data_process["word"];
            $search_field_name = self::$data_process["search_field"];
            $id_cat = self::$data_process["id_cat"];
            $actual_state = self::$data_process["actual_state"];
            $new_state = self::$data_process["new_state"];
            
            $field_PK = "id";
            
            switch ($option) 
            {
                case "select_all":
                    parent::select_all('category');
                    break;
                
                case "by_id":
                    
                    parent::select_by_ID('category', $field_PK, $id_cat);
                    break;
                case "repeat":
                    parent::count_by_field('category', $search_field_name, $search_words);
                    break;
                
                case "by_state":
                    parent::select_by_state('category', $actual_state);
                    break;
                
                default:
                    parent::update_state('category', $field_PK, $id_cat, $new_state);
                    break;
            }
            
        }
        
        /**
         * procedimiento relacionado con la clase CommonSQLQueries para obtener una respuesta
         * procedure related to the CommonSQLQueries class to get a response
         * @return object or @return array() or @return string or @return boolean 
         */
        public function get_response()
        {
            return parent::get_response();
        }
        
        /**
         * procedimiento relacionado con la clase CommonSQLQueries para obtener un error
         * procedure related to CommonSQLQueries class to get error
         * @return string
         */
        public function get_error()
        {
            return parent::get_error();
        }
        
        /**
         * procedimiento relacionado con la clase CommonSQLQueries que solicita romper la conexión con el SGBD
         * procedure related to CommonSQLQueries class that requests to break the connection with the DBMS
         */
        public function break_connection()
        {
            parent::break_connection();
            
        }        

       
    } //end Class
    
    //Creación del objeto para ejecutar la solicitud del form...
    $ObjectCat = new AjaxCategory($view_data);
    $ObjectCat->process();
    $response = $ObjectCat->get_response();
    
    if($response==FALSE || $response==NULL)
    {
        $response = $ObjectCat->get_error();
    }
    
        if($option == 'by_id' || $option=='repeat')
    {
        //utilizamos JSon para codificar mediante clave-Valor un registro
        $objectDB = $response->fetchobject();
        $response = json_encode($objectDB);
        //$response = $number->number;
    }
    
    
    /**#@+
     * obtener un array de datos a partir de un objeto
     * get an array of data from an object
     */
    if ($option == 'select_all' || $option == 'by_state')
    {
        //$data_row= $response->fetchobject();
        //var_dump($data_row);
        //echo 'Select all';
        $dataset = Array();
        while ($data_row= $response->fetchobject())
            {
            
                if($data_row->status == '1')
                {
                    $status = 1;
                }
                else
                {
                    $status = 0;
                }
                $dataset[] = array
                        (
                            // con el siguiente código implemento una bifurcación IF:...
                            // "0"=>($status)?:
                            // De manera que lo correspondiente a true va a continuación del signo de pregunta ?
                            // y el código que va después de los dos puntos : es para cuando la condición no se cumple:...
                           "0"=>($status)?'<button class="btn btn-success fa" title="Editar '.$data_row->name. '" onclick="show_byID('.$data_row->id.')"> <i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></button>'.
                            ' <button class="btn btn-success fa" title="Desactivar '.$data_row->name. '" onclick="enable_disable('.$data_row->id.','.$status.')"> <i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>':
                            '<button class="btn btn-success fa" title="Editar '.$data_row->name. '" onclick="show_byID('.$data_row->id.')"> <i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></button>'.
                            ' <button class="btn btn-success fa" title="Activar '.$data_row->name. '" onclick="enable_disable('.$data_row->id.','.$status.')"><i class="fa fa-hand-peace-o" aria-hidden="true"></i></button>',//$data_row->idcategory,
                           "1"=>$data_row->name,
                           "2"=>$data_row->description,
                           // de nuevo implemento la bifurcación o condicional para mostrar la respectiva imágen:...
                           "3"=>($status)?'<img src="Public/img/enable.png" title="Activa" width="30" height="30" />':'<img src="Public/img/disable.png" title="Inactiva" width="30" height="30" />'
                           
                        );
            }//end while
     
        // Configuramos la información para el DataTable.
        $DataTable = array
                (
                    "sEcho"=>1,
                    "iTotalRecords"=> count($dataset),//num de registros obtenidos
                    "iTotalDisplayRecords"=> count($dataset),//num de registros a mostrar
                    "aaData"=>$dataset
                );
        $response = json_encode($DataTable);
        //var_dump($response);
        
    }
    /*#@+
     * end of elseif
     */
    $ObjectCat->break_connection();
   
    //var_dump($dataset);
    echo $response;
    
} 
/**#@-
 * Fin del Condicional superior
 */

/**#@+
 * Bloque condicional de la variable $opción para heredar de la clase Category
 * Conditional block of variable $option to inherit from Category class
 */
 else 
{    
   
    require_once '../Model/Category.php';
    
    class AjaxCategory extends Category
    {
        /**
         * Datos de la capa View destinados a la Clase Category
         */
        static private $data_process;
        
        /**
         * recibir los datos requeridos para el proceso, mediante el constructor
         * receive the data required for the process, through the constructor...
         * posteriormente, se lanza la conexión con el SGBD
         * subsequently, the connection with the DBMS is launched
         * finalmente, los datos requeridos se asignan al atributo $view_data
         * finally, the required data is assigned to the $view_data attribute
         * @param array() $view_data
         */
        public function __construct($view_data)
        {
            parent::__construct();
            self::$data_process = $view_data;
        }
        
        /**
         * Método para enviar datos al Modelo
         * Method to send data to Model
         */
        public function process()
        {
            /*
             * capturar los datos del formulario en variables independientes
             * capture form data into independent variables...
             * 
             */
            $name_cat = self::$data_process["name"];
            $description = self::$data_process["description"];
            $id_cat = self::$data_process["id_cat"];
            
            
            if($id_cat==="")
            {
               
               parent::new_cat($name_cat, $description);
            }
            else
            {
                
               parent::update_cat($id_cat, $name_cat, $description);  
            }
            
            
        }
        
        /**
         * procedimiento relacionado con la clase Category para obtener una respuesta
         * procedure related to the Category class to get a response
         * @return object or @return array() or @return string or @return boolean 
         */
        public function get_response()
        {
            return parent::get_response();
        }
        
        /**
         * procedimiento relacionado con la clase Category para obtener un error
         * procedure related to Categoryry class to get error
         * @return string
         */
        public function get_error()
        {
            return parent::get_error();
        }
        
        /**
         * procedimiento relacionado con la clase Category que solicita romper la conexión con el SGBD
         * procedure related to Category class that requests to break the connection with the DBMS
         */
        public function break_connection()
        {
            parent::break_connection();
            
        }        
    
    }
    
    $ObjectCat = new AjaxCategory($view_data);
    
    $ObjectCat->process();
    $response = $ObjectCat->get_response();
    if($response==false || $response==null)
    {
        $error = $ObjectCat->get_error();
        $response = $error[2];
    }
    else
    {
        $response="Successful";
    }

    $ObjectCat->break_connection();
    echo $response;
    
}


