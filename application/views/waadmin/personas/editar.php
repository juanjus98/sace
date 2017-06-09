<?php
/*echo '<pre>';
print_r($condominios);
echo '</pre>';*/
?>
<div class="row">
 <div class="col-xs-12">
   <div class="box">

     <form class="form-horizontal" name="edit_form" id="edit_form" action="<?php echo $current_url = (!empty($popop)) ? $current_url . '?' . $popop : $current_url ;?>" method="post" role="form">

       <?php if($wa_tipo == 'E'){ ?> <input type="hidden" name="id" value="<?php echo $post['id'];?>"><?php }?>

       <div class="box-header" style="padding-bottom: 0;">
         <h3 class="box-title"><?php echo $tipo; ?></h3>
         <div class="box-tools">
           <div class="pull-right">
             <?php
             if($wa_tipo == 'C' || $wa_tipo == 'E'){
               ?>
               <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
               <?php
             }
             if($wa_tipo == 'V'){
               ?>
               <a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $editar_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

               <?php }?>

               <a href="<?php echo $back_url = (!empty($popop)) ? $back_url . '?' . $popop : $back_url ;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
             </div>
           </div> 
         </div>

         <div class="box-body">
           <div class="row pad" style="padding: 0px;">
             <fieldset <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
               <div class="col-sm-12">

                 <table class="table table-bordered">
                   <thead class="thead-default">
                     <tr>
                       <th colspan="4"><i class="fa fa-list"></i> Información</th>
                     </tr>
                   </thead>
                   <tbody>
                    <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="condominio_id" class="col-sm-2 control-label" style="text-align: right;"> Condominio / Edificio:</label>
                         <div class="col-sm-4">
                         <select name="condominio_id" id="condominio_id" class="form-control" readonly>
                            <!-- <option value="">Seleccione</option> -->
                            <?php
                            if (!empty($condominios)) {
                              foreach ($condominios as $condominio) {
                                $selected = "";
                                if ($post['condominio_id'] == $condominio['id']) {
                                  $selected = "selected";
                                }
                                echo '<option value="' . $condominio['id'] . '" ' . $selected . '>' . $condominio['nombre_condominio'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <?php echo form_error('condominio_id', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                        <label for="codigo_tipo_documento" class="col-sm-2 control-label" style="text-align: right;"> Tipo Documento:</label>
                         <div class="col-sm-4">
                         <select name="codigo_tipo_documento" id="codigo_tipo_documento" class="form-control">
                            <option value="">Seleccione</option>
                            <?php
                            if (!empty($tipos_documentos)) {
                              foreach ($tipos_documentos as $tipo_documento) {
                                $selected = "";
                                if ($post['codigo_tipo_documento'] == $tipo_documento['codigo']) {
                                  $selected = "selected";
                                }
                                echo '<option value="' . $tipo_documento['codigo'] . '" ' . $selected . '>' . $tipo_documento['nombre_corto'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <?php echo form_error('codigo_tipo_documento', '<div class="error">', '</div>'); ?>
                        </div>

                       <label for="nro_documento" class="col-sm-2 control-label" style="text-align: right;"> N° Documento:</label>
                       <div class="col-sm-4">
                         <input name="nro_documento" id="nro_documento" type="text" value="<?php echo $retVal = (!empty($post['nro_documento'])) ? $post['nro_documento'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('nro_documento', '<div class="error">', '</div>'); ?>
                       </div>
                     </div>
                   </td>
                 </tr>

                 <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                        <label for="nombres" class="col-sm-2 control-label" style="text-align: right;"> Nombres:</label>
                       <div class="col-sm-4">
                         <input name="nombres" id="nombres" type="text" value="<?php echo $retVal = (!empty($post['nombres'])) ? $post['nombres'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('nombres', '<div class="error">', '</div>'); ?>
                       </div>

                       <label for="apellidos" class="col-sm-2 control-label" style="text-align: right;"> Apellidos:</label>
                       <div class="col-sm-4">
                         <input name="apellidos" id="apellidos" type="text" value="<?php echo $retVal = (!empty($post['apellidos'])) ? $post['apellidos'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('apellidos', '<div class="error">', '</div>'); ?>
                       </div>
                     </div>
                   </td>
                 </tr>

                 <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                        <label for="telefono1" class="col-sm-2 control-label" style="text-align: right;"> Teléfono:</label>
                       <div class="col-sm-4">
                         <input name="telefono1" id="telefono1" type="text" value="<?php echo $retVal = (!empty($post['telefono1'])) ? $post['telefono1'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('telefono1', '<div class="error">', '</div>'); ?>
                       </div>

                       <label for="celular1" class="col-sm-2 control-label" style="text-align: right;"> Celular:</label>
                       <div class="col-sm-4">
                         <input name="celular1" id="celular1" type="text" value="<?php echo $retVal = (!empty($post['celular1'])) ? $post['celular1'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('celular1', '<div class="error">', '</div>'); ?>
                       </div>
                     </div>
                   </td>
                 </tr>

                 <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                        <label for="email" class="col-sm-2 control-label" style="text-align: right;"> E-mail:</label>
                       <div class="col-sm-4">
                         <input name="email" id="email" type="text" value="<?php echo $retVal = (!empty($post['email'])) ? $post['email'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                       </div>

                       <!-- <label for="celular1" class="col-sm-2 control-label" style="text-align: right;"> Celular:</label>
                       <div class="col-sm-4">
                         <input name="celular1" id="celular1" type="text" value="<?php echo $retVal = (!empty($post['celular1'])) ? $post['celular1'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('celular1', '<div class="error">', '</div>'); ?>
                       </div> -->
                     </div>
                   </td>
                 </tr>

               </tbody>
             </table><br>
           </div>
         </fieldset >
       </div><!--end pad-->
     </div>

     <div class="box-header">
       <div class="row pad" style="padding-top: 0px; padding-bottom: 0px;">
         <div class="col-sm-6">

           <p><span style="color: red; font-weight: bold;"><strong>(*)</strong> Campos obligatorios.</span></p>

         </div>
         <div class="col-sm-6">

           <div class="pull-right">
             <?php
             if($wa_tipo == 'C' || $wa_tipo == 'E'){
               ?>
               <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
               <?php
             }
             if($wa_tipo == 'V'){
               ?>
               <a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $editar_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

               <?php }?>

               <a href="<?php echo $back_url = (!empty($popop)) ? $back_url . '?' . $popop : $back_url ;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
             </div>

           </div>

         </div>
       </div>

     </form>

   </div>
 </div>
</div>