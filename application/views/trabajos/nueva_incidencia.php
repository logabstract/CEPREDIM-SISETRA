<!--<?php echo validation_errors() ; ?>-->

  <!--<p class="lead">Ingresar nuevo trabajo</p>-->
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default"> 
    <!--<div class="panel-heading"><h4><strong>Ingresar nuevo trabajo</strong></h4></div>-->
      <div class="panel-body">
      <?php echo form_open('incidencias/nueva_incidencia','role="form" class="form-horizontal"') ; ?>
          <legend>Nueva Incidencia</legend>      

          <div class="form-group">
            <label for="inc_detalle" class="col-sm-3 control-label">Detalle</label>
            <div class="col-sm-9">
            <?php echo form_textarea($inc_detalle); ?>
            <?php echo form_error('inc_detalle'); ?>
            </div>
          </div>    

          <?php echo form_hidden($idtrabajo); ?>

          <div class="form-group">
          <div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary">Enviar</button>   
            <?php echo anchor('incidencias/ver_incidencias/' . $idtrabajo['idtrabajo'],'<button type="button" class="btn btn-default">Cancelar</button>');?>
            </div>
          </div>
      <?php echo form_close() ; ?>
      </div>
    </div>
  </div>
</div>
