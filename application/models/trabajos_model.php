<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trabajos_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function obtener_usuarios(){
		$this->db->select('idusuario');
		$query = $this->db->get('usuarios');

		if ($query) {
			return $query;
		} else {
			return false;
		}		

	}

	public function get_all_trabajos($usr_id){
		$this->db->select("t.idtrabajo, DATE_FORMAT(t.tra_fecha_orden, '%d-%m-%Y') as tra_fecha_orden,t.tra_orden, v.ven_nombre, c.idcliente, c.cli_nombre, d.dep_nombre, d.dep_nombre, t.tra_titulo, t.tra_tiraje,sum(g.gui_cantidad) as entregado, DATE_FORMAT(t.tra_fecha_entrega, '%d-%m-%Y') as tra_fecha_entrega, DATE_FORMAT(t.tra_fecha_produccion, '%d-%m-%Y') as tra_fecha_produccion, cm.con_cuenta");
		$this->db->from('trabajos AS t');
		$this->db->join('vendedores AS v', 'v.idvendedor = t.idvendedor');
		$this->db->join('clientes AS c', 'c.idcliente = t.idcliente');
		$this->db->join('dependencias AS d', 'd.iddependencia = c.iddependencia');
		$this->db->join('contador_mensajes AS cm', 'cm.idtrabajo = t.idtrabajo');
		$this->db->join('usuarios AS u', 'u.idusuario = cm.idusuario');
		$this->db->join('guias AS g', 'g.idtrabajo = t.idtrabajo', 'left');
		$this->db->where('u.idusuario', $usr_id);
		$this->db->group_by('t.idtrabajo');

		return $this->db->get();
	}

	public function get_all_trabajos_ids(){
		$this->db->select('t.idtrabajo,count(i.idincidencia) as counter');
		$this->db->from('trabajos as t');
		$this->db->join('incidencias AS i', 't.idtrabajo=i.idtrabajo','left');
		$this->db->group_by('t.idtrabajo'); 
		$query = $this->db->get();

		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function get_trabajo_detalle($id){
		$this->db->where('idtrabajo', $id);
		$result = $this->db->get('trabajos');

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	public function obtener_tiraje_trabajo($idtrabajo){
		$this->db->select('tra_tiraje');
		$this->db->where('idtrabajo', $idtrabajo);
		$query_tiraje = $this->db->get('trabajos');

		if ($query_tiraje) {
			return $query_tiraje;
		} else {
			return false;
		}		
	}

	public function obtener_fecha_orden($idtrabajo){
		$this->db->select('tra_fecha_orden');
		$this->db->where('idtrabajo', $idtrabajo);
		$query_fecha_orden = $this->db->get('trabajos');

		if ($query_fecha_orden) {
			return $query_fecha_orden;
		} else {
			return false;
		}			
	}

	public function obtener_suma_cantidad_guias($idtrabajo){
		$this->db->select('sum(g.gui_cantidad) as suma');
		$this->db->from('trabajos as t, guias as g');
		$this->db->where('g.idtrabajo = t.idtrabajo');
		$this->db->where('t.idtrabajo', $idtrabajo);
		$query_suma_cantidad_guias = $this->db->get();

		if ($query_suma_cantidad_guias) {
			return $query_suma_cantidad_guias;
		} else {
			return false;
		}		
	}

	public function create_trabajo($data){ 
		if($this->db->insert('trabajos', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function create_counter($data1){
		if($this->db->insert('contador_mensajes', $data1)) {
			return $this->db->insert_id();
		} else {
			return false;
		}		
	}

	public function getCountIncidencia($idtrabajo,$idusuario){
		$this->db->where('idtrabajo', $idtrabajo);
		$this->db->where('idusuario', $idusuario);
		$query = $this->db->get('contador_mensajes');

		if ($query) {
			return $query;
		} else {
			return false;
		}
	}	

	public function update_incidencias_counter($idtrabajo,$idusuario,$data1){
		$this->db->where('idtrabajo', $idtrabajo);
		$this->db->where('idusuario', $idusuario);
		if ($this->db->update('contador_mensajes', $data1)) {
			return true;
		} else {
			return false;
		}		
	}

	public function update_trabajo($id, $data){
		$this->db->where('idtrabajo', $id);
		if ($this->db->update('trabajos', $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_trabajo($id) {
		if ($this->db->delete('trabajos', array('idtrabajo' => $id))) {
			return true;
		} else {
			return false;
		}
	}

	public function getVendedores(){
		$this->db->select('idvendedor');
		$this->db->select('ven_nombre');
		$this->db->from('vendedores');
		$query = $this->db->get();
		$result = $query->result();

		// array para almacenar el id y nombre de los vendedores
		$ven_id = array('-SELECT-');
		$ven_name = array('-SELECT-');

		for ($i=0; $i < count($result); $i++) { 
			array_push($ven_id, $result[$i]->idvendedor);
			array_push($ven_name, $result[$i]->ven_nombre);
		}

		return $vendedores_result = array_combine($ven_id, $ven_name);
	}

	public function getClientes(){
		$this->db->select('c.idcliente');
		$this->db->select('c.cli_nombre');
		$this->db->select('d.dep_nombre');
		$this->db->from('clientes as c, dependencias as d');
		$query = $this->db->get();
		$result = $query->result();

		// array para almacenar el id y nombre de los clientes
		$cli_id = array('-SELECT-');
		$cli_name = array('-SELECT-');

		for ($i=0; $i < count($result); $i++) { 
			array_push($cli_id, $result[$i]->idcliente);
			array_push($cli_name, $result[$i]->cli_nombre . ' - ' . $result[$i]->dep_nombre);
		}

		return $clientes_result = array_combine($cli_id, $cli_name);		
	}

	public function getTiposTrabajo(){
		$this->db->select('idtipo_trabajo');
		$this->db->select('tip_nombre');
		$this->db->from('tipo_trabajo');
		$query = $this->db->get();
		$result = $query->result();

		// array para almacenar el id y nombre de los clientes
		$tip_id = array('-SELECT-');
		$tip_name = array('-SELECT-');

		for ($i=0; $i < count($result); $i++) { 
			array_push($tip_id, $result[$i]->idtipo_trabajo);
			array_push($tip_name, $result[$i]->tip_nombre);
		}

		return $tipos_result = array_combine($tip_id, $tip_name);		
	}

}