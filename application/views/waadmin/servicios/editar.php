<?php
//echo '<pre>';
//print_r($post);
//echo '</pre>';
?>
<form name="frm-editar" id="frm-editar" method="post" action="<?php echo base_url(); ?>waadmin/servicios/editar/<?php echo $post['id']; ?>" class="form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
                        <a href="<?php echo base_url(); ?>waadmin/servicios/index" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <!--Tabs-->
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">Información</a></li>
                    <li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Imágenes</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content tab-wa">
                    <div role="tabpanel" class="tab-pane active" id="tab-1">
                        <div class="form-group">
                            <label for="servicio_categoria_id" class="col-sm-2 control-label">Categoría:</label>
                            <div class="col-sm-4">
                                <?php
                                echo select_categorias("servicio_categoria_id", "servicio_categoria", $post["servicio_categoria_id"]);
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre_corto" class="col-sm-2 control-label">Nombre corto:</label>
                            <div class="col-sm-5">
                                <input type="text" name="nombre_corto" id="nombre_corto" class="form-control"  placeholder="Nombre corto" value="<?php echo $post['nombre_corto']; ?>">
                            </div>
                            <?php echo form_error('nombre_corto'); ?>
                        </div>

                        <div class="form-group">
                            <label for="nombre_largo" class="col-sm-2 control-label">Nombre largo:</label>
                            <div class="col-sm-5">
                                <input type="text" name="nombre_largo" id="nombre_largo" class="form-control"  placeholder="Nombre largo" value="<?php echo $post['nombre_largo']; ?>">
                            </div>
                            <?php echo form_error('nombre_corto'); ?>
                        </div>

                        <div class="form-group">
                            <label for="resumen" class="col-sm-2 control-label">Resumen:</label>
                            <div class="col-sm-5">
                                <textarea name="resumen" id="resumen" class="form-control" rows="2" placeholder="Resumen"><?php echo $post['resumen']; ?></textarea>
                            </div>
                            <?php echo form_error('resumen'); ?>
                        </div>

                        <div class="form-group">
                            <label for="descripcion" class="col-sm-2 control-label">Descripción:</label>
                            <div class="col-sm-5">
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" placeholder="Descripción"><?php echo $post['descripcion']; ?></textarea>
                            </div>
                            <?php echo form_error('descripcion'); ?>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab-2">
                        <div class="form-group">
                            <label for="imagen_1" class="col-sm-2 control-label">Imágen:</label>
                            <div class="col-sm-5">
                                <input type="file" name="imagen_1" id="imagen_1" class="form-control" />
                                <i>400px * 400px</i>
                            </div>
                            <?php echo form_error('imagen_1'); ?>
                        </div>


                        <?php
                        if (!empty($post['imagen_1'])) {
                            ?>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <a href="<?php echo base_url(); ?>images/upload/<?php echo $post['imagen_1']; ?>" target="_blank">
                                        <img src="<?php echo base_url(); ?>images/upload/<?php echo $post['imagen_1']; ?>" alt="" class="preview-image" />
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>


<!--                        <div class="form-group">
                            <label for="imagen_2" class="col-sm-2 control-label">Imágen:</label>
                            <div class="col-sm-5">
                                <input type="file" name="imagen_2" id="imagen_2" class="form-control" />
                                <i>600px * 315px</i>
                            </div>
                            <?php echo form_error('imagen_2'); ?>
                        </div>-->

                        <?php
//                        if (!empty($post['imagen_2'])) {
                            ?>
<!--                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <a href="<?php echo base_url(); ?>images/upload/<?php echo $post['imagen_2']; ?>" target="_blank">
                                        <img src="<?php echo base_url(); ?>images/upload/<?php echo $post['imagen_2']; ?>" alt="" class="preview-image" />
                                    </a>
                                </div>
                            </div>-->
                            <?php
//                        }
                        ?>

                    </div>
                </div>

            </div>
            <!--//Tabs-->
        </div>
    </div><!--//panel-->
</form>