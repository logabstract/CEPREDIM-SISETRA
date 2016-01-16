<!--<?php echo validation_errors() ; ?>-->

  <!--<p class="lead">Ingresar nuevo trabajo</p>-->
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default"> 
    <!--<div class="panel-heading"><h4><strong>Ingresar nuevo trabajo</strong></h4></div>-->
      <div class="panel-body">
      <?php echo form_open('trabajos/edit_trabajo','role="form" class="form-horizontal"') ; ?>
          <legend>Editar trabajo</legend>
          <div class="form-group">
            <label for="tra_orden" class="col-sm-3 control-label">Orden de Taller</label>
            <div class="col-sm-9">
              <?php echo form_input($tra_orden); ?>
              <?php echo form_error('tra_orden'); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="tra_fecha_orden" class="col-sm-3 control-label">Fecha Orden</label>
            <div class="col-sm-9">
            <?php echo form_input($tra_fecha_orden); ?>
            <?php echo form_error('tra_fecha_orden'); ?>
            </div>
          </div>           

          <div class="form-group">
            <label for="tip_trabajo" class="col-sm-3 control-label">Tipo de Trabajo</label>
            <div class="col-sm-9">
              <?php $attributes = 'class = "form-control" id = "tip_trabajo"'; ?>
              <?php echo form_dropdown('tip_trabajo',$tip_trabajo,$idtipo_trabajo,$attributes); ?>
              <?php echo form_error('tip_trabajo'); ?>
            </div>
          </div>          

          <div class="form-group">
            <label for="vendedor" class="col-sm-3 control-label">Vendedor</label>
            <div class="col-sm-9">
              <?php $attributes = 'class = "form-control" id = "vendedor"'; ?>
              <?php echo form_dropdown('vendedor',$vendedor,$idvendedor,$attributes); ?>
              <?php echo form_error('vendedor'); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="cliente" class="col-sm-3 control-label">Cliente</label>
            <div class="col-sm-9">
              <?php $attributes = 'class = "form-control" id = "cliente"'; ?>
              <?php echo form_dropdown('cliente',$cliente,$idcliente,$attributes); ?>
              <?php echo form_error('cliente'); ?>
            </div>
          </div>


          <div class="form-group">
            <label for="tra_titulo" class="col-sm-3 control-label">Título</label>
            <div class="col-sm-9">
            <?php echo form_input($tra_titulo); ?>
            <?php echo form_error('tra_titulo'); ?>
            </div>
          </div>   
          
          <div class="form-group">
            <label for="tra_tiraje" class="col-sm-3 control-label">Tiraje</label>
            <div class="col-sm-9">
            <?php echo form_input($tra_tiraje); ?>
            <?php echo form_error('tra_tiraje'); ?>
            </div>
          </div>  

          <div class="form-group">
            <label for="tra_fecha_produccion" class="col-sm-3 control-label">Fecha Producción</label>
            <div class="col-sm-9">
            <?php echo form_input($tra_fecha_produccion); ?>
            <?php echo form_error('tra_fecha_produccion'); ?>
            </div>
          </div>            

          <div class="form-group">
            <label for="tra_fecha_entrega" class="col-sm-3 control-label">Fecha Entrega</label>
            <div class="col-sm-9">
            <?php echo form_input($tra_fecha_entrega); ?>
            <?php echo form_error('tra_fecha_entrega'); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="tra_precio_total" class="col-sm-3 control-label">Precio Total</label>
            <div class="col-sm-9">
            <?php echo form_input($tra_precio_total); ?>
            <?php echo form_error('tra_precio_total'); ?>
            </div>
          </div>           

          <div class="form-group">
            <label for="tra_descripcion" class="col-sm-3 control-label">Descripción</label>
            <div class="col-sm-9">
            <?php echo form_textarea($tra_descripcion); ?>
            <?php echo form_error('tra_descripcion'); ?>
            </div>
          </div>

          <?php echo form_hidden($id); ?>    

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
