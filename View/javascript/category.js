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
 * variable que almacena el contenido actual del DataTable
 * variable that stores the current content of the DataTable
 * @type {array}
 */
var table;

/**
 * función que se ejecuta con la carga inicial del archivo PHP
 * function that is executed with the initial load of the PHP file
 * @returns {undefined}
 */
function initial()
{
    show_form(false);
    show_records();
    
    //establecer la acción al presionar el botón submit ...
    $("#insert_record").on("submit",function(e) 
                            {
                                save_edit(e);
                            }
                        );
}

/**
 * Función que deja los campos de los elementos HTML en blanco mediante JQuery...
 * Function that clears HTML element fields using JQuery
 * @returns {none}
 */
function clean_fields()
{
    
    //llamamos a los objetos HTML por su id...
    $("#name").val("");
    $("#id_cat").val("");
    $("#description").val("");
}

/**
 * función que muestra el formulario o la lista de datos 
 * function that displays the form or data list
 * @param {boolean} signal
 * @returns {none}
 */
function show_form(signal)
{
    //limpiar contenido de los objetos HTML...
    clean_fields();
    
    if(signal===true)
    {
        //Ocultar registros listados
        $("#list_records").hide();
        
        //mostrar formulario de ingreso
        $("#new_record").show();
        
        //PENDIENTE este botón los podemo activar de forma interactiva con las cajitas de texto:...
       $("#save").prop("disabled",false);
    }
    else
    {
        //mostrar registros listados
        $("#list_records").show();
        
        //Ocultar formulario de ingreso
        $("#new_record").hide();
    }
}

/**
 * cancelar envío de datos
 * cancel sending data
 * @returns {none}
 */
function cancel_form()
{
    clean_fields();
    show_form(false);
}

/**
 * función para obtener registros mediante AJAX
 * function to get records using AJAX
 * @returns {none}
 */
function show_records()
{
    table=$("#record_table").dataTable
                                (
                                    {
                                        "aProcessing":true, //prcesamiento de datos activo
                                        "aServerSide":true,//paginación y filtrado activo desde el servidor
                                        dom: 'Bfrtip',//definir elementos de control de la tabla
                                        buttons:// definnimos botones de control para exportar registors a formatos predefinidos..
                                                [
                                                    'copyHtml5',
                                                    'excelHtml5',
                                                    'csvHtml5',
                                                    'pdf'
                                                ],
                                        "ajax":
                                                {
                                                    url:'../Controller/Category.php',
                                                    type:"POST",
                                                    dataType:"json",
                                                    data:{"option":'select_all'},
                                                    error:function(e)// en caso de presentar error
                                                           {
                                                               console.log(e.responseText);
                                                           }                                                 
                                                },
                                                "bDestroy":true,
                                                "iDisplayLength":5,//paginación limitada a  5 registros
                                                "order":[[0,"asc"]]//organizar registros de manera ascendente por el campo id
                                    }
                                ).DataTable();
}

/**
 * 
 * @param {type} e
 * @returns {undefined}
 */
function save_edit(e)
    {
        e.preventDefault();//desactriva la ejecución normal del evento del botón
        $("#save").prop("disabled",true);
        var form_data = new FormData($("#insert_record")[0]);
        
        //petición AJAX:..
        $.ajax(
                {
                  url:'../Controller/Category.php?option=save_edit',
                  type:"POST",
                  data:form_data,
                  contentType: false,
                  processData: false,
                  //cuando todo se ejecuta correctamente, recibo la respuesta del servidor...
                    success: function (response) 
                    {
                        if(response === 'Successful')
                        {

                            $.toast({
                                        heading: 'Succes',
                                        text: 'Proceso Exitoso!!!...',
                                        textAlign: 'center',
                                        icon: 'success',
                                        loader: true,        // Change it to false to disable loader
                                        position: 'mid-center',
                                        showHideTransition: 'slide',
                                        hideAfter: 1500
                                        //loaderBg: '#9EC600'  // To change the background    
                                    });
                            //bootbox.alert("Proceso exitoso!!!...");
                        }
                        else
                        {
                           //$.toast('Error!!!... '+response);
                           $.toast({
                                        heading: 'Warning',
                                        text: response,
                                        textAlign: 'center',
                                        icon: 'error',
                                        loader: true,        // Change it to false to disable loader
                                        position: 'mid-center',
                                        showHideTransition: 'slide',
                                        hideAfter: 6000
                                        //loaderBg: '#9EC600'  // To change the background    
                                    });
                            //bootbox.alert(response); //muestro la respuesta 
                        }

                                
                        show_form(false);
                        table.ajax.reload();
                    }

                }
             );
        clean_fields()();  //limpiar los campos del formulario
    }
function message(nm_cat)
   {         
          
                $.post(
                    "../Controller/Category.php",
                    {option:'repeat',word:nm_cat,search_field:'name'},
                    function (data,status) 
                    //data es el valor obtenido del servidor mediante POST
                    //contiene el estado de la solicitudstatus("success", "notmodified", "error", "timeout", or "parsererror")
                    {
                        
                        if(data>= 1)
                        {
                           
                            
                            $.toast({
                                            heading: 'Warning',
                                            text: 'Esta Categoría ya existe !!!...',
                                            textAlign: 'center',
                                            icon: 'error',
                                            loader: true,        // Change it to false to disable loader
                                            position: 'mid-center',
                                            showHideTransition: 'slide',
                                            hideAfter: 2000
                                            //loaderBg: '#9EC600'  // To change the background    
                                    });
                                        
                        }                

                    }
                  );
                            
    }
initial(); //llamamos a initial en la carga del archivo