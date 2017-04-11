<?php
/*echo "<pre>";
print_r($orden);
echo "</pre>";*/
?>
<section>
<div class="container">
<div class="cont-principal">
<h1>Solicitar <small>Cotización</small></h1>
<div class="cont-cotizador">
<div class="row">
<div class="col-sm-12 col-md-12">
  <div class="cont-confirmacion">
  <div class="container">
  <div class="row">
  <div class="col-sm-6 col-md-6">
    <h3 class="text-center">¡Cotización enviada!</h3>

    <p class="text-center"><br/>
      Tu solicitud de cotización ha sido enviando satisfactoriamente, en breve nos estaremos comunicando con usted para poder enviarle nuestra propuesta sobre los productos que ha elegido.
      <br/><br/>
      Para hacer el seguimiento del estado de su solicitud, por favor tener a la mano el siguiente código:     
    </p>
    <h4 class="text-center">Código de orden: <?php echo $orden['codigo_orden'];?></h4>
    <p class="text-center">
      Agradecemos tu preferencia.
    </p>

    <div class="text-center"> 
      <a class="btn btn-cotizar" href="<?php echo base_url();?>">Volver al inicio.</a>
    </div>
  </div>

  <div class="col-sm-6 col-md-6">
  <img src="<?php echo base_url('images/confirmacion-img.png');?>" class="img-responsive">
  </div>
  
  </div>
  </div>
  </div>
</div>

</div>

</div>
</div>
</div>
</section>