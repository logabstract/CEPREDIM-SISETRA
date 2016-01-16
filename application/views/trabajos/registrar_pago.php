<!--<?php echo validation_errors() ; ?>-->

  <!--<p class="lead">Ingresar nuevo trabajo</p>-->
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default"> 
    <!--<div class="panel-heading"><h4><strong>Ingresar nuevo trabajo</strong></h4></div>-->
      <div class="panel-body">
      <?php echo form_open_multipart('trabajos/registrar_pago','role="form" class="form-horizontal"') ; ?>
          <legend>Registrar Comprobante de Pago</legend>      

          <div class="form-group">
            <label for="tra_com_numero" class="col-sm-3 control-label">Número</label>
            <div class="col-sm-9">
              <?php echo form_input($tra_com_numero); ?>
              <?php echo form_error('tra_com_numero'); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="tra_com_fecha" class="col-sm-3 control-label">Fecha</label>
            <div class="col-sm-9">
            <?php echo form_input($tra_com_fecha); ?>
            <?php echo form_error('tra_com_fecha'); ?>
            </div>
          </div>                    

          <?php echo form_hidden($idtrabajo); ?>

          <div class="form-group">
          <div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary">Enviar</button>   
            <?php echo anchor('trabajos','<button type="button" class="btn btn-default">Cancelar</button>');?>
            </div>
          </div>
      <?php echo form_close() ; ?>
      </div>
    </div>
  </div>
</div>