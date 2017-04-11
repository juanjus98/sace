<?php
/*echo '<pre>';
print_r($productos);
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
             <fieldset <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
               <div class="col-sm-12">

                 <table class="table table-bordered">
                   <thead class="thead-default">
                     <tr>
                       <th colspan="4"><i class="fa fa-list"></i> Información de Contácto</th>
                     </tr>
                   </thead>
                   <tbody>
                    <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="codigo_orden" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Código:</label>
                         <div class="col-sm-4">
                           <input name="codigo_orden" id="codigo_orden" type="text" value="<?php echo $post['codigo_orden'];?>" class="form-control input-sm" placeholder="Automático" disabled>
                           <?php echo form_error('codigo_orden', '<div class="error">', '</div>'); ?>
                         </div>
                         <!-- <label for="url_key" class="col-sm-2 control-label" style="text-align: right;"> Slug:</label>
                         <div class="col-sm-4">
                           <input name="url_key" id="url_key" type="text" value="<?php echo $post['url_key'];?>" class="form-control input-sm" placeholder="Automático" disabled>
                         </div> -->
                       </div>
                     </td>
                   </tr>
                   <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="empresa" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Empresa:</label>
                         <div class="col-sm-4">
                           <input name="empresa" id="empresa" type="text" value="<?php echo $post['empresa'];?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <?php echo form_error('empresa', '<div class="error">', '</div>'); ?>
                         </div>

                         <label for="nombres" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Nombres y Apellidos:</label>
                         <div class="col-sm-4">
                           <input name="nombres" id="nombres" type="text" value="<?php echo $post['nombres'];?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <?php echo form_error('nombres', '<div class="error">', '</div>'); ?>
                         </div>
                       </div>
                     </td>
                   </tr>

                   <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="email" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>E-mail:</label>
                         <div class="col-sm-4">
                           <input name="email" id="email" type="text" value="<?php echo $post['email'];?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                         </div>

                         <label for="telefono" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Teléfono:</label>
                         <div class="col-sm-4">
                           <input name="telefono" id="telefono" type="text" value="<?php echo $post['telefono'];?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <?php echo form_error('telefono', '<div class="error">', '</div>'); ?>
                         </div>
                       </div>
                     </td>
                   </tr>

                   <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="mensaje" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>mensaje:</label>
                         <div class="col-sm-10">
                           <textarea name="mensaje" id="mensaje" class="form-control" rows="3" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>><?php echo $post['mensaje'];?></textarea>
                         </div>
                       </div>
                     </td>
                   </tr>

                 </tbody>
               </table><br>

               <table class="table table-bordered">
                 <thead class="thead-default">
                   <tr>
                     <th>
                       <i class="fa fa-list"></i> Productos

                   <!-- <span class="pull-right">
                    <a href="#" class="btn btn-info btn-xs" id="btn-agregar-especificacion">
                      Agregar especificación <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                  </span> -->

                </th>
              </tr>
            </thead>
            <tbody>
             <tr>
               <td>
                 <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th colspan="2" class="text-center">Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (!empty($productos)) {
                        foreach ($productos as $index => $item) {
                          ?>
                          <tr>
                            <td>
                              <?php $imagen = base_url() . 'imagens/w100_h100_at__' . $item['imagen'];?>
                              <img src="<?php echo $imagen;?>" alt="<?php echo $item['nombre_corto'];?>">
                            </td>
                            <td style="vertical-align: middle;">
                              <h4>
                                <?php echo $item['producto_codigo'] . "-" . $item['nombre_corto'];?><br>
                                <small><?php echo $item['nombre_categoria'];?></small>
                              </h4>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                              <input type="text" class="form-control" placeholder="Cantidad" value="<?php echo $item['cantidad'];?>">
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                              <input type="text" class="form-control" placeholder="Cantidad" value="<?php echo $item['precio'];?>">
                            </td>
                          </tr>
                          <?php
                        }
                      } else {
                        ?>
                        <tr>
                          <td colspan="4"><h3 class="text-center">Sin registros.</h3></td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
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