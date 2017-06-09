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
                         <label for="condominio_id" class="col-sm-2 control-label" style="text-align: right;"> Condominio/Edificio:</label>
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

                        <!-- <label for="comprobante_numeraciones_id" class="col-sm-2 control-label" style="text-align: right;"> Serie:</label>
                         <div class="col-sm-4">
                         <select name="comprobante_numeraciones_id" id="comprobante_numeraciones_id" class="form-control">
                            <option value="">Seleccione</option>
                            <?php
                            if (!empty($series)) {
                              foreach ($series as $serie) {
                                $selected = "";
                                if ($post['comprobante_numeraciones_id'] == $serie['id']) {
                                  $selected = "selected";
                                }
                                echo '<option value="' . $serie['id'] . '" ' . $selected . '>' . $serie['serie'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <?php echo form_error('comprobante_numeraciones_id', '<div class="error">', '</div>'); ?>
                        </div> -->

                      </div>
                    </td>
                  </tr>
                 <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="concepto" class="col-sm-2 control-label" style="text-align: right;"> Concepto:</label>
                       <div class="col-sm-10">
                         <input name="concepto" id="concepto" type="text" value="<?php echo $retVal = (!empty($post['concepto'])) ? $post['concepto'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('concepto', '<div class="error">', '</div>'); ?>
                       </div>
                     </div>
                   </td>
                 </tr>
                 <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="moneda" class="col-sm-2 control-label" style="text-align: right;"> Moneda:</label>
                       <div class="col-sm-4">
                         <select name="moneda" id="moneda" class="form-control">
                            <option value="">Seleccione</option>
                            <?php
                            if (!empty($monedas)) {
                              foreach ($monedas as $indice=>$moneda) {
                                $selected = "";
                                if ($post['moneda'] == $indice) {
                                  $selected = "selected";
                                }
                                echo '<option value="' . $indice . '" ' . $selected . '>' . $indice . '</option>';
                              }
                            }
                            ?>
                          </select>
                         <?php echo form_error('fecha_emision', '<div class="error">', '</div>'); ?>
                       </div>
                       <label for="importe" class="col-sm-2 control-label" style="text-align: right;"> Importe:</label>
                       <div class="col-sm-4">
                         <input name="importe" id="importe" type="text" value="<?php echo $retVal = (!empty($post['importe'])) ? $post['importe'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('importe', '<div class="error">', '</div>'); ?>
                       </div>
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