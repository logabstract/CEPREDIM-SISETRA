<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guias_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_all_guias($id){
		$this->db->select("g.idguia, g.gui_numero,DATE_FORMAT(g.gui_fecha,'%d/%m/%Y') as gui_fecha, g.gui_cantidad, g.gui_scan,g.gui_estado");
		$this->db->from('guias as g');
		$this->db->where('g.idtrabajo', $id);
		$this->db->order_by("g.idguia", "asc");

		return $this->db->get();
	}		

	public function create_guia($data){
		if($this->db->insert('guias', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}		
	}	
}

/* End of file guias_model.php */
/* Location: ./application/models/guias_model.php */