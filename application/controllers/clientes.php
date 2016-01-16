<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Clientes_model');
	}


	public function detalle_cliente($id){
		$data['page_heading'] = 'Detalle Cliente';

		$query = $this->Clientes_model->get_cliente_detalle($id);
		foreach ($query->result() as $row) {
    			echo "Nombre: " . $row->cli_nombre . "<br>";
    			echo "Dirección: " . $row->cli_direccion . "<br>";
    			echo "Teléfono 1: " . $row->cli_telefono1 . "<br>";
    			echo "Teléfono 2: " . $row->cli_telefono2 . "<br>";
    			echo "Celular: " . $row->cli_celular . "<br>";
    			echo "Email 1: " . $row->cli_email1 . "<br>";
    			echo "Email 2: " . $row->cli_email2 . "<br>";
    			echo "Procedencia: " . $row->cli_procedencia . "<br>";
    			echo "Dependencia: " . $row->iddependencia . "<br>";
    			echo "Empresa: " . $row->idempresa . "<br>";
    		}
	}		

}

/* End of file clientes.php */
/* Location: ./application/controllers/clientes.php */