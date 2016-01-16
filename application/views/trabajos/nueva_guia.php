<!--<?php echo validation_errors() ; ?>-->

  <!--<p class="lead">Ingresar nuevo trabajo</p>-->
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default"> 
    <!--<div class="panel-heading"><h4><strong>Ingresar nuevo trabajo</strong></h4></div>-->
      <div class="panel-body">
      <?php echo form_open_multipart('trabajos/nueva_guia','role="form" class="form-horizontal"') ; ?>
          <legend>Nueva Guia de Remisión</legend>      

          <div class="form-group">
            <label for="gui_numero" class="col-sm-3 control-label">Numero de Guía</label>
            <div class="col-sm-9">
              <?php echo form_input($gui_numero); ?>
              <?php echo form_error('gui_numero'); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="gui_fecha" class="col-sm-3 control-label">Fecha de Emisión</label>
            <div class="col-sm-9">
            <?php echo form_input($gui_fecha); ?>
            <?php echo form_error('gui_fecha'); ?>
            </div>
          </div>   

          <div class="form-group">
            <label for="gui_cantidad" class="col-sm-3 control-label">Cantidad Entregada</label>
            <div class="col-sm-9">
              <?php echo form_input($gui_cantidad); ?>
              <?php echo form_error('gui_cantidad'); ?>
            </div>
          </div>  

          <div class="form-group">
            <label for="gui_scan" class="col-sm-3 control-label">Guía Escaneada</label>
            <div class="col-sm-9">
              <?php echo form_upload($gui_scan); ?>
              <?php echo form_error('gui_scan'); ?>
            </div>
          </div>                     

          <?php echo form_hidden($idtrabajo); ?>

          <div class="form-group">
          <div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary">Enviar</button>   
            <?php echo anchor('trabajos/ver_guias/' . $idtrabajo['idtrabajo'],'<button type="button" class="btn btn-default">Cancelar</button>');?>
            </div>
          </div>
      <?php echo form_close() ; ?>
      </div>
    </div>
  </div>
</div>