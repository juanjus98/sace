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
                       <th colspan="4"><i class="fa fa-list"></i> Información</th>
                     </tr>
                   </thead>
                   <tbody>
                    <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="id_condominio" class="col-sm-3 control-label" style="text-align: right;"> Condominio/Edificio:</label>
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
                      </div>
                    </td>
                  </tr>
                  <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="nombre_grupo" class="col-sm-3 control-label" style="text-align: right;"> Nombre tipo de unidad:</label>
                       <div class="col-sm-4">
                         <input name="nombre_grupo" id="nombre_grupo" type="text" value="<?php echo $retVal = (!empty($post['nombre_grupo'])) ? $post['nombre_grupo'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('nombre_grupo', '<div class="error">', '</div>'); ?>
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

               <a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
             </div>

           </div>

         </div>
       </div>

     </form>

   </div>
 </div>
</div>