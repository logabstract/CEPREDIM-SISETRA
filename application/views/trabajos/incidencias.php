<div class="panel panel-default"> 
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed">
<legend>Incidencias | <?php echo $tra_titulo . ' - ' . $cli_nombre . ' <small>(' . $dep_nombre . ') </small>'; ?></legend>
	<thead>
		<tr>
			<th>Autor</th>
			<th>Fecha Incidencia</th>
			<th>Detalle</th>
		</tr>
	</thead>
	<tbody>
	<?php if ($query->num_rows() > 0): ?>
		<?php foreach ($query->result() as $row): ?>
			<tr>
				<td style="width:270px"><?php echo ucfirst($row->usu_nombre) . ' ' . ucfirst($row->usu_apellido) . ' - ' . 'Area de ' . ucfirst($row->are_nombre); ?></td>
				<td style="width:150px"><?php echo $row->inc_fecha; ?></td>
				<td><?php echo $row->inc_detalle; ?></td>
			</tr>
		<?php endforeach; ?>
	<?php else : ?>
		<tr>
			<td colspan="8" class="info">No incidencias here!</td>
		</tr>
	<?php endif; ?>
	</tbody>
</table>
</div>
</div>