<?php
/*echo '<pre>';
print_r($condominios);
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
                       <th colspan="4"><i class="fa fa-list"></i> Comprobante</th>
                     </tr>
                   </thead>
                   <tbody>
                    <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="serie" class="col-sm-2 control-label" style="text-align: right;"> Serie:</label>
                         <div class="col-sm-4">
                         <select name="serie" id="serie" class="form-control">
                            <option value="">Seleccione</option>
                            <?php
                            if (!empty($series)) {
                              foreach ($series as $serie) {
                                $selected = "";
                                if ($post['serie'] == $serie['serie']) {
                                  $selected = "selected";
                                }
                                echo '<option value="' . $serie['serie'] . '" ' . $selected . '>' . $serie['serie'] . '</option>';
                              }
                            }
                            ?>
                          </select>
                          <?php echo form_error('serie', '<div class="error">', '</div>'); ?>
                        </div>

                        <label for="numero" class="col-sm-2 control-label" style="text-align: right;"> Número:</label>
                         <div class="col-sm-4">
                         <input name="numero" id="numero" type="text" value="<?php echo $retVal = (!empty($post['numero'])) ? $post['numero'] : '';?>" placeholder="Autogenerado" class="form-control input-sm" disabled>
                          <?php echo form_error('numero', '<div class="error">', '</div>'); ?>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="fecha_emision" class="col-sm-2 control-label" style="text-align: right;"> Emisión:</label>
                       <div class="col-sm-4">
                         <input name="fecha_emision" id="fecha_emision" type="text" value="<?php echo $retVal = (!empty($post['fecha_emision'])) ? fecha_es($post['fecha_emision'],'d/m/a') : '';?>" class="form-control input-sm input-date">
                         <?php echo form_error('fecha_emision', '<div class="error">', '</div>'); ?>
                       </div>

                       <label for="fecha_vencimiento" class="col-sm-2 control-label" style="text-align: right;"> Vencimiento:</label>
                       <div class="col-sm-4">
                         <input name="fecha_vencimiento" id="fecha_vencimiento" type="text" value="<?php echo $retVal = (!empty($post['fecha_vencimiento'])) ? fecha_es($post['fecha_vencimiento'],'d/m/a') : '';?>" class="form-control input-sm input-date">
                         <?php echo form_error('fecha_vencimiento', '<div class="error">', '</div>'); ?>
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

                       <label for="total" class="col-sm-2 control-label" style="text-align: right;"> Total:</label>
                       <div class="col-sm-4">
                         <input name="total" id="total" type="text" value="<?php echo $retVal = (!empty($post['total'])) ? $post['total'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('total', '<div class="error">', '</div>'); ?>
                       </div>

                     </div>
                   </td>
                 </tr>
               </tbody>
             </table><br>

             <table class="table table-bordered">
                   <thead class="thead-default">
                     <tr>
                       <th colspan="4"><i class="fa fa-list"></i> Detalles
                       <span class="pull-right">
                        <a href="<?php echo $concepto_url;?>" class="btn btn-primary btn-xs wapopup" data-width="800" data-height="600" title="Agregar">
                          <i class="fa fa-plus" aria-hidden="true"></i> Agregar
                        </a>
                    </span>
                       </th>
                     </tr>
                   </thead>
                   <thead class="thead-primary">
                     <tr>
                       <th>Descripción</th>
                       <th class="text-center">Importe</th>
                       <th></th>
                     </tr>
                   </thead>
                   <tbody id="cont_detalles">
                     <!--TR AQUÌ-->
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

               <a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
             </div>

           </div>

         </div>
       </div>

     </form>

   </div>
 </div>
</div>