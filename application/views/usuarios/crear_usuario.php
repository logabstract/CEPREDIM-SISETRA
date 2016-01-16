<!--<?php echo validation_errors() ; ?>-->

  <!--<p class="lead">Ingresar nuevo trabajo</p>-->
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default"> 
    <!--<div class="panel-heading"><h4><strong>Ingresar nuevo trabajo</strong></h4></div>-->
      <div class="panel-body">
      <?php echo form_open('usuarios/crear_usuario','role="form" class="form-horizontal"') ; ?>
          <legend>Crear Usuario</legend>      

          <div class="form-group">
            <label for="usu_nombre" class="col-sm-3 control-label">Nombre</label>
            <div class="col-sm-9">
              <?php echo form_input($usu_nombre); ?>
              <?php echo form_error('usu_nombre'); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="usu_apellido" class="col-sm-3 control-label">Apellido</label>
            <div class="col-sm-9">
            <?php echo form_input($usu_apellido); ?>
            <?php echo form_error('usu_apellido'); ?>
            </div>
          </div>   

          <div class="form-group">
            <label for="usu_password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
              <?php echo form_input($usu_password); ?>
              <?php echo form_error('usu_password'); ?>
            </div>
          </div>       

          <div class="form-group">
            <label for="usu_access_level" class="col-sm-3 control-label">Nivel Acceso</label>
            <div class="col-sm-9">
              <?php echo form_input($usu_access_level); ?>
              <?php echo form_error('usu_access_level'); ?>
            </div>
          </div>     

          <div class="form-group">
            <label for="idarea" class="col-sm-3 control-label">Area Id</label>
            <div class="col-sm-9">
              <?php echo form_input($idarea); ?>
              <?php echo form_error('idarea'); ?>
            </div>
          </div>                          


          <div class="form-group">
          <div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary">Enviar</button>   
            <?php echo anchor('usuarios/crear_usuario','<button type="button" class="btn btn-default">Cancelar</button>');?>
            </div>
          </div>
      <?php echo form_close() ; ?>
      </div>
    </div>
  </div>
</div>