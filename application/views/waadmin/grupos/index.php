<?php
echo '<pre>';
print_r($listado);
echo '</pre>';
/*echo $wa_tipo;*/
?>
<div class="row">
<div class="col-xs-12">
<div class="box">
    <div class="box-header">
		<div class="row pad" style="padding-bottom: 0px;">
			<div class="col-sm-2">
				<select class="form-control input-sm">
			    <option>option 1</option>
			    <option>option 2</option>
			    <option>option 3</option>
			    <option>option 4</option>
			    <option>option 5</option>
			</select>
			</div>
			<div class="col-sm-4">
			<div class="input-group">
			<input type="text" name="table_search" class="form-control input-sm" placeholder="Search"/>
			<div class="input-group-btn">
			    <button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
			</div>
			</div>
				
			</div>
			<div class="col-sm-6">
				<div class="pull-right">

					<!-- <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar </button> -->
					<a href="<?php echo base_url('admin/condominio/V/1');?>" class="btn btn-success btn-sm" title="Cancelar"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo </a>
					
					<a href="<?php echo base_url('admin/condominio/E/1');?>" class="btn btn-danger btn-sm" title="Editar"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar </a>
					
				</div>
			</div>
		</div>
    </div><!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-bordered">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Date</th>
                <th>Status</th>
                <th>Reason</th>
            </tr>
            <tr>
                <td>183</td>
                <td>John Doe</td>
                <td>11-7-2014</td>
                <td><span class="label label-success">Approved</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
            </tr>
            <tr>
                <td>219</td>
                <td>Jane Doe</td>
                <td>11-7-2014</td>
                <td><span class="label label-warning">Pending</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
            </tr>
            <tr>
                <td>657</td>
                <td>Bob Doe</td>
                <td>11-7-2014</td>
                <td><span class="label label-primary">Approved</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
            </tr>
            <tr>
                <td>175</td>
                <td>Mike Doe</td>
                <td>11-7-2014</td>
                <td><span class="label label-danger">Denied</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
            </tr>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>