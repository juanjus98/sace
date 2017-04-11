<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 clear-padd-r">
        <div class="cont_slide_1">

          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <img src="<?php echo base_url('images/slide/slide001.jpg');?>" alt="Titulo">
              </div>
              <div class="item">
                <img src="<?php echo base_url('images/slide/slide001.jpg');?>" alt="Titulo">
              </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

        </div>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="cont_slide_2">
          <a href="#">
            <img src="<?php echo base_url('images/slide/slide002.jpg');?>" alt="Titulo" class="img-responsive">
          </a>
        </div>

        <div class="cont_slide_3">
          <a href="#">
            <img src="<?php echo base_url('images/slide/slide003.jpg');?>" alt="Titulo" class="img-responsive">
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="cont_slide_lomejor">
          <ul id="waslider" class="content-slider">
          <?php
          if(!empty($categorias_carousel)){
            $ii=0;
            foreach ($categorias_carousel as $key => $categoria_carousel) {
              $ii++;
              $url_categoria = base_url("c/" . $categoria_carousel['url_key']);
              /*echo "<pre>";
              print_r($categoria_carousel);
              echo "</pre>";*/
          ?>
            <li class="hvr-float-shadow">
              <a href="<?php echo $url_categoria;?>" title="<?php echo $categoria_carousel['descripcion'];?>">
                <div class="thumbnail">
                  <img src="<?php echo base_url('images/cat1.jpg');?>" alt="<?php echo $categoria_carousel['descripcion'];?>" class="img-responsive">
                  <div class="caption bg-<?php echo $ii;?>">
                    <h3><?php echo $categoria_carousel['nombre'];?></h3>
                  </div>
                </div>
              </a>
            </li>
          <?php
              $ii = ($ii < 3) ? $ii : 0 ;
            }
          }else{
            echo "<h1>SIN CATEGORÍAS</h1>";
          }
          ?>
            <!-- <li class="hvr-float-shadow">
              <a href="#">
                <div class="thumbnail">
                  <img src="<?php echo base_url('images/cat1.jpg');?>" alt="Titulo" class="img-responsive">
                  <div class="caption bg-1">
                    <h3>Sillas</h3>
                  </div>
                </div>
              </a>
            </li>
            <li class="hvr-float-shadow">
              <a href="">
                <div class="thumbnail theme-2">
                  <img src="<?php echo base_url('images/cat6.jpg');?>" alt="Titulo" class="img-responsive">
                  <div class="caption  bg-2">
                    <h3>Escritorios</h3>
                  </div>
                </div>
              </a>
            </li>
            <li class="hvr-float-shadow">
              <a href="">
                <div class="thumbnail">
                  <img src="<?php echo base_url('images/cat3.jpg');?>" alt="Titulo" class="img-responsive">
                  <div class="caption  bg-3">
                    <h3>Organizadores</h3>
                  </div>
                </div>
              </a>
            </li>
            <li class="hvr-float-shadow">
              <a href="">
                <div class="thumbnail">
                  <img src="<?php echo base_url('images/cat6.jpg');?>" alt="Titulo" class="img-responsive">
                  <div class="caption bg-1">
                    <h3>Hogar</h3>
                  </div>
                </div>
              </a>
            </li>
            <li class="hvr-float-shadow">
              <a href="">
                <div class="thumbnail">
                  <img src="<?php echo base_url('images/cat4.jpg');?>" alt="Titulo" class="img-responsive">
                  <div class="caption bg-2">
                    <h3>COUNTER</h3>
                  </div>
                </div>
              </a>
            </li>
            <li class="hvr-float-shadow">
              <a href="">
                <div class="thumbnail">
                  <img src="<?php echo base_url('images/cat5.jpg');?>" alt="Titulo" class="img-responsive">
                  <div class="caption bg-3">
                    <h3>Recepciones</h3>
                  </div>
                </div>
              </a>
            </li> -->

          </ul>

        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-description">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1>MUEBLES<small> PARA LA OFICINA Y EL HOGAR.</small></h1>
        <p>Bienvenido a FYB MUEBLERÍA BELEN S.A.C., somos una empresa familiar, profesionales conocedores de las necesidades de la industria DEL MUEBLE, brindamos soluciones en el  equipamiento integral para oficinas. Nuestra experiencia y motivación sirvió para abrirnos paso y afianzar resultados. Con el transcurrir del tiempo, la calidad de nuestro trabajo se vio reflejada en la satisfacción de nuestros clientes, quienes nos depositaron su confianza y nos permitieron crecer. Gracias al valioso capital humano con el que contamos, nos hemos consolidados como uno de los  mejores proveedores de Mobiliario para la oficina y el hogar.</p>
      </div>
    </div>
  </div>
</section>