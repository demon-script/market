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
    require_once'./header.php';
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Categorías <button class="btn btn-success" onclick="show_form(true)"><i class="fa fa-plus-circle"></i> Nueva</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="list_records">
                        <table id="record_table" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                            <th>Options</th><th>Name</th><th>Description</th><th>Status</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                            <th>Options</th><th>Name</th><th>Description</th><th>Status</th>
                            </tfoot>
                        </table>
                    </div>
                    
                    
                    <div class="panel-body" style="height: 400px;" id="new_record">
                        <form name="insert_record" id="insert_record" method="POST">
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label>Nombre:</label>
                                <i class="fa fa-angle-double-down"></i>
                                <input type="text" class="form-control" id="name" name="name" maxlength="50" placeholder="Nombre de la categoría" onblur=message(this.value) required>
                                <input type="hidden" id="id_cat" name="id_cat" value="">
                                <input type="hidden" id="id" name="id" value="">
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Descripción:...</label><i class="fa fa-angle-double-down"></i>
                                <input type="text" class="form-control" id="description" name="description" maxlength="256" placeholder="Descripción de la Categoría">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" id="save" type="submit">
                                    <i class="fa fa-cloud-upload"></i>  Insertar  
                                </button>
                                <button class="btn btn-danger" id="cancel" type="button" onclick="cancel_form()">
                                    <i class="fa fa-thumbs-down"></i>  Cancelar  
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
require_once './footer.php';
?>
<script src="javascript/category.js" type="text/javascript"></script>