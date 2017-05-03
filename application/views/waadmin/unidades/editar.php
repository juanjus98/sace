<?php
/*echo '<pre>';
print_r(array_reverse($propietarios));
echo '</pre>';*/
?>
<div class="row">
 <div class="col-xs-12">
   <div class="box">

     <form class="form-horizontal" name="edit_form" id="edit_form" action="<?php echo $current_url;?>" method="post" role="form">

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
               <a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
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
                         <label for="id_condominio" class="col-sm-2 control-label" style="text-align: right;"> Condominio/Edificio:</label>
                         <div class="col-sm-4">
                           <select name="id_condominio" id="id_condominio" class="form-control" readonly>
                            <!-- <option value="">Seleccione</option> -->
                            <?php
                            if (!empty($condominios)) {
                              foreach ($condominios as $condominio) {
                                $selected = "";
                                if ($post['id_condominio'] == $condominio['id']) {
                                  $selected = "selected";
                                }
                                echo '<option value="' . $condominio['id'] . '" ' . $selected . '>' . $condominio['nombre_condominio'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <?php echo form_error('id_condominio', '<div class="error">', '</div>'); ?>
                        </div>

                        <label for="id_grupo" class="col-sm-2 control-label" style="text-align: right;"> Tipo de Unidad:</label>
                        <div class="col-sm-4">
                         <select name="id_grupo" id="id_grupo" class="form-control">
                          <option value="">Seleccione</option>
                          <?php
                          if (!empty($grupos)) {
                            foreach ($grupos as $grupo) {
                              $selected = "";
                              if ($post['id_grupo'] == $grupo['id']) {
                                $selected = "selected";
                              }
                              echo '<option value="' . $grupo['id'] . '" ' . $selected . '>' . $grupo['nombre_grupo'] . '</option>';
                            }
                          }
                          ?>
                        </select>
                        <?php echo form_error('id_grupo', '<div class="error">', '</div>'); ?>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="nombre_unidad" class="col-sm-2 control-label" style="text-align: right;"> Nombre de unidad:</label>
                     <div class="col-sm-4">
                       <input name="nombre_unidad" id="nombre_unidad" type="text" value="<?php echo $retVal = (!empty($post['nombre_unidad'])) ? $post['nombre_unidad'] : '';?>" class="form-control input-sm">
                       <?php echo form_error('nombre_unidad', '<div class="error">', '</div>'); ?>
                     </div>
                   </div>
                 </td>
               </tr>

               <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="descripcion" class="col-sm-2 control-label" style="text-align: right;"> Descripción:</label>
                     <div class="col-sm-10">
                       <textarea name="descripcion" id="descripcion" class="form-control" rows="3" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>><?php echo $retVal = (!empty($post['descripcion'])) ? $post['descripcion'] : '' ; ;?></textarea>
                       <?php echo form_error('descripcion', '<div class="error">', '</div>'); ?>
                     </div>
                   </div>
                 </td>
               </tr>

               <tr>
                   <td colspan="4" style="vertical-align: middle;">
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="destacar" class="col-sm-2 control-label" style="text-align: right;">Aporta ingresos:</label>
                       <div class="col-sm-4">
                         <?php
                         $checked = "";
                         if(!empty($post['aporta_ingresos']) && $post['aporta_ingresos'] == 1){
                          $checked = "checked";
                        }
                        ?>
                        <input class="form-control input-sm" id="aporta_ingresos" name="aporta_ingresos" type="checkbox" value="1" <?php echo $checked;?> <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>> 
                      </div>
                    </div>
                  </td>
                </tr>

             </tbody>
           </table>
           <!--Propietarios-->
           <?php
           if(!empty($propietarios)){
            $propietarios = array_reverse($propietarios);
            $iip = 0;
            foreach ($propietarios as $key => $value) {
              $iip++;
              ?>
              <table class="table table-bordered table-child table-propietario">
               <thead class="thead-default">
                 <tr>
                   <th colspan="9"><i class="fa fa-users" aria-hidden="true"></i> Propietario
                    <span class="pull-right" id="cont-btns">
                      <?php
                      if($iip == 1){
                        ?>
                        <a href="<?php echo $propietario_url;?>" class="btn btn-primary btn-xs wapopup" data-width="800" data-height="600" title="Agregar">
                          <i class="fa fa-plus" aria-hidden="true"></i> Agregar
                        </a>
                        <?php
                      }
                      ?>
                      <a href="javascript:;" class="btn btn-danger btn-xs remove-table" data-width="800" data-height="600" data-tableclass="table-propietario" title="Quitar">
                        <i class="fa fa-times" aria-hidden="true"></i> Quitar
                      </a>
                    </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                    <label for="codigo_tipo_documento" class="col-sm-2 control-label" style="text-align: right;"> Tipo Documento:</label>
                    <div class="col-sm-4">
                    <input type="hidden" name="propietario[]" value="<?php echo $value['id'];?>"> <!--ID Propietario-->
                      <select name="codigo_tipo_documento" id="codigo_tipo_documento" class="form-control" disabled>
                        <option value="">Seleccione</option>
                        <?php
                        if (!empty($tipos_documentos)) {
                          foreach ($tipos_documentos as $tipo_documento) {
                            $selected = "";
                            if ($value['codigo_tipo_documento'] == $tipo_documento['codigo']) {
                              $selected = "selected";
                            }
                            echo '<option value="' . $tipo_documento['codigo'] . '" ' . $selected . '>' . $tipo_documento['nombre_corto'] . '</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>

                    <label for="nro_documento" class="col-sm-2 control-label" style="text-align: right;"> N° Documento:</label>
                    <div class="col-sm-4">
                     <input name="nro_documento" id="nro_documento" type="text" value="<?php echo $retVal = (!empty($value['nro_documento'])) ? $value['nro_documento'] : '';?>" class="form-control input-sm" disabled>
                   </div>
                 </div>
               </td>
             </tr>

             <tr>
               <td>
                 <div class="form-group" style="margin-bottom: 0px;">
                  <label for="nombres" class="col-sm-2 control-label" style="text-align: right;"> Nombres:</label>
                  <div class="col-sm-4">
                   <input name="nombres" id="nombres" type="text" value="<?php echo $retVal = (!empty($value['nombres'])) ? $value['nombres'] : '';?>" class="form-control input-sm" disabled>
                 </div>

                 <label for="apellidos" class="col-sm-2 control-label" style="text-align: right;"> Apellidos:</label>
                 <div class="col-sm-4">
                   <input name="apellidos" id="apellidos" type="text" value="<?php echo $retVal = (!empty($value['apellidos'])) ? $value['apellidos'] : '';?>" class="form-control input-sm" disabled>
                 </div>
               </div>
             </td>
           </tr>

           <tr>
             <td>
               <div class="form-group" style="margin-bottom: 0px;">
                <label for="telefono1" class="col-sm-2 control-label" style="text-align: right;"> Teléfono:</label>
                <div class="col-sm-4">
                 <input name="telefono1" id="telefono1" type="text" value="<?php echo $retVal = (!empty($value['telefono1'])) ? $value['telefono1'] : '';?>" class="form-control input-sm" disabled>
               </div>

               <label for="celular1" class="col-sm-2 control-label" style="text-align: right;"> Celular:</label>
               <div class="col-sm-4">
                 <input name="celular1" id="celular1" type="text" value="<?php echo $retVal = (!empty($value['celular1'])) ? $value['celular1'] : '';?>" class="form-control input-sm" disabled>
               </div>
             </div>
           </td>
         </tr>
         <tr>
           <td>
             <div class="form-group" style="margin-bottom: 0px;">
              <label for="email" class="col-sm-2 control-label" style="text-align: right;"> E-mail:</label>
              <div class="col-sm-4">
               <input name="email" id="email" type="text" value="<?php echo $retVal = (!empty($value['email'])) ? $value['email'] : '';?>" class="form-control input-sm" disabled>
             </div>
           </div>
         </td>
       </tr>
     </tbody>
   </table>
   <?php
 }
}else {
  ?>
  <table class="table table-bordered table-child table-propietario">
   <thead class="thead-default">
     <tr>
       <th colspan="9"><i class="fa fa-users" aria-hidden="true"></i> Propietario
        <span class="pull-right" id="cont-btns">
          <a href="<?php echo $propietario_url;?>" class="btn btn-primary btn-xs wapopup" data-width="800" data-height="600" title="Agregar">
            <i class="fa fa-plus" aria-hidden="true"></i> Agregar
          </a>

          <a href="javascript:;" class="btn btn-danger btn-xs remove-table" data-width="800" data-height="600" data-tableclass="table-propietario" title="Quitar">
            <i class="fa fa-times" aria-hidden="true"></i> Quitar
          </a>
        </span>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
     <td>
       <div class="form-group" style="margin-bottom: 0px;">
        <label for="codigo_tipo_documento" class="col-sm-2 control-label" style="text-align: right;"> Tipo Documento:</label>
        <div class="col-sm-4">
          <input type="hidden" name="propietario[]" value=""> <!--ID Propietario-->
          <select name="codigo_tipo_documento" id="codigo_tipo_documento" class="form-control" disabled>
            <option value="">Seleccione</option>
            <?php
            if (!empty($tipos_documentos)) {
              foreach ($tipos_documentos as $tipo_documento) {
                $selected = "";
                          /*if ($post['codigo_tipo_documento'] == $tipo_documento['codigo']) {
                            $selected = "selected";
                          }*/
                          echo '<option value="' . $tipo_documento['codigo'] . '" ' . $selected . '>' . $tipo_documento['nombre_corto'] . '</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>

                  <label for="nro_documento" class="col-sm-2 control-label" style="text-align: right;"> N° Documento:</label>
                  <div class="col-sm-4">
                   <input name="nro_documento" id="nro_documento" type="text" value="" class="form-control input-sm" disabled>
                 </div>
               </div>
             </td>
           </tr>

           <tr>
             <td>
               <div class="form-group" style="margin-bottom: 0px;">
                <label for="nombres" class="col-sm-2 control-label" style="text-align: right;"> Nombres:</label>
                <div class="col-sm-4">
                 <input name="nombres" id="nombres" type="text" value="" class="form-control input-sm" disabled>
               </div>

               <label for="apellidos" class="col-sm-2 control-label" style="text-align: right;"> Apellidos:</label>
               <div class="col-sm-4">
                 <input name="apellidos" id="apellidos" type="text" value="" class="form-control input-sm" disabled>
               </div>
             </div>
           </td>
         </tr>

         <tr>
           <td>
             <div class="form-group" style="margin-bottom: 0px;">
              <label for="telefono1" class="col-sm-2 control-label" style="text-align: right;"> Teléfono:</label>
              <div class="col-sm-4">
               <input name="telefono1" id="telefono1" type="text" value="" class="form-control input-sm" disabled>
             </div>

             <label for="celular1" class="col-sm-2 control-label" style="text-align: right;"> Celular:</label>
             <div class="col-sm-4">
               <input name="celular1" id="celular1" type="text" value="" class="form-control input-sm" disabled>
             </div>
           </div>
         </td>
       </tr>
       <tr>
         <td>
           <div class="form-group" style="margin-bottom: 0px;">
            <label for="email" class="col-sm-2 control-label" style="text-align: right;"> E-mail:</label>
            <div class="col-sm-4">
              <input name="email" id="email" type="text" value="" class="form-control input-sm" disabled>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <?php
}
?>
<!--//Propietarios-->

           <!--Moradores-->
           <?php
           if(!empty($moradores)){
            $moradores = array_reverse($moradores);
            $iim = 0;
            foreach ($moradores as $key => $value) {
              $iim++;
              ?>
              <table class="table table-bordered table-child table-morador">
               <thead class="thead-default">
                 <tr>
                   <th colspan="9"><i class="fa fa-male" aria-hidden="true"></i> Morador
                    <span class="pull-right" id="cont-btns">
                      <?php
                      if($iim == 1){
                        ?>
                        <a href="<?php echo $morador_url;?>" class="btn btn-primary btn-xs wapopup" data-width="800" data-height="600" title="Agregar">
                          <i class="fa fa-plus" aria-hidden="true"></i> Agregar
                        </a>
                        <?php
                      }
                      ?>
                      <a href="javascript:;" class="btn btn-danger btn-xs remove-table" data-width="800" data-height="600" data-tableclass="table-morador" title="Quitar">
                        <i class="fa fa-times" aria-hidden="true"></i> Quitar
                      </a>
                    </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                    <label for="codigo_tipo_documento" class="col-sm-2 control-label" style="text-align: right;"> Tipo Documento:</label>
                    <div class="col-sm-4">
                    <input type="hidden" name="morador[]" value="<?php echo $value['id'];?>"> <!--ID Morador(wa_persona)-->
                      <select name="codigo_tipo_documento" id="codigo_tipo_documento" class="form-control" disabled>
                        <option value="">Seleccione</option>
                        <?php
                        if (!empty($tipos_documentos)) {
                          foreach ($tipos_documentos as $tipo_documento) {
                            $selected = "";
                            if ($value['codigo_tipo_documento'] == $tipo_documento['codigo']) {
                              $selected = "selected";
                            }
                            echo '<option value="' . $tipo_documento['codigo'] . '" ' . $selected . '>' . $tipo_documento['nombre_corto'] . '</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>

                    <label for="nro_documento" class="col-sm-2 control-label" style="text-align: right;"> N° Documento:</label>
                    <div class="col-sm-4">
                     <input name="nro_documento" id="nro_documento" type="text" value="<?php echo $retVal = (!empty($value['nro_documento'])) ? $value['nro_documento'] : '';?>" class="form-control input-sm" disabled>
                   </div>
                 </div>
               </td>
             </tr>

             <tr>
               <td>
                 <div class="form-group" style="margin-bottom: 0px;">
                  <label for="nombres" class="col-sm-2 control-label" style="text-align: right;"> Nombres:</label>
                  <div class="col-sm-4">
                   <input name="nombres" id="nombres" type="text" value="<?php echo $retVal = (!empty($value['nombres'])) ? $value['nombres'] : '';?>" class="form-control input-sm" disabled>
                 </div>

                 <label for="apellidos" class="col-sm-2 control-label" style="text-align: right;"> Apellidos:</label>
                 <div class="col-sm-4">
                   <input name="apellidos" id="apellidos" type="text" value="<?php echo $retVal = (!empty($value['apellidos'])) ? $value['apellidos'] : '';?>" class="form-control input-sm" disabled>
                 </div>
               </div>
             </td>
           </tr>

           <tr>
             <td>
               <div class="form-group" style="margin-bottom: 0px;">
                <label for="telefono1" class="col-sm-2 control-label" style="text-align: right;"> Teléfono:</label>
                <div class="col-sm-4">
                 <input name="telefono1" id="telefono1" type="text" value="<?php echo $retVal = (!empty($value['telefono1'])) ? $value['telefono1'] : '';?>" class="form-control input-sm" disabled>
               </div>

               <label for="celular1" class="col-sm-2 control-label" style="text-align: right;"> Celular:</label>
               <div class="col-sm-4">
                 <input name="celular1" id="celular1" type="text" value="<?php echo $retVal = (!empty($value['celular1'])) ? $value['celular1'] : '';?>" class="form-control input-sm" disabled>
               </div>
             </div>
           </td>
         </tr>
         <tr>
           <td>
             <div class="form-group" style="margin-bottom: 0px;">
              <label for="email" class="col-sm-2 control-label" style="text-align: right;"> E-mail:</label>
              <div class="col-sm-4">
               <input name="email" id="email" type="text" value="<?php echo $retVal = (!empty($value['email'])) ? $value['email'] : '';?>" class="form-control input-sm" disabled>
             </div>
           </div>
         </td>
       </tr>
     </tbody>
   </table>
   <?php
 }
}else {
  ?>
  <table class="table table-bordered table-child table-morador">
   <thead class="thead-default">
     <tr>
       <th colspan="9"><i class="fa fa-male" aria-hidden="true"></i> Morador
        <span class="pull-right" id="cont-btns">
          <a href="<?php echo $morador_url;?>" class="btn btn-primary btn-xs wapopup" data-width="800" data-height="600" title="Agregar">
            <i class="fa fa-plus" aria-hidden="true"></i> Agregar
          </a>

          <a href="javascript:;" class="btn btn-danger btn-xs remove-table" data-width="800" data-height="600" data-tableclass="table-morador" title="Quitar">
            <i class="fa fa-times" aria-hidden="true"></i> Quitar
          </a>
        </span>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
     <td>
       <div class="form-group" style="margin-bottom: 0px;">
        <label for="codigo_tipo_documento" class="col-sm-2 control-label" style="text-align: right;"> Tipo Documento:</label>
        <div class="col-sm-4">
          <input type="hidden" name="morador[]" value=""> <!--ID Morador (wa_persona)-->
          <select name="codigo_tipo_documento" id="codigo_tipo_documento" class="form-control" disabled>
            <option value="">Seleccione</option>
            <?php
            if (!empty($tipos_documentos)) {
              foreach ($tipos_documentos as $tipo_documento) {
                $selected = "";
                          /*if ($post['codigo_tipo_documento'] == $tipo_documento['codigo']) {
                            $selected = "selected";
                          }*/
                          echo '<option value="' . $tipo_documento['codigo'] . '" ' . $selected . '>' . $tipo_documento['nombre_corto'] . '</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>

                  <label for="nro_documento" class="col-sm-2 control-label" style="text-align: right;"> N° Documento:</label>
                  <div class="col-sm-4">
                   <input name="nro_documento" id="nro_documento" type="text" value="" class="form-control input-sm" disabled>
                 </div>
               </div>
             </td>
           </tr>

           <tr>
             <td>
               <div class="form-group" style="margin-bottom: 0px;">
                <label for="nombres" class="col-sm-2 control-label" style="text-align: right;"> Nombres:</label>
                <div class="col-sm-4">
                 <input name="nombres" id="nombres" type="text" value="" class="form-control input-sm" disabled>
               </div>

               <label for="apellidos" class="col-sm-2 control-label" style="text-align: right;"> Apellidos:</label>
               <div class="col-sm-4">
                 <input name="apellidos" id="apellidos" type="text" value="" class="form-control input-sm" disabled>
               </div>
             </div>
           </td>
         </tr>

         <tr>
           <td>
             <div class="form-group" style="margin-bottom: 0px;">
              <label for="telefono1" class="col-sm-2 control-label" style="text-align: right;"> Teléfono:</label>
              <div class="col-sm-4">
               <input name="telefono1" id="telefono1" type="text" value="" class="form-control input-sm" disabled>
             </div>

             <label for="celular1" class="col-sm-2 control-label" style="text-align: right;"> Celular:</label>
             <div class="col-sm-4">
               <input name="celular1" id="celular1" type="text" value="" class="form-control input-sm" disabled>
             </div>
           </div>
         </td>
       </tr>
       <tr>
         <td>
           <div class="form-group" style="margin-bottom: 0px;">
            <label for="email" class="col-sm-2 control-label" style="text-align: right;"> E-mail:</label>
            <div class="col-sm-4">
              <input name="email" id="email" type="text" value="" class="form-control input-sm" disabled>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <?php
}
?>
<!--//Moradores-->

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

         <a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
       </div>

     </div>

   </div>
 </div>

</form>

</div>
</div>
</div>