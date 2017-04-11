<?php
//echo '<pre>';
//print_r($post);
//echo '</pre>';
?>
<form name="frm-editar" id="frm-editar" method="post" action="<?php echo base_url(); ?>waadmin/marcas/editar/<?php echo $post['id']; ?>" class="form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
                        <a href="<?php echo base_url(); ?>waadmin/marcas/index" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Cancelar</a>
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
                    <li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Imagen</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content tab-wa">
                    <div role="tabpanel" class="tab-pane active" id="tab-1">
                        <div class="form-group">
                            <label for="nombre" class="col-sm-2 control-label">Nombre marca:</label>
                            <div class="col-sm-4">
                                <input type="text" name="nombre" id="nombre" class="form-control"  placeholder="Nombre marca" value="<?php echo $post['nombre']; ?>">
                            </div>
                            <?php echo form_error('nombre'); ?>
                        </div>
                        <div class="form-group">
                            <label for="url_key" class="col-sm-2 control-label">Slug:</label>
                            <div class="col-sm-4">
                                <input type="text" name="url_key" id="url_key" class="form-control"  placeholder="Slug" value="<?php echo $post['url_key']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descripcion" class="col-sm-2 control-label">Descripción:</label>
                            <div class="col-sm-4">
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Descripción"><?php echo $post['descripcion']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="orden" class="col-sm-2 control-label">Orden:</label>
                            <div class="col-sm-4">
                                <input type="text" name="orden" id="orden" class="form-control"  placeholder="Orden" value="<?php echo $post['orden']; ?>">
                            </div>
                            <?php echo form_error('orden'); ?>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab-2">
                        <div class="form-group">
                            <label for="imagen_1" class="col-sm-2 control-label">Imagen:</label>
                            <div class="col-sm-5">
                                <input type="file" name="imagen" id="imagen" class="form-control" />
                                <i>300px * 300px</i>
                            </div>
                            <?php echo form_error('imagen'); ?>
                        </div>

                        <?php
                        if (!empty($post['imagen'])) {
                            ?>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <a href="<?php echo base_url(); ?>images/upload/<?php echo $post['imagen']; ?>" target="_blank">
                                        <img src="<?php echo base_url(); ?>images/upload/<?php echo $post['imagen']; ?>" alt="" class="preview-image" />
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
            <!--//Tabs-->
        </div>
    </div><!--//panel-->
</form>