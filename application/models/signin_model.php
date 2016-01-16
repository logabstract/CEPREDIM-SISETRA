<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function does_user_exist($username){
		$this->db->where('usu_nombre', $username);
		$query = $this->db->get('usuarios');
		return $query;
	}

}

/* End of file signin_model.php */
/* Location: ./application/models/signin_model.php */