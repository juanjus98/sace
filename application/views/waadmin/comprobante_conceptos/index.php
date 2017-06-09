<?php
/*echo '<pre>';
print_r($listado);
echo '</pre>';*/
?>
<?php echo msj(); ?>
<?php if(!empty($popop)){ ?>
<div class="alert alert-info alert-dismissable">
    <i class="fa fa-warning"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b>Nota!</b> Clic sobre un registro para seleccionar.
</div>
<?php } ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <form name="frm-buscar" id="frm-buscar" method="post" action="" role="search">
                    <div class="row pad" style="padding-bottom: 0px;">

                        <div class="col-sm-2">
                            <select name="campo" class="form-control input-sm">
                                <?php
                                foreach ($campos_busqueda as $indice => $campo) {
                                    $selected_campo = "";
                                    if ($post['campo'] == $indice) {
                                        $selected_campo = "selected";
                                    }
                                    echo '<option value="' . $indice . '" ' . $selected_campo . '>' . $campo . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" name="busqueda" class="form-control input-sm" placeholder="Busqueda" value="<?php if(!empty($post['busqueda'])){ echo $post['busqueda'];} ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <a href="<?php echo $refresh_url = (!empty($popop)) ? $refresh_url . '&' . $popop : $refresh_url;?>" class="btn btn-default btn-sm" title="Restablecer"><i class="fa fa-undo" aria-hidden="true"></i> Restablecer </a>
                        </div>

                        <div class="col-sm-5">
                            <div class="pull-right">

                                <!-- <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar </button> -->
                                <a href="<?php echo $agregar_url = (!empty($popop)) ? $agregar_url . '?' . $popop : $agregar_url ;?>" class="btn btn-success btn-sm" title="Agregar"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar </a>

                                <?php
                                if(empty($popop)){
                                ?>
                                <a href="#" class="btn btn-danger btn-sm" id="btn-eliminar" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.box-header -->
            <form name="index_form" id="index_form" action="<?php echo $eliminar_url; ?>" method="post">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <?php if(empty($popop)){?>
                                <th class="text-center"><input type="checkbox" id="chkTodo" /></th>
                            <?php } ?>
                                <th>Concepto</th>
                                <th class="text-center">Importe</th>
                                <?php if(empty($popop)){?>
                                <th></th>
                                <?php } ?>
                            </tr>
                            <?php
                            if(!empty($listado)){
                                foreach ($listado as $key => $item) {
                                    $jsonInfo = json_encode($item);
                                    ?>
                                    <tr class="<?=(!empty($popop)) ? 'add-opener-register' : '' ;?>" data-jsoninfo='<?=$jsonInfo;?>'>
                                        <?php if(empty($popop)){?>
                                        <td class="text-center">
                                            <input type="checkbox" name="items[]" id="eliminarchk-<?php echo $item['id'] ?>" value="<?php echo $item['id'] ?>" class="chk">
                                        </td>
                                        <?php } ?>
                                        <td><?php echo $item['concepto']; ?></td>
                                        <td class="text-right">
                                        <?php
                                            $total = setImporte($item['importe'], $item['moneda']);
                                            echo $total;
                                        ?>
                                        </td>
                                        <?php if(empty($popop)){?>
                                        <td class="text-center">
                                            <a href="<?php echo $ver_url . $item['id']; ?>" class="btn btn-default btn-xs" title="Visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="<?php echo $editar_url . $item['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">No se encontro ningún registro.</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="pull-right">
                    <?php
                    echo $links;
                    ?>
                </div>
            </form>
        </div><!-- /.box -->
    </div>
</div>