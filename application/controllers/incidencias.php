<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidencias extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Trabajos_model');
		$this->load->model('Incidencias_model');
		$this->load->model('Clientes_model');
		$this->load->model('Usuarios_model');
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
	}

	public function ver_incidencias($id){
		$data['page_heading'] = 'Incidencias del trabajo';	

		$query_detalle_usuario = $this->Usuarios_model->get_detalle_usuario($this->session->userdata('usr_id'));

		foreach ($query_detalle_usuario->result() as $row) {
			$data['usuario_nombre'] = $row->usu_nombre;
			$data['usuario_apellido'] = $row->usu_apellido;
			$data['usuario_area'] = $row->are_nombre;
		}

    	$data1 = array(	    		
	        'con_cuenta' => 0,
	      );	    	

    	//resetea el contador de incidencias no leidas
    	$this->Trabajos_model->update_incidencias_counter($id,$this->session->userdata('usr_id'),$data1);

		$trabajo = $this->Trabajos_model->get_trabajo_detalle($id);

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

		$data['query'] = $this->Incidencias_model->get_all_incidencias($id);

		$this->load->view('common/header',$data);
		$this->load->view('nav/top_nav', $data);
		$this->load->view('trabajos/incidencias', $data);
		$this->load->view('common/footer', $data);

	}	

	public function nueva_incidencia(){
		date_default_timezone_set('America/Lima');
		$data['page_heading'] = 'Nueva Incidencia';
		$this->form_validation->set_rules('inc_detalle', 'Detalle', 'required|min_length[1]|max_length[125]');

		$query_detalle_usuario = $this->Usuarios_model->get_detalle_usuario($this->session->userdata('usr_id'));

		foreach ($query_detalle_usuario->result() as $row) {
			$data['usuario_nombre'] = $row->usu_nombre;
			$data['usuario_apellido'] = $row->usu_apellido;
			$data['usuario_area'] = $row->are_nombre;
		}

        if ($this->input->post()) {
	      $idtrabajo = $this->input->post('idtrabajo');
	    } else {
	      $idtrabajo = $this->uri->segment(3); 
	    }	


		if ($this->form_validation->run() == FALSE) {
	    	$data['inc_detalle'] = array('name' => 'inc_detalle', 'class' => 'form-control', 'id' => 'inc_detalle', 'value' => set_value('inc_detalle', ''), 'maxlength'   => '100');			
	    	$data['idtrabajo'] = array('idtrabajo' => set_value('idtrabajo', $idtrabajo)); 

		    $this->load->view('common/header',$data);
	    	$this->load->view('nav/top_nav', $data);
	    	$this->load->view('trabajos/nueva_incidencia',$data);
	    	$this->load->view('common/footer',$data);
		} else {

			$idtrabajo = $this->input->post('idtrabajo');
			$idusuario = $this->session->userdata('usr_id');


	    	$data = array(
		        'inc_fecha' => date("Y-m-d H:i:s", time()),
		        'inc_detalle' => $this->input->post('inc_detalle'),
		        'idtrabajo' => $idtrabajo,
		        'idusuario' => $idusuario,
		      );	

	    	$this->Incidencias_model->create_incidencia($data);


	    	//aumenta en uno el contador de incidencias no leidas para los demas usuarios
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


	    	$data1 = array(	    		
		        'con_cuenta' => 0,
		      );	    	

	    	//resetea el contador de incidencias no leidas
	    	$this->Trabajos_model->update_incidencias_counter($idtrabajo,$idusuario,$data1);	    	


	    	redirect('incidencias/ver_incidencias/'. $idtrabajo);			
		}




	}

}

/* End of file incidencias.php */
/* Location: ./application/controllers/incidencias.php */