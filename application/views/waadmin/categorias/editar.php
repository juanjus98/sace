<?php
/*echo '<pre>';
print_r($post);
echo '</pre>';*/
?>
<div class="row">
   <div class="col-xs-12">
       <div class="box">

           <form class="form-horizontal" name="edit_form" id="edit_form" action="<?php echo $current_url;?>" method="post" role="form" enctype="multipart/form-data">

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
                               <a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $edit_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

                               <?php }?>

                               <a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
                           </div>
                       </div> 
                   </div>

                   <div class="box-body">
                       <div class="row pad" style="padding: 0px;">
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
                                                   <label for="nombre" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Categoría:</label>
                                                   <div class="col-sm-4">
                                                       <input name="nombre" id="nombre" type="text" value="<?php echo $post['nombre'];?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                                                       <?php echo form_error('nombre', '<div class="error">', '</div>'); ?>
                                                   </div>
                                                   <label for="url_key" class="col-sm-2 control-label" style="text-align: right;"> Slug:</label>
                                                   <div class="col-sm-4">
                                                       <input name="url_key" id="url_key" type="text" value="<?php echo $post['url_key'];?>" class="form-control input-sm" placeholder="Automático" disabled>
                                                   </div>
                                               </div>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td>
                                               <div class="form-group" style="margin-bottom: 0px;">
                                                   <label for="parent_id" class="col-sm-2 control-label" style="text-align: right;">Superior(Opcional):</label>
                                                   <div class="col-sm-4">
                                                    <?php
                                                        echo select_categorias("parent_id", "categoria", $post["parent_id"]);
                                                    ?>
                                                   </div>
                                               </div>
                                           </td>
                                       </tr>


                                       <tr>
                                           <td>
                                               <div class="form-group" style="margin-bottom: 0px;">
                                                   <label for="descripcion" class="col-sm-2 control-label" style="text-align: right;">Descripción:</label>
                                                   <div class="col-sm-10">
                                                       <textarea name="descripcion" id="descripcion" class="form-control" rows="3" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>><?php echo $post['descripcion'];?></textarea>
                                                   </div>
                                               </div>
                                           </td>
                                       </tr>

                                       <tr>
                                           <td>
                                               <div class="form-group" style="margin-bottom: 0px;">
                                                   <label for="orden" class="col-sm-2 control-label" style="text-align: right;">Orden:</label>
                                                   <div class="col-sm-4">
                                                       <input name="orden" id="orden" type="text" value="<?php echo $post['orden'];?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                                                   </div>
                                               </div>
                                           </td>
                                       </tr>

                                      <tr>
                                         <td colspan="4" style="vertical-align: middle;">
                                           <div class="form-group" style="margin-bottom: 0px;">
                                             <label for="destacar" class="col-sm-2 control-label" style="text-align: right;">Principal:</label>
                                             <div class="col-sm-4">
                                               <?php
                                               $checked_principal = "";
                                               if($post['destacar'] == 1){
                                                $checked_principal = "checked";
                                              }
                                              ?>
                                              <input class="form-control input-sm" id="destacar" name="destacar" type="checkbox" value="1" <?php echo $checked_principal;?> <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>> 

                                              <a href="#" style="font-size: 16px;" data-toggle="tooltip" data-placement="right" title="Muestra el producto en el home."><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>

                                   </tbody>
                               </table><br>

                               <table class="table table-bordered">
                                   <thead class="thead-default">
                                       <tr>
                                           <th colspan="4"><i class="fa fa-list"></i> Imagen</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr>
                                           <td>
                                               <div class="form-group" style="margin-bottom: 0px;">
                                                   <label for="imagen" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Imagen:</label>
                                                   <div class="col-sm-10">
                                                       <input type="file" name="imagen" id="imagen" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                                                       <?php
                                                       if(!empty($post['imagen'])){
                                                       ?>
                                                       <br>
                                                       <a href="<?php echo base_url('images/uploads/' . $post['imagen']);?>" target="_blank">
                                                       <img src="<?php echo base_url('images/uploads/' . $post['imagen']);?>" style="max-height: 60px;">
                                                       </a>
                                                       <?php }?>
                                                   </div>
                                               </div>
                                           </td>
                                       </tr>
                                   </tbody>
                               </table>
                           </div>
                       </div>
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
                                       <a class="btn btn-success btn-sm" title="Editar registro" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

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