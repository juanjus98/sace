<div class="row">
	<div class="col-xs-12">
		<div class="box">

			<form class="form-horizontal" name="edit_form" id="edit_form" action="" method="post" role="form"><!--strtolower($nombre_modulo)-->

				<div class="box-header">
					<div class="row pad" style="padding-bottom: 0px;">
						<div class="col-sm-2">


							<div class="btn-group btn-block">
								<button class="btn btn-default btn-block btn-sm dropdown-toggle" data-toggle="dropdown" style="min-width: 100px;">Acci&oacute;n <span class="caret"></span></button>
								<ul class="dropdown-menu btn-block" role="menu"><?=$menu_dropdown; ?></ul>
							</div>

							&nbsp;


							<p><span style="color: red; font-weight: bold;"><strong>(*)</strong> Campos obligatorios.</span></p>

						</div>

						<div class="col-sm-2">

							<div class="btn-group btn-block">
								<button class="btn btn-info btn-block btn-sm dropdown-toggle" data-toggle="dropdown">Relacionados <span class="caret"></span></button>
								<ul class="dropdown-menu btn-block" role="menu">
									<li><a href="#"><i class="fa fa-envelope"></i>&nbsp;Contactos</a></li>
									<li><a href="#"><i class="fa fa-clipboard"></i>&nbsp;Comprobantes</a></li>
									<li><a href="#"><i class="fa fa-clipboard"></i>&nbsp;Contratos</a></li>
									<li><a href="#"><i class="fa fa-clipboard"></i>&nbsp;Test</a></li>
								</ul>
							</div>

						</div>

						<div class="col-sm-4"></div>
						<div class="col-sm-2">
							<button class="btn btn-success btn-block btn-sm save" style="min-width: 100px;"> Guardar </button>

							<a class="btn btn-success btn-block btn-sm edit" title="Editar registro" href="#" style="min-width: 100px; color: #FFF;"> Editar </a><!--strtolower($nombre_modulo).-->

						</div>
						<div class="col-sm-2">
							<a href="#" class="btn btn-default btn-block btn-sm" style="min-width: 100px;"> Cancelar </a><!--onclick="javascript:window.history.back();"-->
						</div>
					</div>
				</div>

				<div class="box-body">
					<div class="row pad" style="padding: 0px;">
						<div class="col-sm-12">

							<table class="table table-bordered">
								<thead class="thead-default">
									<tr>
										<th colspan="4"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Datos del Cliente</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="4" style="vertical-align: middle;">
											<div class="form-group" style="margin-bottom: 0px;">
												<label for="codigo_cliente" class="col-sm-2 control-label" style="text-align: right;">C&oacute;digo Cliente</label>
												<div class="col-sm-4">
													<input class="form-control input-sm" id="codigo_cliente" name="clientes[codigo_cliente]" type="text" maxlength="10" value="" disabled="disabled">
												</div>
												<label for="id_estado" class="col-sm-2 control-label" style="text-align: right;">Estado</label>
												<div class="col-sm-4">
													<select class="form-control selectpicker" id="id_estado" name="clientes[id_estado_cliente]"  data-live-search="true">
														<option value="">----</option>
													</select>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="4" style="vertical-align: middle;">
											<div class="form-group" style="margin-bottom: 0px;">
												<label for="tipo_cliente" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Tipo de Cliente</label>
												<div class="col-sm-4">
													<select class="form-control selectpicker mandatory" id="tipo_cliente" name="clientes[tipo_cliente]" data-live-search="true">
														<option value="">----</option>
														<option value="N">Natural</option>
														<option value="J">Jur&iacute;dico</option>
													</select>
												</div>
												<label for="tipo_documento" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Tipo de Documento</label>
												<div class="col-sm-4">
													<select class="form-control selectpicker mandatory" id="tipo_documento" name="clientes[tipo_documento]"  data-live-search="true">
														<option value="">----</option>
														<option value="D" >DNI</option>
														<option value="C" >Carn&eacute; de Extranjer&iacute;a</option>
														<option value="R" >RUC</option>
													</select>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="4" style="vertical-align: middle;">
											<div class="form-group" style="margin-bottom: 0px;">
												<label for="nro_documento" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Nro. de Documento</label>
												<div class="col-sm-4">
													<input class="form-control input-sm only_number mandatory" id="nro_documento" name="clientes[nro_documento]" type="text" maxlength="15" autocomplete="off" value="">
												</div>
												<label for="distribuidor" class="col-sm-2 control-label" style="text-align: right;">Distribuidor</label>
												<div class="col-sm-4">

													<input class="form-control input-sm" id="distribuidor" name="clientes[distribuidor]" type="checkbox" >

												</div>
											</div>
										</td>
									</tr>





								</tbody>
							</table><br>


						</div>
					</div>
				</div>

				<div class="box-header">
					<div class="row pad" style="padding-top: 0px; padding-bottom: 0px;">
						<div class="col-sm-8">

							<p><span style="color: red; font-weight: bold;"><strong>(*)</strong> Campos obligatorios.</span></p>

						</div>
						<div class="col-sm-2">

							<button class="btn btn-success btn-block btn-sm save" style="min-width: 100px;"> Guardar </button>

							<a class="btn btn-success btn-block btn-sm edit" title="Editar registro" href="#" style="min-width: 100px; color: #FFF;"> Editar </a>

						</div>
						<div class="col-sm-2">
							<a href="#" class="btn btn-default btn-block btn-sm" style="min-width: 100px;"> Cancelar </a>
						</div>
					</div>
				</div>


			</form>


		</div>
	</div>
</div>