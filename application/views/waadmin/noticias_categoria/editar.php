<?php
//echo '<pre>';
//print_r($post);
//echo '</pre>';
?>
<form name="frm-editar" id="frm-editar" method="post" action="<?php echo base_url(); ?>waadmin/noticias_categoria/editar/<?php echo $post['id']; ?>" class="form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
                        <a href="<?php echo base_url(); ?>waadmin/noticias_categoria/index" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Categoría</label>
                <div class="col-sm-4">
                    <input type="text" name="nombre" id="nombre" class="form-control"  placeholder="Categoría" value="<?php echo $post["nombre"];?>">
                </div>
                <?php echo form_error('nombre'); ?>
            </div>
            <div class="form-group">
                <label for="url_key" class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-4">
                    <input type="text" name="url_key" id="url_key" class="form-control"  placeholder="Slug" value="<?php echo $post["url_key"];?>">
                </div>
            </div>

            <div class="form-group">
                <label for="parent_id" class="col-sm-2 control-label">Superior</label>
                <div class="col-sm-4">
                    <?php
                    echo select_categorias("parent_id", "noticia_categoria", $post["parent_id"]);
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-4">
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Descripción"><?php echo $post["descripcion"];?></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label for="orden" class="col-sm-2 control-label">Orden</label>
                <div class="col-sm-4">
                    <input type="text" name="orden" id="orden" class="form-control"  placeholder="Orden" value="<?php echo $post["orden"];?>">
                </div>
            </div>

        </div>
    </div><!--//panel-->
</form>