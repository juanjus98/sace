<?php
//echo '<pre>';
//print_r($listado);
//echo '</pre>';
?>
<?php echo msj(); ?>
<form name="index_form" id="index_form" action="<?php echo base_url(); ?>waadmin/servicios_galeria/eliminar/<?php echo $servicio_info['id']; ?>" method="post">
    <div class="panel panel-default wapanel">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">

                    <div class="pull-right">
                        <a href="<?php echo base_url(); ?>waadmin/servicios_galeria/agregar/<?php echo $servicio_info['id']; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar imágen</a>
                        <button type="button" class="btn btn-danger btn-xs btn_eliminar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar</button>
                        <a href="<?php echo base_url(); ?>waadmin/servicios/index" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Voler</a>
                    </div>

                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" id="chkTodo" /></th>
                    <th>Título</th>
                    <th>Imágen</th>
                    <th>Orden</th>
                    <th>Fecha de creación</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($listado)) {
                    foreach ($listado as $item) {
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="items[]" id="eliminarchk" value="<?php echo $item['id'] ?>" class="chk">
                            </td>
                            <td><?php echo $item['titulo']; ?></td>
                            <td><a href="<?php echo base_url();?>images/upload/<?php echo $item['imagen']; ?>" target="_blank"><?php echo $item['imagen']; ?></a></td>
                            <td><?php echo $item['orden']; ?></td>
                            <td><?php echo $item['agregar']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr><td colspan="5">Sin registros.</td></tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div><!--//panel-->
    <div class="row">
        <div class="col-lg-12">
            <?php
            echo $links;
            ?> 
        </div>
    </div>
</form>