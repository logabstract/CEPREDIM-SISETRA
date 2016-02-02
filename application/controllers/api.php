<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Clientes_model');
	}

	public function clientes_get()
	{
		if(! $this->get('id'))
		{
			$clientes = $this->Clientes_model->get_all();
		} else {
			$clientes = $this->Clientes_model->get_cliente($this->get('id'));
		}

		if($clientes)
		{
			$this->response($clientes, 200);
		} else {
			$this->response([], 404);
		}
	}

}

/* End of file api.php */
/* Location: ./application/controllers/api.php */