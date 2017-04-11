<?php
//echo '<pre>';
//print_r($post);
//echo '</pre>';
?>
<form name="frm-agregar" id="frm-agregar" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
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
                            <label for="url_facebook" class="col-sm-2 control-label">Facebook:</label>
                            <div class="col-sm-5">
                                <input type="text" name="url_facebook" id="url_facebook" class="form-control"  placeholder="Facebook" value="<?php echo $post['url_facebook']; ?>">
                            </div>
                            <?php echo form_error('url_facebook'); ?>
                        </div>
                        <div class="form-group">
                            <label for="url_googleplus" class="col-sm-2 control-label">Google Plus:</label>
                            <div class="col-sm-5">
                                <input type="text" name="url_googleplus" id="url_googleplus" class="form-control"  placeholder="Google Plus" value="<?php echo $post['url_googleplus']; ?>">
                            </div>
                            <?php echo form_error('url_googleplus'); ?>
                        </div>
                        <div class="form-group">
                            <label for="url_twitter" class="col-sm-2 control-label">Twitter:</label>
                            <div class="col-sm-5">
                                <input type="text" name="url_twitter" id="url_twitter" class="form-control"  placeholder="Twitter" value="<?php echo $post['url_twitter']; ?>">
                            </div>
                            <?php echo form_error('url_twitter'); ?>
                        </div>
                        <div class="form-group">
                            <label for="url_youtube" class="col-sm-2 control-label">Youtube:</label>
                            <div class="col-sm-5">
                                <input type="text" name="url_youtube" id="url_youtube" class="form-control"  placeholder="Youtube" value="<?php echo $post['url_youtube']; ?>">
                            </div>
                            <?php echo form_error('url_youtube'); ?>
                        </div>
                        <div class="form-group">
                            <label for="url_pinterest" class="col-sm-2 control-label">Pinterest:</label>
                            <div class="col-sm-5">
                                <input type="text" name="url_pinterest" id="url_pinterest" class="form-control"  placeholder="Pinterest" value="<?php echo $post['url_pinterest']; ?>">
                            </div>
                            <?php echo form_error('url_pinterest'); ?>
                        </div>
                    </div>
                </div>

            </div>
            <!--//Tabs-->
        </div>
    </div><!--//panel-->
</form>