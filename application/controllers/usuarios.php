<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here

		$this->load->model('Usuarios_model');
		$this->load->model('Trabajos_model');
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
	}

	public function crear_usuario()
	{
		$data['page_heading'] = 'Nuevo Usuario';

		$this->form_validation->set_rules('usu_nombre', 'Nombre' , 'required|min_length[1]|max_length[125]');
		$this->form_validation->set_rules('usu_apellido', 'Apellido' , 'required|min_length[1]|max_length[125]');
		$this->form_validation->set_rules('usu_password', 'Password' , 'required|min_length[1]|max_length[125]');
		$this->form_validation->set_rules('usu_access_level', 'Nivel Acceso', 'required|min_length[1]|max_length[10]|integer|is_natural');
		$this->form_validation->set_rules('idarea', 'Area Id', 'required|min_length[1]|max_length[10]|integer|is_natural');

		if ($this->form_validation->run() == FALSE) {

			$data['usu_nombre'] = array('name' => 'usu_nombre', 'class' => 'form-control', 'id' => 'usu_nombre', 'value' => set_value('usu_nombre', ''), 'maxlength'   => '100', 'size' => '35');
			$data['usu_apellido'] = array('name' => 'usu_apellido', 'class' => 'form-control', 'id' => 'usu_apellido', 'value' => set_value('usu_apellido', ''), 'maxlength'   => '100', 'size' => '35');
			$data['usu_password'] = array('name' => 'usu_password', 'class' => 'form-control', 'id' => 'usu_password', 'value' => set_value('usu_password', ''), 'maxlength'   => '100', 'size' => '35');
			$data['usu_access_level'] = array('name' => 'usu_access_level', 'class' => 'form-control', 'id' => 'usu_access_level', 'value' => set_value('usu_access_level', ''), 'maxlength'   => '100', 'size' => '35');
			$data['idarea'] = array('name' => 'idarea', 'class' => 'form-control', 'id' => 'idarea', 'value' => set_value('idarea', ''), 'maxlength'   => '100', 'size' => '35');

	    	$this->load->view('common/header',$data);
	    	$this->load->view('usuarios/crear_usuario',$data);
	    	$this->load->view('common/footer',$data);

		} else {
			$data = array(
		        'usu_nombre' => $this->input->post('usu_nombre'),
		        'usu_apellido' => $this->input->post('usu_apellido'),
		        'usu_password' => $this->input->post('usu_password'),
		        'usu_access_level' => $this->input->post('usu_access_level'),
		        'idarea' => $this->input->post('idarea'),
		      );

			//creamos al usuario y almacenamos al id automaticamente creado
			$idusuario = $this->Usuarios_model->crear_usuario($data);

			//obtenemos la lista de trabajos (ids)
			$query_trabajos = $this->Trabajos_model->get_all_trabajos_ids();

			foreach ($query_trabajos->result() as $row) {

				echo $row->counter . ' ';

		    	$data1 = array(
			        'idtrabajo' => $row->idtrabajo,
			        'idusuario' => $idusuario,
			        'con_cuenta' => $row->counter,
			      );

		    	//creamos un contador de incidencias no leidas inicializado en la cantidad de incidencias registradas 
		    	//para los trabajos creados con respecto al usuario nuevo
		    	$this->Trabajos_model->create_counter($data1);
			}

		   	//redirect('/');
		}

	}

}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */