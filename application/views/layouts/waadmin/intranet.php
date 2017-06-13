<?php
$user_info = $this->user_info;
/*echo "<pre>";
print_r($user_info);
echo "</pre>";
die();*/
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

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('plugins/tagsinput/bootstrap-tagsinput.css') ?>">

    <!--iCheked-->
    <link href="<?php echo base_url('plugins/icheck/skins/all.css?v=1.0.2') ?>" rel="stylesheet">

    <!--Daterange-->
    <link href="<?php echo base_url('css/daterangepicker/daterangepicker.css') ?>" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico">
    <script type="text/javascript">var base_url='<?php echo base_url();?>';</script>
    <?php //echo notify();?>

</head>
<body class="skin-wa">
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="<?php echo base_url();?>" class="logo">
            <?php echo $this->config->item('admin_name');?>
            <!-- <img src="<?php echo $this->config->item('admin_logo');?>" alt="<?php echo $this->config->item('admin_name');?>"> -->
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" id="wa-togle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Menú</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">4 Nuevos mensajes.</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?php echo base_url('images/avatar3.png');?>" class="img-circle" alt="User Image"/>
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li><!-- end message -->
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?php echo base_url('images/avatar2.png');?>" class="img-circle" alt="user image"/>
                                            </div>
                                            <h4>
                                                AdminLTE Design Team
                                                <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?php echo base_url('images/avatar.png');?>" class="img-circle" alt="user image"/>
                                            </div>
                                            <h4>
                                                Developers
                                                <small><i class="fa fa-clock-o"></i> Today</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?php echo base_url('images/avatar2.png');?>" class="img-circle" alt="user image"/>
                                            </div>
                                            <h4>
                                                Sales Department
                                                <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="<?php echo base_url('images/avatar.png');?>" class="img-circle" alt="user image"/>
                                            </div>
                                            <h4>
                                                Reviewers
                                                <small><i class="fa fa-clock-o"></i> 2 days</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">Ver todos los mensajes.</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-warning"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">10 Notificaciones</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users warning"></i> 5 new members joined
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="ion ion-ios7-cart success"></i> 25 sales made
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ion ion-ios7-person danger"></i> You changed your username
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">Ver todo</a></li>
                        </ul>
                    </li>
                    
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>
                            <span><?php echo $user_info['nombre'];?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img src="<?php echo base_url('images/avatar3.png');?>" class="img-circle" alt="User Image" />
                                <p>
                                    <?php echo $user_info['nombre'] ." ". $user_info['apellido'];?>
                                    <small>Desde: <?php echo date("d/m/Y",strtotime($user_info['fch_ingreso'])); ?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                                <!-- <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li> -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url('waadmin/perfil/V');?>" class="btn btn-default btn-flat"><i class="fa fa-user" aria-hidden="true"></i> Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('waadmin/salir');?>" class="btn btn-danger btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i>Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->load->view('layouts/waadmin/aside'); ?>

            <?php
                //collpase_cookie (mostrar / ocultar menu)
            $strech_left = "";
            if(isset($_COOKIE["collpase_cookie"])){
              $strech_left = ($_COOKIE["collpase_cookie"] == 2) ? "strech" : "";
          }
          ?>
          <!-- Right side column. Contains the navbar and content of the page -->
          <aside class="right-side <?php echo $strech_left?>">                
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $wa_menu;?>
                    <small><?php echo $wa_modulo;?></small>
                </h1>
                <!-- <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Blank page</li>
                </ol> -->
            </section>

            <!-- Main content -->
            <section class="content">
               <?php echo @$template['body']; ?>
           </section><!-- /.content -->

       </aside><!-- /.right-side -->
   </div><!-- ./wrapper -->


   <script src="<?php echo base_url() ?>plugins/jquery/jquery-3.1.1.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url() ?>js/bootstrap.min.js" type="text/javascript"></script>
   <!-- <script type="text/javascript" src="<?php echo base_url() ?>plugins/sticky/jquery.sticky.js"></script> -->
   <script src="<?php echo base_url('plugins/tagsinput/bootstrap-tagsinput.js') ?>" type="text/javascript"></script>

   <script src="<?php echo base_url('plugins/js-cookie/js.cookie.js');?>" type="text/javascript"></script>

   <script src="<?php echo base_url('plugins/icheck/icheck.js?v=1.0.2');?>" type="text/javascript"></script>
   <script src="<?php echo base_url('plugins/moment/moment.js');?>" type="text/javascript"></script>
   <script src="<?php echo base_url('plugins/daterangepicker/daterangepicker.js');?>" type="text/javascript"></script>


   <script type="text/javascript" src="<?php echo base_url() ?>js/general.min.js"></script>
   <!-- <script type="text/javascript" src="<?php echo base_url() ?>js/app.js"></script> -->

</body>

</html>

