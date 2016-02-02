<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_all()
	{
		$query = $this->db->get('clientes');
		return $query->result();
	}

	public function get_cliente_detalle($id){
		$this->db->where('idcliente', $id);
		$result = $this->db->get('clientes');

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	public function get_cliente($id) {
		$this->db->where('idcliente',$id);
		$query = $this->db->get('clientes');
		return $query->result();
	}

	public function get_dependencia($idcliente){
		$this->db->select('dep_nombre');
		$this->db->from('dependencias as d, clientes as c');
		$this->db->where('c.iddependencia=d.iddependencia');
		$this->db->where('idcliente', $idcliente);

		$result = $this->db->get();

		if ($result) {
			return $result;
		} else {
			return false;
		}		
	}

}

/* End of file clientes_model.php */
/* Location: ./application/models/clientes_model.php */