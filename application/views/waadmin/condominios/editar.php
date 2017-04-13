<?php
/*echo '<pre>';
print_r($administrador);
echo '</pre>';*/
/*echo $wa_tipo;*/

$disabled = ($wa_tipo === 'V') ? "disabled" : "";
?>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<form class="form-horizontal" name="edit_form" id="edit_form" action="" method="post" role="form">
				<input type="hidden" name="condominio[id]" value="<?php echo $condominio['id'];?>">
				<input type="hidden" name="administrador[id_personal]" value="<?php echo $administrador['id_personal'];?>">
				<div class="box-header">
					<div class="row pad" style="padding-bottom: 0px;">
						<div class="col-sm-6">
							<?php if($wa_tipo == 'V'){ ?>
							<div class="btn-group">
								<button class="btn btn-default btn-block btn-sm dropdown-toggle" data-toggle="dropdown" style="min-width: 100px;">Acci&oacute;n <span class="caret"></span></button>
								<ul class="dropdown-menu btn-block" role="menu">
									<li><a href="#"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;Copiar</a></li>
									<li><a href="#"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Eliminar</a></li>
								</ul>
							</div>
							<?php } ?>
						</div>
						<div class="col-sm-6">
							<div class="pull-right">
								<?php if($wa_tipo == 'E'){ ?>
								<button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar </button>
								<a href="<?php echo base_url('waadmin/condominio/V/1');?>" class="btn btn-default btn-sm" title="Cancelar"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
								<?php } ?>
								<?php if($wa_tipo == 'V'){ ?>
								<a href="<?php echo base_url('waadmin/condominio/E/1');?>" class="btn btn-primary btn-sm" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar </a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>

				<div class="box-body">
					<?php echo msj();?>
					<div class="row">
						<div class="col-sm-12">

							<table class="table table-bordered">
								<thead class="thead-default">
									<tr>
										<th><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Datos del condominio.</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="form-group" style="margin-bottom: 0px;">
												<label for="codigo_condominio" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Código:</label>
												<div class="col-sm-4">
													<input class="form-control input-sm" id="codigo_condominio" name="condominio[codigo_condominio]" type="text" value="<?php echo $condominio['codigo_condominio'];?>" <?php echo $disabled;?>>
													<?php echo form_error('condominio[nombre_condominio]'); ?>
												</div>
												<label for="nombre_condominio" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Nombre:</label>
												<div class="col-sm-4">
													<input class="form-control input-sm" id="nombre_condominio" name="condominio[nombre_condominio]" type="text" value="<?php echo $condominio['nombre_condominio'];?>" <?php echo $disabled;?>>
													<?php echo form_error('condominio[nombre_condominio]'); ?>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group" style="margin-bottom: 0px;">
												<label for="direccion" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Dirección:</label>
												<div class="col-sm-4">
													<input class="form-control input-sm" id="direccion" name="condominio[direccion]" type="text" value="<?php echo $condominio['direccion'];?>" <?php echo $disabled;?>>
													<?php echo form_error('condominio[direccion]'); ?>
												</div>
												<label for="direccion_referencia" class="col-sm-2 control-label" style="text-align: right;">Referencia:</label>
												<div class="col-sm-4">
													<input class="form-control input-sm" id="direccion_referencia" name="condominio[direccion_referencia]" type="text" value="<?php echo $condominio['direccion_referencia'];?>" <?php echo $disabled;?>>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group" style="margin-bottom: 0px;">
												<label for="telefono" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Teléfono:</label>
												<div class="col-sm-4">
													<input class="form-control input-sm" id="telefono" name="condominio[telefono]" type="text" value="<?php echo $condominio['telefono'];?>" <?php echo $disabled;?>>
													<?php echo form_error('condominio[telefono]'); ?>
												</div>
												<label for="email" class="col-sm-2 control-label" style="text-align: right;">E-mail:</label>
												<div class="col-sm-4">
													<input class="form-control input-sm" id="email" name="condominio[email]" type="text" value="<?php echo $condominio['email'];?>" <?php echo $disabled;?>>
												</div>
											</div>
										</td>
									</tr>

								</tbody>
							</table><br>
							<table class="table table-bordered">
								<thead class="thead-default">
									<tr>
										<th><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Administrador.</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="form-group" style="margin-bottom: 0px;">
												<label for="nombre" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Nombre:</label>
												<div class="col-sm-4">
													<input class="form-control input-sm" id="nombre" name="administrador[nombre]" type="text" value="<?php echo $administrador['nombre'];?>" <?php echo $disabled;?>>
													<?php echo form_error('administrador[nombre]'); ?>
												</div>
												<label for="apellido" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Apellidos:</label>
												<div class="col-sm-4">
													<input class="form-control input-sm" id="apellido" name="administrador[apellido]" type="text" value="<?php echo $administrador['apellido'];?>" <?php echo $disabled;?>>
													<?php echo form_error('administrador[apellido]'); ?>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="form-group" style="margin-bottom: 0px;">
												<label for="telefono" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Teléfono:</label>
												<div class="col-sm-4">
													<input class="form-control input-sm" id="telefono" name="administrador[telefono]" type="text" value="<?php echo $administrador['telefono'];?>" <?php echo $disabled;?>>
													<?php echo form_error('administrador[telefono]'); ?>
												</div>
												<label for="email" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> E-mail:</label>
												<div class="col-sm-4">
													<input class="form-control input-sm" id="email" name="administrador[email]" type="text" value="<?php echo $administrador['email'];?>" <?php echo $disabled;?>>
													<?php echo form_error('administrador[email]'); ?>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table><br>
						</div>
					</div>
					<div><p><span style="color: red; font-weight: bold;"><strong>(*)</strong> Campos obligatorios.</span></p></div>
				</div>

				<div class="box-header">
					<div class="row pad">
						<div class="col-sm-12">
							<div class="pull-right">
								<?php if($wa_tipo == 'E'){ ?>
								<button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar </button>
								<a href="<?php echo base_url('waadmin/condominio/V/1');?>" class="btn btn-default btn-sm" title="Cancelar"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>

			</form>

		</div>
	</div>
</div>