<?php
//echo '<pre>';
//print_r($servicio_info);
//echo '</pre>';
?>
<form name="frm-agregar" id="frm-agregar" method="post" action="<?php echo base_url(); ?>waadmin/servicios_galeria/agregar/<?php echo $post['servicio_id']; ?>" class="form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="servicio_id" id="servicio_id" value="<?php echo $post['servicio_id']; ?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
                        <a href="<?php echo base_url(); ?>waadmin/servicios_galeria/index/<?php echo $post['servicio_id']; ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Volver</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="imagen" class="col-sm-2 control-label">Imágen:</label>
                <div class="col-sm-5">
                    <input type="file" name="imagen" id="imagen" class="form-control" />
                    <i>600px * 450px</i>
                </div>
                <?php echo form_error('titulo'); ?>
            </div>
            
            <div class="form-group">
                <label for="titulo" class="col-sm-2 control-label">Título:</label>
                <div class="col-sm-5">
                    <input type="text" name="titulo" id="titulo" class="form-control"  placeholder="Título" value="<?php echo $post['titulo']; ?>">
                </div>
                <?php echo form_error('titulo'); ?>
            </div>

            <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">Descripción:</label>
                <div class="col-sm-5">
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Descripción"><?php echo $post['descripcion']; ?></textarea>
                </div>
                <?php echo form_error('descripcion'); ?>
            </div>

            <div class="form-group">
                <label for="orden" class="col-sm-2 control-label">Orden:</label>
                <div class="col-sm-5">
                    <input type="text" name="orden" id="orden" class="form-control"  placeholder="Orden" value="<?php echo $post['orden']; ?>">
                </div>
                <?php echo form_error('orden'); ?>
            </div>
        </div>
    </div><!--//panel-->
</form>