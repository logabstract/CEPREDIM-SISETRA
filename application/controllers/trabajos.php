<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trabajos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Trabajos_model');
		$this->load->model('Usuarios_model');
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');

		if ($this->session->userdata('logged_in') == FALSE) {
			redirect('signin');
		}
	}

	public function index()
	{
		$data['page_heading'] = 'Trabajos en Producción';
		$data['query'] = $this->Trabajos_model->get_all_trabajos($this->session->userdata('usr_id'));
		$query_detalle_usuario = $this->Usuarios_model->get_detalle_usuario($this->session->userdata('usr_id'));

		foreach ($query_detalle_usuario->result() as $row) {
			$data['usuario_nombre'] = $row->usu_nombre;
			$data['usuario_apellido'] = $row->usu_apellido;
			$data['usuario_area'] = $row->are_nombre;
		}

		$this->load->view('common/header',$data);
		$this->load->view('nav/top_nav', $data);
		$this->load->view('trabajos/view_all_trabajos', $data);
		$this->load->view('common/footer', $data);
	}

	public function new_trabajo()
	{
	    $data['page_heading'] = 'Nuevo Trabajo';
	    $data['vendedor'] = $this->Trabajos_model->getVendedores();
	    $data['cliente'] = $this->Trabajos_model->getClientes();
	    $data['tip_trabajo'] = $this->Trabajos_model->getTiposTrabajo();

		$query_detalle_usuario = $this->Usuarios_model->get_detalle_usuario($this->session->userdata('usr_id'));

		foreach ($query_detalle_usuario->result() as $row) {
			$data['usuario_nombre'] = $row->usu_nombre;
			$data['usuario_apellido'] = $row->usu_apellido;
			$data['usuario_area'] = $row->are_nombre;
		}

		$this->form_validation->set_rules('tra_orden', 'Orden de Taller', 'required|min_length[1]|max_length[125]|integer|is_natural');
		$this->form_validation->set_rules('tra_fecha_orden', 'Fecha Orden de Impresión', 'required|trim|callback_fecha_orden_check');
	    $this->form_validation->set_rules('tip_trabajo','Tipo de Trabajo' , 'callback_combo_check');
	    $this->form_validation->set_rules('vendedor', 'Vendedor', 'callback_combo_check');
	    $this->form_validation->set_rules('cliente', 'Cliente', 'callback_combo_check');
	    $this->form_validation->set_rules('tra_titulo', 'Título' , 'required|min_length[1]|max_length[125]');
	    $this->form_validation->set_rules('tra_tiraje', 'Tiraje', 'required|min_length[1]|max_length[255]|integer|is_natural');
	    $this->form_validation->set_rules('tra_fecha_produccion', 'Fecha de producción', 'required|trim|callback_fecha_produccion_check');
	    $this->form_validation->set_rules('tra_fecha_entrega', 'Fecha de Entrega', 'trim|callback_fecha_entrega_check');
	    $this->form_validation->set_rules('tra_precio_total','Precio Total','required|trim|numeric|greater_than[0.99]');
	    $this->form_validation->set_rules('tra_descripcion', 'Detalle', 'required|min_length[1]|max_length[125]');


	    if ($this->form_validation->run() == FALSE) {

	    	$data['tra_orden'] = array('name' => 'tra_orden', 'class' => 'form-control', 'id' => 'tra_orden', 'value' => set_value('tra_orden', ''), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_fecha_orden'] = array('name' => 'tra_fecha_orden', 'class' => 'form-control', 'id' => 'tra_fecha_orden', 'value' => set_value('tra_fecha_orden', ''), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_titulo'] = array('name' => 'tra_titulo', 'class' => 'form-control', 'id' => 'tra_titulo', 'data-date-format' => 'MM/DD/YYYY', 'value' => set_value('tra_titulo', ''), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_tiraje'] = array('name' => 'tra_tiraje', 'class' => 'form-control', 'id' => 'tra_tiraje', 'data-date-format' => 'MM/DD/YYYY', 'value' => set_value('tra_tiraje', ''), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_fecha_produccion'] = array('name' => 'tra_fecha_produccion', 'class' => 'form-control', 'id' => 'tra_fecha_produccion', 'value' => set_value('tra_fecha_produccion', ''), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_fecha_entrega'] = array('name' => 'tra_fecha_entrega', 'class' => 'form-control', 'id' => 'tra_fecha_entrega', 'value' => set_value('tra_fecha_entrega', ''), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_precio_total'] = array('name' => 'tra_precio_total', 'class' => 'form-control', 'id' => 'tra_precio_total', 'value' => set_value('tra_precio_total', ''), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_descripcion'] = array('name' => 'tra_descripcion', 'class' => 'form-control', 'id' => 'tra_descripcion', 'value' => set_value('tra_descripcion', ''), 'maxlength'   => '100', 'rows' => '2');


	    	$this->load->view('common/header',$data);
	    	$this->load->view('nav/top_nav', $data);
	    	$this->load->view('trabajos/new_trabajo',$data);
	    	$this->load->view('common/footer',$data);
	    } else {

	    	$data = array(
		        'tra_orden' => $this->input->post('tra_orden'),
		        'tra_fecha_orden' => date('Y-m-d', strtotime($this->input->post('tra_fecha_orden'))),
		        'idtipo_trabajo' => $this->input->post('tip_trabajo'),
		        'idvendedor' => $this->input->post('vendedor'),
		        'idcliente' => $this->input->post('cliente'),
		        'tra_titulo' => $this->input->post('tra_titulo'),
		        'tra_tiraje' => $this->input->post('tra_tiraje'),
		        'tra_fecha_entrega' => date('Y-m-d', strtotime($this->input->post('tra_fecha_entrega'))),
		        'tra_fecha_produccion' => date('Y-m-d', strtotime($this->input->post('tra_fecha_produccion'))),
		        'tra_precio_total' => $this->input->post('tra_precio_total'),
		        'tra_descripcion' => $this->input->post('tra_descripcion'),
		      );

	    	$trabajoid = $this->Trabajos_model->create_trabajo($data);

	    	$query_usuarios = $this->Trabajos_model->obtener_usuarios();

	    	foreach ($query_usuarios->result() as $row) {
		    	$data1 = array(
			        'idtrabajo' => $trabajoid,
			        'idusuario' => $row->idusuario,
			        'con_cuenta' => 0,
			      );

	    		$this->Trabajos_model->create_counter($data1);		    	
	    	}

	    	redirect('trabajos');
	    	
	    }

	}

	public function fecha_orden_check($param){
		date_default_timezone_set('America/Lima');
		if (date('d-m-Y',strtotime($param)) < date('d-m-Y')) {
			$this->form_validation->set_message('fecha_orden_check', 'La fecha ingresada :'. $param . ' es anterior a la fecha actual');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function fecha_produccion_check($param){
		date_default_timezone_set('America/Lima');
		if (date('d-m-Y',strtotime($param)) < date('d-m-Y',strtotime($this->input->post('tra_fecha_orden')))) {
			$this->form_validation->set_message('fecha_produccion_check', 'La fecha ingresada : '. $param . ' es anterior a la fecha de creación de la orden de impresión : ' . $this->input->post('tra_fecha_orden'));
			return FALSE;
		} else {
			return TRUE;
		}

	}	

	public function fecha_entrega_check($param){
		date_default_timezone_set('America/Lima');
		if ($this->input->post('tra_fecha_entrega')) {

			$str = '';

			if (date('d-m-Y',strtotime($param)) < date('d-m-Y',strtotime($this->input->post('tra_fecha_orden')))) {
				$str .= 'La fecha ingresada : '. $param . ' es anterior a la fecha de creación de la orden de impresión : ' . $this->input->post('tra_fecha_orden'); 
			} 

			if (date('d-m-Y',strtotime($param)) < date('d-m-Y',strtotime($this->input->post('tra_fecha_produccion')))) {
				$str .= '<br><br>La fecha ingresada : '. $param . ' es anterior a la fecha de producción del trabajo : ' . $this->input->post('tra_fecha_produccion');
			}

			if (date('d-m-Y',strtotime($param)) < date('d-m-Y',strtotime($this->input->post('tra_fecha_orden'))) || date('d-m-Y',strtotime($param)) < date('d-m-Y',strtotime($this->input->post('tra_fecha_produccion')))) {
				$this->form_validation->set_message('fecha_entrega_check', $str);
				return FALSE;
			} else {
				return TRUE;
			}

		} else {
			return TRUE;
		}

	}	

	public function edit_trabajo(){
		
		$data['page_heading'] = 'Editar Trabajo';
	    $data['vendedor'] = $this->Trabajos_model->getVendedores();
	    $data['cliente'] = $this->Trabajos_model->getClientes();
	    $data['tip_trabajo'] = $this->Trabajos_model->getTiposTrabajo();

		$query_detalle_usuario = $this->Usuarios_model->get_detalle_usuario($this->session->userdata('usr_id'));

		foreach ($query_detalle_usuario->result() as $row) {
			$data['usuario_nombre'] = $row->usu_nombre;
			$data['usuario_apellido'] = $row->usu_apellido;
			$data['usuario_area'] = $row->are_nombre;
		}		

		$this->form_validation->set_rules('tra_orden', 'Orden de Taller', 'required|min_length[1]|max_length[125]|integer|is_natural');
		$this->form_validation->set_rules('tra_fecha_orden', 'Fecha Orden de Impresión', 'required|min_length[1]|max_length[125]');
	    $this->form_validation->set_rules('tip_trabajo','Tipo de Trabajo' , 'callback_combo_check');
	    $this->form_validation->set_rules('vendedor', 'Vendedor', 'callback_combo_check');
	    $this->form_validation->set_rules('cliente', 'Cliente', 'callback_combo_check');
	    $this->form_validation->set_rules('tra_titulo', 'Título' , 'required|min_length[1]|max_length[125]');
	    $this->form_validation->set_rules('tra_tiraje', 'Tiraje', 'required|min_length[1]|max_length[255]|integer|is_natural');
	    $this->form_validation->set_rules('tra_fecha_produccion', 'Fecha de producción', 'required|min_length[1]|max_length[125]');
	    $this->form_validation->set_rules('tra_fecha_entrega', 'Fecha de Entrega', 'min_length[1]|max_length[125]');
	    $this->form_validation->set_rules('tra_precio_total','Precio Total','required|numeric|greater_than[0.99]');
	    $this->form_validation->set_rules('tra_descripcion', 'Detalle', 'required|min_length[1]|max_length[125]');		

        if ($this->input->post()) {
	      $id = $this->input->post('idtrabajo');
	    } else {
	      $id = $this->uri->segment(3); 
	    }

        if ($this->form_validation->run() == FALSE) { // First load, or problem with form
    		$query = $this->Trabajos_model->get_trabajo_detalle($id);
    		foreach ($query->result() as $row) {
    			$tra_orden = $row->tra_orden;
    			$tra_fecha_orden = date('d-m-Y', strtotime($row->tra_fecha_orden));
    			$idtipo_trabajo = $row->idtipo_trabajo;
    			$idvendedor = $row->idvendedor;
    			$idcliente = $row->idcliente;
    			$tra_titulo = $row->tra_titulo;
    			$tra_tiraje = $row->tra_tiraje;
    			$tra_fecha_entrega = date('d-m-Y', strtotime($row->tra_fecha_entrega));
    			$tra_fecha_produccion = date('d-m-Y', strtotime($row->tra_fecha_produccion));
    			$tra_precio_total = $row->tra_precio_total;
    			$tra_descripcion = $row->tra_descripcion;
    		}


    		$data['id'] = array('idtrabajo' => set_value('idtrabajo', $id));
    		$data['tra_orden'] = array('name' => 'tra_orden', 'class' => 'form-control', 'id' => 'tra_orden', 'value' => set_value('tra_orden', $tra_orden), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_fecha_orden'] = array('name' => 'tra_fecha_orden', 'class' => 'form-control', 'id' => 'tra_fecha_orden', 'value' => set_value('tra_fecha_orden', $tra_fecha_orden), 'maxlength'   => '100', 'size' => '35');
    		$data['idtipo_trabajo'] = array('idtipo_trabajo' => set_value('idtipo_trabajo', $idtipo_trabajo));
    		$data['idvendedor'] = array('idvendedor' => set_value('idvendedor', $idvendedor));
    		$data['idcliente'] = array('idcliente' => set_value('idcliente', $idcliente));
	    	$data['tra_titulo'] = array('name' => 'tra_titulo', 'class' => 'form-control', 'id' => 'tra_titulo', 'value' => set_value('tra_titulo', $tra_titulo), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_tiraje'] = array('name' => 'tra_tiraje', 'class' => 'form-control', 'id' => 'tra_tiraje', 'value' => set_value('tra_tiraje', $tra_tiraje), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_fecha_produccion'] = array('name' => 'tra_fecha_produccion', 'class' => 'form-control', 'id' => 'tra_fecha_produccion', 'value' => set_value('tra_fecha_produccion', $tra_fecha_produccion), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_fecha_entrega'] = array('name' => 'tra_fecha_entrega', 'class' => 'form-control', 'id' => 'tra_fecha_entrega', 'value' => set_value('tra_fecha_entrega', $tra_fecha_entrega), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_precio_total'] = array('name' => 'tra_precio_total', 'class' => 'form-control', 'id' => 'tra_precio_total', 'value' => set_value('tra_precio_total', $tra_precio_total), 'maxlength'   => '100', 'size' => '35');
	    	$data['tra_descripcion'] = array('name' => 'tra_descripcion', 'class' => 'form-control', 'id' => 'tra_descripcion', 'value' => set_value('tra_descripcion', $tra_descripcion), 'maxlength'   => '100', 'rows' => '2');

	    	$this->load->view('common/header', $data);
	    	$this->load->view('nav/top_nav', $data);
	      	$this->load->view('trabajos/edit_trabajo', $data);
      		$this->load->view('common/footer', $data);
      	} else {
	    	$data = array(
		        'tra_orden' => $this->input->post('tra_orden'),
		        'tra_fecha_orden' => date('Y-m-d', strtotime($this->input->post('tra_fecha_orden'))),
		        'idtipo_trabajo' => $this->input->post('tip_trabajo'),
		        'idvendedor' => $this->input->post('vendedor'),
		        'idcliente' => $this->input->post('cliente'),
		        'tra_titulo' => $this->input->post('tra_titulo'),
		        'tra_tiraje' => $this->input->post('tra_tiraje'),
		        'tra_fecha_produccion' => date('Y-m-d', strtotime($this->input->post('tra_fecha_produccion'))),
		        'tra_fecha_entrega' => date('Y-m-d', strtotime($this->input->post('tra_fecha_entrega'))),
		        'tra_precio_total' => $this->input->post('tra_precio_total'),
		        'tra_descripcion' => $this->input->post('tra_descripcion'),
		      );

	    	$this->Trabajos_model->update_trabajo($id,$data);
	    	redirect('trabajos');      		
      	}

	}

	function combo_check($str){
		if ($str == '-SELECT-')
        {
            $this->form_validation->set_message('combo_check', 'Valid %s Name is required');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
	}

	public function detalle_trabajo($id){
		$data['page_heading'] = 'Detalle Trabajo';

		$query = $this->Trabajos_model->get_trabajo_detalle($id);
		foreach ($query->result() as $row) {
    			echo "Orden de Impresión: " . $row->tra_orden . "<br>";
    			echo "Fecha Orden de Impresión: " . $row->tra_fecha_orden . "<br>";
    			echo "Tipo de trabajo: " . $row->idtipo_trabajo . "<br>";
    			echo "Vendedor: " . $row->idvendedor . "<br>";
    			echo "Cliente: " . $row->idcliente . "<br>";
    			echo "Título: " . $row->tra_titulo . "<br>";
    			echo "Tiraje: " . $row->tra_tiraje . "<br>";
    			echo "Fecha de Entrega: " . $row->tra_fecha_entrega . "<br>";
    			echo "Fecha de producción: " . $row->tra_fecha_produccion . "<br>";
    			echo "Precio Total: S/." . $row->tra_precio_total . "<br>";
    			echo "Descripción: " . $row->tra_descripcion . "<br>";
    		}
	}


	public function ver_guias($id){
		$data['page_heading'] = 'Guias de Remisión entregadas del trabajo';	
		$trabajo = $this->Trabajos_model->get_trabajo_detalle($id);

		$query_detalle_usuario = $this->Usuarios_model->get_detalle_usuario($this->session->userdata('usr_id'));

		foreach ($query_detalle_usuario->result() as $row) {
			$data['usuario_nombre'] = $row->usu_nombre;
			$data['usuario_apellido'] = $row->usu_apellido;
			$data['usuario_area'] = $row->are_nombre;
		}

		$this->load->model('Clientes_model');
		
		foreach ($trabajo->result() as $row) {
			$idcliente = $row->idcliente;
			$cliente = $this->Clientes_model->get_cliente_detalle($row->idcliente);
			foreach ($cliente->result() as $row2) {
				$data['cli_nombre'] = $row2->cli_nombre;
				$dependencia = $this->Clientes_model->get_dependencia($row2->iddependencia);
				foreach ($dependencia->result() as $row3) {
					$data['dep_nombre'] = $row3->dep_nombre;
				}
			}
			$data['tra_titulo'] = $row->tra_titulo;
		}

		$this->load->model('Guias_model');

		$data['query'] = $this->Guias_model->get_all_guias($id);
		$this->load->view('common/header',$data);
		$this->load->view('nav/top_nav', $data);
		$this->load->view('trabajos/guias', $data);
		$this->load->view('common/footer', $data);
	}

	public function nueva_guia(){
		date_default_timezone_set('America/Lima');
		$data['page_heading'] = 'Nueva Guia de Remisión';

		$query_detalle_usuario = $this->Usuarios_model->get_detalle_usuario($this->session->userdata('usr_id'));

		foreach ($query_detalle_usuario->result() as $row) {
			$data['usuario_nombre'] = $row->usu_nombre;
			$data['usuario_apellido'] = $row->usu_apellido;
			$data['usuario_area'] = $row->are_nombre;
		}

		$this->form_validation->set_rules('gui_numero', 'Número de Guía', 'required|trim|min_length[1]|max_length[125]|is_unique[guias.gui_numero]');
		$this->form_validation->set_rules('gui_fecha', 'Fecha Guía', 'required|trim|callback_fecha_guia_check');
		$this->form_validation->set_rules('gui_cantidad', 'Cantidad Entregada', 'required|trim|callback_cantidad_entregada_check');
		$this->form_validation->set_rules('gui_scan', 'Guia', 'callback_file_selected_test|is_unique[guias.gui_scan]');

        if ($this->input->post()) {
	      $idtrabajo = $this->input->post('idtrabajo');
	    } else {
	      $idtrabajo = $this->uri->segment(3); 
	    }		


		if ($this->form_validation->run() == FALSE) {
	    	$data['gui_numero'] = array('name'=> 'gui_numero', 'class' => 'form-control', 'id' => 'gui_numero', 'value' => set_value('gui_numero', ''), 'maxlength'   => '100'); 			
	    	$data['gui_fecha'] = array('name'=> 'gui_fecha', 'class' => 'form-control', 'id' => 'gui_fecha', 'value' => set_value('gui_fecha', ''), 'maxlength'   => '100'); 			
	    	$data['gui_cantidad'] = array('name'=> 'gui_cantidad', 'class' => 'form-control', 'id' => 'gui_cantidad', 'value' => set_value('gui_cantidad', ''), 'maxlength'   => '100'); 				    	
	    	$data['gui_scan'] = array('name'=> 'gui_scan', 'class' => 'filestyle','data-buttonText' => 'Seleccionar Archivo', 'id' => 'gui_scan');
	    	$data['idtrabajo'] = array('idtrabajo' => set_value('idtrabajo', $idtrabajo)); 

		    $this->load->view('common/header',$data);
	    	$this->load->view('nav/top_nav', $data);
	    	$this->load->view('trabajos/nueva_guia' ,$data);
	    	$this->load->view('common/footer',$data);
		} else {

			if (!is_dir('application/uploads/' . $idtrabajo)){
				mkdir('application/uploads/' . $idtrabajo, 0777, true);
			}

			if (!is_dir('application/uploads/' . $idtrabajo . '/guias/')){
				mkdir('application/uploads/' . $idtrabajo . '/guias/', 0777, true);
			}

			$config['upload_path'] = 'application/uploads/' . $idtrabajo . '/guias/' ;
			$config['allowed_types'] = 'pdf|jpg|png';
			$config['max_size']  = '2000000';
			//$config['max_width']  = '1024';
			//$config['max_height']  = '768';
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('gui_scan')){
				$error = array('error' => $this->upload->display_errors());
			} else {
				$upload_data = $this->upload->data();
				$data1 = array(
		    		'gui_numero' => $this->input->post('gui_numero'),
			        'gui_fecha' => date('Y-m-d',strtotime($this->input->post('gui_fecha'))),
			        'gui_cantidad' => $this->input->post('gui_cantidad'),
			        'idtrabajo' => $this->input->post('idtrabajo'),
			        'gui_scan' => $upload_data['file_name'],
			      );	

		    	$data2 = array(
			        'inc_fecha' => date("Y-m-d H:i:s", time()),
			        'inc_detalle' => 'Se registró la guia N°' . $this->input->post('gui_numero') . ' por ' . $this->input->post('gui_cantidad') . ' unidades',
			        'idtrabajo' =>$this->input->post('idtrabajo'),
			        'idusuario' => $this->session->userdata('usr_id'),
		      	);

      	    	$this->load->model('Guias_model');
	    		$this->Guias_model->create_guia($data1);

	    		// crear una nueva incidencia por la guia ingresada

	    		$this->load->model('Incidencias_model');
	    		$this->Incidencias_model->create_incidencia($data2);


	    		// sumar en uno el contador de incidencias de todos los usuarios
		    	$query_usuarios = $this->Trabajos_model->obtener_usuarios();

		    	foreach ($query_usuarios->result() as $row) {

		    		$query_count = $this->Trabajos_model->getCountIncidencia($idtrabajo,$row->idusuario);

		    		foreach ($query_count->result() as $row1) {
				    	$data2 = array(	    		
					        'con_cuenta' => $row1->con_cuenta + 1,
					      );
		    		}

			    	$this->Trabajos_model->update_incidencias_counter($idtrabajo,$row->idusuario,$data2);
		    	}

		    	// redireccionar al usuario a ver los trabajos
	    		redirect('trabajos/ver_guias/'. $idtrabajo);			
			}				

			
		}		
	}

	function cantidad_entregada_check($param){

		if (ctype_digit($param)) {
			if (intval($param)==0) {
				$this->form_validation->set_message('cantidad_entregada_check', 'No puede ser cero');
				return FALSE;
			} else {
				

				//hallar el tiraje del trabajo
				$query_tiraje = $this->Trabajos_model->obtener_tiraje_trabajo($this->input->post('idtrabajo'));

				foreach ($query_tiraje->result() as $row) {
					$tiraje = $row->tra_tiraje;
				}

				//hallar la suma de las cantidades de las guias registradas
				$query_suma_cantidad_guias = $this->Trabajos_model->obtener_suma_cantidad_guias($this->input->post('idtrabajo'));

				foreach ($query_suma_cantidad_guias->result() as $row2) {
					$total_cantidad_guias = $row2->suma;
				}

				if ($tiraje >= $total_cantidad_guias + $this->input->post('gui_cantidad')) {
					return TRUE;
				} else {
					$this->form_validation->set_message('cantidad_entregada_check', 'La cantidad total de las guias debe ser menor o igual que el tiraje total: '. $tiraje);
					return FALSE;
				}
			}
		} else {

			$this->form_validation->set_message('cantidad_entregada_check', 'Debe ingresar un número entero positivo');
			return FALSE;
		}
	}

	function fecha_guia_check($param){

		$query_fecha_orden = $this->Trabajos_model->obtener_fecha_orden($this->input->post('idtrabajo'));

		foreach ($query_fecha_orden->result() as $row) {
			$fecha_orden = $row->tra_fecha_orden;
		}

		if ($this->input->post('gui_fecha')) {
			if (strtotime($this->input->post('gui_fecha')) < strtotime($fecha_orden)) {
				$this->form_validation->set_message('fecha_guia_check', 'La fecha ingresada '. $param . ' es anterior a la fecha de ingreso de la orden de taller: '. $fecha_orden);
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			return TRUE;
		}

	}

	function file_selected_test(){
		
    	if (empty($_FILES['gui_scan']['name'])) {
    		$this->form_validation->set_message('file_selected_test', 'Please select file.');
            return false;
        }else{
            return true;
        }
	}

	public function download($idtrabajo,$guias,$nombre){
		$this->load->helper('download');

		$data = file_get_contents(APPPATH .'/uploads/' . $idtrabajo . '/' . $guias . '/' .$nombre);

		force_download($nombre, $data);
	}

	public function registrar_pago(){
		$data['page_heading'] = 'Registrar Pago';

		$query_detalle_usuario = $this->Usuarios_model->get_detalle_usuario($this->session->userdata('usr_id'));

		foreach ($query_detalle_usuario->result() as $row) {
			$data['usuario_nombre'] = $row->usu_nombre;
			$data['usuario_apellido'] = $row->usu_apellido;
			$data['usuario_area'] = $row->are_nombre;
		}

		$this->form_validation->set_rules('tra_com_numero', 'Número', 'required|trim|min_length[1]|max_length[125]|is_unique[trabajos.tra_com_numero]');
		$this->form_validation->set_rules('tra_com_fecha', 'Fecha', 'required|trim|min_length[1]|max_length[125]');

        if ($this->input->post()) {
	      $idtrabajo = $this->input->post('idtrabajo');
	    } else {
	      $idtrabajo = $this->uri->segment(3); 
	    }

		if ($this->form_validation->run() == FALSE) {
			$data['tra_com_numero'] = array('name' => 'tra_com_numero', 'class' => 'form-control', 'id' => 'tra_com_numero', 'value' => set_value('tra_com_numero', ''), 'maxlength'   => '100', 'size' => '35');
			$data['tra_com_fecha'] = array('name' => 'tra_com_fecha', 'class' => 'form-control', 'id' => 'tra_com_fecha', 'value' => set_value('tra_com_fecha', ''), 'maxlength'   => '100', 'size' => '35');
			$data['idtrabajo'] = array('idtrabajo' => set_value('idtrabajo', $idtrabajo)); 
		
			$this->load->view('common/header',$data);
			$this->load->view('nav/top_nav', $data);
			$this->load->view('trabajos/registrar_pago', $data);
			$this->load->view('common/footer', $data);	
		} else {
			$data = array(
		        'tra_com_numero' => $this->input->post('tra_com_numero'),
		        'tra_com_fecha' => date('Y-m-d',strtotime($this->input->post('tra_com_fecha'))),
	      	);

	    	$data2 = array(
		        'inc_fecha' => date("Y-m-d H:i:s", time()),
		        'inc_detalle' => 'Se registró el pago del trabajo con comprobante de pago N°' . $this->input->post('tra_com_numero'),
		        'idtrabajo' =>$this->input->post('idtrabajo'),
		        'idusuario' => $this->session->userdata('usr_id'),
	      	);	      	

	      	$this->Trabajos_model->update_trabajo($idtrabajo,$data);

    		// crear una nueva incidencia por la guia ingresada

    		$this->load->model('Incidencias_model');
    		$this->Incidencias_model->create_incidencia($data2);


    		// sumar en uno el contador de incidencias de todos los usuarios
	    	$query_usuarios = $this->Trabajos_model->obtener_usuarios();

	    	foreach ($query_usuarios->result() as $row) {

	    		$query_count = $this->Trabajos_model->getCountIncidencia($idtrabajo,$row->idusuario);

	    		foreach ($query_count->result() as $row1) {
			    	$data2 = array(	    		
				        'con_cuenta' => $row1->con_cuenta + 1,
				      );
	    		}

		    	$this->Trabajos_model->update_incidencias_counter($idtrabajo,$row->idusuario,$data2);
	    	}    		

	    	redirect('trabajos'); 
		}
	}


}

/* End of file users.php $this->input->post('gui_fecha')*/
/* Location: ./application/controllers/users.php */