<?php
$user_info = $this->user_info;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-smile-o" aria-hidden="true"></i>
                <h3 class="box-title">Bienvenido <?php echo $user_info['nombre'] . ' ' . $user_info['apellido'];?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                </blockquote>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- ./col -->
</div>