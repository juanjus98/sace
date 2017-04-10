<?php
$user_info = $this->user_info;
/*echo "<pre>";
print_r($user_info);
echo "</pre>";*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo @$template['title']; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1"><!--Escalable en cualquier dispositivo-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/general.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/font-awesome.min.css">


    <link rel="shortcut icon" href="<?php echo base_url() ?>images/favicon_tuyo.ico">
    <script type="text/javascript">var base_url='<?php echo base_url();?>';</script>
    <?php echo notify();?>
    
</head>

<body>
    <div id="header">
    <div class="line-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 cont-logo">
                    <a href="/"><img src="<?php echo base_url(); ?>images/tuyo-logo-write.png" /></a>
                </div>

                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

                <div class="cont_user pull-right">
                    <!-- Single button -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle" aria-hidden="true"></i> <?php echo $user_info['nombre']; ?>  <?php echo $user_info['apellido']; ?> <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="#">Cambiar contraseña</a></li>
                        <li><a href="#">Actualizar Perfil</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>salir">Salir</a></li>
                      </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </di v>
    <div class="container-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 sidebar">
                    <?php echo modulos_menus();?>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                    <?php echo @$template['body']; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container-fluid">
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 copy-footer">
                © <?php echo date('Y')?> webApu.com<br/>
                info@webapu.com<br/>
                www.webapu.com
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 contact-footer">
                CENTRO DE ATENCION AL CLIENTE<br/>
                Teléfono: (01)-748-1777<br/>
                E-mail: info@webapu.com
            </div>

        </div>
    </div>
    
<script src="<?php echo base_url() ?>plugins/jquery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>plugins/notifyjs/notify.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>plugins/sticky/jquery.sticky.js"></script>

<script type="text/javascript" src="<?php echo base_url() ?>js/general.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>js/main.js"></script> -->

</body>

</html>

