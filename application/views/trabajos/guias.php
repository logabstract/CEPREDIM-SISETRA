<div class="panel panel-default"> 
<div class="panel-body">
<table class="table table-bordered table-striped table-condensed">
<legend>Guías De Remisión Entregadas | <?php echo $tra_titulo . ' - ' . $cli_nombre . ' <small>(' . $dep_nombre . ') </small>'; ?></legend>
	<thead>
		<tr>
			<th>Número</th>
			<th>Fecha Guía</th>
			<th>Cantidad Entregada</th>
			<th>Archivo Escaneado</th>
		</tr>
	</thead>
	<tbody>
	<?php if ($query->num_rows() > 0): ?>
		<?php foreach ($query->result() as $row): ?>
			<tr>
				<td><?php echo $row->gui_numero; ?></td>
				<td><?php echo $row->gui_fecha; ?></td>
				<td><?php echo $row->gui_cantidad; ?></td>
				<td ><?php echo anchor('trabajos/download/' . $this->uri->segment(3) . '/guias/' . $row->gui_scan, $row->gui_scan); ?></td>
			</tr>
		<?php endforeach; ?>
	<?php else : ?>
		<tr>
			<td colspan="8" class="info">No guias here!</td>
		</tr>
	<?php endif; ?>
	</tbody>
</table>
</div>
</div>