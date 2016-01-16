<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidencias_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_all_incidencias($id){
		$this->db->select('i.idincidencia, u.usu_nombre, u.usu_apellido, a.are_nombre, i.inc_fecha, inc_detalle');
		$this->db->from('incidencias as i, usuarios as u, areas as a');
		$this->db->where('i.idusuario=u.idusuario');
		$this->db->where('u.idarea=a.idarea');
		$this->db->where('i.idtrabajo', $id);
		$this->db->order_by("i.idincidencia", "asc");

		return $this->db->get();
	}	

	public function create_incidencia($data){
		if($this->db->insert('incidencias', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}		
	}

}

/* End of file incidencias_model.php */
/* Location: ./application/models/incidencias_model.php */