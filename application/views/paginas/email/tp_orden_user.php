<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
	<tbody>
		<tr>
			<td align="center" valign="top">
				<div>
					<a href="#">
						<img src="<?php echo $cabeceras['logo'];?>" alt="<?php echo utf8_decode($website['title']);?>" style="max-height: 60px;">
					</a>
				</div>
				<span style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;">
					<!-- <font color="#888888">Texto aquí</font> -->
				</span>
				<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#fdfdfd;border:1px solid #dcdcdc;border-radius:3px!important; margin-top: 10px;">
					<tbody>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:<?php echo $cabeceras['color'];?>;border-radius:3px 3px 0 0!important;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif">
									<tbody>
										<tr>
											<td style="padding:36px 48px;display:block">
												<h1 style="color:#ffffff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left">
													<?php echo utf8_decode('Gracias por su orden');?>
												</h1>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="600"><tbody><tr>
									<td valign="top" style="background-color:#fdfdfd">
										<table border="0" cellpadding="20" cellspacing="0" width="100%"><tbody><tr>
											<td valign="top" style="padding:40px">
												<div style="color:#737373;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
													<p style="margin:0 0 16px">
														<?php echo utf8_decode('Su pedido de cotización ha sido recibido y ahora se está procesando. Los detalles de su pedido se muestran a continuación para su referencia:');?>
													</p>
													<h2 style="color:<?php echo $cabeceras['color'];?>;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">Orden: <?php echo $orden['codigo_orden'];?></h2>
													<table cellspacing="0" cellpadding="6" style="width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;color:#737373;border:1px solid #e4e4e4" border="1">
														<thead>
															<tr>
																<th scope="col" colspan="2" style="text-align:left;color:#737373;border:1px solid #e4e4e4;padding:12px">Producto</th>
																<th scope="col" style="text-align:center;color:#737373;border:1px solid #e4e4e4;padding:12px">Cantidad</th>
															</tr>
														</thead>
														<tbody>
															<?php
															foreach ($carrito as $key => $value):
																$name = $value['name'];
															$qty = $value['qty'];
															$url = $value['options']['url'];
															$img = $value['options']['img'];
															$color = $value['options']['color'];
															?>
															<?php
														/*echo "<pre>";
														print_r($value);
														echo "</pre>";*/
														?>
														<tr>
															<td style="text-align:left;vertical-align:middle;border:1px solid #eee;word-wrap:break-word;padding:12px">
																<a href="<?php echo $url;?>" target="_blank" title="<?php echo $name;?>">
																	<img src="<?php echo $img;?>" style="max-height: 100px;" alt="<?php echo $name;?>">
																</a>
															</td>
															<td style="text-align:left;vertical-align:middle;border:1px solid #eee;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;color:#737373;padding:12px">
																<a href="<?php echo $url;?>" target="_blank" title="<?php echo $name;?>">
																	<?php echo $name;?></a>
																	<br><small>Color: <?php echo $color;?></small>
																</td>
																<td style="text-align:center;vertical-align:middle;border:1px solid #eee;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;color:#737373;padding:12px">
																	<?php echo $qty;?>
																</td>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
												<h2 style="color:<?php echo $cabeceras['color'];?>;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">
													<?php echo utf8_decode('Información de contácto:');?>
												</h2>
												<ul>
													<li>
														<strong>Empresa:</strong> <span  style="color:#505050;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif">
														<?php echo $orden['empresa'];?>
													</span>
												</li>
												<li>
													<strong>Nombres y Apellidos:</strong> <span  style="color:#505050;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif">
													<?php echo $orden['nombres'];?>
												</span>
											</li>
											<li>
												<strong>Correo:</strong> <span  style="color:#505050;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif"><a href="mailto:juanjus98@gmail.com" target="_blank"><?php echo $orden['email'];?></a></span>
											</li>
											<li>
												<strong><?php echo utf8_decode('Teléfono:');?></strong> <span  style="color:#505050;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif">
												<?php echo $orden['telefono'];?>
											</span>
										</li>
										<li>
											<strong>Mensaje:</strong> <span  style="color:#505050;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif">
											<?php
											echo str_replace("\n", "<br>", $orden['mensaje']);
											?>
										</span>
									</li>
								</ul>
								<span style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif; font-size: 12px;"><font color="#888888"><!--texto--></font></span>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
</tbody>
</table>
<span style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif; font-size: 12px;">
	<font color="#888888">&copy; <?php echo utf8_decode($website['title']);?></font>
</span>
</td>
</tr>
<tr>
	<td align="center" valign="top">
		<table border="0" cellpadding="10" cellspacing="0" width="600"><tbody><tr>
			<td valign="top" style="padding:0">
				<table border="0" cellpadding="10" cellspacing="0" width="100%">
					<tbody>
						<tr>
							<td colspan="2" valign="middle" style="padding:0 48px 48px 48px;border:0;color:#99b1c7;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
								<p><a href="<?php echo "//" . $cabeceras['dominio']; ?>" target="_blank"><?php echo $cabeceras['dominio']; ?></a></p>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>