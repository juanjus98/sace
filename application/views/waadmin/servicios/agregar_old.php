<form name="frm-agregar" id="frm-agregar" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <a href="<?php echo base_url(); ?>waadmin/categorias" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Listado</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label for="nombre" class="col-sm-2 control-label">Categoría</label>
                <div class="col-sm-4">
                    <input type="text" name="nombre" id="nombre" class="form-control"  placeholder="Categoría">
                </div>
                <?php echo form_error('nombre'); ?>
            </div>
            <div class="form-group">
                <label for="url_key" class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-4">
                    <input type="text" name="url_key" id="url_key" class="form-control"  placeholder="Slug">
                </div>
            </div>

            <div class="form-group">
                <label for="parent_id" class="col-sm-2 control-label">Superior</label>
                <div class="col-sm-4">
                    <?php
                    echo select_categorias("parent_id", "categoria", $post["parent_id"]);
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-4">
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3" placeholder="Descripción"></textarea>
                </div>
            </div>
            
<!--            <div class="form-group">
                <label for="imagen" class="col-sm-2 control-label">Imágen</label>
                <div class="col-sm-4">
                    <input type="file" name="imagen" id="imagen" class="form-control">
                </div>
            </div>-->

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="<?php echo base_url(); ?>waadmin/categorias" class="btn btn-default">Cancelar</a>
                </div>
            </div>
        </div>
    </div><!--//panel-->
</form>