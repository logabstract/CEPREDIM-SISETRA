    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span><img src="<?php echo base_url('UNMSM.png'); ?>" class="pull-left" style="max-width:30px;margin-right: 7px;margin-top: 7px;"></span><?php echo anchor('trabajos', '<strong>CEPREDIM - SISETRA</strong>','class="navbar-brand" title="Sistema de Seguimiento de Trabajos"') ; ?>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php if ($this->session->userdata('usr_access_level') == 1) : ?>
              <li <?php if ($this->uri->segment(1) == 'trabajos' && $this->uri->segment(2) == FALSE):  ; ?>
                    <?php echo 'class="active">'; ?>
                    <?php echo anchor('trabajos', 'Trabajos') . '</li>' ; ?>
                    <?php echo '<li>'. anchor('trabajos/new_trabajo', 'Nuevo Trabajo') . '</li>' ; ?>
                  <?php elseif ($this->uri->segment(1) == 'trabajos' && $this->uri->segment(2) == 'new_trabajo'): ; ?>
                    <?php echo '>' . anchor('trabajos', 'Trabajos') . '</li>' ; ?>
                    <?php echo '<li class="active">' . anchor('trabajos/new_trabajo', 'Nuevo Trabajo') . '</li>' ; ?>
                  <?php elseif ($this->uri->segment(1) == 'trabajos' && $this->uri->segment(2) == 'edit_trabajo'): ; ?>
                    <?php echo '>' . anchor('trabajos', 'Trabajos') . '</li>' ; ?>
                    <?php echo '<li class="active">' . anchor('trabajos/edit_trabajo/'. $this->uri->segment(3), 'Editar Trabajo') . '</li>' ; ?>                    
                  <?php elseif ($this->uri->segment(1) == 'incidencias' && $this->uri->segment(2) == 'ver_incidencias'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('incidencias/ver_incidencias/'. $this->uri->segment(3),'Incidencias') . '</li>'; ?>
                    <?php echo '<li>' .  anchor('incidencias/nueva_incidencia/'. $this->uri->segment(3),'Nueva Incidencia'); ?>                    
                  <?php elseif ($this->uri->segment(1) == 'incidencias' && $this->uri->segment(2) == 'nueva_incidencia'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li>' .  anchor('incidencias/ver_incidencias/'. $this->uri->segment(3),'incidencias') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('incidencias/nueva_incidencia/'. $this->uri->segment(3),'Nueva Incidencia'); ?>                     
                  <?php endif; ?>
              </li>
            <?php elseif ($this->session->userdata('usr_access_level') == 2): ?>
              <li <?php if ($this->uri->segment(1) == 'trabajos'):  ; ?>
                    <?php echo 'class="active">'; ?>
                    <?php echo anchor('trabajos', 'Trabajos') . '</li>' ; ?>            
                  <?php elseif ($this->uri->segment(1) == 'incidencias' && $this->uri->segment(2) == 'ver_incidencias'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('incidencias/ver_incidencias/'. $this->uri->segment(3),'Incidencias') . '</li>'; ?>
                    <?php echo '<li>' .  anchor('incidencias/nueva_incidencia/'. $this->uri->segment(3),'Nueva Incidencia'); ?>                    
                  <?php elseif ($this->uri->segment(1) == 'incidencias' && $this->uri->segment(2) == 'nueva_incidencia'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li>' .  anchor('incidencias/ver_incidencias/'. $this->uri->segment(3),'incidencias') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('incidencias/nueva_incidencia/'. $this->uri->segment(3),'Nueva Incidencia'); ?>                     
                  <?php endif; ?>
              </li>
            <?php elseif ($this->session->userdata('usr_access_level') == 3): ?>
              <li <?php if ($this->uri->segment(1) == 'trabajos' && $this->uri->segment(2) == FALSE):  ; ?>
                    <?php echo 'class="active">'; ?>
                    <?php echo anchor('trabajos', 'Trabajos') . '</li>' ; ?>
                  <?php elseif ($this->uri->segment(1) == 'trabajos' && $this->uri->segment(2) == 'ver_guias'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('trabajos/ver_guias/'. $this->uri->segment(3),'Guías de Remisión') . '</li>'; ?>
                    <?php echo '<li>' .  anchor('trabajos/nueva_guia/'. $this->uri->segment(3),'Nueva Guía'); ?>
                  <?php elseif ($this->uri->segment(1) == 'trabajos' && $this->uri->segment(2) == 'nueva_guia'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li>' .  anchor('trabajos/ver_guias/'. $this->uri->segment(3),'Guías de Remisión') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('trabajos/nueva_guia/'. $this->uri->segment(3),'Nueva Guía'); ?>                    
                  <?php elseif ($this->uri->segment(1) == 'incidencias' && $this->uri->segment(2) == 'ver_incidencias'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('incidencias/ver_incidencias/'. $this->uri->segment(3),'Incidencias') . '</li>'; ?>
                    <?php echo '<li>' .  anchor('incidencias/nueva_incidencia/'. $this->uri->segment(3),'Nueva Incidencia'); ?>                    
                  <?php elseif ($this->uri->segment(1) == 'incidencias' && $this->uri->segment(2) == 'nueva_incidencia'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li>' .  anchor('incidencias/ver_incidencias/'. $this->uri->segment(3),'incidencias') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('incidencias/nueva_incidencia/'. $this->uri->segment(3),'Nueva Incidencia'); ?>                     
                  <?php endif; ?>
              </li>         
            <?php elseif ($this->session->userdata('usr_access_level') == 4): ?>
              <li <?php if ($this->uri->segment(1) == 'trabajos' && $this->uri->segment(2) == FALSE):  ; ?>
                    <?php echo 'class="active">'; ?>
                    <?php echo anchor('trabajos', 'Trabajos') . '</li>' ; ?>
                  <?php elseif ($this->uri->segment(1) == 'trabajos' && $this->uri->segment(2) == 'ver_guias'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('trabajos/ver_guias/'. $this->uri->segment(3),'Guías de Remisión') . '</li>'; ?>                   
                  <?php elseif ($this->uri->segment(1) == 'incidencias' && $this->uri->segment(2) == 'ver_incidencias'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('incidencias/ver_incidencias/'. $this->uri->segment(3),'Incidencias') . '</li>'; ?>
                    <?php echo '<li>' .  anchor('incidencias/nueva_incidencia/'. $this->uri->segment(3),'Nueva Incidencia'); ?>                    
                  <?php elseif ($this->uri->segment(1) == 'incidencias' && $this->uri->segment(2) == 'nueva_incidencia'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li>' .  anchor('incidencias/ver_incidencias/'. $this->uri->segment(3),'incidencias') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('incidencias/nueva_incidencia/'. $this->uri->segment(3),'Nueva Incidencia'); ?>                     
                  <?php elseif ($this->uri->segment(1) == 'trabajos' && $this->uri->segment(2) == 'registrar_pago'): ?>
                    <?php echo '>' .  anchor('trabajos', 'Trabajos') . '</li>'; ?>
                    <?php echo '<li class="active">' .  anchor('trabajos/registrar_pago/'. $this->uri->segment(3),'Registro de Pago') . '</li>'; ?>                     
                  <?php endif; ?>
              </li>         
            <?php endif ; ?>            
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trabajos <span class="caret"></span></a>
              <ul class="dropdown-menu">

              </ul>
            </li>-->
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            <!--<?php if ($this->session->userdata('logged_in') == TRUE) : ?>
              <li><?php echo anchor('signin/signout', 'Cerrar sesion') ; ?></li>
            <?php else : ?>
              <li><?php echo anchor('signin/signin', 'signin') ; ?></li>
            <?php endif ; ?>
            -->

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo ucfirst($usuario_nombre) . ' ' . ucfirst($usuario_apellido) . ' - ' . 'Area de ' . ucfirst($usuario_area)  ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Cambiar Contraseña</a></li>
                <li role="separator" class="divider"></li>
                <li><?php echo anchor('signin/signout', 'Cerrar Sesión') ; ?></li>
              </ul>
            </li>

          </ul>   

        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!--<div class="container-fluid">
      <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>">Sistema de Seguimiento de Trabajos</a>
          </li>
          <li><a href="http://startbootstrap.tumblr.com">Blog</a></li>
          <li class="active">Start Bootstrap Blog</li>
      </ol>
    </div>-->

    <div class="container-fluid">

