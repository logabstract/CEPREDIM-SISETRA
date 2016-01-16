<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function crear_usuario($data){
		if($this->db->insert('usuarios', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function get_detalle_usuario($usr_id){
		$this->db->select('u.usu_nombre, u.usu_apellido, a.are_nombre');
		$this->db->from('usuarios as u');
		$this->db->join('areas as a', 'u.idarea=a.idarea');
		$this->db->where('u.idusuario', $usr_id);
		$query = $this->db->get();

		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios_model.php */