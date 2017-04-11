<form name="frm-agregar" id="frm-agregar" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">                    
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
                        <a href="<?php echo base_url(); ?>waadmin/noticias/index" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Cancelar</a>
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
                    <li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Otros detalles</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content tab-wa">
                    <div role="tabpanel" class="tab-pane active" id="tab-1">
                        <div class="form-group">
                            <label for="parent_id" class="col-sm-2 control-label">Categoría:</label>
                            <div class="col-sm-5">
                                <?php
                                echo select_categorias("noticia_categoria_id", "noticia_categoria", $post["noticia_categoria_id"]);
                                ?>
                            </div>
                            <?php echo form_error('noticia_categoria_id'); ?>
                        </div>
                        <div class="form-group">
                            <label for="titulo_corto" class="col-sm-2 control-label">Título corto:</label>
                            <div class="col-sm-5">
                                <input type="text" name="titulo_corto" id="titulo_corto" class="form-control"  placeholder="Título corto" value="<?php echo $post['titulo_corto']; ?>">
                            </div>
                            <?php echo form_error('titulo_corto'); ?>
                        </div>

                        <div class="form-group">
                            <label for="titulo_largo" class="col-sm-2 control-label">Título largo:</label>
                            <div class="col-sm-5">
                                <input type="text" name="titulo_largo" id="titulo_largo" class="form-control"  placeholder="Título largo" value="<?php echo $post['titulo_largo']; ?>">
                            </div>
                            <?php echo form_error('titulo_largo'); ?>
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
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="5" placeholder="Descripción"><?php echo $post['descripcion']; ?></textarea>
                            </div>
                            <?php echo form_error('descripcion'); ?>
                        </div>

                        <div class="form-group">
                            <label for="descripcion" class="col-sm-2 control-label">Destacar:</label>
                            <div class="col-sm-5">
                                <div class="checkbox">
                                    <?php
                                    if ($post['destacada'] != 0) {
                                        $checked = 'checked="checked"';
                                    }
                                    ?>
                                    <label>
                                        <input type="checkbox" name="destacada" id="destacada" value="1" <?php echo $checked;?>> Destacar noticia
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab-2">
                        <div class="form-group">
                            <label for="url_video" class="col-sm-2 control-label">Youtube URL:</label>
                            <div class="col-sm-5">
                                <input type="text" name="url_video" id="url_video" class="form-control"  placeholder="Youtube URL" value="<?php echo $post['url_video']; ?>">
                            </div>
                            <?php echo form_error('url_video'); ?>
                        </div>

                        <div class="form-group">
                            <label for="referencia_nombre" class="col-sm-2 control-label">Referencia:</label>
                            <div class="col-sm-5">
                                <input type="text" name="referencia_nombre" id="referencia_nombre" class="form-control"  placeholder="Referencia" value="<?php echo $post['referencia_nombre']; ?>">
                            </div>
                            <?php echo form_error('referencia_nombre'); ?>
                        </div>

                        <div class="form-group">
                            <label for="referencia_url" class="col-sm-2 control-label">Referencia URL:</label>
                            <div class="col-sm-5">
                                <input type="text" name="referencia_url" id="referencia_url" class="form-control"  placeholder="Referencia URL" value="<?php echo $post['referencia_url']; ?>">
                            </div>
                            <?php echo form_error('referencia_url'); ?>
                        </div>

                        <div class="form-group">
                            <label for="keywords" class="col-sm-2 control-label">Keywords:</label>
                            <div class="col-sm-5">
                                <input type="text" name="keywords" id="keywords" class="form-control"  placeholder="Keywords" value="<?php echo $post['keywords']; ?>">
                            </div>
                            <?php echo form_error('keywords'); ?>
                        </div>

                        <div class="form-group">
                            <label for="imagen_1" class="col-sm-2 control-label">Imagen:</label>
                            <div class="col-sm-5">
                                <input type="file" name="imagen_1" id="imagen_2" class="form-control" />
                                <i>600px * 380px Máximo</i>
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

                    </div>
                </div>

            </div>
            <!--//Tabs-->            
        </div>
    </div><!--//panel-->
</form>