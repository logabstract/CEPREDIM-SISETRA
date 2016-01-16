<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">','</div>');
	}


	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect('trabajos');
		} else {
			$this->form_validation->set_rules('usr_name', 'Username', 'trim|required');
			$this->form_validation->set_rules('usr_password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('common/login_header');
				$this->load->view('trabajos/signin');
				$this->load->view('common/footer');
			} else {
				$usr_name = $this->input->post('usr_name');
				$password = $this->input->post('usr_password');

				$this->load->model('Signin_model');
				$query = $this->Signin_model->does_user_exist($usr_name);

				if ($query->num_rows() == 1) {
					foreach ($query->result() as $row) {
						if ($password != $row->usu_password) {
							$data['login_fail'] = true;
							$this->load->view('common/login_header');
							$this->load->view('trabajos/signin', $data);
							$this->load->view('common/footer');
						} else{
							$data = array(
								'usr_id' => $row->idusuario,
								'usr_access_level' => $row->usu_access_level,
								'logged_in' => TRUE
								);

							//Save data to session
							$this->session->set_userdata($data);
							redirect('trabajos');
							
						}
					}
				} else {
					$data['login_fail'] = true;
					$this->load->view('common/login_header');
					$this->load->view('trabajos/signin', $data);
					$this->load->view('common/footer');
				}
			}
		}
		
	}

	public function signout() {
		$this->session->sess_destroy();
		redirect('signin');
	}

}

/* End of file signin.php */
/* Location: ./application/controllers/signin.php */