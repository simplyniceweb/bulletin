<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if($mysession) redirect('');
		$this->load->view('login');
	}
	
	public function verify() {
		$mysession = $this->session->userdata('logged');
		if($mysession) redirect('');
		
		$data = array(
			'user_email'    => $this->input->post('user_email'),
			'user_password' => sha1($this->input->post('user_password'))
		);
		
		$this->db->from('users');
		$this->db->where('user_email', $data['user_email']);
		$this->db->where('user_password', $data['user_password']);
		$login = $this->db->get();
		$this->db->limit(1);
		
		if($login->num_rows() == 0) redirect('login/?login=false');
		foreach($login->result() as $row) {

			if($row->user_status == 1) redirect('login/?ban=true');

			$department = NULL;
			$sess_array = array(
				'logged'          => TRUE,
				'user_id'         => $row->user_id,
				'user_name'       => $row->user_name,
				'user_email'      => $row->user_email,
				'user_std_id'     => $row->user_std_id,
				'user_level'      => $row->user_level,
				'user_picture'    => $row->user_picture,
			);
			
			$this->db->from('student_id');
			$this->db->where('unique', $sess_array['user_std_id']);
			$department = $this->db->get();
			
			if($department->num_rows > 0) {
				foreach($department->result() as $dept) {
					$department = $dept->department_id;
				}
			} else {
				if($sess_array['user_level'] == 0) {
					redirect('login/?std=invalid');
				}
			}
			$sess_array['department'] = $department;
		}
		$this->session->set_userdata('logged', $sess_array);

		if($sess_array['user_level'] == 0) {
			redirect('homepage');
		} else {
			redirect('index');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */