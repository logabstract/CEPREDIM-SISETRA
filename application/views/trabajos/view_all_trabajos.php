<!--<h2><?php echo $page_heading; ?></h2>-->
<?php date_default_timezone_set('America/Lima'); ?>

<div class="panel panel-default"> 
<div class="panel-body">
<table class="table table-bordered table-condensed">
<legend>Trabajos en Producción</legend>
	<thead>
		<tr>
			<th>Orden</th>
			<th>Fecha Orden</th>
			<th>Vendedor</th>
			<th>Cliente</th>
			<th>Título</th>
			<th>Tiraje</th>
			<th>Entregado</th>
			<th>Fecha Producción</th>
			<th>Fecha Entrega</th>
			<th style="text-align: center;white-space: nowrap;"></th>
		</tr>
	</thead>
	<tbody>
	<?php if ($query->num_rows() > 0): ?>
		<?php foreach ($query->result() as $row): ?>
			<?php $fecha_entrega = strtotime($row->tra_fecha_entrega); ?>
			<tr <?php if(time() >= $fecha_entrega){echo 'style="background-color:#ff3333"';} elseif (ceil(($fecha_entrega - time())/60/60/24) <= 7) {echo 'style="background-color:#ff8533"';}?> >
				<td><?php echo anchor('trabajos/detalle_trabajo/' . $row->idtrabajo,$row->tra_orden); ?></td>
				<td><?php echo $row->tra_fecha_orden; ?></td>
				<td><?php echo $row->ven_nombre; ?></td>
				<td><?php echo anchor('clientes/detalle_cliente/' . $row->idcliente,$row->cli_nombre . ' - ' . $row->dep_nombre); ?></td>
				<td><?php echo $row->tra_titulo; ?></td>
				<td><?php echo $row->tra_tiraje; ?></td>
				<td><?php echo $row->entregado; ?></td>
				<td><?php echo $row->tra_fecha_produccion; ?></td>
				<td><?php echo $row->tra_fecha_entrega; ?></td>
				<td style="text-align: center;white-space: nowrap;">
					<?php if ($this->session->userdata('usr_access_level') == 1): ?>
						<?php echo anchor('trabajos/edit_trabajo/' . $row->idtrabajo, '<button type="button" class="btn btn-default" title="Editar">Editar <span class="glyphicon glyphicon-edit"></span></button>'); ?>
					<?php endif; ?>			


					<?php echo anchor('incidencias/ver_incidencias/' . $row->idtrabajo, '<button type="button" class="btn btn-default" title="Incidencias">Incidencias <span class="badge"> '. $row->con_cuenta . '</span></button>'); ?>

					<?php if ($this->session->userdata('usr_access_level') == 3 || $this->session->userdata('usr_access_level') == 4): ?>
						<?php echo anchor('trabajos/ver_guias/' . $row->idtrabajo, '<button type="button" class="btn btn-default" title="Guias de Remisión">Guías <span class="glyphicon glyphicon-open-file"></span></button>'); ?>
					<?php endif; ?>


					<?php if ($this->session->userdata('usr_access_level') == 4): ?>
						<?php echo anchor('trabajos/registrar_pago/' . $row->idtrabajo, '<button type="button" class="btn btn-default" title="Comprobante de Pago">Registrar Pago <span class="glyphicon glyphicon-usd"></span></button>'); ?>
					<?php endif; ?>		

				</td>
			</tr>
		<?php endforeach; ?>
	<?php else : ?>
		<tr>
			<td colspan="10" class="info">No trabajos here!</td>
		</tr>
	<?php endif; ?>
	</tbody>
</table>
</div>
</div>

